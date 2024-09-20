<?php

namespace App\Console\Commands;

use App\Exceptions\TaskDelegationException;
use App\Models\TaskDelegation;
use Illuminate\Console\Command;
use Throwable;

class DelegateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:delegate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delegates tasks when the task has ended.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /** @var TaskDelegation $taskDelegation */
        foreach(TaskDelegation::undelegated()->get() as $taskDelegation)
        {
            try
            {
                $taskDelegation->delegate();
            } catch(TaskDelegationException|Throwable $e)
            {
                $this->error($e->getMessage());
            }
        }

        return 0;
    }
}
