<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Router\Compiler;

use Windwalker\Router\RouteHelper;

/**
 * The Compiler class.
 *
 * @since  2.0
 */
abstract class BasicCompiler
{
    /**
     * compile
     *
     * @param string $pattern
     * @param array  $requirements
     *
     * @return  string
     */
    public static function compile($pattern, $requirements = [])
    {
        $pattern = RouteHelper::sanitize($pattern);

        $regex = static::replaceOptionalSegments($pattern);
        $regex = static::replaceOptionalWildcards($regex);
        $regex = static::replaceWildcards($regex);

        return chr(1) . '^' . static::replaceAllRegex($regex, $requirements) . '$' . chr(1);
    }

    /**
     * prepareOptionalSegments
     *
     * @param string $regex
     *
     * @return  string
     */
    protected static function replaceOptionalSegments($regex)
    {
        preg_match(chr(1) . '\(/([a-z][a-zA-Z0-9_,]*)\)' . chr(1), $regex, $matches);

        if (!$matches) {
            return $regex;
        }

        $list = explode(',', $matches[1]);
        $head = '';

        if (strpos($regex, '(/') === 0) {
            $name = array_shift($list);
            $head = "/(\{{$name}\})?";
        }

        $tail = '';

        foreach ($list as $name) {
            $head .= "(/({$name})";
            $tail .= ')?';
        }

        $repl = $head . $tail;

        return str_replace($matches[0], $repl, $regex);
    }

    /**
     * replaceRegex
     *
     * @param string $regex
     * @param array  $requirements
     *
     * @return  string
     */
    protected static function replaceAllRegex($regex, $requirements = [])
    {
        $find = chr(1) . '\(([a-z][a-zA-Z0-9_]*)\)' . chr(1);

        preg_match_all($find, $regex, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $name = $match[1];
            $subpattern = static::requirementPattern($name, $requirements);
            $regex = str_replace("({$name})", $subpattern, $regex);
        }

        return $regex;
    }

    /**
     * requirementPattern
     *
     * @param string $name
     * @param array  $requirements
     *
     * @return  string
     */
    protected static function requirementPattern($name, $requirements = [])
    {
        if (isset($requirements[$name])) {
            return "(?P<{$name}>{$requirements[$name]})";
        }

        return "(?P<{$name}>[^/]+)";
    }

    /**
     * Adds a wildcard pattern to the regex.
     *
     * @param string $regex
     *
     * @return null
     */
    protected static function replaceWildcards($regex)
    {
        preg_match_all(chr(1) . '\(\\*([a-z][a-zA-Z0-9]*)\)' . chr(1), $regex, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $name = $match[1];

            $regex = str_replace("(*{$name})", "(?P<{$name}>.*)", $regex);
        }

        return $regex;
    }

    /**
     * replaceOptionalWildcards
     *
     * @param string $regex
     *
     * @return  mixed
     *
     * @since  3.5.12
     */
    protected static function replaceOptionalWildcards($regex)
    {
        preg_match_all(chr(1) . '\(/\\*([a-z][a-zA-Z0-9]*)\)' . chr(1), $regex, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $name = $match[1];

            $regex = str_replace("(/*{$name})", "(/(?P<{$name}>.*))?", $regex);
        }

        return $regex;
    }
}
