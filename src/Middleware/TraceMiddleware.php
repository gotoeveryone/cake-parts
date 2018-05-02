<?php
/**
 * @since       0.0.5
 * @license     https://raw.githubusercontent.com/gotoeveryone/cake-parts/master/LICENSE MIT License
 */
namespace Gotoeveryone\Middleware;

use Cake\Log\Log;
use Cake\Http\Response;
use Cake\Http\ServerRequest as Request;

/**
 * Recording access to action.
 */
class TraceMiddleware
{
    /**
     * Invoke this middleware.
     *
     * @param Cake\Http\ServerRequest $request HTTP reqeust
     * @param Cake\Http\Response $response HTTP response
     * @param callable $next Next function
     * @return Cake\Http\Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $url = $request->getRequestTarget();
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');
        $message = "${url} (${controller}@${action})";

        Log::debug("${message} - Start");
        $response = $next($request, $response);
        Log::debug("${message} - End");

        return $response;
    }
}
