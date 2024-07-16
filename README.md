**NOTE : Laravel 8 requires atleast PHP version 7.4**
+ Check Composer, Open CMD then type :
```
composer --version
```
+ Check php version, type : `localhost` in your browser. the version of php will be visible after the page loaded. (located at the top most part of the page).

**Clone project on your desktop**

To clone the project using Git, open the command prompt (CMD) and navigate to your desktop using the `cd desktop` command. Then, use the appropriate Git command to clone the project. 
```
git clone https://github.com/your_username_/Project-Name.git
```
To navigate your folder:
```
cd <Folder Name>
```
Install NPM packages:
```
yarn install or npm install
```
Install Composer:
```
composer install
```
To connect to the database, copy the `.env.example` file, paste it as `.env`, and then edit the configuration details within the `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customer_info
DB_USERNAME=root
DB_PASSWORD=admin
```

**Running Migrations**

To run all of your outstanding migrations, execute the migrate Artisan command:

```
php artisan migrate
```

