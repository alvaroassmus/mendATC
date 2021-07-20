<?php

namespace App\Models\Atc;

class Aircraft
{
    /** @var int */
    private $id;
    /** @var string */
    private $type;
    /** @var string */
    private $size;

    function __construct($type, $size, $id = 0)
    {
        $this->id = $id;
        $this->type = $type;
        $this->size = $size;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'size' => $this->size
        ];
    }
}
