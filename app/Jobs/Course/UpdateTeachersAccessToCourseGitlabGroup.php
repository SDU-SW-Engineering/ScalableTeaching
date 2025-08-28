<?php

namespace App\Jobs\Course;

use App\Models\Course;
use Domain\GitLab\Definitions\GitLabUserAccessLevelEnum;
use Exception;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Log;

class UpdateTeachersAccessToCourseGitlabGroup implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Course $course, public int $level = GitLabUserAccessLevelEnum::OWNER->value)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->course->teacher_access_to_gitlab_group)
        {
            foreach ($this->course->teachers()->get() as $teacher)
            {
                try
                {
                    app(GitLabManager::class)->groups()->addMember($this->course->gitlab_group_id, $teacher->gitlab_id, $this->level);
                    continue;
                } catch (Exception $exception)
                {
                    Log::error("An error occured trying to add teacher: ". $teacher->name . " From the Gitlab group of course: ".$this->course->name);
                    Log::error($exception->getMessage());
                }
            }
        } else
        {
            foreach ($this->course->teachers()->get() as $teacher)
            {
                try
                {
                    app(GitLabManager::class)->groups()->removeMember($this->course->gitlab_group_id, $teacher->gitlab_id);
                    continue;
                } catch (Exception $exception)
                {
                    Log::error("An error occured trying to remove teacher: ". $teacher->name . " From the Gitlab group of course: ".$this->course->name);
                    Log::error($exception->getMessage());
                }
            }
        }
    }
}
