<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Component\Alert as BaseAlert;
use TRF4\UI\Element\AbstractElement;
use TRF4\UI\UI;

class Alert extends BaseAlert
{
    /** @var AbstractElement */
    public $_div;

    public function __construct(string $innerHTML)
    {
        parent::__construct($innerHTML);

        $this->_div = UI::el('div', $this->innerHTML)
            ->role('alert')
            ->class("alert");
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_div;
    }

    public function render(): string
    {
        $class = $this->getClassForAlert();

        return $this->_div
            ->innerHTML($this->_div->innerHTML . $this->renderDismissButton())
            ->class($class)
            ->render();
    }

    private function renderDismissButton(): string
    {
        if ($this->isDismissible) {
            return UI::el('button')
                ->class('close')
                ->dataDismiss('alert')
                ->ariaLabel('Close')
                ->innerHTML(UI::el('span')->ariaHidden('true')->innerHTML('&times;')->render())
                ->render();
        }

        return '';
    }

    private function getClassForAlert(): string
    {
        $alert = $this;
        $class = 'alert-';

        switch ($alert->type) {
            case BaseAlert::TYPE_INFO:
                $class .= 'info';
                break;

            case BaseAlert::TYPE_DANGER:
                $class .= 'danger';
                break;

            case BaseAlert::TYPE_SUCCESS:
                $class .= 'success';
                break;

            case BaseAlert::TYPE_WARNING:
                $class .= 'warning';
                break;

            case BaseAlert::TYPE_SECONDARY:
            default:
                $class .= 'secondary';
                break;
        }

        if ($this->isDismissible) {
            $class .= ' alert-dismissible fade show';
        }

        return $class;
    }


}
