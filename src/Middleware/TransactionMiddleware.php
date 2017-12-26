<?php
/**
 * @since       0.0.1
 * @license     https://raw.githubusercontent.com/gotoeveryone/cake-parts/master/LICENSE MIT License
 */
namespace Gotoeveryone\Middleware;

use Cake\Datasource\ConnectionManager;
use Cake\Error\PHP7ErrorException;
use Cake\Log\Log;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

/**
 * Manage transaction at application request unit.
 */
class TransactionMiddleware
{
    /**
     * Connection name
     *
     * @var string
     */
    private $__name = '';

    /**
     * Constructor
     *
     * @param string $name Connection name
     */
    public function __construct($name = 'default')
    {
        $this->__name = $name;
    }

    /**
     * Invoke this middleware.
     *
     * @param Psr\Http\Message\ServerRequestInterface $request HTTP reqeust
     * @param Psr\Http\Message\ResponseInterface $response HTTP response
     * @param callable $next Next function
     * @return Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $conn = ConnectionManager::get($this->__name);

        return $conn->enableSavePoints(true)
            ->transactional(function ($conn) use ($request, $response, $next) {
                try {
                    $res = $next($request, $response);
                    Log::debug('Commit the transaction.');

                    return $res;
                } catch (Throwable $e) {
                    Log::error('Error! Rollback the transaction...');
                    throw new PHP7ErrorException($e);
                } catch (Exception $e) {
                    Log::error('Error! Rollback the transaction...');
                    throw $e;
                }
            });
    }
}
