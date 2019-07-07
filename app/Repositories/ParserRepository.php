<?php


namespace App\Repositories;






use App\Repositories\ParserHelper\Parser;




class ParserRepository
{

    private $parser;
    /**
     * @var array
     */
    private $urls = [];

    /**
     * ParserRepository constructor.
     * @param $urls
     */
    public function __construct($urls)
    {
        $this->urls = $urls;
        $this->parser = new Parser();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exec()
    {
        $data = [];
         foreach ($this->urls['links'] as $key => $val){
             if($val['type'] == 'xml'){

                $data['rates'] = $this->parser
                    ->getDataUrl($val['url'],'GET')
                    ->XMLtoArray()
                    ->getKey('Cube')
                    ->getKey('Cube')
                    ->getKey('Cube')
                    ->get();



             }else{
                $data['courses'] = $this->parser
                    ->getDataUrl($val['url'],'GET')
                    ->jsonToArray()
                    ->getKey('Valute')
                    ->get();

             }
         }
         return $this->filterData($data);
    }

    /**
     * @param $arr
     * @return mixed
     */
    private function filterData($arr)
    {
        foreach ($arr['rates'] as $v=>$k){
            foreach($arr['courses'] as $i=>$data){
                if($i == $k['@attributes']['currency']){
                    $arr['courses'][$i]['rate'] = $k['@attributes']['rate'];
                }
            }
        }
        unset($arr['rates']);
        return $arr['courses'];
    }








}
