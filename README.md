# Hisings-tobacca

This repository is a project for the Laravel course in the Web Developer program at Yrgo Higher Vocational School in Gothenburg. The project has a MIT license. The purpose of the project was to build an admin tool for a company where they can handle their products. 

# Description

This admin page will help the owner and employees of "Hisings Tobacca" to keep track of, add, delete and edit their products that will be viewed on their website. Using [Laravel](https://laravel.com/docs/11.x/readme), [breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze) and [mysql](https://dev.mysql.com/doc/) we created an application and database that allows users to be assigned the role of either "admin" or "employee".

# Installation

* $ composer install        (This will download all the necessary packages and additions that the app uses)
* $ npm install             (Catch anything missed by composer)

* $ touch .env
    * In .env: Set up a proper database with your credentials following the .env.example

* $ php artisan migrate     (Create the database setup needed for products and users)

* $ php artisan tinker
    * Copy the last three sections of .env.example to create an admin login, employee login and categories, as shown here:
    * App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('admin'), 'role' => 'admin']);
    * App\Models\User::create(['name' => 'Employee', 'email' => 'employee@example.com', 'password' => Hash::make('employee'), 'role' => 'employee']);
    * use App\Models\Category;
        * Category::create(['name' => 'White']);
        * Category::create(['name' => 'Black']);
        * Category::create(['name' => 'Powder']);
        * Category::create(['name' => 'Pouches']);
    * Here you are able to create a login for either admin or employee, which will have different privileges.

You can now log in using your chosen email and password, once on the admin page you can *add products*, *edit products* or *delete products*. These will be added, edited and removed under the "products" table in your mysql database. If you are logged in as employee you may *edit products* but will not be able to *add* or *delete*.

# Database

The database has the tables **users**, **products**, **categories** and **category_product**. They are set up to look like this:

### Users
| id | name | email | email_verified_at | password | role | remember_token | created_at | updated_at |
| -- | ---- | ----- | ----------------- | -------- | ---- | -------------- | ---------- | ---------- |
| 1  | Jeff | jeff@example.com | NULL | *hash* | admin | NULL | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |
| 2  | Geoff | geoff@example.com | NULL | *hash* | intern | NULL | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |

### Products
| id | name | description | strength | type | price | image | created_at | updated_at |
| -- | ---- | ----------- | -------- | ---- | ----- | ----- | ---------- | ---------- |
| 1 | Product1 | description | 2 | white | 39.00 | images/123.jpg | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |
| 2 | Product2 | description | 4 | brown | 41.00 | images/456.jpg | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |

### Categories
| id | name    | created_at          | updated_at          |
| -- | ------- | ------------------- | ------------------- |
|  1 | White   | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |
|  2 | Black   | 2025-01-01 12:12:12 | 2025-01-01 12:12:12 |

### Categoriy_product
| id | product_id | category_id | created_at | updated_at |
| -- | ---------- | ----------- | ---------- | ---------- |
|  1 |          1 |           4 | NULL       | NULL       |
|  2 |          2 |           1 | NULL       | NULL       |