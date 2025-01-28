Creating API using Laravel 11 and API token authentication using Laravel Sanctum

1) Crud Operation
2) Using Laravel Sanctum
3) AuthController
4) Public route:
   * Register (public route - no need bearer token)
   * Login (public route - no need bearer token, generate user token)
   * Logout (public route - need bearer token, generated by login)
6) All CRUD operation need bearer token
7) Query operation in PostController reflect to 1 to many relationship between users and post table
8) All routes tested using Postman
