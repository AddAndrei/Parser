<?php

namespace App\Http\Controllers\Controllers;


use App\Repositories\ParserRepository;

class ParserController extends BaseController
{
    /**
     *
     */
    public function index()
    {
        $parser = new ParserRepository($this->urls);
        return $parser->exec();
    }
}
