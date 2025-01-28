Laravel API and auth using sanctum

1) create new laravel project

2) install sanctum
   - php artisan install:api

Note: 
- Ctrl / to code line comment
- php artisan route:list (to list all app route)
- all route in api.php will start with api/route-name

3) test first api in postman
   - http://laravel-api-app.test/api 
     GET /api

Note:
   - php artisan make:model -h (info on generating model)
   - php artisan make:model Post -a --api (making model specifically for api)

4) Edit App\Models\Post.php (add the fillable)

5) Edit the Post migration (update schema create fields)

6 run php aritsan migrate (to create the posts table)