<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    //Абстрактная прослойка
    protected $urls = [
        'links' => [
            'rate'     => [
                'url'=>'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
                'type' => 'xml'
            ],
            'course'   => [
                'url'  => 'https://www.cbr-xml-daily.ru/daily_json.js',
                'type' => 'json'
            ]
        ]
    ];
}
