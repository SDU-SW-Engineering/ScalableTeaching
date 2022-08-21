<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use InvalidArgumentException;

class SubTask implements Arrayable
{
    public ?int $id = null;
    private ?bool $isRequired = null;
    public ?int $points = null;

    public function __construct(private string $name, private ?string $alias = null, public ?string $group = null)
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function hasId(): bool
    {
        return $this->id != null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->alias ?? $this->name;
    }

    /**
     * @return bool|null
     */
    public function isRequired(): ?bool
    {
        return $this->isRequired;
    }

    /**
     * @param bool|null $isRequired
     */
    public function setIsRequired(?bool $isRequired): SubTask
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }


    /**
     * @param int|null $points
     */
    public function setPoints(?int $points): SubTask
    {
        $this->points = $points;

        return $this;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $alias
     */
    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return string|null
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string|null $group
     */
    public function setGroup(?string $group): void
    {
        $this->group = $group;
    }

    public function toArray()
    {
        return [
            'id'     => $this->id,
            'points' => $this->points,
            'group'  => $this->group,
            'name'   => $this->name,
            'alias'  => $this->alias,
        ];
    }
}
