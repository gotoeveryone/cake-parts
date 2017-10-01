<?php

namespace Gotoeveryone\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Cake\Log\Log;

/**
 * アクションへのアクセスを記録します。
 */
class TraceMiddleware
{
    /**
     * ミドルウェアの実行メソッド
     *
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @param callable $next
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
