<?php

namespace TRF4\UI\Util\Autocomplete;

use TRF4\UI\Component\AbstractAutocomplete;
use TRF4\UI\Util\Autocomplete\Multi\AbstractAutocompleteObject;
use TRF4\UI\Util\Autocomplete\Multi\ArrayOfObjects;
use TRF4\UI\Util\Autocomplete\Multi\ArrayOfStrings;
use TRF4\UI\Util\Autocomplete\Multi\Map;
use TRF4\UI\Util\Autocomplete\Multi\NullObject;

class MultiObjectFactory
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
