<?php

namespace App\Http\Middleware;

use Silber\PageCache\Middleware\CacheResponse as BaseCacheResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse extends BaseCacheResponse
{
    protected function shouldCache(Request $request, Response $response)
    {

        if (!env('PRODUCTION')) {
            return false;
        }

        return $request->isMethod('GET') && $response->getStatusCode() == 200;
    }

}