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
   - GET id for model: $postId = $post->getKey();

9) Creating AuthController (for sanctum to generate bearer token)
   - php artisan make:controller AuthController
   - create function register, login, logout
   
   - open api route (api.php) and add route for 3 functions above
      //auth routes
      Route::post('/register', [AuthController::class, 'register']);
      Route::post('/login', [AuthController::class, 'login']);
      Route::post('/logout', [AuthController::class, 'logout']);
   
   - update model user to for token generation
      use Laravel\Sanctum\HasApiTokens;
      use HasFactory, Notifiable, HasApiTokens;

   - for logout, the route must be protected 
     ->middleware('auth:sanctum')
     - when calling logout route, token from login must be put in header
       as bearer token
     - token created when login is inserted into table personal_access_tokens,
       this token is deleted from table when logout route is called