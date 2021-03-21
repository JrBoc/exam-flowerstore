# FLOWERSTORE EXAM
- After cloning this repo. Create a database with the name "app_exam_flowerstore".
- rename the ".env.example" to ".env"
- Run the following commands:
```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

You can access the exam at http://127.0.0.1:8000

I've added features that is not required in the exam.

Laravel packages used:
- Livewire
- Laravel UI
- IDE Helper (for development only purposes)

Javascript Libraries used:
- jQuery
- Bootstrap (includes CSS)
- Jansy Bootstrap
