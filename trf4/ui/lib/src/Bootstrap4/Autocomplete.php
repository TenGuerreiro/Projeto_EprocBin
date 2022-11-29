<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Config;
use TRF4\UI\Util\Autocomplete\Single\AbstractAutocompleteObject;

class Autocomplete extends \TRF4\UI\Component\Autocomplete
{
    use AutocompleteActions;

    protected function getJSSelectedValues(): string
    {
        if ($this->selectedValue instanceof AbstractAutocompleteObject) {
            $values = $this->selectedValue->object();
        } else {
            $values = $this->selectedValue;
        }

        $fn = Config::$autocompleteBeforeJsonEncodeValuesHook;

        if (is_callable($fn)) {
            $values = $fn($values);
        }

        return json_encode($values);
    }
}
