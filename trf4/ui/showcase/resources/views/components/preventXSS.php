<?php

use TRF4\UI\UI;

?>

<form action="/outros" method="POST" class="needs-validation" novalidate>

    <input type="hidden" name="_token" id="csrf-token" value="<?php echo csrf_token() ?>"/>

    <?php

    echo UI::textarea('Escapar XSS', 'my_textarea_xss')
        ->append('TODO')
        ->required();

    echo UI::inputText('Input text', 'my_input_text')
        ->value($_POST['my_input_text'] ?? null);

    echo UI::button('Enviar')
        ->primary()
        ->type('submit');

    ?>

</form>

<!--
</textarea><script>alert(1);</script><textarea>

"'><script>alert(1);</script>
-->