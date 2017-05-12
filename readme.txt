Welcome to pathology Lab reporting system. Laravel 5.3 is used to build this app.

To get started, Create a file in the root directory of the project, call it `.env`.

Copy, paste and modify the following file with your environment configuration set up of
your database configuration in the env as follow:

APP_ENV=local
APP_KEY=base64:gBXeGpW9nFybEnRRNG/Sx8E4e2uqjHQTEWdQPC6Ciw8=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

### Database Configuration for localhost
DB_CONNECTION=mysql
DB_HOST=xxx
DB_PORT=xxx
DB_DATABASE=xxx
DB_USERNAME=xxx
DB_PASSWORD=xxx

### PHPMailer configuration
Host=smtp.gmail.com
Username=xxx
Password=xxx

### SMS configuration
JUSIBE_PUBLIC_KEY=xxxx
JUSIBE_ACCESS_TOKEN=xxxx

To be able to send mail, input your username (your email) and password (your email password) in the PHPMailer configuration. In the sms 
configuration, Open an account on `https://jusibe.com` and copy your public key and access token.

For you to be able to send email, you will need to turn on third party on your gmail setting.

After the configuration is done, run ```composer install``` in order to install all the dependency used in this project.
Then run ```php artisan migrate``` to migrate your tables.

Also in the command line run ```php artisan vendor:publish --provider="Unicodeveloper\JusibePack\JusibeServiceProvider"```
and ```php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"``` in order to get the configuration
files for both JusibePack and snappyPdf respectively.

When all these are done, you can start your server by running `php artisan serve` and vagrant users,
run `vagrant up`. Then visit your address to view the homepage.

# As a staff user

There are 2 kinds of staff users: The Operator user and Lab user

# Operator user 

This user has the super admin priviledges and create patient and create test report, also has the priviledge to
edit and delete patient and report information.

Operator user has a `role_id` of 3. After signing up, you will need to edit the `role_id` field to 3 because the
default value is set to 1. This way, you will have all the privileges of an operator user. When signed in or
logged in, you will be directed to the admin page where you will have access the all the links.

To create a  patient; click `PATIENT TEST FORM`  and fill the form. 
To create a report: visit `REPORT FORM` and fill the form.
To view all the patient available on the platform, click `VIEW PATIENTS`
To view all the report available on the platform, click `VIEW REPORTS`

# Lab user

This user has an admin privilege in that it can acess the dashboard and see `VIEW PATIENTS` and `VIEW REPORTS` link
and he can also view them. However, this user doesn't have the access to perform basic CRUD action on patient and 
report. He can only send a text message to the patient about there login details.

A lab user has a `role_id` of 2

# Patient

This user cannot view the dashboard, they receive a text message about there login details. They can login with 
the details sent to them in order to view their reports. They can view more details by clicking on each of them.
They can export the report to PDF and send as an attatchement to their Mail if they wish to.

# Tests
<hr>

if you have phpunit installed globally (recommended), run
`phpunit`
Otherwise, run
`vendor/bin/phpunit`

NOTE!!! NOTE!!! NOTE!!!

For the test to pass, change your `DB_CONNECTION` to sqlite in your `.env` file before running `phpunit`


