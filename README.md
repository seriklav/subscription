# Subscription Management System

A Laravel-based system to manage user subscriptions with options for upgrading, downgrading, and billing. The system supports one-to-one relationships between users and subscriptions, and includes authentication, localization, and queue-based subscription updates.

## Features

- **One-to-One User-Subscription Relationship:** Each user has exactly one subscription, and each subscription belongs to one user.
- **Subscription Management:** Users can upgrade or downgrade their subscriptions.
- **Automated Subscription Updates:** Subscription changes are scheduled to take effect at the end of the current billing period.
- **Configurable Prices:** Plan prices are defined in configuration files for easy management.
- **Authentication:** Registration, login, and protected routes ensure only authorized users can access subscription information.
- **Localization:** The system supports multiple languages, with translations stored in separate files.
- **Queue Handling:** Subscription updates use job queues for asynchronous processing.

## Prerequisites

- PHP 8.0+
- Composer
- Node.js & npm
- MySQL or other supported databases

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. **Install PHP dependencies:**
    ```bash
    composer install
    ```

3. **Install JavaScript dependencies:**
    ```bash
    npm install && npm run dev
    ```

4. **Set up the `.env` file:**
    - Copy the example file and update the necessary values:
    ```bash
    cp .env.example .env
    ```
    - Update database, mail, and other configurations in the `.env` file.

5. **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

6. **Run migrations:**
    ```bash
    php artisan migrate
    ```

7. **Start the development server:**
    ```bash
    php artisan serve
    ```

## Configuration

### Subscription Prices

Plan prices are defined in the `config/subscription.php` file:
```php
return [
    'plans' => [
        'lite' => [
            'price_per_user' => 4.00,
        ],
        'starter' => [
            'price_per_user' => 6.00,
        ],
        'premium' => [
            'price_per_user' => 10.00,
        ],
    ],
    'discount' => [
        'yearly' => 0.20, // 20% discount for yearly billing
    ],
];
