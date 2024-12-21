@extends('pages.layouts.master')

@section('title', 'URL List')

@section('css')
<!-- DataTables CSS (with Bootstrap 4/5 integration) -->
<link href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .table td {
        word-wrap: break-word;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4>List of URLs</h4>
        <button id="addNewBtn" class="btn btn-light btn-sm">Add New URL</button>
    </div>
    <div class="card-body">
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Create Form -->
        <div id="createForm" style="display: none;" class="mb-4">
            <form action="{{url('url-link/store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="urls">URLs</label>
                    <input type="text" class="form-control" name="urls" id="urls" placeholder="Enter URLs">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- DataTable -->
        <table class="table table-bordered hover display" id="url_list">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Scheme</th>
                    <th>Domain</th>
                    <th>Path</th>
                    <th>Query</th>
                    <th>Fragment</th>
                    <th>Full URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables JS with Bootstrap 4/5 integration -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        const ajaxURL = "{{ route('url-link.list') }}";

        // Initialize DataTable
        $('#url_list').DataTable({
            dom: 'Blfrtip', // Use this to display the DataTable with Bootstrap's classes
            language: {
                processing: "<span class='loading-datatable'><span class='spinner-border spinner-border-sm'></span> Loading Data...</span>"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxURL
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'domain.scheme',
                    name: 'domain.scheme'
                },
                {
                    data: 'domain.domain_name',
                    name: 'domain.domain_name'
                },
                {
                    data: 'domain.path',
                    name: 'domain.path'
                },
                {
                    data: 'domain.query',
                    name: 'domain.query'
                },
                {
                    data: 'domain.fragment',
                    name: 'domain.fragment'
                },
                {
                    data: 'full_url',
                    name: 'full_url'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return ` 
                            <button class="btn btn-sm btn-secondary edit-btn" data-id="${row.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                        `;
                    }
                }
            ]
        });

        $(document).on('click', '.delete-btn', function() {
            const id = $(this).data('id');

            if (confirm('Are you sure you want to delete this URL?')) {
                $.ajax({
                    url: `/url-link/delete/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#url_list').DataTable().ajax.reload();
                    },
                    error: function() {
                        alert('Failed to delete the URL.');
                    }
                });
            }
        });

        $(document).on('click', '.edit-btn', function() {
            const row = $(this).closest('tr');
            const id = $(this).data('id');

            row.find('td').each(function(index) {
                const text = $(this).text();
                if (index > 0 && index < 6) {
                    $(this).html(`<input type="text" class="form-control" value="${text}">`);
                }
            });

            $(this).text('Update').removeClass('edit-btn').addClass('update-btn');
        });

        $(document).on('click', '.update-btn', function() {
            const row = $(this).closest('tr');
            const id = $(this).data('id');

            const scheme = row.find('td:eq(1) input').val();
            const domain = row.find('td:eq(2) input').val();
            const path = row.find('td:eq(3) input').val();
            const query = row.find('td:eq(4) input').val();
            const fragment = row.find('td:eq(5) input').val();

            $.ajax({
                url: `/url-link/update/${id}`,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    scheme: scheme,
                    domain_name: domain,
                    path: path,
                    query: query,
                    fragment: fragment
                },
                success: function(response) {
                    alert('URL updated successfully');


                    $('#url_list').DataTable().ajax.reload(); // Reload DataTable
                },
                error: function(xhr) {
                    let errors = '';
                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errors += value + '<br>';
                        });
                    } else {
                        errors = xhr.responseJSON.message || 'Failed to update the URL.';
                    }
                    alert(errors);
                }

            });
        });

        // Toggle Create Form
        $('#addNewBtn').click(function() {
            $('#createForm').slideToggle();
        });
    });
</script>
@endsection