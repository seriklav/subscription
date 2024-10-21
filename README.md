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

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL
- Redis

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/seriklav/subscription
    cd subscription
    ```

2. **Clone the repository:**
    ```bash
    sail up -d
    ```

3. **Install PHP dependencies:**
    ```bash
    sail composer install
    ```

4. **Install JavaScript dependencies:**
    ```bash
    npm install && npm run dev
    ```

5. **Set up the `.env` file:**
    - Copy the example file and update the necessary values:
    ```bash
    cp .env.example .env
    ```
    - Update database, mail, and other configurations in the `.env` file.

6. **Generate the application key:**
    ```bash
    sail artisan key:generate
    ```

7. **Run migrations:**
    ```bash
    sail artisan migrate
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
