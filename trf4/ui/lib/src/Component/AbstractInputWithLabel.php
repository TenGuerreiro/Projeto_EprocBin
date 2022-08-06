<?php

namespace TRF4\UI\Component;


use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Element\GenericElement;
use TRF4\UI\Labeled\AbstractElementWithLabel;
use TRF4\UI\UI;
use TRF4\UI\Util\Internal;

abstract class AbstractInputWithLabel extends AbstractElementWithLabel
{
    /** @var string */
    protected $type = "text";

    /** @var GenericElement */
    public $_input;

    /**
     * InputText constructor.
     * @param string|null $labelInnerHtml
     * @param string|null $name
     */
    public function __construct(?string $labelInnerHtml = null, ?string $name = null)
    {
        parent::__construct($labelInnerHtml);

        $this->_input = UI::el('input')->type($this->type);

        if ($name) {
            $this->name($name);
        }
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_input;
    }

    public function accesskey(string $char): self
    {
        $this->_label->innerHTML(Internal::addAccesskeyTagToString($this->_label->innerHTML, $char));
        $this->_input->accesskey($char);
        return $this;
    }
}
