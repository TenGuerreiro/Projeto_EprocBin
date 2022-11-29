<?php


namespace TRF4\UI;

use TRF4\UI\Component\Alert;
use TRF4\UI\Component\Autocomplete;
use TRF4\UI\Component\Button;
use TRF4\UI\Component\CheckboxGroup;
use TRF4\UI\Component\Date;
use TRF4\UI\Component\FileUpload;
use TRF4\UI\Component\InputButton;
use TRF4\UI\Component\InputHidden;
use TRF4\UI\Component\InputNumber;
use TRF4\UI\Component\InputReset;
use TRF4\UI\Component\InputSubmit;
use TRF4\UI\Component\InputText;
use TRF4\UI\Component\MultiAutocomplete;
use TRF4\UI\Component\MultiRange;
use TRF4\UI\Component\RadioGroup;
use TRF4\UI\Component\Range;
use TRF4\UI\Component\Table;
use TRF4\UI\Component\Textarea;
use TRF4\UI\Component\Time;
use TRF4\UI\Element\GenericElement;
use TRF4\UI\Helper\DataSource;
use TRF4\UI\Labeled\Checkbox;
use TRF4\UI\Labeled\Radio;
use TRF4\UI\Labeled\Select;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Util\Dependency;
use TRF4\UI\Util\Option;

class UI
{
    /** @var string */
    public static $defaultFeedbackForInvalidField;

    /**
     * @var AbstractRenderer
     */
    protected static $defaultRenderer;

    /**
     * @param AbstractRenderer $defaultRenderer é o renderer usado
     * É uma string que pode receber como parâmetro (para o sprintf) o label do campo em questão.
     *
     * Ex.: `O campo %s é obrigatório` se transforma em  `O campo UF é obrigatório` para um input com label "UF"
     */
    public static function config(AbstractRenderer $defaultRenderer)
    {
        Config::setRenderer($defaultRenderer);
    }

    /**
     * É possível alterar o tipo do alerta utilizando os seguintes métodos:
     * * `danger()`
     * * `info()`
     * * `secondary()`
     * * `success()`
     * * `warning()`
     *
     * Por padrão, o alerta criado é do tipo `secondary`.
     *
     * @mainSubcomponent div
     * @param string $innerHTML O conteúdo do alerta
     * @return Alert
     */
    public static function alert(string $innerHTML): Alert
    {
        $class = self::getRenderer()->getAlertClass();
        return new $class($innerHTML);
    }

    /**
     * Esse componente permite a seleção de múltiplas opções por meio de um campo de busca textual, ou seja: autocomplete.
     * A fonte de dados deve ser um endereço acessível via ajax.
     * Para recuperar os dados, utilize a classe Unserializer.
     *
     * Lib utilizada: https://github.com/yairEO/tagify
     *
     *
     * @param string $label O rótulo do componente
     * @param string $nameAndDefaultId
     * @param DataSource $dataSource O endereço de provisão dos dados. Pode retornar um array, um objeto (mapa) ou um array de objetos.
     * @return Autocomplete
     * @mainSubcomponent input
     * @subcomponents input, label, labelWrapper, wrapper
     * @see Unserialize::autocompleteObjects()
     * @see Unserialize::autocomplete()
     */
    public static function autocomplete(
        string     $label,
        string     $nameAndDefaultId,
        DataSource $dataSource
    ): Autocomplete
    {
        $class = self::getRenderer()->getAutocompleteClass();
        return new $class($label, $nameAndDefaultId, $dataSource);
    }


    /**
     * Cria um botão.
     * Por padrão, os botões criados são secundários.
     *
     * @param string $innerHTML
     * @mainSubcomponent button
     * @return Button
     */
    public static function button(string $innerHTML): Button
    {
        $class = self::getRenderer()->getButtonClass();
        return new $class($innerHTML);
    }

    /**
     * Cria um grupo de checkboxes.
     *
     * Caso utilize o checkboxGroup,
     * se este checkbox não possuir um name,
     * o name atribuído será o do checkboxGroup
     *
     * Caso precise de mais opções de configuração em cada um dos checkboxes de um grupo,
     * é possível usar objetos do tipo `TRF4\UI\Labeled\Checkbox`.
     * Note que, por padrão, os checkboxes recebem:
     * Como `name`, o `name` do grupo
     * Como `id`, o próprio `name` acrescido de `_` e seu `value`.
     * @param string|null $labelnnerHtml
     * @param string|null $name
     * @param string|null $value
     * @return Checkbox
     * @subcomponents label, input
     * @mainSubcomponent input
     * @see self::checkboxGroup
     */
    public static function checkbox(
        ?string $labelInnerHtml = null,
        ?string $name = null,
        ?string $value = null
    ): Checkbox
    {
        $class = self::getRenderer()->getCheckboxClass();
        return new $class($labelInnerHtml, $name, $value);
    }

    /**
     * Caso `$name` seja definido, para simplificar o código,
     * os checkboxes de $setOptions herdarão este $name, APENAS SE eles próprios não possuírem um name.
     *
     * @param string $label O rótulo do grupo
     * @param array $options O conjunto de opções. Pode ser:
     * - Um array de arrays (opções), na forma curta
     * - Um array de objetos `Checkbox`, permitindo configurações adicionais
     * @param string|null $defaultChildrenName
     * @subcomponents label, wrapper
     * @mainSubcomponent wrapper
     * @return CheckboxGroup
     */
    public static function checkboxGroup(
        ?string $label = null,
        array   $options,
        ?string $defaultChildrenName = null
    ): CheckboxGroup
    {
        $class = self::getRenderer()->getCheckboxGroupClass();
        return new $class($label, $options, $defaultChildrenName);
    }


    /**
     * Campo de escolha de data e hora.
     * Em seu input, possui uma máscara e um botão que, ao ser clicado, exibe um calendário.
     *
     * @param string|null $label
     * @param string $nameAndId
     * @return Date
     * @subcomponents label, wrapper, input
     * @mainSubcomponent input
     */
    public static function datetime(?string $label = null, string $nameAndId): Date
    {
        return self::date($label, $nameAndId)->withTime();
    }

    /**
     * Campo de esoclha de data.
     * Em seu input, possui uma máscara e um botão que, ao ser clicado, exibe um calendário.
     * @param string|null $label
     * @param string $nameAndId
     * @return Date
     * @subcomponents label, wrapper, input
     * @mainSubcomponent input
     */
    public static function date(?string $label = null, string $nameAndId): Date
    {
        $class = self::getRenderer()->getDateClass();
        return new $class($label, $nameAndId);
    }


    /**
     * Permite criar um campo de horário do dia (00:00 - 23:59) com máscara e um widget `time picker`.
     * @param string|null $label
     * @param string $name
     * @return Time
     * @subcomponents label, wrapper, input
     * @mainSubcomponent input
     */
    public static function time(?string $label, string $name): Time
    {
        $class = self::getRenderer()->getTimeClass();
        return new $class($label, $name);
    }

    /**
     * Cria dois campos para definir um intervalo de datas/horas.
     * @param string $label
     * @param string $name
     * @return Date
     */
    public static function dateTimeInterval(?string $label = null, string $name): Date
    {
        return self::dateInterval($label, $name)->withTime();
    }

    /**
     * Cria dois campos que permitem selecionar um intervalo de datas.
     * @param string|null $label
     * @param string $name
     * @return Date
     */
    public static function dateInterval(?string $label = null, string $name): Date
    {
        $class = self::getRenderer()->getDateIntervalClass();
        return new $class($label, $name);
    }

    public static function el(string $tagName, string $innerHTML = ''): GenericElement
    {
        return new GenericElement($tagName, $innerHTML);
    }

    /**
     * Cria um campo de entrada de texto.
     *
     * @param string|null $label
     * @param string $nameAndDefaultId
     * @subcomponents label, input, wrapper
     * @mainSubcomponent input
     * @return InputText
     */
    public static function inputText(?string $label = null, string $nameAndDefaultId): InputText
    {
        $class = self::getRenderer()->getInputTextClass();
        return new $class($label, $nameAndDefaultId);
    }

    /**
     * Cria um campo oculto.
     *
     * @param string $nameAndDefaultId
     * @param string|null $value
     * @mainSubcomponent input
     * @return InputHidden
     */
    public static function hidden(string $nameAndDefaultId, ?string $value = null): InputHidden
    {
        $class = self::getRenderer()->getInputHiddenClass();
        return new $class($nameAndDefaultId, $value);
    }

    /**
     * Cria um campo de entrada numérica.
     * @param string $label
     * @param string $nameAndDefaultId
     * @subcomponents input, label, wrapper
     * @mainSubcomponent input
     * @return InputNumber
     */
    public static function inputNumber(?string $label = null, string $nameAndDefaultId): InputNumber
    {
        $class = self::getRenderer()->getInputNumberClass();
        return new $class($label, $nameAndDefaultId);
    }

    /**
     * Input de tipo `button`
     * @param string $label É o rótulo do botão. Utiliza o atributo `value` do `input`.
     * @return InputButton
     */
    public static function inputButton(string $label): InputButton
    {
        $class = self::getRenderer()->getInputButtonClass();
        return new $class($label);
    }

    /**
     * Input do tipo `reset`, que serve para redefinir formulários.
     * @param string $label
     * @return InputReset
     * @mainSubcomponent input
     */
    public static function inputReset(string $label): InputReset
    {
        $class = self::getRenderer()->getInputResetClass();
        return new $class($label);
    }

    /**
     * Input de tipo `submit`, que serve para enviar formulários.
     * Por padrão, é do tipo `primary`.
     * @param string $label
     * @param string $nameAndDefaultId
     * @mainSubcomponent input
     * @return InputSubmit
     * @see self::button
     */
    public static function inputSubmit(string $label): InputSubmit
    {
        $class = self::getRenderer()->getInputSubmitClass();
        return new $class($label);
    }

    /**
     * Cria um campo para upload de arquivo padrão, com apenas 1 arquivo, com formato livre
     * @param string $label
     * @param string $nameAndDefaultId
     * @return FileUpload
     */
    public static function fileUpload(?string $label = null, string $nameAndDefaultId): FileUpload
    {
        $class = self::getRenderer()->getFileUploadClass();
        return new $class($label, $nameAndDefaultId);
    }

    /**
     * Cria um campo range simples, permitindo informar um valor numérico dentro de limites mínimo e máximo.
     * @param string|null $label
     * @param string $nameAndDefaultId
     * @param float $min
     * @param float $max
     * @return Range
     * @subcomponents input, output, label, wrapper
     * @mainSubcomponent input
     */
    public static function range(?string $label = null, string $nameAndDefaultId, float $min, float $max): Range
    {
        $class = self::getRenderer()->getRangeClass();
        return new $class($label, $nameAndDefaultId, $min, $max);
    }

    /**
     * Permite a seleção de um intervalo de valores.
     *
     * Além do `name`, é obrigatório informar os valores mínimo e máximo.
     *
     * @param string|null $label
     * @param string $name O atributo `name`
     * @param float $min O limite mínimo
     * @param float $max O limite máximo
     * @return MultiRange
     * @subcomponents wrapper, label
     */
    public static function multiRange(?string $label = null, string $name, float $min, float $max): MultiRange
    {
        $class = self::getRenderer()->getMultiRangeClass();
        return new $class($label, $name, $min, $max);
    }


    /**
     * Cria um `input` do tipo `radio`. Pode ser usado de forma individual ou no componente `RadioGroup`.
     * @param string $label
     * @param string $value
     * @param string $id
     * @subcomponents wrapper, label, input
     * @mainSubcomponent input
     * @return Radio
     */
    public static function radio(?string $label = null, string $value, string $id): Radio
    {
        $class = self::getRenderer()->getRadioClass();
        return new $class($label, $value, $id);
    }

    /**
     * Permite a escolha de uma dentre várias opções. Contém um conjunto de radios.
     *
     * @param string|null $label O rótulo
     * @param string $name O atributo `name` de suas opções
     * @param array $options O conjunto de opções.
     * @return RadioGroup
     * @subcomponents label, wrapper
     */
    public static function radioGroup(?string $label = null, string $name, array $options): RadioGroup
    {
        $class = self::getRenderer()->getRadioGroupClass();
        return new $class($label, $name, $options);
    }

    /**
     * Componente de seleção simples de valores.
     * Utiliza a biblioteca [bootstrap-select](https://developer.snapappointments.com/bootstrap-select/)
     *
     * @param string|null $label O rótulo do select
     * @param string|null $nameAndDefaultId O atributo `name` e a `id` default
     * @param array $options Um array contendo opções ou optgroups. Sendo `k` um índice do array e `v` seu valor, este parâmetro pode receber qualquer um dos 3 seguintes formatos:
     *
     * - Sendo `v` uma string ou número, `k` será o valor da opção e `v` o rótulo
     * - Sendo `v` um array, `v` será tratado como um `optgroup`
     * - Sendo `v` um objeto do tipo `Option`
     * @subcomponents select, wrapper, label
     * @mainSubcomponent select
     * @return Select
     */
    public static function select(?string $label = null, ?string $nameAndDefaultId = null, array $options = []): Select
    {
        $class = self::getRenderer()->getSelectClass();
        return new $class($label, $nameAndDefaultId, $options);
    }


    /**
     * Esse componente permite a seleção de múltiplas opções por meio de um campo de busca textual, ou seja: autocomplete.
     * A fonte de dados deve ser um endereço acessível via ajax.
     * Para recuperar os dados, utilize a classe Unserializer.
     *
     * Lib utilizada: https://github.com/yairEO/tagify
     *
     *
     * @param string $label O rótulo do componente
     * @param string $nameAndDefaultId
     * @param DataSource $dataSource O endereço de provisão dos dados. Pode retornar um array, um objeto (mapa) ou um array de objetos.
     * @mainSubcomponent input
     * @subcomponents input, label, labelWrapper, wrapper
     * @return MultiAutocomplete
     * @see Unserialize::multiAutocomplete()
     * @see Unserialize::multiAutocompleteObjects()
     */
    public static function multiAutocomplete(
        string     $label,
        string     $nameAndDefaultId,
        DataSource $dataSource
    ): MultiAutocomplete
    {
        $class = self::getRenderer()->getMultiAutocompleteClass();
        return new $class($label, $nameAndDefaultId, $dataSource);
    }

    /**
     * Permite selecionar várias opções de um select.
     * As opções seguem o mesmo formato do componente `Select`.
     *
     * @param string|null $label
     * @param string|null $nameAndDefaultId
     * @subcomponents select, label, wrapper
     * @mainSubcomponent select
     * @param array $options
     * @return Select
     */
    public static function multiSelect(
        ?string $label = null,
        ?string $nameAndDefaultId = null,
        array   $options = []
    ): Select
    {
        $class = self::getRenderer()->getMultiSelectClass();

        return new $class($label, $nameAndDefaultId, $options);
    }

    public static function option($value, $innerHtml): Option
    {
        return new Option($value, $innerHtml);
    }

    public static function table(?string $title, array $rows): Table
    {
        $class = self::getRenderer()->getTableClass();
        return new $class($title, $rows);
    }

    /**
     * Cria um campo de texto multilinha.
     * @param string|null $label
     * @param string $nameAndDefaultId
     * @subcomponents textarea, wrapper, label
     * @mainSubcomponent textarea
     * @return Textarea
     */
    public static function textarea(?string $label = null, string $nameAndDefaultId): Textarea
    {
        $class = self::getRenderer()->getTextareaClass();
        return new $class($label, $nameAndDefaultId);
    }

    public static function getRenderer(): ?AbstractRenderer
    {
        return Config::getRenderer();
    }

    /**
     * Mover para Helper
     * @param string $name
     * @param string $inputId
     * @param string $placeholderIfNull
     * @return Dependency
     */
    public static function dependency(string $name, string $inputId, string $placeholderIfNull): Dependency
    {
        return new Dependency($name, $inputId, $placeholderIfNull);
    }

}
