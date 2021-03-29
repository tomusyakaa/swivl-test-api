Symfony 5 Classroom api
========================
- [Installation](#installation)
  
- [Requests](#Requests)


# Installation
 ```sh
 $ # Clone api repository.
 $ cd you-dir
 $ git clone git@github.com:tomusyakaa/swivl-test-api.git
 
 $ # Install dependencies
 $ cd you-dir
 $ composer install
 
 $ # Make own env file
 $ cp .env.template .env
 $ #Fill DATABASE_URL in .env file with path to your databsase 

 $ # Create the database
 $ bin/console doctrine:database:create
 
 $ # Run the migration
 $ bin/console doctrine:migrations:migrate
  
 $ # Start local server
 $  symfony server:start

  ```
# Requests

Check all api methods by uri /api/doc.json

Post classroom example:
- curl
 ```sh
  $ curl --request POST \
--url http://127.0.0.1:8000/v1/classrooms \
--header 'content-type: application/json' \
--data '{
"title": "322121111",
"isActive": true,
"createdAt": "2021-03-28 09:02:30"
} '
  ```
