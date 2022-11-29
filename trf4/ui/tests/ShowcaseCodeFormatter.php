<?php


namespace Tests;


class ShowcaseCodeFormatter
{

    /**
     * ShowcaseCodeFormatter constructor.
     */
    public function __construct()
    {
    }

    public function format(array $lines)
    {
        $this->removeLinesWithBracketsOnly($lines);
        $this->removeFirstAndLastEmptyLines($lines);
        $this->removeLeadingWhitespaces($lines);
        $this->removeLineEndFromLastLine($lines);
        return $lines;
    }


    private function removeLinesWithBracketsOnly(array &$lines)
    {
        $lines = array_filter($lines, function (string $line) {
            preg_match('/^\s*?[{}]\s*?/', $line, $matches);
            return empty($matches);
        });

    }

    private function removeFirstAndLastEmptyLines(array &$lines)
    {

        foreach ($lines as $k => $line) {
            $matchFound = $this->unsetIfEmpty($lines, $line, $k);
            if (!$matchFound) {
                break;
            }
        }

        for (end($lines); $k = key($lines) !== null; prev($lines)) {
            $line = current($lines);

            $matchFound = $this->unsetIfEmpty($lines, $line, $k);
            if (!$matchFound) {
                break;
            }
        }
    }

    private function unsetIfEmpty(array &$lines, string $line, $key): bool
    {
        $matchFound = empty(ltrim($line));

        if ($matchFound) {
            unset($lines[$key]);
        }
        return $matchFound;
    }

    private function removeLeadingWhitespaces(array &$lines)
    {

        $firstLeadingWhitespaces = $this->getFirstLeadingWhitespaces($lines);

        array_walk($lines, function (string &$line) use ($firstLeadingWhitespaces) {
            $line = preg_replace("/^$firstLeadingWhitespaces/", '', $line);

            if (str_contains($line, 'return ')) {
                $line = str_replace('return ', '', $line);
            }
        });
    }

    private function getFirstLeadingWhitespaces(array $lines)
    {
        $firstLine = $lines[array_key_first($lines)];
        preg_match('/(\s+)./', $firstLine, $matchedSpace);
        $firstLeadingWhitespaces = $matchedSpace[1];
        return $firstLeadingWhitespaces;
    }

    private function removeLineEndFromLastLine(array &$lines)
    {
        $last = array_key_last($lines);
        $lines[$last] = rtrim($lines[$last]);
    }


}