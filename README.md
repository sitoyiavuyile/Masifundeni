# Masifundeni

## Setup

1. Clone the repo
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. Create a MySQL database called `masifundeni_db`
6. Update `.env` with your local DB credentials
7. `php artisan migrate:fresh --seed`
8. `npm install && npm run dev`
9. `php artisan serve`

## Seeded credentials
- Admin: admin@sms.test / password
- Instructor: instructor@sms.test / password  
- Student: student@sms.test / password