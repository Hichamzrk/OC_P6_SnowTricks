# SnowTricks
![GitHub Logo](/public/images/favicon.png)
### Social network of Snowboarding

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/0c0e4612508c42edb9cc18a8960bcdd8)](https://www.codacy.com/manual/Hichamzrk/OC_P6_SnowTricks/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Hichamzrk/OC_P6_SnowTricks&amp;utm_campaign=Badge_Grade)

# How to install the project ?

## Required !

- PHP 7.2.5 or higher
- Symfony 5.1 or higher
- Localhost or WebHost

## Code recovery with git

Connect with SSH key to your server.
Use the command : `git clone https://github.com/MalronWall/OC_Fo-Back_P6.git`

## Configuration

Update environnements variables in the .env file with your values. 

- At the very least you need to define the SYMFONY_ENV=prod
- DATABASE_URL
- MAILER_DSN

## Vendors installation

- If you can use Composer in your server, use `composer install --no-dev -ao` for optimized installation of vendors.
- If you can't use Composer, download Composer.phar and use `php composer.phar install --no-dev -ao` .

## Database creation

- Use the command `php bin/console doctrine:database:create` for database creation.
- Use the command `php bin/console doctrine:migrations:migrate` for creation of the tables.
- Use the command `php bin/console doctrine:fixtures:load` for load some data in database

## Start the project

- At the root of your project use the command `php bin/console server:start -d`
- Default connection use Email :`Example@test.fr` - Password :`123456`
