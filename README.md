
## Intoduction

a fleet-management system allows the user to book a seat for his trip and listing all the available seats for his trip

## Built with

Stack | Technology used
----- | ---------------
Programming Language | PHP
Web Framework | [Laravel 10](https://laravel.com/docs/10.x)
Relational Database | MySQL

## Installation & Setup
1. Clone the repository

2. Install all the dependencies using composer 
    ```
    composer install

    ```

"make sure that you've Created your database"

3. Copy the example env file and make the required configuration changes in the .env file accoarding to your database credintials

4. Once the last step is done you can migrate & seed the database with the Database dump
    ```
    php artisan migrate --seed

    ```

## How to use

login with any user exist in the database (email and password) http://localhost:8000/api/login it will return user object and [token]

You will use this Token with all other endpoints as [Bearer] [token]
 you can start usning this credentials 
 ```
 email : "emanmorsy@gmail.com"
 password : "12345678" 
 ```
 accoarding to the seeded data

http://127.0.0.1:8000/api/book-seat this route is used to book a seat by sending the trip_id ,from_station_id , to_station_id which refers to the targeted trip and the id's of your destinations (stations)

http://127.0.0.1:8000/api/available-seats?from_station_id=&to_station_id= this route used to retrieve a list of available seats for all the trips which passes over your destination by sending ,from_station_id , to_station_id which refers to the targeted id's of your destinations (stations)

## API Endpoints

All API endpoints are prefixed with `/api`

