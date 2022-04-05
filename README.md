# Installation of the project (DEV)

- create a file named : ```.env.local```
- edit it with : ```DATABASE_URL="mysql://Concerto:password@127.0.0.1:3306/Concerto?serverVersion=mariadb-10.3.32&charset=utf8mb4"```
- be careful about the version of mariadb
- create Database (Concerto) and user with same name (Concerto) and password (password), give the user all permissions on database with same name
  
## Terminal

- ```composer install```    (dependencies installation)
- ```bin/console do:mi:mi``` (DB table creation)
- ```bin/console do:fi:lo``` (FakeData)
- ```php -S 0.0.0.0:8000 -tpublic``` (server)
  