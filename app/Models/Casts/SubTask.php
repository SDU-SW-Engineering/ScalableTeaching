<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class SubTask
{
    private ?int $id = null;
    private ?bool $isRequired = null;
    private ?int $points = null;

    public function __construct(private string $name, private ?string $alias = null)
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
    public function getAlias() : ?string
    {
        return $this->alias;
    }

    public function hasId() : bool
    {
        return $this->id != null;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function isRequired() : ?bool
    {
        return $this->isRequired;
    }

    /**
     * @param bool|null $isRequired
     */
    public function setIsRequired(?bool $isRequired) : SubTask
    {
        $this->isRequired = $isRequired;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPoints() : ?int
    {
        return $this->points;
    }


    /**
     * @param int|null $points
     */
    public function setPoints(?int $points) : SubTask
    {
        $this->points = $points;

        return $this;
    }


    public function setId($id)
    {
        $this->id = $id;
    }
}
