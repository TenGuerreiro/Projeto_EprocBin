<?php

namespace TRF4\UI\Component;


use TRF4\UI\Util\Autocomplete\Multi\AbstractAutocompleteObject;

abstract class MultiAutocomplete extends AbstractAutocomplete
{
    /** @var bool */
    public $isMultiple = true;
    /** @var array|AbstractAutocompleteObject */
    public $selectedValues = [];

    /**
     * Define os valores iniciais do componente
     * @param array|AbstractAutocompleteObject $values
     * @return $this
     */
    public function selectedValues($values): self
    {
        $this->selectedValues = $values;
        return $this;
    }
}
