<?php

namespace TRF4\UI\Util\Autocomplete\Multi;

class NullObject extends AbstractAutocompleteObject
{

    public function __construct()
    {
    }

    public function values(): array
    {
        return [];
    }

    public function objects(): array
    {
        return [];
    }
}
