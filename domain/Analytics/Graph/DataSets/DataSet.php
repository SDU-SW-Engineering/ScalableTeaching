<?php

namespace Domain\Analytics\Graph\DataSets;

use App\Models\Project;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * @implements Arrayable<string, Collection|string>
 */
class DataSet implements Arrayable
{
    protected string $borderColor;

    protected string $backgroundColor;

    protected string $label;

    /** @var Collection<int, Project> */
    protected Collection $data;

    /**
     * @param string $label
     * @param Collection<int, Project> $data
     * @param string $color
     * @param bool $transparent
     */
    public function __construct(string $label, Collection $data, string $color, bool $transparent = false)
    {
        $this->label = $label;
        $this->data = $data->values();
        $this->borderColor = $color;
        $this->backgroundColor = $color . ($transparent ? "44" : "");
    }

    public function toArray()
    {
        return [
            'borderColor'     => $this->borderColor,
            'backgroundColor' => $this->backgroundColor,
            'label'           => $this->label,
            'data'            => $this->data,
        ];
    }
}
