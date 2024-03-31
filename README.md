# Weather API Service

This project is a Laravel-based service for retrieving weather data from the OpenWeatherMap API.

## Getting Started

### Prerequisites

Before running the application, make sure you have the following installed on your system:

- PHP (>= 8.0)
- Composer

### Installation

1. Clone the repository to your local machine:

   ```bash
    git clone https://github.com/ArenGr/Weather-app

2. Install PHP dependencies using Composer:

   ```bash
    composer install

3. Copy the .env.example file to .env and configure your environment variables, including OpenWeatherMap API key:

   ```bash
    cp .env.example .env

4. Generate an application key:

   ```bash
   php artisan key:generate

5. Start the Laravel development server:
   ```bash
   php artisan serve

#### The Weather API service will be accessible at http://localhost:8000.

API Documentation
The API endpoints and usage instructions are documented using Swagger. You can access the Swagger UI by visiting /api/documentation when the application is running.
