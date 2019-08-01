# cvproject

Requirements:

* PHP 7.2+
* MySQL 5.5+ 

Installation steps:

1. Install composer from https://getcomposer.org/download/
1. Install symfony client from https://symfony.com/download
1. Run "php composer.phar install"
1. run "symfony serve" from the base project directory
1. copy the ".env" file to ".env.local"
1. edit ".env.local" file with the DB connection
1. create the database: "php bin/console doctrine:database:create"
1. update the database: "php bin/console doctrine:migrations:migrate"