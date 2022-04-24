# Codeigniter 4 JWT Starter

Starter API using Codeigniter 4 and JWT Authentication.

## Installation

- Download the repository and extract it to your `htdoc` folder.

- Create database and execute this SQL code:

  ```sql
  CREATE TABLE `users` (
    `id` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);
  COMMIT;
  ```

  

- You have to change database name, username, and password in `Config/Database.php` file.

## Test Register User

Test registration for a user using postman or other REST Client App.

```
/POST
body:
{
	"email": "useremail@domain.com",
	"password": "userpassword",
	"name": "User Name"
}
```

## Test Login 

Test registration for a user using postman or other REST Client App.

```
/POST
body:
{
	"email": "useremail@domain.com",
	"password": "userpassword"
}
Example Response:
{
    "message": "User authenticated successfully",
    "user":{
        "id": "62640c421cca4",
        "email": "fareedsurya@gmail.com",
        "name": "Farid Surya",
        "updated_at": "2022-04-23 21:25:06",
        "created_at": "2022-04-23 21:25:06"
	},
	"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZhcmVlZHN1cnlhQGdtYWlsLmNvbSIsImlhdCI6MTY1MDc5NTIxNCwiZXhwIjozMzAxNjc2ODI4fQ.l0c9sgDWOFWxarFKN6vPUcuKHCOHBNfIFHAuVnaUZeo"
}
```

## Test Get Data with Authorization

Test get data with authorization using REST Client App.

```
GET: /index.php/users

Header Data:
Authorization: Bearer [access_token]
```

## Change The Secret Key

You can change the secret key by modify `getSecretKey()` function in `Config/Services.php`.

## Change Token Time and Payload

You can change the token time to live and payload data by modify `getSignedJWTForUser()` function in `jwt_helper.php` file.

```php
function getSignedJWTForUser(string $email)
{   
    $issuedAtTime = time();
    $tokenTimeToLive = strtotime('+1 day', $issuedAtTime);
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration,
    ]; 
    $jwt = JWT::encode($payload, Services::getSecretKey(), 'HS256');
    return $jwt;
}
```

You can change the `$tokenTimeToLive` variable with the constant variable, for example `3600`, to define token active time. You also can add other data in `$payload` variable to determine user personal information.
