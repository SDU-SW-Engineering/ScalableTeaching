<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectSubTask;
use App\Models\Task;
use App\Models\User;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use GraphQL\Client;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function pushes(Course $course, Task $task) : View
    {
        $pushes = $task->pushes()->with(['project.ownable'])->latest()->paginate(50);

        return view('tasks.admin.pushes', compact('pushes'));
    }

    public function gradingOverview(Course $course, Task $task) : View
    {
        return view('tasks.admin.gradingOverview');
    }
}
