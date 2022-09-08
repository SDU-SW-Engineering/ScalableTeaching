<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function preferences(Course $course, Task $task): View
    {
        return view('tasks.admin.preferences');
    }

    public function saveDescription(Course $course, Task $task): string
    {
        $markdown = request('markdown');
        $html = Http::post(getenv('FORMATTER_SERVICE_URL') . '/md', ['text' => $markdown])->json('html');

        $task->description = $html;
        $task->markdown_description = $markdown;
        $task->save();

        return "OK";
    }

    public function updateTitle(Course $course, Task $task): RedirectResponse
    {
        $validated = request()->validateWithBag('title', [
            'title' => 'required',
        ]);

        $task->update(['name' => $validated['title']]);

        return back()->with('title-success', 'Changes saved');
    }

    public function updateDuration(Course $course, Task $task): RedirectResponse
    {
        $validated = request()->validateWithBag('duration', [
            'from'       => ['required', 'date', 'before_or_equal:to'],
            'to'         => ['required', 'date', 'after_or_equal:from'],
            'start-time' => ['required', 'date_format:H:i'],
            'end-time'   => ['required', 'date_format:H:i'],
        ]);

        $from = Carbon::parse($validated['from'] . " " . $validated['start-time']);
        $to = Carbon::parse($validated['to'] . " " . $validated['end-time']);

        if($from->isAfter($to) || $from->eq($to))
            return back()->withInput()->withErrors('The from date must happen before the to date.', 'duration');

        $task->update([
            'starts_at' => $from,
            'ends_at'   => $to,
        ]);

        return back()->with('duration-success', 'Changes saved');
    }

    public function toggleVisibility(Course $course, Task $task) : string
    {
        $task->is_visible = ! $task->is_visible;
        $task->save();

        return "ok";
    }
}
