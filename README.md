# Laravel Multi Application

A simple loader that permits to split the project in multiple parts or even create multiple application

## Installation

- Add the package and the folder psr-4 to your `composer.json` and run `composer update`.

```json
{
    "require": {
        "echowine/laravel-app": "*"
    },
    "autoload": {
        "psr-4": {
            "": "src/"
        }
    },
}
```
- Add the service provider to the `providers` array in `config/app.php`

```php
EchoWine\Laravel\App\AppServiceProvider::class,
```

- Create a new src package folder `php artisan src:new Example` at the root of your project.


## Usage

### Return view

```php
return view('Example::index');
```

### Assets

```php
{{asset('src/Example/assets/welcome/main.css')}}
```
