<?php declare(strict_types=1);
if (!\function_exists('xdebug_set_filter')) {
    return;
}

\xdebug_set_filter(
    \XDEBUG_FILTER_CODE_COVERAGE,
    \XDEBUG_PATH_WHITELIST,
    [
        __DIR__ . '/../src/myapp/infra_php/ui/lib/src/',
        __DIR__ . '/../infra_php/'
    ]
);

\xdebug_set_filter(
    \XDEBUG_FILTER_CODE_COVERAGE,
    \XDEBUG_PATH_BLACKLIST,
    [
        __DIR__ . '/../infra_php/ui/showcase',
        __DIR__ . '/../infra_php/vendor',
        __DIR__ . '/../infra_php/BeSimple',
        __DIR__ . '/../infra_php/Infra.php',
        __DIR__ . '/../infra_php/InfraDataTest.php',
        __DIR__ . '/../infra_php/PHPExcel',
        __DIR__ . '/../infra_php/font',
        __DIR__ . '/../infra_php/formularios',
        __DIR__ . '/../infra_php/infra_configurar.php',
        __DIR__ . '/../infra_php/phpqrcode',
        __DIR__ . '/../infra_php/phpzabbix',
        __DIR__ . '/../infra_php/mail',
        __DIR__ . '/../infra_php/relatorio',
    ]
);
