<?php

namespace TRF4\UI\Labeled;

use Exception;
use TRF4\UI\Component\Customizable;
use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Element\GenericElement;
use TRF4\UI\UI;
use TRF4\UI\Util\AjaxCallback;
use TRF4\UI\Util\Dependency;
use TRF4\UI\Util\Option;

abstract class Select extends AbstractElementWithLabel
{

    use Customizable;
    use ActivatedBy;

    /**
     * @var Dependency[]|Dependency
     */
    public $dependencies;
    /** @var AjaxCallback */
    public $callback;
    /** @var bool */
    public $withSearchFilter = false;
    /** @var GenericElement */
    public $_select;
    /** @var GenericElement */
    public $_wrapper;
    /** @var Option[]|array */
    protected $options = [];
    /** @var bool */
    private $required = false;
    /** @var string|null */
    public $placeholder = null;
    /** @var array */
    private $selectedValues = [];

    /**
     * SelectWrapper constructor.
     * @param string|null $labelInnerHtml
     * @param string|null $name
     * @param array $options
     */
    public function __construct(?string $labelInnerHtml = null, ?string $name = null, array $options = [])
    {
        parent::__construct($labelInnerHtml);
        $this->_select = new GenericElement('select');
        $this->_wrapper = new GenericElement('div');

        if ($name) {
            $this->name($name);
        }

        $this->options = $options;
    }

    public function placeholder(string $string): self
    {
        $this->placeholder = $string;
        return $this;
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_select;
    }

    /**
     * Recebe uma string, número ou array destes.
     * Marca as respectivas opções (com base em seus valores/chaves como selecionadas.
     *
     * Note que o array de valores selecionados s� faz sentido em um select que teve o método ->multiple() invocado.
     * @param $selectedValueOrValues
     * @return $this
     * @throws Exception
     */
    public function selected($selectedValueOrValues = null): self
    {
        if ($this->isEmptyValue($selectedValueOrValues)) {
            return $this;
        }

        if (!is_array($selectedValueOrValues)) {
            $selectedValueOrValues = [$selectedValueOrValues];
        }

        $this->validateSelectedValues($selectedValueOrValues);

        $this->selectedValues = $selectedValueOrValues;
        return $this;
    }

    private function isEmptyValue($selectedValueOrValues)
    {
        return is_null($selectedValueOrValues)
            || $selectedValueOrValues === ''
            || (is_array($selectedValueOrValues) and count($selectedValueOrValues) === 0);
    }

    /**
     * @param array $selectedValueOrValues
     * @throws Exception
     */
    protected function validateSelectedValues(array $selectedValueOrValues)
    {
        foreach ($selectedValueOrValues as $value) {
            if (!is_string($value) and
                !is_numeric($value) and
                !is_null($value)
            ) {
                throw new Exception('O método select aceita apenas string, número ou um array destes');
            }
        }
    }

    /**
     * @param string|string[] $id
     * @param $dataProviderUrl
     */
    public function dependsOn($dependencies, string $dataProviderUrl)
    {
        $this->dependencies = $dependencies;
        $this->dataProviderURL = $dataProviderUrl;
    }

    /**
     * @param Dependency|Dependency[] $dependency
     * @param AjaxCallback $callback
     * @return Select
     */
    public function dependencies($dependency, AjaxCallback $callback)
    {
        $this->dependencies = !is_array($dependency) ? [$dependency] : $dependency;
        $this->callback = $callback;
        return $this;
    }

    /**
     * Adiciona um filtro de busca simples ao select
     * @return $this
     */
    public function searchable(): self
    {
        $this->withSearchFilter = true;
        return $this;
    }

    public function width(string $width): self
    {
        $this->dataWidth($width);
        return $this;
    }

    protected function optionsToHtml(): string
    {
        $optionsHtml = '';

        if ($this->placeholder !== null) {
            $optionsHtml .= $this->buildOption('', $this->placeholder);
        }

        foreach ($this->options as $k => $v) {
            $optionsHtml .= $this->buildOption($k, $v);
        }
        return $optionsHtml;
    }

    protected function buildOption($value, $innerHtml): string
    {
        if (is_array($innerHtml)) {
            return $this->createOptGroup($innerHtml);
        } else {
            return $this->KVtoOptionHtml($value, $innerHtml);

        }
    }

    protected function createOptGroup(array $optgroup)
    {
        $this->validateOptgroup($optgroup);

        $label = $optgroup[0];
        $values = $optgroup[1];
        $disabled = $optgroup[2] ?? false;
        $attrDisabled = $disabled ? 'disabled="disabled"' : '';

        $html = "<optgroup $attrDisabled label=\"$label\">";

        foreach ($values as $k => $v) {
            $html .= $this->KVtoOptionHtml($k, $v);
        }

        $html .= "</optgroup>";
        return $html;
    }

    /**
     * @param array $optgroup
     * @throws Exception
     */
    private function validateOptgroup(array $optgroup)
    {
        foreach ($optgroup[1] as $v) {
            if (is_array($v)) {
                throw new Exception('Formato de de opções inválido; opções de optgroups não podem ser arrays');
            }
        }
    }


    protected function valueShouldBeSelected($value): bool
    {
        return in_array($value, $this->selectedValues);
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }


    private function KVtoOptionHtml($k, $v)
    {
        if (!$v instanceof Option) {
            $v = UI::option($k, $v);
        }

        $value = $v->get('value');

        if ($this->valueShouldBeSelected($value)) {
            $v->selected();
        }

        return $v->render();
    }


}
