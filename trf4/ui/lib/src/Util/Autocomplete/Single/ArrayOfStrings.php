<?php

namespace TRF4\UI\Util\Autocomplete\Single;

class ArrayOfStrings extends AbstractAutocompleteObject
{

    public function value()
    {
        return array_keys($this->data)[0];
    }

    public function object(): array
    {
        return array_keys($this->data);
    }
}
