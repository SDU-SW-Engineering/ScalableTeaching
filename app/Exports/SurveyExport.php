<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\SurveyField;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SurveyExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct(public Survey $survey)
    {

    }

    public function sheets(): array
    {
      return [new SurveyResp($this->survey)];
    }
}
