# Blog Platform

A comprehensive blog platform built using PHP, MySQL, HTML, CSS, and JavaScript. This project supports multiple user dashboards with role-based access, providing a flexible way for users to create and manage blog posts.

## Features

- **User Authentication**: Users can sign up with a username, email, and password.
- **User Roles**: Separate dashboards for Authors.
- **Post Management**: All posts displayed on a single page for easy access.
- **Post Creation & Editing**: Allows users to write, edit, and delete posts.
- **Draft Auto-Save**: Posts are auto-saved as drafts while being edited.
- **TinyMCE Integration**: Rich text editing enabled for creating blog content.
- **AJAX Search**: Search functionality with highlighted terms.
- **Responsive Design**: Mobile and desktop-friendly layout.
- **Session Management**: Secure and customizable session handling.

## Technology Stack

- **Backend**: PHP, MySQL
- **Frontend**: HTML5, CSS, JavaScript
- **Rich Text Editor**: TinyMCE
- **AJAX**: Used for search functionality and dynamic updates
- **Session Management**: Custom session handling for security and efficiency

## Third-Party Libraries and Dependencies

- **FontAwesome**: Used in login and sign-up pages for adding icons.  
  [FontAwesome](https://fontawesome.com/) provides scalable vector icons that can be customized.
  
- **TinyMCE**: A powerful rich text editor used to enable formatting options for blog posts.  
  [TinyMCE](https://www.tiny.cloud/) was integrated for seamless blog post creation and editing.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Safeera-banu/Blog-Platform.git

2. Navigate to the project directory:
   cd Blog-Platform

3. Import the SQL file to your database:
   Create a new database.
   Import blogs.sql into your MySQL server.

4. Configure the database connection:
   Open the db.php file.
   Set your database credentials (DB_NAME, DB_USER, DB_PASSWORD, DB_HOST).

6. Start the local development server:
   If you're using XAMPP or WAMP, place the project folder in the htdocs directory and start the Apache server.

7. Access the platform:
   Visit http://localhost/Blog-Platform in your web browser.
