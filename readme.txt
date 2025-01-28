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

6) run php aritsan migrate (to create the posts table)

7) create apiResource in routes\api.php
   - Route::apiResource('posts', PostController::class);
   - automatically create CRUD route for posts
   - check route list: php artisan route:list
   - GET|HEAD        api/posts .............. posts.index › PostController@index
   - POST            api/posts .............. posts.store › PostController@store
   - GET|HEAD        api/posts/{post} ....... posts.show › PostController@show
   - PUT|PATCH       api/posts/{post} ....... posts.update › PostController@update
   - DELETE          api/posts/{post} ....... posts.destroy › PostController@destroy

8) edit PostController and complete all the CRUD operations
   - app\Http\Controllers\PostController

NOTE:
   - For POST /posts in postman must set Headers to Accept : application/json