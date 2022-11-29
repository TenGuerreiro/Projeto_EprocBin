<?php

namespace TRF4\UI\Component;


use TRF4\UI\Util\Autocomplete\Multi\AbstractAutocompleteObject;

abstract class Autocomplete extends AbstractAutocomplete
{
    /** @var bool */
    public $isMultiple = false;
    /** @var AbstractAutocompleteObject|array */
    public $selectedValue = [];

    /**
     * Define o valor inicial do componente.
     * Pode ser uma string ou um array.
     * @param $value
     * @return $this
     */
    public function selectedValue($value): self
    {
        if (!$value instanceof \TRF4\UI\Util\Autocomplete\Single\AbstractAutocompleteObject) {
            $value = [$value];
        }
        $this->selectedValue = $value;
        return $this;
    }

}
