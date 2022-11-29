<?php

namespace Tests;

use Exception;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use ReflectionException;
use ReflectionMethod;
use Throwable;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\UI;
use App\Helpers\PHPDocParser;

abstract class Showcaser extends TestCase
{
    use ReadDescriptionComment;
    /** @var bool */
    protected $isPrototype = false;

    /**
     * @var ShowcaseCodeFormatter
     */
    protected $codeFormatter;

    /** @var ?string */
    protected $name = null;
    /** @var string Markdown referente à descrição do caso de exemplo. */

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->codeFormatter = new ShowcaseCodeFormatter();

        parent::__construct($name, $data, $dataName);
    }

    public static function md2html(string $markdown): string
    {
        $converter = new GithubFlavoredMarkdownConverter();
        return $converter->convertToHtml($markdown);
    }

    /**
     * @dataProvider rendererExpectations
     * @param AbstractRenderer $renderer
     * @param string $expected
     * @throws Exception
     */
    public function test(AbstractRenderer $renderer, string $expected)
    {
        if ($this->isPrototype()) {
            $this->markTestSkipped("Teste ignorado por estar em estado de prototipação.");
        }

        try {

            UI::config($renderer);

            $this->assertHtmlEquals(
                $expected,
                $this->actual()
            );
        } catch (Throwable $e) {

            echo 'Erro ao rodar teste na classe ' . get_called_class();
            //só para facilitar o debug, porque o teste foi declarado na classe pai
            throw $e;
        }
    }

    /**
     * Devolve um mapa de strings 'expected' onde a chave é a classe do renderer.
     * @return array
     */
    abstract public function rendererExpectations(): array;


    /**
     * Executa um script (monta um componente) e retorna o HTML gerado.
     * @return string
     */
    abstract public function actual(): string;


    /**
     * Retorna o título do caso de teste. Por padrão, é  [NomeDaClasse] - 'Test'
     * Caso a propriedade self::$name esteja definida, esta será utilizada.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name ? $this->name : $this->buildNameFromClass();
    }

    private function buildNameFromClass(): string
    {

        $class_basename = class_basename($this);
        if (substr($class_basename, -4) === 'Test') {
            $class_basename = substr($class_basename, 0, -4);
        }

        preg_match_all("/([A-Z])\w([^A-Z])+/", $class_basename, $matches);
        $ret = implode(' ', $matches[0]);
        if (!$ret) {
            $ret = $class_basename;
        }
        return $ret;
    }

    /**
     * Utilizado somente pelo Showcase
     * @return string
     * @throws ReflectionException
     */

    public function getActualMethodCode(): string
    {
        return $this->getCodeFromMethod('actual');
    }

    public function isPrototype(): bool
    {
        return $this->isPrototype;
    }

    public function getCodeFromMethod(string $method): string
    {
        $reflector = new ReflectionMethod($this, $method);
        $startLine = $reflector->getStartLine();
        $endLine = $reflector->getEndLine();
        $fileName = $reflector->getFileName();
        $contentsArray = file($fileName);
        $methodLength = $endLine - $startLine;
        $lines = array_slice($contentsArray, $startLine, $methodLength);
        $lines = $this->codeFormatter->format($lines);
        return implode($lines);
    }

}