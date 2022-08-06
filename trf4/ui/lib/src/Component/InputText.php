<?php

namespace TRF4\UI\Component;


use TRF4\UI\Util\Internal;

abstract class InputText extends AbstractInputWithLabel
{
    use Customizable {
        render as customizableRender;
    }

    /** @var ?string */
    protected $mask = null;
    /** @var bool */
    protected $lazyLoadMask;
    protected $type = 'text';

    public function __construct(?string $labelInnerHtml = null, ?string $name = null)
    {
        parent::__construct($labelInnerHtml, $name);
        $this->getDefaultElement()->withValueSanitization();
    }

    /**
     * @param string $mask
     * @param bool $lazyLoadMask
     * @return $this
     */
    public function mask(string $mask, bool $lazyLoadMask = true): self
    {
        $this->mask = $mask;
        $this->lazyLoadMask = $lazyLoadMask;
        return $this;
    }

    public function render(): string
    {
        $this->sanitizeValueAttrIfEnabled();
        return $this->customizableRender();
    }

    protected function sanitizeValueAttrIfEnabled()
    {
        $el = $this->getDefaultElement();
        $value = $el->get('value');

        if ($value && $el->hasValueSanitizing) {
            $el->attr('value', Internal::sanitize($value), true);
        }
    }
}
