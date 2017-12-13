<?php
/**
 * @since       0.0.5
 * @license     https://raw.githubusercontent.com/gotoeveryone/cake-parts/master/LICENSE MIT License
 */
namespace Gotoeveryone\Middleware;

use Cake\Log\Log;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Recording access to action.
 */
class TraceMiddleware
{
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
        $url = $request->here();
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');
        $message = "${url} (${controller}@${action})";

        Log::debug("${message} - Start");
        $response = $next($request, $response);
        Log::debug("${message} - End");

        return $response;
    }
}
