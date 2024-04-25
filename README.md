## Creating OAuth Facebook login using Socialite in Laravel 11

Go inside the Project and install the required packages.
- composer install
- npm install

Create your database. I am using MySQL. So, add the required credentials inside .env file.

Create a Facebook Application from this url (https://developers.facebook.com/). It will give you the app_id and app_secret.

Save the app_id, app_secret, and redirect url into the .env file. Make sure you give the proper permission in your Facebook Developer portal.

To start the laravel server, use this command: php artisan serve

Go to this URL: (http://localhost:8000/login) and you will see the "Login with Facebook" Button.