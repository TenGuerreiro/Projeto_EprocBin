<?php

namespace TRF4\UI\Util\Autocomplete\Multi;

abstract class AbstractAutocompleteObject
{

    public function __construct(string $name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public abstract function values(): array;

    public abstract function objects(): array;
}
