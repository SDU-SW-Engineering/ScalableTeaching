<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class SubTaskCollection implements Castable
{
    /**
     * @var Collection
     */
    private Collection $tasks;

    public function __construct(array $tasks = [])
    {
        $this->tasks = collect($tasks);
    }

    public function isEmpty() : bool
    {
        return $this->tasks->isEmpty();
    }

    public function count() : int
    {
        return $this->tasks->count();
    }

    public function onlyRequired() : Collection
    {
        return $this->tasks->filter(fn(SubTask $task) => $task->isRequired());
    }

    public function all() : Collection
    {
        return $this->tasks;
    }

    private function ids()
    {
        return $this->tasks->map(fn(SubTask $task) => $task->getId());
    }

    public function maxPoints()
    {
        return $this->tasks->reduce(fn($carry, SubTask $task) => $carry + $task->getPoints());
    }

    private function requiredIds()
    {
        return $this->tasks
            ->filter(fn(SubTask $task) => $task->isRequired())
            ->map(fn(SubTask $task) => $task->getId());
    }

    public function missing(Collection $completedIds) : Collection
    {
        return $this->ids()->diff($completedIds);
    }

    public function isMissingAny(Collection $completedIds) : bool
    {
        return $this->missing($completedIds)->count() > 0;
    }

    public function isMissingAnyRequired(Collection $completedIds) : bool
    {
        return $this->requiredIds()->diff($completedIds)->count() > 0;
    }

    public function points(Collection $completedIds) : int
    {
        return $this->tasks
                ->filter(fn(SubTask $task) => $completedIds->contains($task->getId()))
                ->reduce(fn($carry, SubTask $task) => $carry + $task->getPoints()) ?? 0;
    }

    public function add(SubTask $subTask)
    {
        $this->tasks[] = $subTask;
    }

    public function update(int $id, SubTask $subTask)
    {
        /** @var SubTask $update */
        $update = $this->tasks->search(fn(SubTask $subTask) => $subTask->getId() == $id);
        $this->tasks[$update]->setPoints($subTask->getPoints());
        $this->tasks[$update]->setIsRequired($subTask->isRequired());
        $this->tasks[$update]->setName($subTask->getName());
        $this->tasks[$update]->setAlias($subTask->getAlias());
    }

    public function remove(array $ids)
    {
        foreach($ids as $id)
        {
            $foundId = $this->tasks->search(fn(SubTask $subTask) => $subTask->getId() == $id);
            if ($foundId === false)
                continue;
            $this->tasks->forget($foundId);
        }
    }

    public static function castUsing(array $arguments) : CastsAttributes
    {
        return new class implements CastsAttributes {

            public function get($model, string $key, $value, array $attributes) : SubTaskCollection
            {
                if ($value == null)
                    return new SubTaskCollection();

                return new SubTaskCollection(collect(json_decode($value, true))->map(function ($v)
                {
                    $task = new SubTask($v['name'], $v['alias']);
                    $task->setId($v['id']);
                    $task->setIsRequired($v['required'] ?? null);
                    $task->setPoints($v['points'] ?? null);
                    return $task;
                })->toArray());
            }

            public function set($model, string $key, $value, array $attributes) : bool|string
            {
                $values = $value instanceof SubTaskCollection ? $value->all() : collect($value);
                throw_unless($values->every(fn($v) => $v instanceof SubTask), InvalidArgumentException::class, "Every item must be an SubTask instance.");
                $id = $values->max(fn(SubTask $task) => $task->getId()) ?? 0;

                return $values->map(function (SubTask $subTask) use (&$id)
                {
                    return [
                        'id'       => $subTask->hasId() ? $subTask->getId() : ++$id,
                        'name'     => $subTask->getName(),
                        'alias'    => $subTask->getAlias(),
                        'points'   => $subTask->getPoints(),
                        'required' => $subTask->isRequired()
                    ];
                })->toJson();
            }
        };
    }
}
