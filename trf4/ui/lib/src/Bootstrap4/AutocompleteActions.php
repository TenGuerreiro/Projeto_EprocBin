<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Component\Customizable;
use TRF4\UI\Element\GenericElement;
use TRF4\UI\Helper\DataSource;
use TRF4\UI\Renderer\Bootstrap4;

trait AutocompleteActions
{

    use Customizable {
        render as customizableRender;
    }

    /** @var GenericElement */
    public $_wrapper;

    public function __construct(string $labelInnerHtml = null, string $nameAndDefaultId = null, DataSource $dataSource)
    {
        parent::__construct($labelInnerHtml, $nameAndDefaultId, $dataSource);

        $this->_wrapper = (new GenericElement('div'))->class('form-group ui-autocomplete-wrapper');
        $this->_labelWrapper = (new GenericElement('div'))->class("d-flex justify-content-between");
        $this->_input->class('ui-autocomplete-input');
    }

    protected function buildElements(): void
    {
        $id = $this->getAttrId();

        $this->_wrapper->id($id . '-wrapper');
        $this->_label->innerHTML($this->labelInnerHtml);
        Bootstrap4::transformLabel($this);

        $dataSource = $this->dataSource->toJS();

        $jsValues = $this->getJSSelectedValues();

        if (!$this->isMultiple) {
            $this->_input->class('select-mode');
        }


        $isMultiple = json_encode($this->isMultiple);
        $inputNamePrefix = json_encode(self::buildName($this->get('name')));


        $this->scripts[] = <<<js
            UI.multiAutocomplete.init(
                '$id',
                $jsValues,
                $inputNamePrefix,
                $isMultiple,
                $dataSource,
                $this->minChars
            );
js;
    }

    protected abstract function getJSSelectedValues(): string;



    protected function assembleAndPrintElements(): string
    {
        $this->_labelWrapper->innerHTML(
            $this->_label->render() .
            $this->getListAllButton()
        );

        $this->_wrapper->innerHTML(
            $this->_labelWrapper .
            $this->_input .
            Bootstrap4::getFeedbackForInvalidValue($this)
        );
        return $this->_wrapper->render();
    }

    private function getListAllButton(): string
    {
        if ($this->showListAll) {
            return '<button type="button" id="' . $this->getAttrId(
                ) . '-listAll" class="p-0 btn btn-link" title="Listar todos (Seta para baixo)"><small>Listar todos</small></button>';
        }

        return '';
    }
}
