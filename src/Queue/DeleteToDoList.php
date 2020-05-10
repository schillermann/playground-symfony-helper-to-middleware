<?php
namespace App\Queue;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteToDoList implements MiddlewareInterface
{
    function process(Request $request, RequestHandlerInterface $handler): JsonResponse
    {
        $listId = $request->query->get('listid');

        return new JsonResponse(['message ' => 'ToDo list with id ' . $listId . ' deleted']);
    }
}