<?php


namespace TRF4\UI;

use Exception;
use TRF4\UI\Bootstrap4\DateInterval;
use TRF4\UI\Component\MultiRange;
use TRF4\UI\Util\Autocomplete;
use TRF4\UI\Util\Autocomplete\MultiObjectFactory;
use TRF4\UI\Util\Autocomplete\ObjectFactory;

class Unserialize
{
    protected $data;

    public function __construct(&$data)
    {
        $this->data = &$data;
    }

    public static function get(): self
    {
        return new self($_GET);
    }

    public static function post(): self
    {
        return new self($_POST);
    }

    public function multiRange(string $idPrefix): ?array
    {
        $key_v1 = $idPrefix;
        $key_v2 = MultiRange::get2ndRangeId($idPrefix);

        $val1 = $_REQUEST[$key_v1] ?? null;
        $val2 = $_REQUEST[$key_v2] ?? null;

        $values = [$val1, $val2];
        if ($val1 === null || $val2 === null) {
            throw new Exception("Tentando recuperar valores inexistentes ($key_v1, $key_v2)");
        }

        sort($values);
        return $values;
    }

    public function dateInterval(string $namePrefix): ?array
    {
        $startKey = DateInterval::buildStartDate($namePrefix) ?? null;
        $endKey = DateInterval::buildEndDate($namePrefix) ?? null;

        $start = $_REQUEST[$startKey] ?? null;
        $end = $_REQUEST[$endKey] ?? null;

        return [$start, $end];
    }

    /**
     * Devolve um array contendo apenas os valores de um multiAutocomplete enviados na submissão de um formulário.
     * Caso não haja valores, será retornado um array vazio.
     * @param string $namePrefix
     * @return array
     */
    public function multiAutocomplete(string $namePrefix): array
    {
        return $this->multiAutocompleteObjects($namePrefix)->values();
    }

    /**
     * Recupera as tags enviadas pelo formulário.
     * Utilize este método para repopular um multiAutocomplete com os valores previamente enviados pelo submit.
     * @param string $namePrefix
     * @return array
     */
    public function multiAutocompleteObjects(string $namePrefix): Autocomplete\Multi\AbstractAutocompleteObject
    {
        return MultiObjectFactory::create($namePrefix, $this->data);
    }

    /**
     *
     * @param string $namePrefix
     * @return array|string|null
     */
    public function autocomplete(string $namePrefix)
    {
        $value = $this->autocompleteObject($namePrefix)->value();

        $filter = Config::$autocompleteValueFilterFunction;

        if ($filter) {
            $value = $filter($value);
        }

        return $value;
    }

    public function autocompleteObject(string $namePrefix): Autocomplete\Single\AbstractAutocompleteObject
    {
        return ObjectFactory::create($namePrefix, $this->data);
    }
}
