# simplestORM
Not a full fledged Object-relational mapper, but made my life easier, so I'm sharing :)

Up to now working only with MySQL/MariaDB, plan to support other DBMSes

## config.json
You will have to create a `config.json` in the same directory from `Conn.php`.
Use the following template as an example.

```
{
  "host": "localhost",
  "db": "project_database",
  "user": "root",
  "password": "my_most_secretest_secret",
  "DSN": "mysql:host={{host}};dbname={{db}};charset=utf8"
}
```
