<?php

namespace TRF4\UI\Util\Autocomplete\Multi;

class Map extends AbstractAutocompleteObject
{

    public function values():array
    {
        return array_keys($this->data);
    }

    public function objects(): array
    {
        return $this->data;
    }
}
