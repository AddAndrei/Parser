<?php


namespace App\Repositories\ParserHelper;


use GuzzleHttp\Client;

abstract class AbstractParser
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var array
     */
    protected $data;

    /**
     * ParserXml constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $url
     * @param $type
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDataUrl($url,$type)
    {
        $this->data = $this->client->request($type,$url)->getBody()->read(E_ALL);
        return $this;
    }

    /**
     * @param bool $assoc
     * @return $this
     */
    public function jsonToArray($assoc = true)
    {
        $this->data = json_decode($this->data,$assoc);
        return $this;
    }

    /**
     * from xml to array
     * @return $this
     */
    public function XMLtoArray()
    {
        $this->data = json_decode(json_encode(simplexml_load_string($this->data)), true);
        return $this;
    }

    /**
     * Просмотр данных
     * @return $this
     */
    public function debug()
    {
        echo "<pre>".print_r($this->data,true)."</pre>";
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function getKey($key)
    {
        $this->data = array_get($this->data,$key);
        return $this;
    }

    /**
     * По умолчанию laravel сам вернет все данные в формате json
     * Но решил функцию в виде комментариев
     * parse to json
     * @return $this
     */
    /*public function json()
    {
        $this->data = json_encode($this->data);
        return $this;
    }
    */
    /**
     * getter
     * @return array
     */
    public function get()
    {
        return $this->data;
    }


    public function changeKey($old,$new,$rewrite = true)
    {

    }


}
