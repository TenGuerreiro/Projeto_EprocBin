<?php


namespace TRF4\UI\Util;


class Internal
{

    /**
     * Adiciona a tag "U" na primeira ocorrência conforme a seguinte lógica:
     * 1 - Sublinhar a primeira letra da primeira palavra que correponder ao $accesskey;
     * 2 - Sublinha o primeiro caracter no label inteiro que correponder ao $accesskey;
     * 3 - Não sublinhar
     *
     * Se a correspondência for após um espaço, o espaço anterior deverá será substituído por &nbsp;
     * Se a correspondência for antes de um espaço, o espaço posterior será substituído por &nbsp;
     * @param string $label
     * @param string $accesskey
     * @return string
     */
    public static function addAccesskeyTagToString(string $label, string $accesskey): string
    {
        $lowerLabel = strtolower($label);
        $lowerAccessKey = strtolower($accesskey);

        if (mb_substr($lowerLabel, 0, 1) === $lowerAccessKey) {
            $matchpos = 0;
            $hasMatch = true;
        } else {
            if (preg_match("/\s$accesskey/i", $label, $matches, PREG_OFFSET_CAPTURE)) {
                $matchpos = $matches[0][1] + 1;
                $hasMatch = true;
            } else {
                $matchpos = mb_strpos(strtolower($label), strtolower($accesskey));
                $hasMatch = $matchpos !== false;
            }
        }

        if ($hasMatch) {
            $hasSpaceBefore = mb_substr($label, $matchpos - 1, 1) === ' ';
            $hasSpaceAfter = mb_substr($label, $matchpos + 1, 1) === ' ';

            $nbspBefore = $hasSpaceBefore ? '&nbsp;' : '';
            $nbspAfter = $hasSpaceAfter ? '&nbsp;' : '';

            $match = mb_substr($label, $matchpos, 1);

            $label = mb_substr($label, 0, $matchpos + ($hasSpaceBefore ? -1 : 0))
                . "$nbspBefore<u>$match</u>$nbspAfter"
                . mb_substr($label, $matchpos + 1 + ($hasSpaceAfter ? 1 : 0));
        }

        return $label;
    }

    public static function sanitize(?string $value): string
    {
        $value = htmlentities(htmlspecialchars($value));
        return $value;
    }
}
