<?php


namespace TRF4\UI\Util;


/**
 * @property array dataMap
 */
class AjaxCallback
{
    /** @var string */
    public $method;
    /** @var array */
    public $params;
    /** @var string */
    public $valueAttr;
    /** @var string */
    public $innerHTMLAttr;
    /** @var string */
    public $url;

    /**
     * @param string $method O método HTTP (GET/POST)
     * @param string $url O endpoint que retornará os dados
     * @param array $params Parâmetros adicionais da requisição
     * @param string $valueAttr O javascript usado para formatar o valor da opção
     * @param string $innerHTMLAttr O javascript usado para formatar o rótulo da opção (variáveis disponíveis: k, v)
     * @param array $dataMap TODO
     */
    public function __construct(
        string $method,
        string $url,
        array $params,
        string $valueAttr,
        string $innerHTMLAttr,
        array $dataMap = []
    ) {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
        $this->valueAttr = $valueAttr;
        $this->innerHTMLAttr = $innerHTMLAttr;
        $this->dataMap = $dataMap;
    }

    /**
     * @param $strChave
     * @param $strValor
     */
    public function addParam($strChave, $strValor): self
    {
        $this->params[$strChave] = $strValor;
        return $this;
    }
}
