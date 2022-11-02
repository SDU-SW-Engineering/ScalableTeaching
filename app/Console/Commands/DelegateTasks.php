<?php

namespace App\Console\Commands;

use App\Exceptions\TaskDelegationException;
use App\Models\TaskDelegation;
use Illuminate\Console\Command;

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
    public function handle()
    {
        foreach (TaskDelegation::undelegated()->get() as $taskDelegation) {
            /** @var TaskDelegation $taskDelegation */
            if (now()->isBefore($taskDelegation->task->ends_at)) {
                continue;
            }
            try {
                $taskDelegation->delegate();
            } catch(TaskDelegationException $e) {
                $this->error($e->getMessage());
            }
        }

        return 0;
    }
}
