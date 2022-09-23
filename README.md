
## Configuration

Clone this repo.

install dependencies

`` composer install``

Then copy `.env.example` to `.env` and add database configuration and mail server. 

add this to your crontab file

```* * * * * php /{ProjectPath}/artisan schedule:run >> /dev/null 2>&1```

#### Note
Find attach postman collection in the base repo directory and edit `local` environment variable to your local url

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
