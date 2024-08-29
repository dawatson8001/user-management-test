Task: User Management Laravel Application

Objective:
Create a new Laravel application that includes a simple user management system.

Requirements:

    Database Setup:
        Set up a database to store user data (SQLite for simplicity, but other databases are acceptable).
    API Endpoints:
        Create API endpoints for the following actions:
            Create a new user: Should accept user data and store it in the database.
            Update an existing user: Should allow updating a user's details based on their ID.
            Get an existing user: Should retrieve a user's details based on their ID.
    User Display Page:
        Develop a page that displays all users in an easy-to-view and understandable format.
        There are no strict design requirements, but the page should be user-friendly and clearly present the user data.

Using the terminal in the main directory run
bash ./vendor/laravel/sail/bin/sail up
to create a docker container with the project 

RUN 
    php artisan migrate
to create the database, then
    php artisan db:seed
to generated some random user data

SCSS file should be compiled and minified, if not RUN npm run build to generate them 

You should now have a running version of the application on localhost

The users page is accessible from '/' and should display all the user records with some of the database fields displayed as wel las a delete button
The page uses Livewire to so the filters are responsive and the CSS uses Tailwind

API Routes

localhost/api/v1/user/view/{userId} - to view a user based on the database UserId
localhost/api/v1/user/add           - to create a new user entry in the database
localhost/api/v1/user/edit          - to update a user entry in the database using the UserId in the json data supplied

Fields to send and receive via the API are:
    forename
    surname
    emailAddress
    userLevel
    creationDatetime

As an object
{
    "forename":"John",
    "surname":"Smith",
    "emailAddress": "test@test.com",
    "userLevel": "ADMIN",
    "password": "b!gS3cr3tPassw0rd"
}