## Installation
#### Download and setup

- Clone the repo
   ```
   git clone https://github.com/haziq-danial/psm-management-system.git
   ```
- Change directory
    ```
    cd psm-management-sys
    ```
- Copy sample `env` file and change configuration according to your need in ".env" file and create Database
    ```
    cp .env.example .env
    ```
- Install php & javascript libraries
    ```
    composer install
    npm install
    ```
- Setup application
    
    - Generate key
       ```
       php artisan key:generate
       ```
    - Migrate database
       ```
       php artisan migrate
       ```    
    - Run seeder
        ```
        php artisan db:seed
        ```
