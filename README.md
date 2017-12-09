# CakePHP's development tools.

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
        ->add(new TransactionMiddleware());

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
        ->registerMiddleware('transaction', new TransactionMiddleware())
        ->applyMiddleware('trace', 'transaction');
});
```

### Other

About for middleware is [here](https://book.cakephp.org/3.0/en/controllers/middleware.html).
