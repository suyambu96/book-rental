---

# Book Rental Project

This document provides the installation steps necessary to set up and run the Laravel project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed on your system:
- Composer 2
- PHP >= 8,1
- A database system (MySQL)

## Installation Steps

Follow these steps to set up the project:

### 1. Clone the repository

First, clone the project repository from GitHub or another version control system.

```bash
git clone <repository-url>
```

### 2. Install Dependencies

Navigate to the project directory and install the PHP dependencies.

```bash
cd <project-name>
composer install
```

### 3. Environment Setup

Copy the example environment file and make the necessary configuration adjustments.

```bash
cp .env.example .env
```

Edit the `.env` file to suit your environment (database connection, mail settings, etc.).

### 4. Generate Application Key

Generate a new unique key for the application.

```bash
php artisan key:generate
```

### 5. Run Migrations

Execute the migrations to create the database schema.

```bash
php artisan migrate
```

### 6. Database Seeding

Populate the database with initial data using seeders.

```bash
php artisan db:seed
```

If you have a specific seeder to run, use:

```bash
php artisan db:seed --class=SpecificSeeder
```

### 7. Start the Development Server

Start the Laravel development server.

```bash
php artisan serve
```

### 8. Schedule Commands (Optional)

If your application uses scheduled tasks, you can manually trigger them to run.

```bash
php artisan schedule:run
```

## Usage

Once the installation is complete and the server is running, you can access the application via:

```
http://localhost:8000
```

## Postman collection 

Check the Rental.postman_collection.json file import it to postman collection.

## email 

Configure the smtp setting on the env file with proper credentials.
```bash
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Troubleshooting

If you encounter any issues during the installation, ensure that your `.env` file is set up correctly and that all services needed by the project (like the database server) are running.

---
