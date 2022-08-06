<?php

namespace TRF4\UI\Component;

use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Element\GenericElement;
use TRF4\UI\Helper\DataSource;

abstract class AbstractAutocomplete extends AbstractInputWithLabel
{
    public $type = 'text';
    /** @var DataSource */
    public $dataSource;
    /** @var int */
    protected $minChars = 3;

    /**
     * @param string|null $labelInnerHtml
     * @param string|null $nameAndDefaultId
     * @param string $sourceUrl
     */
    public function __construct(?string $labelInnerHtml = null, ?string $nameAndDefaultId = null, DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
        parent::__construct($labelInnerHtml, $nameAndDefaultId);
        $this->_input->placeholder('Pesquisar...');
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_input;
    }

    /**
     * Exibe o botão "listar todos"
     * @return self
     */
    public function showListAll(): self
    {
        $this->showListAll = true;
        return $this;
    }

    /**
     * Permite alterar a quantidade mínima de caracteres necessária para que a busca por dados seja feita.
     *
     * Valor default: 3
     *
     * @param int $val
     * @return $this
     */
    public function minChars(int $val): self
    {
        $this->minChars = $val;
        return $this;
    }

    public static function buildName(string $namePrefix, bool $isMap = false): string
    {
        $ret = $namePrefix . '_value';
        if ($isMap) {
            $ret .= '_map';
        }
        return $ret;
    }

    /** @var bool */
    protected $showListAll = false;
    /** @var GenericElement */
    protected $_labelWrapper;
}
