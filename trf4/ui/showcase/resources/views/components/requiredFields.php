<?php

use TRF4\UI\Helper;
use TRF4\UI\UI;

?>

<form action="/" class="needs-validation" novalidate>

    <?php

    echo UI::Autocomplete(
        'Autocomplete',
        'my_required_ac',
        Helper::ajax('get', '/states_objects?country=Brazil')
    )
        ->showListAll()
        ->required()
        ->placeholder('Pesquisar...');

    echo UI::multiAutocomplete(
        'Multi autocomplete',
        'my_required_mac',
        Helper::ajax('get', '/states_objects?country=Brazil')
    )
        ->showListAll()
        ->required()
        ->placeholder('Pesquisar...');

    echo UI::inputText('Nome', 'nome_n')
        ->required();

    echo UI::date('Data de nascimento', 'data_nascimento')
        ->required('Você deve informar uma data válida');

    echo UI::dateInterval('Dateinterval required', 'dateinterval_r')
        ->required();

    echo UI::dateInterval('Dateinterval', 'dateinterval');

    echo UI::inputText('Endereço', 'endereco')
        ->required('Preencha com pelo menos 4 caracteres alfanuméricos');

    echo UI::select('UF', 'my_uf', ['RS', 'PR', 'SC'])
        ->placeholder('Escolha um estado')
        ->required();

    echo UI::radioGroup('Radiogroup', 'my_radio', [
        [1, 2, 'id2'],
        [11, 22, 'id1']
    ])->required();

    echo UI::textarea('Observações (opcional)', 'my_textarea');

    echo UI::button('Enviar')
        ->primary()
        ->type('submit');

    ?>

</form>
