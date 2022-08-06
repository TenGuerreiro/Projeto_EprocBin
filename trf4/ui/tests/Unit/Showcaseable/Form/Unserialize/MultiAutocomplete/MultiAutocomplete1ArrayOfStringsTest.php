<?php

namespace Tests\Unit\Showcaseable\Form\Unserialize\MultiAutocomplete;

use Tests\FormShowcaser;
use TRF4\UI\Helper;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

class MultiAutocomplete1ArrayOfStringsTest extends FormShowcaser
{

    protected $name = 'Array of strings';
    protected $description = 'No caso de a requisição retornar um array de strings, os valores serão as próprias descrições das tags/opções.';

    public function rendererExpectations(): array
    {
        return [
            // TODO refatorar esta classe. Esse tipo de teste é diferente dos testes tipo "Showcaser".
        ];
    }

    public function actual(): string
    {
        return UI::multiAutocomplete('Estados (array of strings)', 'multi_ac_3', Helper::ajax('get','/states_strings?country=Brazil'))
            ->showListAll()
            ->placeholder("Pesquisar...");
    }


    public function retrieveValue(string $method)
    {
        return [
            'Valores' => Unserialize::$method()->multiAutocomplete('multi_ac_3'),
            'Objetos' => Unserialize::$method()->multiAutocompleteObjects('multi_ac_3')
        ];
    }

}