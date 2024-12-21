<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\Domain;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LinkGeneratorController extends Controller
{
    public function create()
    {
        return view('pages.link-generate.list');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Eager-load the 'domain' relationship
            $urls = Url::with('domain')->get();

            return DataTables::of($urls)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-sm btn-primary edit-btn" data-id="' . $row->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>';
                })
                ->make(true);
        }

        return view('pages.link-generate.list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'urls' => 'required|url'
        ]);

        $urls = $request->input('urls');
        $parse_url = parse_url($urls);

        DB::beginTransaction();

        try {
            // Create or retrieve the domain with additional sections
            $domain_info = Domain::firstOrCreate([
                'domain_name' => $parse_url['host'],
                'scheme' => $parse_url['scheme'] ?? null,
                'path' => $parse_url['path'] ?? null,
                'query' => $parse_url['query'] ?? null,
                'fragment' => $parse_url['fragment'] ?? null
            ]);

            // Save new URL record
            if ($domain_info) {
                $new_url = new Url();
                $new_url->domain_id = $domain_info->id;
                $new_url->full_url = $urls;
                $new_url->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('url-link.list')->with('success', 'Url Submitted');
    }

    public function destroy($id)
    {
        $url = Url::find($id);
        if ($url) {
            // Find and delete the associated domain
            $domain = Domain::find($url->domain_id);
            if ($domain) {
                $domain->delete();
            }
            $url->delete();
            return response()->json(['message' => 'URL deleted successfully']);
        }
        return response()->json(['message' => 'URL not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $url = Url::find($id);
        if ($url) {
            $domain = Domain::find($url->domain_id);
            
            // Gather new values
            $scheme = $request->input('scheme');
            $domain_name = $request->input('domain_name');
            $path = $request->input('path');
            $query = $request->input('query');
            $fragment = $request->input('fragment');

            // Update domain and URL fields
            $domain->update([
                'scheme' => $scheme,
                'domain_name' => $domain_name,
                'path' => $path,
                'query' => $query,
                'fragment' => $fragment,
            ]);

            // Construct the full URL
            $full_url = $scheme . '://' . $domain_name . $path . ($query ? '?' . $query : '') . ($fragment ? '#' . $fragment : '');

            $url->update(['full_url' => $full_url]);

            return response()->json(['message' => 'URL updated successfully']);
        }
        return response()->json(['message' => 'URL not found'], 404);
    }
}
