# Sample PHP/Laravel

Sample Laravel project that takes any URL and extracts the part of the URL and shows it using Yajra Data-Table enabling CRUD operations. 
---

## 🚀 Getting Started  

### Open Using Daytona  

1. **Install Daytona**: Follow the [Daytona installation guide](https://www.daytona.io/docs/installation/installation/).  
2. **Create the Workspace**:  
   ```bash  
   daytona create https://github.com/daytonaio/sample-laravel-url-extractor
   ```  
3. **Install Laravel**:  
   Follow the [Laravel Installation Documentation](https://laravel.com/docs/11.x/installation) to create a new Laravel application.  
3. **Install Dependencies**:  
   Run the following command to install the project dependencies:  
   ```bash  
   composer install  
   ```  
 
5. **Set Up Environment Variables**:  
   Copy the `.env.example` file to `.env` and configure your environment variables, such as database credentials:  
   ```bash  
   cp .env.example .env  
   php artisan key:generate  
   ```  
4. **Run Database Migrations**:  
   Create a Local repository in Mysql and set username to `root` and password to `null` in `XXAMP or Laragon` [Example has been shown in the `.env.example`].
   Then run the following command in your Laravel application. 
   ```bash  
   php artisan migrate  
   ``` 
4. **Start the Application**:  
   Use the following command to start the server:  
   ```bash  
   php artisan serve
   ``` 
7. **Access the Application**:  
   Open your browser and navigate to:  
   ```
   http://localhost:8000  

   ```

---

## ✨ Features  

- **URL Link Extraction**: Allows users to extract and manage various parts of a URL (scheme, domain, path, query, fragment).
- **Dynamic Routing**: Routes for adding, listing, editing, and deleting URL links.
- **Form Handling**: Simple forms for adding new URLs to the system.
- **Pagination**: The URLs are displayed in a paginated list.
- **Data Validation**: Ensures valid URL input through form validation.
- **Error Handling**: Custom error pages for 404 and other server errors.  

---

## 📂 File Structure  

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── LinkGeneratorController.php   # Controller to handle URL operations
├── Models/                                   # Models to control Database 
│   ├── Domain.php
│   ├── Url.php
│   ├──User.php
├── resources/
│   ├── views/
│   │   ├── pages/
│   │   │   ├── layouts/      
│   │   │   │   ├── master.blade.php        
│   │   │   ├── link-generate/    
│   │   │   │   ├── list.blade.php           # URL list page template             
│   │   │   ├── home.blade.php               # Home page template
│   │   │   ├── contact.blade.php            # Contact page template  
├── routes/
│   ├── web.php                              # Web routes for the application
├── public/
│   ├── css/                                 # Static CSS files
│   ├── js/                                  # Static JavaScript files
│   ├── images/                              # Static images
├── .env                                     # Environment configuration
├── .gitignore                               # Git ignore file
├── composer.json                            # Composer dependencies
├── artisan                                  # Laravel CLI
├── README.md                                # Project documentation


```

---

## 🤝 Contribution  

Feel free to open issues or submit pull requests to improve this sample.

---

## 📝 License  

This project is licensed under the MIT License. See the `LICENSE` file for more details.