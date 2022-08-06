<?php

use Tests\TestCase;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class TableAdditionalColumnTest extends TestCase
{
    /**
     * @dataProvider dataprovider
     */
    public function test($renderer, $expected)
    {
        UI::config($renderer);

        $rows = [
            [
                'Índice' => '1',
                'Letra' => 'a'
            ], [
                'Índice' => '2',
                'Letra' => 'b'
            ],
        ];

        $actual = UI::table('Título', $rows)
            ->addColumn('Custom', function ($row) {
                return "$row[Índice]$row[Letra]";
            });

        $this->assertHtmlEquals($expected, $actual);
    }

    public function dataprovider()
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
									<thead>
										<tr>
											<th class="font-weight-bold">Índice</th>
											<th class="font-weight-bold">Letra</th>
											<th class="font-weight-bold">Custom</th>
										</tr>
									</thead>
									<tbody>
										<tr>   
											<td>1</td>
											<td>a</td>
											<td>1a</td>
										</tr>
										<tr>   
											<td>2</td>
											<td>b</td>
											<td>2b</td>
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
