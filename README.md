# Laravel Referral Board

#About Project

This is referral system where a user can invite other users on the portal for registration. Just like the Dropbox's referral. In this system you will get one point for each successful referral.

#Build With
For this project we used below technologies:
1. Laravel 8
2. PHP 7.3
3. Javascript
4. CSS
5. HTML
6. mySQL

#Getting Started
We need following packages:
1. composer
2. npm

#Installation
Please follow the below commands
1. composer install
2. composer require laravel/ui —dev (for laravel bootstrap and auth scaffolding)
3. php artisan ui bootstrap --auth
4. touch .env (add mail and database configuration details in env)
5. php artisan key:generate
6. php artisan optimize
7. npm install
8. npm run development
9. create database database_name (make sure add the same configuration in env file)

#Database Migration
Please run this command to migrate your tables in the database:
    **php artisan migrate**
    
#Database Seeder
We have written a seeder to create a admin user for the portal who can view all the referrals and their status. To make the seeder work please run the below command:
    **php artisan db:seed**
    
#Now you are good to go
Just run the command **php artisan serve**. You will get a link http://127.0.0.1:8000/. Open the link you can register yourself or you can just use admin credentials that we created using seeder file.
Admin login credentials:`'email' => 'admin@admin.com', 'password' => 12345678`. 


After login, click on **Referral Invite Page** and enter the comma separated email ids to invite the users. After clicking send invitation button, invitation mail will be sent to the emails ids provided. Now if a user registers using that link referrer will earn 1 point.

