# Inventory Management Portal

This project is a simple inventory management system built using **Laravel**.
It focuses mainly on **bulk product import performance**, **background processing**, and **real-time user presence** using WebSockets.

The goal was to build something practical, scalable, and easy to understand, without over-engineering.

---

## What this project does

### Admin side
- Admin login and dashboard
- Create and manage products
- Import products using CSV / Excel
- Handle large files without server timeout
- Track failed rows during import
- See real-time online Admins & Customers

### Customer side
- Customer login and dashboard
- Browse products
- Filter products by category
- Clean, card-based product listing

---

## Bulk Product Import (Main Focus)

This was the most important part of the project.

### How it works
- Admin uploads a CSV / Excel file
- File is stored safely first
- Import runs in background using Queue & Job
- Data is processed in chunks
- Each row is validated before insert
- Invalid rows are saved with row number, error message, and row data

This allows importing large files without freezing the application.

---

## Real-Time Presence (WebSockets only)

- Online / Offline status for Admins and Customers
- Uses Laravel Reverb (WebSockets)
- No AJAX polling used
- Presence stored in user_presences table
- Counts update live on Admin Dashboard

---

## Sample Import File

The repository includes:
products_sample_import.csv

This file was personally used to test and verify the import functionality.

---

## Testing

Included tests:
- Feature test for Admin product creation
- Unit test for import validation logic

Run tests:
php artisan test

---

## Tech Used
- Laravel 12
- MySQL
- Database Queue
- Laravel Reverb
- Blade + Bootstrap
- PHPUnit

---

## Run Project

composer install
php artisan key:generate
php artisan migrate
php artisan queue:work
php artisan reverb:start
php artisan serve

---

## Notes
- All code is original
- No tutorial copy-paste
- Commit history shows step-by-step development
