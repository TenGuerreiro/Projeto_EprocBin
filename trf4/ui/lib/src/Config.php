<?php

declare(strict_types=1);

namespace TRF4\UI;

use TRF4\UI\Renderer\AbstractRenderer;

class Config
{
    /** @var Renderer\AbstractRenderer */
    protected static $defaultRenderer;
    /** @var string */
    protected static $defaultFeedbackForInvalidField = "O campo \"%s\" é obrigatório";
    /** @var ?callable */
    public static $selectFeedbackForInvalidValueFilter = null;
    /** @var ?callable */
    public static $autocompleteValueFilterFunction = null;
    /** @var ?callable */
    public static $autocompleteBeforeJsonEncodeValuesHook = null;

    public static function setRenderer(Renderer\AbstractRenderer $defaultRenderer)
    {
        self::$defaultRenderer = $defaultRenderer;
    }

    public static function getRenderer(): AbstractRenderer
    {
        return self::$defaultRenderer;
    }

    public static function setDefaultFeedbackForInvalidField(string $defaultFeedbackForInvalidField)
    {
        self::$defaultFeedbackForInvalidField = $defaultFeedbackForInvalidField;
    }

    public static function getFeedbackForInvalidField(?string $label): string
    {
        return sprintf(self::$defaultFeedbackForInvalidField, $label);
    }

    public static function setSelectInvalidValueFeedbackFilter(?callable $fn): void
    {
        self::$selectFeedbackForInvalidValueFilter = $fn;
    }

    public static function getSelectInvalidValueFeedbackFilter(): ?callable
    {
        return self::$selectFeedbackForInvalidValueFilter;
    }

    /**
     * Adiciona um filtro chamado após a recuperação dos valores de autocompletes
     * @param callable|null $fn
     * @return void
     */
    public static function setAutocompleteValueFilterFunction(?callable $fn): void
    {
        self::$autocompleteValueFilterFunction = $fn;
    }

    /**
     * Adiciona um filtro chamado logo antes da realização de json_encode do valor de um autocomplete.
     * @param callable|null $fn
     * @return void
     */
    public static function setAutocompleteBeforeJsonEncodeValuesHook(?callable $fn): void
    {
        self::$autocompleteBeforeJsonEncodeValuesHook = $fn;
    }
}
