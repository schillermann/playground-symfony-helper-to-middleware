<?php
namespace App\Queue;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AllDoneToDoList implements MiddlewareInterface
{
    protected $databaseToDoList;

    function __construct(array $databaseToDoList)
    {
        $this->databaseToDoList = $databaseToDoList;
    }

    function process(Request $request, RequestHandlerInterface $handler): JsonResponse
    {
        $listId = (int)$request->query->get('listid');
        if(isset($this->databaseToDoList[$listId]) && $this->databaseToDoList[$listId]['isDone']) {
            return $handler->handle($request);
        }

        return new JsonResponse(['message' => 'ToDo List not done'], Response::HTTP_FORBIDDEN);
    }
}