# Software-engineer-challenge

**Description**:  This is a challenge from COD NETWORK team, the purpose is to test the ability to focus in the code quality and software engineering principles & best practices.

**Technology stack**: This project uses ReactJS for the frontend and Laravel for the backend.

## Dependencies

This project needs node, npm, php, php-sqlite and composer installed.


## Installation

First you need to create a .env and past the content of .env.example to it, or simply rename .env.example to .env.
Do the same thing with the frontend directory, and make sure the URLs in .env (frontend) have the same port as the one laravel runs on.

You will also need to generate the key for laravel project, run this command in the project's root directory:
```
npm run generate:key
```
To install this project navigate to its root directory and run the following command:
```
npm run install:all
```
To run the laravel migrations and seed the database, run the following command:
```
npm run migrate:seed
```
To start the development servers run the following command:
```
npm run start:all
```

## Configuration

If you prefer to use MySQL instead, you can configure the Laravel .env file.

## Usage

There are two different ways to interact with this app:

### CLI

You can manipulate the database records directly from the CLI as I created specific artisan commands for that.

To create a product, first navigate to the backend directory:
```
cd backend
```
Then use this artisan command:
```
php artisan product:create {name} {description} {price} {category_ids}
```

To delete a product:
```
php artisan product:delete {product_id}
```

To create a category:
```
php artisan category:create {name} {parent_id}
```

To delete a category:
```
php artisan category:delete {product_id}
```

### Web

You can also view, filter, sort and create the products using the web interface.

## Tests

I have created several tests for the creation of products you can run them using the following command in the root directory:
```
npm run test:createProduct
```

## Credits and references
COD-NETWORK
