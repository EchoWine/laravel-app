# Laravel Multi Application

A simple loader that permits to split the project in multiple parts or even create multiple application. All the basic functions of laravel will be automatically loaded: Commands, Resources/views, Resources/public, routes, Exceptions/Handler, Providers

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

- Replace "HandlerException in app/Exceptions/Handler"

```php
use EchoWine\Laravel\App\Exceptions\Handler as ExceptionHandler;
```

## Usage

- Create a new src package folder with `php artisan src:generate Example` at the root of your project.

### Return view

```php
return view('Example::index');
```

### Assets

```php
{{asset('src/Example/assets/welcome/main.css')}}
```

### Exception Handler

```php

    public function report(Exception $exception)
    {
        # Report only if is a custom report
        # echo "A custom report";
    }
    
    public function render($request, Exception $exception)
    {
    	
        # Return only if is a custom render
        # The first handler with a return in method render will be used
        # return parent::render($request, $exception);
        
    }
```
