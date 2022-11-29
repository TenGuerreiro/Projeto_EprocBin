<?php

use Tests\TestCase;
use TRF4\UI\Renderer\Bootstrap4 as Bootstrap4Renderer;
use TRF4\UI\Renderer\Infra as InfraRenderer;
use TRF4\UI\UI;

class CheckboxGroupTest extends TestCase
{


	protected function setUp(): void {
		UI::config(new Bootstrap4Renderer());
	}

	/**
	 * @dataProvider dpValidateOptionsOnConstruct
	 */
	public function testValidateOptionsOnConstruct($options, $expectedMsg) {
		if (!is_array($expectedMsg)) {
			$expectedMsg = [$expectedMsg];
		}

		foreach ($expectedMsg as $msg) {
			$this->expectExceptionMessage($msg);
		}

		UI::checkboxGroup('1', $options, '2');
	}

	public function dpValidateOptionsOnConstruct() {
		return [
			[
				[], 'É necessário haver pelo menos uma opção no construtor de CheckboxGroup.'
			],
			[
				[[1]], ['Formato do array array (', '0 => 1,', ') não suportado por Checkbox::fromArray']
			],
		];
	}

}
