<?php

namespace Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public static function assertHtmlEquals(string $expectedHtml, string $actualHtml, string $message = ''): void
    {
        $expectedHtml = self::getFormattedHTML($expectedHtml);
        $actualHtml = self::getFormattedHTML($actualHtml);

        if (!$message) {
            $message = 'O html' . PHP_EOL . PHP_EOL . $actualHtml . PHP_EOL . PHP_EOL . 'deve ser igual ao esperado,' . PHP_EOL . PHP_EOL . $expectedHtml;
        }

        self::assertEquals($expectedHtml, $actualHtml, $message);
    }

    protected static function cleanString(string $str)
    {
        return preg_replace('/\s+/', '', $str);
    }

    private static function getFormattedHTML(string $html): string
    {
        $htmlFormatter = new HtmlFormatter();
        return $htmlFormatter->indent($html);
    }

    protected function renderTwigString(string $template, array $viewParams): string
    {
        $name = '1time';

        $loader = new \Twig\Loader\ArrayLoader([
            $name => $template,
            'cache' => false,
            'debug' => true,
        ]);

        $twig = new \Twig\Environment($loader);

        $result = $twig->render(
            $name,
            $viewParams
        );

        return $result;
    }
}
