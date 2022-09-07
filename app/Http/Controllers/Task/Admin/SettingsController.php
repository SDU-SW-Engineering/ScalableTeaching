<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function preferences(Course $course, Task $task) : View
    {
        return view('tasks.admin.preferences');
    }

    public function saveDescription(Course $course, Task $task) : string
    {
        $markdown = request('markdown');
        $html = Http::post(getenv('FORMATTER_SERVICE_URL').'/md', ['text' => $markdown])->json('html');

        $task->description = $html;
        $task->markdown_description = $markdown;
        $task->save();

        return "OK";
    }
}
