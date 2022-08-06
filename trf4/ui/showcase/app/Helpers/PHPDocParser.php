<?php


namespace App\Helpers;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;
use Tests\Showcaser;

class PHPDocParser
{

    public static function getPHPDoc(string $class, string $method): string
    {
        $reflector = new \ReflectionClass($class);

        if ($reflector->hasMethod($method)) {
            $method = $reflector->getMethod($method);

            $docBlock = DocBlockFactory::createInstance()->create($method);

            return self::buildHtmlHeader($docBlock)
                . self::buildHtmlParams($docBlock)
                . self::buildHtmlSubcomponents($docBlock);
        }

        return '';
    }

    private static function buildHtmlHeader(DocBlock $docBlock): string
    {
        $str = $docBlock->getSummary();

        $description = $docBlock->getDescription();

        if (strlen($description)) {
            $str .= "\n\n";
            $str .= $description;
        }
        return $str;
    }

    private static function buildHtmlParams(DocBlock $docBlock)
    {
        /** @var DocBlock\Tags\Param[] $params */
        $params = $docBlock->getTagsByName('param');
        $rows = [];


        foreach ($params as $param) {
            $type = $param->getType();
            $name = $param->getVariableName();

            $rows[] = [
                "<code>$type <b>\$$name</b>",
                $param->getDescription()
            ];
        }

        if ($rows) {
            return
                "\n" .
                self::title('Parâmetros') . "\n" .
                self::buildTable(['Nome', 'Descrição'], $rows);
        }

        return '';
    }

    private static function buildHtmlSubcomponents(DocBlock $docBlock): string
    {
        /** @var DocBlock\Tags\Generic[] $params */
        $subcomponents = $docBlock->getTagsByName('subcomponents');

        $str = '';
        if ($subcomponents) {
            $str .= self::title('Subcomponentes');

            foreach ($subcomponents as $s) {
                $str .= $s->getDescription();
            }
        }
        return $str;
    }

    protected static function buildTable($headers, $rows): string
    {
        $htmlRows = '';
        foreach ($rows as $row) {
            $htmlRows .= '<tr>';
            foreach ($row as $c) {
                $c = Showcaser::md2html($c);
                $htmlRows .= "<td>$c</td>";
            }
            $htmlRows .= "</tr>";
        }

        $htmlHeaders = '';
        foreach ($headers as $c) {
            $htmlHeaders .= "<th>$c</th>";
        }

        return <<<html
<table class="table table-sm table-bordered">
    <thead>
        <tr>$htmlHeaders</tr>
    </thead>
    <tbody>$htmlRows</tbody>
</table>
html;
    }

    private static function title(string $string): string
    {
        return "<h5 class='mt-2'>$string</h5>";
    }


}
