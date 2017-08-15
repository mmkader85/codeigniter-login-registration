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
2. Import [docs/chope.sql](docs/chope.sql) into MySQL.
3. Configure the following according to your development server.
    * [application/config/config.php](application/config/config.php)
    * [application/config/myredis.php](application/config/myredis.php)
    * [application/config/database.php](application/config/database.php)
4. Set up virtual host for the project. See [docs/chope.conf](docs/chope.conf) for reference.

### Files created or updated on top of CodeIgniter bundle

##### Configuration files
* [autoload.php](application/config/autoload.php)
* [config.php](application/config/config.php)
* [constants.php](application/config/constants.php)
* [database.php](application/config/database.php)
* [myredis.php](application/config/myredis.php)
* [pagination.php](application/config/pagination.php)

##### Controllers, Libraries and Models
Docs for the user defined classes (Controllers, Libraries and Models) can be found [docs/phpdoc/index.html](docs/phpdoc/index.html)

##### View files
* [layout/header.php](application/views/layout/header.php)
* [layout/footer.php](application/views/layout/footer.php)
* [audit.php](application/views/audit.php)
* [login.php](application/views/login.php)
* [register.php](application/views/register.php)
* [start.php](application/views/start.php)
