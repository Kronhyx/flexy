![TopLanguage](https://img.shields.io/github/languages/top/kronhyx/flexy)
![LanguagesCount](https://img.shields.io/github/languages/count/kronhyx/flexy)
![GitHub Issues](https://img.shields.io/github/issues/Kronhyx/flexy)
![GitHub Stars](https://img.shields.io/github/stars/Kronhyx/flexy)
![GitHub License](https://img.shields.io/github/license/Kronhyx/flexy)   
   
<p align="center">
    <img width="250" height="auto" src="https://symfony.com/logos/symfony_black_02.png"/>
    <img width="250" height="auto" src="https://d8vlg9z1oftyc.cloudfront.net/site/template/img/logo.png"/>
</p>
   
   
**Symfony FLexY** is a basic example of how to use Symfony with his main features and bundles.

[![Dashboard](https://startbootstrap.com/assets/img/screenshots/themes/sb-admin-2.png)](https://startbootstrap.com/assets/img/screenshots/themes/sb-admin-2.png)

* [System requirements](#system-requirements)
* [Installing](#installing)
* [Updating](#updating)
* [Migrations](#migrations)

## System Requirements
* GIT 2 or higher 

* PHP 7.4 or higher

* PHP extensions: (all of them are installed and enabled by default in PHP 7+)
    * Ctype
    * iconv
    * JSON
    * PCRE
    * Session
    * SimpleXML
    * Tokenizer

* Writable directories: (must be writable by the web server)
    * The project's cache directory (var/cache/ by default, but the app can override the cache dir)
    * The project's log directory (var/log/ by default, but the app can override the logs dir)

* Web-server (Nginx or Apache2);

* Database (MySQL/MariaDB);

* npm v6 or higher

* Node v10.13 or higher

## Installing

* Go to the directory in which you want to install the project, for example: `/var/www`:

```bash
cd /var/www
```

* Clone the repo from gihub:

```bash
git clone https://github.com/Kronhyx/flexy.git
```

Or download [latest archive](https://github.com/Kronhyx/flexy/archive/master.zip) from GitHub.

* Install all dependencies using `composer install` and after `npm install`

* Create an **uncommited** file named `.env.local` with value
 
See more about environments in [Official Symfony Documentation](https://symfony.com/doc/current/configuration.html#configuring-environment-variables-in-env-files) 
```dotenv
#.env.local
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
```

* Create an empty database for your application (MySQL/MariaDB);
    - `--if-not-exists` is used to *dont trigger an error if database already exists*
```bash
php bin/console doctrine:database:create --if-not-exists
```

* Using **DoctrineMigrationsBundle** you can upgrade or downgrade your database schema, now you need to update database schema to the latest 
```bash
php bin/console doctrine:migrations:migrate -n
```

* If you need fill database with some initial values you can use **DoctrineFixturesBundle** to populate itself with autogenerated data
```bash
php bin/console doctrine:fixtures:load -n
```

* [Add a virtual host to your web server](https://symfony.com/doc/current/setup/web_server_configuration.html), pointing to the `public` directory within your new
Symfony directory. You'll need to set up rewrite rules to point all non-existent requests to application;

## Updating

* This application use [WebpackEncoreBundle](https://symfony.com/doc/current/frontend/encore/installation.html#installing-encore-in-symfony-applications), after **add/change/remove** code in any css or js file you will need to
 stop and restart encore each time to generate the new assets:

     ```bash    
     # compile assets once
     npm run dev
     
     # or, recompile assets automatically when files change
     npm run dev -- --watch
    
     # on deploy, create a production build
     npm run dev production
    ```

* Pull the latest code from the repository by Git (If you want the latest `master` branch):

    ```bash
    git checkout master
    git pull -r
    ```

    Or pull the latest version:

    ```bash
    git fetch
    git checkout <version>
    ```
* Commit and push your local changes and feel free to make a new Pull Rquest


## Migrations

Run to apply latest migrations:

```bash
php bin/console doctrine:migrations:migrate -n
```

Run to create a new migration:

```bash
php bin/console make:migration  
```
