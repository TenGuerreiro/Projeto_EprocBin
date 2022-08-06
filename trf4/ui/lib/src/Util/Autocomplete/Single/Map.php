<?php

namespace TRF4\UI\Util\Autocomplete\Single;

class Map extends AbstractAutocompleteObject
{

    public function value()
    {
        return array_keys($this->data)[0];
    }

    public function object(): array
    {
        return $this->data;
    }
}
