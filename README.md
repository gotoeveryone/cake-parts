# CakePHP's development tools.

### Requirements

- PHP 5.6+
- CakePHP 3.x

### Getting Started

#### Installing

```sh
$ composer require gotoeveryone/cake-parts
```

#### Usage

- `src/Application.php`

```php
use Gotoeveryone\Middleware\TraceMiddleware;
use Gotoeveryone\Middleware\TransactionMiddleware;

public function middleware($middlewareQueue)
{
    // Add to middlewareQueue.
    $middlewareQueue
        ->add(new TraceMiddleware())
        ->add(new TransactionMiddleware('connection name'));

    return $middlewareQueue;
}
```

- `config/routes.php`

```php
use Gotoeveryone\Middleware\TraceMiddleware;
use Gotoeveryone\Middleware\TransactionMiddleware;

Router::scope('/', function ($routes) {
    // Register middleware
    $routes->registerMiddleware('trace', new TraceMiddleware())
        ->registerMiddleware('transaction', new TransactionMiddleware('connection name'))
        ->applyMiddleware('trace', 'transaction');
});
```

When `connection name` is not specified to `TransactionMiddleware` constructor argument, using `default`.

### Other

About for middleware is [here](https://book.cakephp.org/3.0/en/controllers/middleware.html).
