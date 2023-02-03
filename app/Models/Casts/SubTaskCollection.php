<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class SubTaskCollection implements Castable
{
    /**
     * @var Collection<int, SubTask>
     */
    private Collection $tasks;

    /**
     * @param  Collection<int, SubTask>|null  $tasks
     */
    public function __construct(Collection $tasks = null)
    {
        if ($tasks == null) {
            $tasks = new Collection();
        }
        $this->tasks = $tasks;
    }

    public function isEmpty(): bool
    {
        return $this->tasks->isEmpty();
    }

    public function count(): int
    {
        return $this->tasks->count();
    }

    /**
     * @return Collection<int,SubTask>
     */
    public function onlyRequired(): Collection
    {
        return $this->tasks->filter(fn (SubTask $task) => $task->isRequired());
    }

    /**
     * @return Collection<int,SubTask>
     */
    public function all(): Collection
    {
        return $this->tasks;
    }

    /**
     * @return Collection<int,int|null>
     */
    private function ids(): Collection
    {
        return $this->tasks->map(fn (SubTask $task) => $task->getId());
    }

    public function maxPoints(): int
    {
        return $this->tasks->reduce(fn ($carry, SubTask $task) => $carry + $task->getPoints());
    }

    /**
     * @return Collection<int,int|null>
     */
    private function requiredIds(): Collection
    {
        return $this->tasks
            ->filter(fn (SubTask $task) => $task->isRequired())
            ->map(fn (SubTask $task) => $task->getId());
    }

    /**
     * @param  Collection<int,int|null>  $completedIds
     * @return Collection<int,int|null>
     */
    public function missing(Collection $completedIds): Collection
    {
        return $this->ids()->diff($completedIds);
    }

    /**
     * @param  Collection<int,int|null>  $completedIds
     * @return bool
     */
    public function isMissingAny(Collection $completedIds): bool
    {
        return $this->missing($completedIds)->count() > 0;
    }

    /**
     * @param  Collection<int,int|null>  $completedIds
     * @return bool
     */
    public function isMissingAnyRequired(Collection $completedIds): bool
    {
        return $this->requiredIds()->diff($completedIds)->count() > 0;
    }

    /**
     * @param  Collection<int,int|null>  $completedIds
     * @return int
     */
    public function points(Collection $completedIds): int
    {
        return $this->tasks
                ->filter(fn (SubTask $task) => $completedIds->contains($task->getId()))
                ->reduce(fn ($carry, SubTask $task) => $carry + ($task->getPoints() ?? 0));
    }

    public function add(SubTask $subTask): void
    {
        $this->tasks[] = $subTask;
    }

    public function update(int $id, SubTask $subTask): void
    {
        $updateIndex = $this->tasks->search(fn (SubTask $subTask) => $subTask->getId() == $id);
        $this->tasks[$updateIndex]->setPoints($subTask->getPoints());
        $this->tasks[$updateIndex]->setIsRequired($subTask->isRequired());
        $this->tasks[$updateIndex]->setName($subTask->getName());
        $this->tasks[$updateIndex]->setAlias($subTask->getAlias());
    }

    public function remove(array $ids): void
    {
        foreach ($ids as $id) {
            $foundId = $this->tasks->search(fn (SubTask $subTask) => $subTask->getId() == $id);
            if ($foundId === false) {
                continue;
            }
            $this->tasks->forget($foundId);
        }
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes
        {
            public function get($model, string $key, $value, array $attributes): SubTaskCollection
            {
                if ($value == null) {
                    return new SubTaskCollection();
                }

                return new SubTaskCollection((new Collection(json_decode($value, true)))->map(function ($v) {
                    $task = new SubTask($v['name'], $v['alias']);
                    $task->setId($v['id']);
                    $task->setIsRequired($v['required'] ?? null);
                    $task->setPoints($v['points'] ?? null);
                    $task->setGroup($v['group'] ?? null);

                    return $task;
                }));
            }

            public function set($model, string $key, $value, array $attributes): bool|string
            {
                $values = $value instanceof SubTaskCollection ? $value->all() : new Collection($value);
                throw_unless($values->every(fn ($v) => $v instanceof SubTask), InvalidArgumentException::class, 'Every item must be a SubTask instance.');
                $id = $values->max(fn (SubTask $task) => $task->getId()) ?? 0;

                return $values->map(function (SubTask $subTask) use (&$id) {
                    return [
                        'id' => $subTask->hasId() ? $subTask->getId() : ++$id,
                        'name' => $subTask->getName(),
                        'alias' => $subTask->getAlias(),
                        'points' => $subTask->getPoints(),
                        'required' => $subTask->isRequired(),
                        'group' => $subTask->getGroup(),
                    ];
                })->toJson();
            }
        };
    }
}
