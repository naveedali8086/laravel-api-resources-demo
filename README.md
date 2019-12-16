## Laravel APIs Resources Demo

This sample app demonstrates 'How to use Laravel API Resources'. For the sake of simplicity Laravel's simple API authentication has been used instead of Passport.

## Available End Points
Store Book  
http://your-domain.com/api/store-book  

Edit Book   
http://your-domain.com/api/edit-book/book-id

Get Single Book    
http://your-domain.com/api/get-book/book-id

Get Books Collection  
http://your-domain.com/api/get-books  

#### Note:  
The 'api' keyword in URL

## How To Run This App Locally 

- Run following command or download the project's zip

  git clone https://github.com/naveedali8086/laravel-api-resources-demo.git

- Create database (i.e. your_db_name) at local machine.

- Set DB name, DB user & password in .env file or database.php configuration.

- And finally run following commands:
1. composer install  
2. composer dump-autoload (optional)  
3. php artisan migrate
4. php db:seed
5. Use any HTTP client/Application (i.e. Postman) to get APIs response

#### Note  
Before making API request add the 'api_token' value (saved into the User's table) into the request.<br>
Go to <a href="https://laravel.com/docs/6.x/api-authentication#passing-tokens-in-requests">How to pass API token in request</a> 