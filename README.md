# Todo List
A simple and straightforward application for managing works. This application is built using PHP and allows users to create, read, update, and delete works with a user-friendly interface.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes

## Features
1. Add new work with name, starting date, ending date, and status
2. View all existing works
3. Update existing work information
4. Delete a work

## Prerequisites
1. PHP 7.2 or higher
2. MySQL 5.7 or higher
3. Apache or Nginx web server
5. Composer

## Installation

1. Clone the repository to your local machine
```bash
git clone https://github.com/AuNguyen1999/todo-php.git
```


2. Change into the project directory:
```bash
git cd todo-php
```
3. Install the required dependencies using Composer:
```bash
git cd composer install
```
4. Create a new database in your MySQL server
5. Import the `works.sql` file to the newly created database
6. Modify the `connection.php` file with your database credentials
7. Move the project files to your web server directory
8. Open your web browser and navigate to the project URL

## Running the tests
This project uses PHPUnit for unit testing. To run the tests, simply run the following command in the project root directory:
```bash
vendor/bin/phpunit tests
```

## Built With
* PHP 7.4 
* MySQL or MariaDB database
* Composer
* Fullcalendar

## Author
Au Nguyen
