<?php

use TRF4\UI\Helper as UIH;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

echo '<form>';


$selectedValue = Unserialize::get()->autocompleteObject('my_ac');

echo UI::autocomplete(
    'Estado (array of strings)',
    'my_ac',
    UIH::ajax('get', '/states_strings?country=Brazil')
)
    ->selectedValue($selectedValue)
    ->showListAll()
    ->placeholder("Pesquisar...");
echo Unserialize::get()->autocomplete('my_ac');
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////

$selectedObjectValues = Unserialize::get()->autocompleteObject('my_ac2');

echo UI::autocomplete(
    'Estado (array of objects)',
    'my_ac2',
    UIH::ajax('get', '/states_objects?country=Brazil')->withFormats('v.code', '`(${v.short}) - ${v.name}`')
)
    ->showListAll()
    ->selectedValue($selectedObjectValues)
    ->placeholder("Pesquisar...");

echo Unserialize::get()->autocomplete('my_ac2');
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////

$selectedObjectValues = Unserialize::get()->autocompleteObject('my_ac3');
echo UI::autocomplete('Estado (object/map)', 'my_ac3', UIH::ajax('get', '/states_map?country=Brazil'))
    ->selectedValue($selectedObjectValues)
    ->showListAll()
    ->placeholder("Pesquisar...");

echo Unserialize::get()->autocomplete('my_ac3');
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////


$selectedValues = Unserialize::get()->multiAutocompleteObjects('my_autocomplete');

echo UI::multiAutocomplete(
    'Estados (array of strings)',
    'my_autocomplete',
    UIH::ajax('get', '/states_strings?country=Brazil')
)
    ->selectedValues($selectedValues)
    ->showListAll()
    ->placeholder("Pesquisar...");
echo implode(', ', Unserialize::get()->multiAutocomplete('my_autocomplete'));
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////

$selectedObjectValues = Unserialize::get()->multiAutocompleteObjects('my_autocomplete2');

echo UI::multiAutocomplete(
    'Estados (array of objects)',
    'my_autocomplete2',
    UIH::ajax('get', '/states_objects?country=Brazil')->withFormats('v.code', '`(${v.short}) - ${v.name}`')
)
    ->showListAll()
    ->selectedValues($selectedObjectValues)
    ->placeholder("Pesquisar...");

echo implode(', ', Unserialize::get()->multiAutocomplete('my_autocomplete2'));
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////

$selectedObjectValues = Unserialize::get()->multiAutocompleteObjects('my_autocomplete3'); //uih.ajax.autocomplete
echo UI::multiAutocomplete(
    'Estados (object/map)',
    'my_autocomplete3',
    UIH::ajax('get', '/states_map?country=Brazil')
)
    ->selectedValues($selectedObjectValues)
    ->showListAll()
    ->placeholder("Pesquisar...");

echo implode(', ', Unserialize::get()->multiAutocomplete('my_autocomplete3'));
echo '<br><br>';

//////////////////////////////////////////////////////////////////////////////////

echo UI::inputSubmit('Enviar');


echo '</form>';


