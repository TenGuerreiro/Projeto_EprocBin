<?php

namespace TRF4\UI\Helper;

class Ajax extends DataSource
{

    /** @var string */
    public $method;
    /** @var string */
    public $url;
    /** @var string */
    public $labelFormat = 'UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v)';
    /** @var string */
    public $valueFormat = 'UI.multiAutocomplete.defaultValueFormat(k, v)';

    public function __construct($method, $action)
    {
        $this->method = $method;
        $this->url = $action;
    }

    public function withFormats(string $valueFormat, string $labelFormat): self
    {
        $this->valueFormat($valueFormat);
        $this->labelFormat($labelFormat);
        return $this;
    }

    /**
     * Define um template (js) de valor retornado
     * @param string $valueFormat
     * @return Ajax
     */
    public function valueFormat(string $valueFormat = 'UI.multiAutocomplete.defaultValueFormat(k, v)'): self
    {
        $this->valueFormat = $valueFormat;
        return $this;
    }

    /**
     * Define um template (js) de valor retornado
     * @param string $labelFormat
     * @return Ajax
     */
    public function labelFormat(string $labelFormat = 'UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v)'): self
    {
        $this->labelFormat = $labelFormat;
        return $this;
    }

    /**
     * Converte este objeto em um objeto js
     * @return string
     */
    public function toJS(): string
    {
        $url = json_encode($this->url);
        return <<<json
            {
                method: "$this->method",
                url:$url,
                labelFormatFn: function(k, v){ return $this->labelFormat;},
                valueFormatFn: function (k, v){ return $this->valueFormat;}
            }
json;
    }
}
