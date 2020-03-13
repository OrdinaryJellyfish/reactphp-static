# reactphp-static

A simple middleware for serving static files with ReactPHP

## Installation

```
composer require ordinaryjellyfish/react-static
```

## Usage

Use it in your ReactPHP like a normal middleware, passing in your webroot:

```php
new OrdinaryJellyfish\ReactStatic\StaticServer(__DIR__);
```

The middleware will serve any static files if they exist. If a file does not exist for the requested path, the middleware will exit, letting you run the rest of your application.

Enjoy!

[Buy me a coffee <3](https://paypal.me/tristiank3604)
