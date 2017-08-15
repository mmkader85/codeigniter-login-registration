# CodeIgniter demo registration and login

### Description
This is a sample project to demonstrate user registration and user login in CodeIgniter. The behaviors of the web application are as follows,

##### Registration
1. User can register on web application by filling in the form.
2. User's registration is recorded in Redis.

##### Login
1. Login for registered users.
2. Logged in users can see their register/login history.
3. Logout action is recorded in Redis.

### Requirements
1. PHP 5.6
2. Mysql 5.7
3. Redis 4.0.1
4. Apache 2.4

### Installation in development machine
1. Install composer dependencies **`composer install`**.
2. Import **`docs/chope.sql`** into MySQL.
3. Configure **`application/config/config.php`** and **`application/config/database.php`** according to your development server.
4. Set up virtual host for the project. See **`docs/chope.conf`** for reference.