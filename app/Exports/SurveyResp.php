<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SurveyResp implements FromQuery, WithTitle, WithMapping, WithHeadings
{
    private readonly array $questions;

    private readonly array $items;

    public function __construct(private Survey $survey)
    {
        $this->questions = $this->survey->fields->pluck('question', 'id')->toArray();
        $this->items = $this->survey->fields()->with('items')->get()->pluck('items', 'id')->flatten()->pluck('name', 'id')->toArray();
    }

    /**
     * @return EloquentBuilder<SurveyResponse>
     */
    public function query(): EloquentBuilder
    {
        return SurveyResponse::query()->where('survey_id', $this->survey->id)->orderBy('created_at');
    }

    public function title(): string
    {
        return 'Responses';
    }

    public function map($row): array
    {
        $response = new Collection($row->response);

        return [$row->user->name, ...$response->map(function ($response) {
            $values = new Collection($response['values']);
            if ($values->has('value')) {
                $value = $values['value'];
                $text = match (true) {
                    is_int($value) => $this->items[$value], //@phpstan-ignore-line
                    default => $value
                };
            } else {
                $text = collect($values)->map(function ($values) {
                    $partialResponse = $this->items[$values['value']];
                    if (array_key_exists('extras', $values) && $values['extras'] != null) { //@phpstan-ignore-line
                        $partialResponse .= " {$values['extras']}";
                    }

                    return $partialResponse;
                })->implode(';');
            }

            return $text;
        })->toArray(), $row->created_at->toDateTimeString()];
    }

    public function headings(): array
    {
        return ['Submitted By', ...$this->questions, 'Submitted At'];
    }
}
