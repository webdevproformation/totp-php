# inspiré par 

<https://www.youtube.com/watch?v=e-1Yh8iH8jk>

# dépendances

```sh
composer install
composer require robthree/twofactorauth
```

---

# création base de données `db.sqlite`

```sql
DROP TABLE IF EXISTS users ;

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    secret VARCHAR(255) DEFAULT NULL 
);
```

# start projet

```sh
php -S localhost:1234
```