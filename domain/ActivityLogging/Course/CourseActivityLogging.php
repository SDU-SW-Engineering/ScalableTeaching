<?php

namespace Domain\ActivityLogging\Course;

use App\Models\CourseActivity;
use App\Models\Enums\CourseActivityType;
use Illuminate\Database\Eloquent\Model;

trait CourseActivityLogging
{
    public static function bootCourseActivityLogging(): void
    {
        static::created(function(Model $model) {
            try {
                $message = $model->logCreated($model); // @phpstan-ignore-line
                if($message == null)
                    return;

                CourseActivity::create([
                    'course_id'      => $message->courseId,
                    'affected_id'    => $message->affectedUserId,
                    'affected_by_id' => $message->affectedByUserId,
                    'resource_type'  => $model::class,
                    'resource_id'    => $model->getKey(),
                    'message'        => $message->message,
                    'type'           => CourseActivityType::Created,
                    'additional'     => $message->additional
                ]);
            } catch(\Exception $e) {
            }
        });

        static::updated(function(Model $model) {
            $message = $model->logUpdated($model); // @phpstan-ignore-line
            if($message == null)
                return;

            CourseActivity::create([
                'course_id'     => $message->courseId,
                'affected'      => $message->affectedUserId,
                'affected_by'   => $message->affectedByUserId,
                'resource_type' => $model::class,
                'resource_id'   => $model->{$model->getKey()},
                'message'       => $message->message,
                'type'          => CourseActivityType::Updated,
                'additional'    => $message->additional
            ]);
        });

        static::deleted(function(Model $model) {
            try {
                $message = $model->logDeleted($model); // @phpstan-ignore-line
                if($message == null)
                    return;

                CourseActivity::create([
                    'course_id'      => $message->courseId,
                    'affected_id'    => $message->affectedUserId,
                    'affected_by_id' => $message->affectedByUserId,
                    'resource_type'  => $model::class,
                    'resource_id'    => $model->getKey(),
                    'message'        => $message->message,
                    'type'           => CourseActivityType::Deleted,
                    'additional'     => $message->additional
                ]);
            } catch(\Exception $e) {
            }
        });
    }

    protected function logCreated(Model $created): ?CourseActivityMessage
    {
        return null;
    }

    protected function logUpdated(Model $updated): ?CourseActivityMessage
    {
        return null;
    }

    protected function logDeleted(Model $deleted): ?CourseActivityMessage
    {
        return null;
    }
}
