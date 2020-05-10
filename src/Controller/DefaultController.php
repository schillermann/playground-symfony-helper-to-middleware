<?php
namespace App\Controller;

use App\Queue\AllDoneToDoList;
use App\Queue\DeleteToDoList;
use App\Queue\ValidToDoList;
use App\Queue\QueueRequestHandler;
use Symfony\Component\HttpFoundation\Request;

class DefaultController
{
    function index(Request $request)
    {
        $databaseToDoList = [
          1 => [ 'isDone' => false ],
          2 => [ 'isDone' => false ],
          3 => [ 'isDone' => true ]
        ];

        $queue = new QueueRequestHandler();

        $queue->add(new ValidToDoList());
        $queue->add(new AllDoneToDoList($databaseToDoList));
        $queue->add(new DeleteToDoList());

        return $queue->handle($request);
    }
}