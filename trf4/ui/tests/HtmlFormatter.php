<?php


namespace Tests;


class HtmlFormatter extends \Windwalker\Dom\Format\HtmlFormatter
{
    protected const TEMP_FILE = 'test.js';
    /**
     * @var AttributesSort
     */
    protected $attrSorter;

    protected const TAB_SPACE = "    ";

    public function __construct(array $options = [])
    {
        $this->attrSorter = new  \Tests\SortAttributes();
        parent::__construct($options);
    }

    /**
     * indent
     *
     * @param string $input
     *
     * @return  string
     */
    public function indent($input)
    {
        $this->log = [];

        $input = $this->tempScripts($input);

        $input = $this->removeDoubleWhiteSpace($input);

        $input = $this->sortAttributes($input);

        $input = $this->tempInlineElements($input);

        $output = $this->doIndent($input);

        $output = $this->restoreScripts($output);

        $output = $this->restoreInlineElements($output);

        return trim($output);
    }

    /**
     * removeDoubleWhiteSpace
     *
     * @param string $input
     *
     * @return  string
     */
    protected function removeDoubleWhiteSpace($input)
    {
        //troca espaços duplos por um espaço
        $input = preg_replace('/\s{2,}/', ' ', $input);

        //remover espaço depois de tag
        $input = preg_replace('/> /', '>', $input);

        //remover espaços antes de início de tag
        $input = preg_replace('/\s+</', '<', $input);

        //remover espaço antes de fim de tag auto-fechada
        $input = preg_replace('/(.)\s(\/?>)/', '$1$2', $input);
        return $input;
    }

    /**
     * NÃO SE DEVE USAR REGEX PARA HTML. Solução temporária
     * https://stackoverflow.com/questions/1732348/regex-match-open-tags-except-xhtml-self-contained-tags/1732454#1732454
     * @param string $html
     * @return string
     */
    protected function sortAttributes(string $html): string
    {
        return $this->attrSorter->sortAttr($html);
    }


    /**
     * restoreScripts
     *
     * @param string $output
     *
     * @return  string
     */
    protected function restoreScripts($output)
    {
        foreach ($this->temporaryReplacementsScript as $i => $original) {
            $n = ($i + 1);
            $currentScriptTag = '<script>' . $n . '</script>';
            $currentScriptTagForRegex = '\<script\>' . $n . '\<\/script\>';
            $regex = '/( *?)' . $currentScriptTagForRegex . '/';
            preg_match($regex, $output, $matches);
            $spacesPrefix = $matches[1];
            $spacesPrefix = (is_null($spacesPrefix))? "": $spacesPrefix;
            
            $formattedScript = $this->formatJs($original, $spacesPrefix);
            $output = str_replace($currentScriptTag, $formattedScript, $output);
        }

        return $output;
    }


    private function formatJs(string $html, string $baseSpacesPrefix): string
    {
        $iniJs = strpos($html, "<script");

        $tagIni = substr($html, $iniJs);
        $tagIni = substr($tagIni, 0, strpos($tagIni, ">") + 1);

        $tagEnd = "</script>";

        $strPosTagIni = strpos($html, $tagIni);
        $start = $strPosTagIni + strlen($tagIni);
        $endPos = strpos($html, $tagEnd);
        $length = $endPos - $start;

        $jsCode = substr($html, $start, $length);
        $jsCode = $this->trim($jsCode);


        $spacesPrefix = $baseSpacesPrefix . str_repeat(' ', $strPosTagIni + 4);
        $script = $this->formatScript($jsCode, $spacesPrefix);
        $script = $this->removeDoubleLineBreaks($script);

        $script = "\n" . $script;

        $endContent = $baseSpacesPrefix . str_repeat(' ', $strPosTagIni) . $tagEnd;

        $script = $tagIni . $script . $endContent;

        return $script;
    }

    protected function trim(string $jsCode): string
    {
        $jsCode = ltrim($jsCode);
        $jsCode = rtrim($jsCode);
        return $jsCode;
    }

    protected function formatScript(string $script, string $spacesPrefix): ?string
    {
        if (!strlen($script)) {
            return false;
        }

        if (file_exists(self::TEMP_FILE)) {
            unlink(self::TEMP_FILE);
        }

        file_put_contents(self::TEMP_FILE, $script);

        shell_exec('npm run format');
        $script = $this->indentScript($spacesPrefix);
        unlink(self::TEMP_FILE);


        return $script;
    }

    private function indentScript(string $spacesPrefix): string
    {
        $handle = fopen(self::TEMP_FILE, "r");
        $script = '';
        while (($line = fgets($handle)) !== false) {

            if ($line) {
                $line = $spacesPrefix . $line;
            }

            $script .= $line;
        }

        fclose($handle);
        return $script;
    }

    private function removeDoubleLineBreaks(string $script): string
    {
        return preg_replace("/\n\s+?\n/", "\n", $script);
    }

}