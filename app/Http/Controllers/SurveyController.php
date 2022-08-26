<?php

namespace App\Http\Controllers;

use App\Exports\SurveyExport;
use App\Models\Enums\SurveyFieldType;
use App\Models\Project;
use App\Models\Survey;
use App\Models\Task;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit,survey')->except('index', 'all');
    }

    public function index()
    {
        return view('surveys.index');
    }

    public function all()
    {
        return auth()->user()->surveys()->withCount('responses')->get()->map(fn(Survey $survey) => [
            'id' => $survey->id,
            'name' => $survey->name,
            'responses_count' =>  $survey->responses_count,
            'created_at' => $survey->created_at,
        ]);
    }

    public function details(Survey $survey)
    {
        $survey->load(['responses', 'fields.items']);

        return $survey;
    }

    public function projectSurvey(Request $request, Project $project, Survey $survey)
    {
        abort_unless(auth()->user()->can('answer', [$survey, $project]), 400, "You cannot answer this survey");
        $fields = [];

        $surveyFields = $survey->fields;

        $environment = [
            'track.name' => $project->task->track?->path()->reverse()->pluck('name')->join(' / '),
        ];

        foreach($surveyFields as $field)
        {
            if($field->type == SurveyFieldType::Environment)
            {
                $fields[] = [
                    'field'  => $field->id,
                    'values' => [
                        'value'  => strtr($field->question, $environment),
                        'extras' => null,
                    ],
                ];
                continue;
            }

            $validItemIds = $field->items->pluck('id');
            $value = $request->json('values.v' . $field->id);
            if(is_array($value))
            {
                $temp = [];
                foreach($value as $item)
                {
                    abort_if( ! $validItemIds->contains($item), 400, 'Invalid option supplied.');
                    $temp[] = [
                        'value'  => $item,
                        'extras' => $request->json('extras.v' . $item),
                    ];
                }
                $fields[] = [
                    'field'  => $field->id,
                    'values' => $temp,
                ];
                continue;
            }
            abort_if( ! $validItemIds->contains($value), 400, 'Invalid option supplied.');

            $fields[] = [
                'field'  => $field->id,
                'values' => [
                    'value'  => $value,
                    'extras' => $request->json('extras.v' . $value),
                ],
            ];
        }

        $survey->responses()->create([
            'user_id'      => auth()->id(),
            'ownable_id'   => $project->task_id,
            'ownable_type' => Task::class,
            'response'     => $fields,
        ]);

        return "OK";
    }

    public function export(Survey $survey)
    {
        return Excel::download(new SurveyExport($survey), $survey->name . '.xlsx');
    }
}
