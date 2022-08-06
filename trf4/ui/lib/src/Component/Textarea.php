<?php


namespace TRF4\UI\Component;


use TRF4\UI\Element;
use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Labeled\AbstractElementWithLabel;
use TRF4\UI\UI;

abstract class Textarea extends AbstractElementWithLabel
{
    /** @var Element\GenericElement */
    public $_textarea;
    /** @var Element\GenericElement */
    public $_wrapper;

    public function __construct(?string $labelInnerHtml = null, string $name)
    {
        parent::__construct($labelInnerHtml);
        $this->_textarea = UI::el('textarea');
        $this->_wrapper = UI::el('div');
        $this->name($name);
    }

    /**
     * Este método é um alias para o `innerHtml`, visto que o elemento <textarea> não suporta o atributo `value`.
     * @param string $innerHTML
     * @return self
     */
    public function value(?string $innerHTML = null): self
    {
        $this->innerHTML($innerHTML);
        return $this;
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_textarea;
    }
}
