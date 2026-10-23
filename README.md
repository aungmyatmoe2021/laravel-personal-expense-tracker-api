# Laravel Personal Expense Tracker API (Sanctum Auth)

## Objective

The objective of this assignment is to build a Personal Expense Tracker RESTful API using Laravel Sanctum. You will focus on implementing secure authentication, managing user-specific data (Ownership Logic), and ensuring that users can only interact with their own financial records.

## Data Models & Migrations

You must generate migrations and models for the following schema:

Table: expenses

|Column|Type|Constraints|
|------|----|-----------|
|id|BigInt|Primary Key|
|title|string||
|amount|decimal||
|category|string|e.g., Food, Travel, Bills|
|user_id|BigInt|Foreign Key|
|created_at|datetime||
|updated_at|datetime||

[!NOTE] You must establish a One-to-Many relationship in the Models: A User has many Expenses, and an Expense belongs to a User.

## Authentication & Authorization

- Sanctum Integration: Implement User Registration and Login to issue API Tokens.
- Protected Routes: All expense-related endpoints must be protected by the auth:sanctum middleware.
- Ownership Logic: Users must only be able to View, Update, or Delete expenses that they created. Accessing another user's expense ID should return a 403 Forbidden or 404 Not Found response.

## Implementation Requirements

- A. CRUD Operations
    - Create an AuthController and ExpenseController with the following endpoints:
        - POST /api/register — Create a new user account.
        - POST /api/login — Authenticate user and return a PlainTextToken.
        - POST /api/logout — User Logout.
        - GET /api/me —- Get User Profile.
        - GET /api/expenses — List all expenses belonging only to the authenticated user (with Pagination).
        - POST /api/expenses — Create a new expense (automatically assign user_id).
        - GET /api/expenses/{id} — Show details of a specific expense.
        - PUT /api/expenses/{id} — Update an existing expense record.
        - DELETE /api/expenses/{id} — Remove an expense record from the database.
- B. Filtering & Search
    - Implement a filter to find expenses by Category.
    - Implement a search feature to find expenses by Title.

## Request Validation

- Use a Form Request class with the following validation rules:
    - title: required | string | max:255
    - amount: required | numeric | min:0.01
    - category: required | string | max:100

## API Response Format

- All responses must be returned in JSON format:
    - Success: 200 OK or 201 Created.
    - Validation Error: 422 Unprocessable Entity.
    - Authentication Error: 401 Unauthorized.
    - Authorization Error: 403 Forbidden (if a user tries to edit someone else's data).

## Deliverables
- Laravel Project Source Code on GitHub.
- Bruno API Collection
- README.md: Short instructions on how to set up the project and run migrations.

#
#

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
