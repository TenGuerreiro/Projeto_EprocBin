<?php

namespace Tests;

use App\Helpers\PHPDocParser;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use TRF4\UI\UI;

trait ReadDescriptionComment
{

    protected $componentMethod;

    /** @var string Markdown referente à descrição do caso de exemplo. */
    protected $description = '';

    /** classe padrão na qual a descrição dos componentes será lida */
    protected $mainClass = UI::class;

    public static function md2html(string $markdown): string
    {
        $converter = new GithubFlavoredMarkdownConverter();
        return $converter->convertToHtml($markdown);
    }

    /**
     * @return string um html contendo a descrição do caso de uso.
     */
    public function description(): string
    {
        if ($this->componentMethod) {
            $this->description = PHPDocParser::getPHPDoc($this->mainClass, $this->componentMethod);
        }

        return self::md2html($this->description);
    }


    public function getDescription(): ?string
    {
        return $this->description();
    }
}
