<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\View\DocsHelper\FormTestClass;
use Illuminate\Http\Request;
use Tests\FormShowcaser;

Route::get('/', function () {
    return redirect('/docs');
});

Route::middleware('page-cache')->get('/docs/{renderer?}', [
        'uses' => 'Showcaser\ShowcaserController@show',
        'as' => 'ui'
    ]
);

Route::get('/outros', function (Request $request) {
    return view('/outros');
});

Route::post('/testeFile', function (Request $request) {
    return view('bootstrap4/form_file_teste');
});

Route::post('/outros', function (Request $request) {
    return view('/outros');
});

Route::post('/bootstrap4/deletefile', function (Request $request) {
    $data['status'] = 200;
    return json_encode($data);
});

Route::post('/testeFile', function (Request $request) {
    return view('bootstrap4/form_file_teste');
});

Route::get('/bootstrap4/form', function (Request $request) {
    return view('bootstrap4/form');
});

Route::get('/bootstrap4/form_short', function (Request $request) {
    return view('bootstrap4/form_short');
});

Route::get('/releases', function (Request $request) {
    $markdown = file_get_contents(__DIR__ . '/../../CHANGELOG.md');
    $html = \Tests\Showcaser::md2html($markdown);
    return view('releases', [
        'html' => $html
    ]);
});

Route::match(['get', 'post'], '/showcase-uiget', function (Request $request) {
    // instancia classe
    $class = $request->request->get('ui-class');

    /** @var FormShowcaser $formShowcaser */
    $formShowcaser = new $class();
    $httpMethod = strtolower($request->get('http_method'));
    $ret = $formShowcaser->retrieveValue($httpMethod);
    $testClass = new FormTestClass($formShowcaser);

    return view('components.showcase.formcard.result', [
        'serverCode' => $testClass->getPhpServerCode($httpMethod),
        'testClass' => $testClass,
        'request' => $request->all(),
        'result' => $ret
    ]);
});

Route::get('/states', function (Request $request) {
    $data = [
        'Brazil' => ['Rio Grande do Sul', 'Santa Catarina', 'Paraná'],
        'Argentina' => ['Córdoba', 'Chaco']
    ];
    $country = $request->get('country');
    usleep(array_rand([500, 1000]));
    return json_encode($data[$country]);
});

function getStatesByCountryAndQuery($country, Request $request)
{
    function state($short, $name)
    {
        return [
            'short' => $short,
            'name' => $name,
            'code' => null
        ];
    }

    $data = [
        'Brazil' => [
            state('AC', 'Acre'),
            state('AL', 'Alagoas'),
            state('AP', 'Amapá'),
            state('AM', 'Amazonas'),
            state('BA', 'Bahia'),
            state('CE', 'Ceará'),
            state('DF', 'Distrito Federal'),
            state('ES', 'Espírito Santo'),
            state('GO', 'Goiás'),
            state('MA', 'Maranhão'),
            state('MT', 'Mato Grosso'),
            state('MS', 'Mato Grosso do Sul'),
            state('MG', 'Minas Gerais'),
            state('PA', 'Pará'),
            state('PB', 'Paraíba'),
            state('PR', 'Paraná'),
            state('PE', 'Pernambuco'),
            state('PI', 'Piauí'),
            state('RJ', 'Rio de Janeiro'),
            state('RN', 'Rio Grande do Norte'),
            state('RS', 'Rio Grande do Sul'),
            state('RO', 'Rondônia'),
            state('RR', 'Roraima'),
            state('SC', 'Santa Catarina'),
            state('SP', 'São Paulo'),
            state('SE', 'Sergipe'),
            state('TO', 'Tocantins'),
        ],

        'Argentina' => [
            state('CR', 'Córdoba'),
            state('CH', 'Chaco'),
        ]

    ];
    $code = 0;

    foreach ($data as $k => $v) {
        foreach ($v as $state) {
            $state['code'] = $code++;
        }
    }
    $data = $data[$country];

    if ($q = $request->get('q')) {
        $data = array_filter($data, function ($country) use ($q) {
            return str_contains(strtolower($country['name']), strtolower($q));
        });
    };

    return $data;
}

Route::get('/states_objects', function (Request $request) {
    $country = $request->get('country');
    $data = getStatesByCountryAndQuery($country, $request);
    return json_encode($data);
});

Route::any('/states_strings', function (Request $request) {
    $country = $request->get('country');

    $data = array_map(function ($c) {
        return $c['name'];
    }, getStatesByCountryAndQuery($country, $request));

    return json_encode($data);
});

Route::get('states_map', function (Request $request) {
    $country = $request->get('country');
    $data = getStatesByCountryAndQuery($country, $request);
    $newData = [];
    // converte em um mapa code => name
    foreach ($data as $d) {
        $newData[$d['code']] = $d['name'];
    }
    return json_encode($newData);
});


Route::get('autocomplete_action', function (Request $request) {
    $query = $request->get('q');

    $data = [
        'a',
        'aab',
        'aaac',
        'aaaad',
        'aaaaae',
    ];

    if ($query) {
        $filtered = array_filter($data, function ($row) use ($query) {
            return str_contains($row, $query);
        });
    } else {
        $filtered = $data;
    }

    return json_encode(array_values($filtered));
});


