<?php

namespace TRF4\UI\Util\Autocomplete\Single;

class NullObject extends AbstractAutocompleteObject
{

    public function __construct()
    {
    }

    public function value()
    {
        return null;
    }

    public function object(): array
    {
        return [];
    }
}
