<?php

namespace App\Console\Commands;

use App\Exports\GradeExport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExportGradings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:gradings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grading description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Excel::store(new GradeExport(Task::whereIn('id', [14, 15])->get()), 'points.xlsx');

        return 0;
    }
}
