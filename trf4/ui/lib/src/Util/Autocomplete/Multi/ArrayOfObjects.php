<?php

namespace TRF4\UI\Util\Autocomplete\Multi;

class ArrayOfObjects extends AbstractAutocompleteObject
{

    public function values(): array
    {
        return array_keys($this->data);
    }

    public function objects(): array
    {
        return array_values($this->data);
    }
}
