# How to Run This Project on Your PC

## Requirements
- XAMPP installed (download from https://www.apachefriends.org)
- Composer (will be installed in the steps below)

## Step 1: Get Composer

Open a terminal and run these two commands:

```
C:\xampp\php\php.exe -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
C:\xampp\php\php.exe composer-setup.php --install-dir=C:\xampp\php
```

## Step 2: Install Project Dependencies

Open a terminal inside the project folder and run:

```
C:\xampp\php\php.exe C:\xampp\php\composer.phar install
```

This will download all the required packages into the `vendor` folder.

## Step 3: Set Up Environment File

Copy the `.env.example` file and rename the copy to `.env`

Then run this command to generate the app key:

```
C:\xampp\php\php.exe artisan key:generate
```

## Step 4: Create the Database

1. Open XAMPP Control Panel
2. Start Apache and MySQL
3. Open your browser and go to `http://localhost/phpmyadmin`
4. Click "New" on the left sidebar
5. Type `poll_platform` as the database name
6. Click "Create"

## Step 5: Run Migrations

This will create all the tables in the database:

```
C:\xampp\php\php.exe artisan migrate
```

## Step 6: Start the Server

```
C:\xampp\php\php.exe artisan serve
```

Now open `http://localhost:8000` in your browser.

## Step 7: Using the App

1. Click "Register" and create an account
2. After registering you will be logged in automatically
3. Click "Create Poll" to make a new poll
4. Go to "Dashboard" to see all active polls
5. Click on any poll to see its options (loads without page refresh)

## Troubleshooting

If you get an error about "directory must be present and writable" then do NOT put the project inside a OneDrive folder. Move it to a normal folder like `C:\Projects\module 1` instead.
