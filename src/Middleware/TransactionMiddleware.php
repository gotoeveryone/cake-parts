<?php

namespace Gotoeveryone\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;

/**
 * アプリケーションのリクエスト単位でトランザクションを設定します。
 */
class TransactionMiddleware
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
        $conn = ConnectionManager::get('default');
        return $conn->enableSavePoints(true)
            ->transactional(function($conn) use ($request, $response, $next) {
                try {
                    $res = $next($request, $response);
                    Log::debug('Commit the transaction.');
                    return $res;
                } catch (Exception $e) {
                    Log::error('Error! Rollback the transaction...');
                    throw $e;
                }
            });
    }
}
