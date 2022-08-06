<?php

namespace TRF4\UI\Util\Autocomplete;

use TRF4\UI\Component\AbstractAutocomplete;
use TRF4\UI\Util\Autocomplete\Single\AbstractAutocompleteObject;
use TRF4\UI\Util\Autocomplete\Single\ArrayOfObjects;
use TRF4\UI\Util\Autocomplete\Single\ArrayOfStrings;
use TRF4\UI\Util\Autocomplete\Single\Map;
use TRF4\UI\Util\Autocomplete\Single\NullObject;

class ObjectFactory
{
    public static function create(string $namePrefix, $requestData): AbstractAutocompleteObject
    {
        $name = AbstractAutocomplete::buildName($namePrefix);
        $mapName = AbstractAutocomplete::buildName($namePrefix, true);
        if (isset($requestData[$mapName])) {
            return new Map($mapName, $requestData[$mapName]);
        } else {
            if (isset($requestData[$name])) {
                $data = $requestData[$name];
                $firstKey = array_key_first($data);

                if (is_array($data[$firstKey])) {
                    return new ArrayOfObjects($name, $data);
                } else {
                    return new ArrayOfStrings($name, $data);
                }
            }
        }

        return new NullObject();
    }
}
