<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Config;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

trait SelectActions
{

    protected function buildElements(): void
    {
        $select = $this->_select;

        if ($this->hasLabel()) {
            $label = $this->_label;
        }

        if ($this->withSearchFilter) {
            $select->dataLiveSearch('true');
            $select->dataLiveSearchNormalize('true');
        }

        if ($this->hasLabel()) {
            Bootstrap4::transformLabel($this);
            $label->class('d-block');
        }

        $this->_select->innerHTML = $this->optionsToHtml();

        $this->buildHintIfIsSet();

        if ($this->_hintWrapper) {
            $select = $this->_hintWrapper;
        }

        if ($this->dependencies && $this->_label) {
            $label->class('d-flex');
            $spinnerPlaceholder = $this->buildSpinnerDropdownId();

            $label->innerHTML = <<<h
                <span class="d-flex">$label->innerHTML</span>
                <span id='$spinnerPlaceholder' style="display:none;">
                    <div class="d-flex text-primary ml-2 badge badge-light align-content-center badge-pill">
                        <span class="mr-2">Carregando...</span>
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </span>
h;
        }

        $this->_wrapper->class('form-group');
    }

    private function buildSpinnerDropdownId()
    {
        return $this->getDefaultElement()->getAttrId() . '-spinner';
    }

    protected function assembleAndPrintElements(): string
    {
        $select = $this->_select;
        $wrapper = $this->_wrapper;

        $id = $select->getAttrId();

        if ($this->get('multiple')) {
            $select->overrideName($select->get('name') . "[]");
            $select->id($id);
        }

        if ($this->dependencies) {
            $dependencyFeedback = UI::el('div')->class('dependency-feedback-message danger')->id(
                $id . '-feedbackMessage'
            )->render();
        } else {
            $dependencyFeedback = "";
        }

        $label = "";
        if ($this->hasLabel()) {
            $label = $this->_label;
        }
        $wrapper->innerHTML($label . $select . $dependencyFeedback);

        $wrapperHTML = $wrapper->render();

        $depHtml = $this->buildDependenciesForSelect();

        $html = $wrapperHTML . $depHtml;

        $feedbackContainerHTML = json_encode(
            Bootstrap4::getFeedbackForInvalidValue($this, Config::getSelectInvalidValueFeedbackFilter())
        );
        $this->scripts[] = "UI.PHPHelper.select.init('$id', $feedbackContainerHTML);";

        return $html;
    }


    private function buildDependenciesForSelect(): string
    {
        $select = $this;

        if ($this->dependencies === null) {
            return '';
        }

        $spinnerPlaceholder = json_encode($this->buildSpinnerDropdownId());

        $childId = json_encode($select->getAttrId());
        $ret = '';

        $callback = $select->callback;
        $placeholder = $select->placeholder;
        $valueAttr = $callback->valueAttr;
        $innerHTMLAttr = $callback->innerHTMLAttr;

        $url = json_encode($callback->url);
        $params = ['params' => $callback->params];
        $params = str_replace(['"', "'"], '', json_encode($params));
        $dataMap = json_encode($callback->dataMap, JSON_FORCE_OBJECT);
        $shouldTriggerSelectOnChange = json_encode(count($this->options) === 0);

        foreach ($select->dependencies as $dependency) {
            $placeholderIfNull = json_encode($dependency->placeholderIfNull);
            $inputId = json_encode($dependency->inputId);
            $dependencyName = $dependency->name;

            $ret .= <<<html
            <script>

            (function(){
                var $dependencyName = document.getElementById($inputId);

                UI.PHPHelper.select.addDependency(
                    '$dependencyName',
                    $inputId,
                    $spinnerPlaceholder,
                    $childId,
                    '$callback->method',
                    $url,
                    function(){ return $params;},
                    '$placeholder',
                    $placeholderIfNull,
                    function(k, v){ return $valueAttr;},
                    function(k, v){ return $innerHTMLAttr;},
                    $dataMap,
                    $shouldTriggerSelectOnChange);
            })();
            </script>
html;
        }

        return $ret;
    }
}
