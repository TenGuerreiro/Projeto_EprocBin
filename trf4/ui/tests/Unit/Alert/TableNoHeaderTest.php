<?php

use Tests\TestCase;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class TableNoHeaderTest extends TestCase
{
    public $rows = [
        [
            'Índice' => '1',
            'Letra' => 'a'
        ], [
            'Índice' => '2',
            'Letra' => 'b'
        ],
    ];
    private $message = "<span><strong>Alerta: </strong></span><span> mensagem.</span>";


    /**
     * @dataProvider dpTestAlert
     */
    public function test($renderer, $expected)
    {
        UI::config($renderer);

        $actual = UI::table('Título', $this->rows)->noHeader();

        $this->assertHtmlEquals($expected, $actual);
    }

    public function dpTestAlert()
    {
        return [
            [
                new Bootstrap4,
                <<<html
					<div class="card shadow-sm">
    					<div class="card-body">
							<h2 class="title-table">Título</h2>
							<div class="table-responsive table-striped">
								<table class="table table-hover table-sm">
									<tbody>
										<tr>   
											<td>1</td>
											<td>a</td>
										</tr>
										<tr>   
											<td>2</td>
											<td>b</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
html
            ]
        ];
    }

}
