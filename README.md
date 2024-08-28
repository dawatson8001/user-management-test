Using the terminal in the main directory run
bash ./vendor/laravel/sail/bin/sail up
to create a docker container with the project

RUN 
    php artisan migrate
to create the database, then
    php artisan db:seed
to generated some random user data