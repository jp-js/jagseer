1 .first clone project 
 	git clone https://github.com/jp-js/jagseer.git

2. After Download run this command
 	composer update OR composer install

3. create .env file and add configure your database name, SMTP username and password as well as TWILIO username and password

4. create database name as you like


5. After Run migration 

 	php artisan migrate
 

api url

User Register Api
http://localhost/jagseer/public/api/users/register

paramerter
name:Jagseer Singh
email:jsinghkik@gmail.com
mobile:9041100846
password:12345678




User verityOTP Api
http://localhost/jagseer/public/api/users/verityOTP
email:jsinghkik@gmail.com
otp:3057




User reSendotp Api
http://localhost/jagseer/public/api/users/reSendotp

email:jsinghkik@gmail.com




User login Api
http://localhost/jagseer/public/api/users/login
email:jsinghkik@gmail.com
password:12345678
otp:2420


User reset-password Api
http://localhost/jagseer/public/api/users/reset-password
email:jsinghkik@gmail.com




User changePassword Api
http://localhost/LBM/public/api/users/changePassword

old_password:12345678
new_password:123456789
otp:8872