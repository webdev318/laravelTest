## Installation Setup

1. Clone the repository
2. Run `composer install` to install the dependencies.
3. Run `composer run-script post-root-package-install` to generate your local `.env` file.
4. Run `composer run-script post-create-project-cmd` to generate your application key.
5. Open your `.env` and configure your database credentials.
6. Run `php artisan migrate --seed`

It is completed by Rafael.
