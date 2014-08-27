Timeline demo application
=========================

- [Standalone library](https://github.com/stephpy/timeline)
- [Symfony2 Bundle](https://github.com/stephpy/TimelineBundle)

![screenshot](https://raw.github.com/stephpy/timeline-app/master/web/img/screenshot.png)

Use it ?

```
composer install
# edit app/config/parameters.yml file
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:migrations:migrate -n
php -S localhost:8000 -t web
```

Go on "/app_dev.php"

If you have any suggestion or improvement, feel free to contact me or create an issue.
