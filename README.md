# From helpers to middleware
A nice way to use middleware approach is to set a stack different steps, they can be success or fail and return the right response data and code.
Marco Pivetta gave a talk about [From helpers to middleware](https://www.youtube.com/watch?v=MjpiHy_e8kQ).

Middleware standard comes from [PSR-15: HTTP Server Request Handlers](https://www.php-fig.org/psr/psr-15/meta/#queue-based-request-handler).
About this topic you can find also good talks like [PSR-15: Http Server Request Handlers - Singapore PHP User Group](https://www.youtube.com/watch?v=rx1maWrjZBs).
If you will using middleware standard of PSR-15 for symfony, you have a problem of compatibility with PSR-15.
I know it's possible to [convert to PSR-7 in symfony](https://symfony.com/blog/psr-7-support-in-symfony-is-here).
Or you use your own middleware interface.

With this example you can check out how can it work with symfony request and response objects.

## How it works
We've a ToDo app, where you should be able to delete a todo list.
In our controller `src/Queue/DefaultController.php` is our handler stack with middleware.

    $queue = new QueueRequestHandler();
    
    $queue->add(new ValidToDoList());
    $queue->add(new AllDoneToDoList($databaseToDoList));
    $queue->add(new DeleteToDoList());
    
    return $queue->handle($request);


First we've `ValidToDoList` as validator. If you will delete a todo list with wrong id ...
> http://localhost/?listid=dfd

... you get an error.
> {"message":"Invalid todo list id"}

Next handler `AllDoneToDoList` is checking weather all todos in list are done.
Todo list with id 1 is...
> http://localhost/?listid=1

... not yet done
> {"message":"ToDo List not done"}

The last handler `DeleteToDoList` will delete our todo list, for example the 3...
> http://localhost/?listid=3

... and you get a successful response
> {"message ":"ToDo list with id 3 deleted"}