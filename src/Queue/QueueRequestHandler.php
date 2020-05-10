<?php
namespace App\Queue;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QueueRequestHandler implements RequestHandlerInterface
{
    protected $middleware = [];

    public function add(MiddlewareInterface $middleware): self
    {
        $this->middleware[] = $middleware;
        return $this;
    }

    public function handle(Request $request): Response
    {
        if (0 === count($this->middleware)) {
            throw new \Exception('Latest request handler should return a response');
        }

        $middleware = array_shift($this->middleware);

        return $middleware->process($request, $this);
    }
}