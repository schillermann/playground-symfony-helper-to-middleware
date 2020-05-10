<?php
namespace App\Queue;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidToDoList implements MiddlewareInterface
{
    function process(Request $request, RequestHandlerInterface $handler): JsonResponse
    {
        $listId = $request->query->get('listid');
        if(is_numeric($listId)) {
            return $handler->handle($request);
        }

        return new JsonResponse(['message' => 'Invalid todo list id'], Response::HTTP_BAD_REQUEST);
    }
}