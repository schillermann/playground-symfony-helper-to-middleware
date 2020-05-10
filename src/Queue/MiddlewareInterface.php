<?php
namespace App\Queue;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

interface MiddlewareInterface
{
    function process(Request $request, RequestHandlerInterface $next): Response;
}