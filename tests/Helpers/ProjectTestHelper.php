<?php


use App\Models\Casts\SubTask;
use Faker\Factory;


/**
 * @param array{title: string, points?: int} $subtaskData
 * @return SubTask[]
 */
function createSubTasks(array $subtaskData):  array
{
    $subTaskArray = [];

    foreach ($subtaskData as $subtask)
    {
        $subTask = new SubTask($subtask['title'], $subtask['title']);
        $subTask->setId(fake()->unique()->randomNumber());
        if (isset($subtask['points']))
        {
            $subTask->setPoints($subtask['points']);
        }
        $subTaskArray[] = $subTask;
    }

    return $subTaskArray;
}

?>
