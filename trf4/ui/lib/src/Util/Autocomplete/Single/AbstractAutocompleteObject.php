<?php

namespace TRF4\UI\Util\Autocomplete\Single;

abstract class AbstractAutocompleteObject
{

    public function __construct(string $name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public abstract function value();

    public abstract function object(): array;
}
