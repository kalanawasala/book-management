<h1>Book Management System </h1>
    
    This is the my first project that developed using laravel framework.The purpose of the application 
    is to handle the book managemnt events smoothly .

<h2>How to install</h1>
<h2>STEP-01</h2> You Should have installed the all of necessary softwares on your pc 
    
    php server
    Git
    composer
<h2>STEP-02</h2> clone the git repository to the location on your machine that you need to store the application.
go to that location and open your terminal there and run the git clone command.
    
    git clone <repository url>.git
<h2>STEP-03</h2> Move into the application directory using the cd command: 
    
    cd <project-location>
<h2>STEP-04</h2> Laravel uses Composer for PHP dependency management for that You has to have installed php composer in your directory 
    
    composer install
    (This command will download and install all the required packages specified in the composer.json file.)
    
<h2>STEP-05</h2> Duplicate the .env.example file and rename it to .env and open .env file and update database details as
follows.
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=book-management
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_passwords   
    (change DB_DATABASE=book-management,DB_USERNAME=root)

<h2>STEP-06</h2> Generate application key for project
    
    php artisan key:generate
    (This key is used for encrypting user sessions and other sensitive data)

<h2>STEP-07</h2> Run database migrations to create tables.
    
    php artisan migrate
    (this will create necessry tables on the database using migrations tables)
<h2>STEP-07</h2> To run the Laravel development server, use the following command:
    
    php artisan serve
<h4>After successfully following above steps, you can quickly get the project up and running in your local development environment </h4>
    
