<?php


namespace TRF4\UI\Element;

use Exception;
use TRF4\UI\UI;
use TRF4\UI\UIHtmlBuilder;
use Windwalker\Dom\Builder\HtmlBuilder;

abstract class AbstractSimpleElement extends AbstractElement
{

    /** @var ?string */
    public $innerHTML = null;

    public function __construct()
    {
    }

    public function render(): string
    {
        $this->validate();

        $tag = $this->getTagName();
        $innerHTML = $this->innerHTML;
        $this->setIdIfNotSet();
        $attrs = $this->getAttrs();
        ksort($attrs); // o sort é feito
        $html = HtmlBuilder::create($tag, $innerHTML, $attrs);
        return $html . "\n";
    }

    /**
     * @throws Exception
     */
    protected function validate(): void
    {
        if (!$this->renderer && !UI::getRenderer()) {
            throw new Exception(
                'O objeto não possui um renderer. Inicie o UI:config passando o renderer padrão ou construa o elemento usando o método `renderer`, passando um renderer específico '
            );
        }
    }

    abstract public function getTagName(): string;

    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Seta o conteúdo (inner html)
     * @param string $innerHTML
     */
    public function innerHTML(?string $innerHTML = null): self
    {
        $this->innerHTML = $innerHTML;
        return $this;
    }

    public function prepend(string $innerHTMLPrefix): self
    {
        $this->innerHTML = $innerHTMLPrefix . $this->innerHTML;
        return $this;
    }

    public function append(string $innerHTMLSuffix): self
    {
        $this->innerHTML .= $innerHTMLSuffix;
        return $this;
    }


    public function withValueSanitization(): self
    {
        $this->hasValueSanitizing = true;
        return $this;
    }

    public function noValueSanitizing(): self
    {
        $this->hasValueSanitizing = false;
        return $this;
    }


}
