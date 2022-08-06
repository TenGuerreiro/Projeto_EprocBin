<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Util\Autocomplete\Multi\AbstractAutocompleteObject;

class MultiAutocomplete extends \TRF4\UI\Component\MultiAutocomplete
{
    use AutocompleteActions;

    protected function getJSSelectedValues(): string
    {
        if ($this->selectedValues instanceof AbstractAutocompleteObject) {
            $values = $this->selectedValues->objects();
        } else {
            $values = $this->selectedValues;
        }

        return json_encode($values);
    }
}
