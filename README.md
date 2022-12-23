<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Instructions on how to run the project locally.

##Windows users:
- Download xammp: https://www.apachefriends.org/download.html
 
##Mac Os, Ubuntu and windows users continue here:
- Create a database locally named `lms` 
- Download composer https://getcomposer.org/download/
- Pull Laravel/php project from git provider.
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
- Open the console and cd your project root directory
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders. 

#####You can now access your project at localhost/lms

## If for some reason your project stop working do these:
- `composer install`
- `php artisan migrate`
