<?php

namespace App\Models;

use GuzzleHttp\Client;

class Api{
    protected $client;
    protected $body;
    protected $page = 0;
    protected $last_page = 1;

    public function __construct()
    {
        $api_url = $_ENV['API_URL'];
        $this->client = new Client(['base_uri' => $api_url]);
    }

    public function first()
    {
    	$res = $this->get(['page' => 1]);
    	$this->body = $res['data'];
    	$this->page = $res['current_page'];
    	$this->last_page = $res['last_page'];
    	return $this;
    }

    public function next()
    {
    	if($this->page == $this->last_page){
    		throw new Exception('You\'re on the last page of the API already.');
    	}

    	$res = $this->get(['page' => $this->page + 1]);
    	$this->body = $res['data'];
    	$this->page = $res['current_page'];
    	$this->last_page = $res['last_page'];
    	return $this;
    }

    public function results()
    {
    	return $this->body;
    }

    public function nextPageExists()
    {
    	return $this->page < $this->last_page;
    }

    protected function get($args)
    {
    	$response = $this->client->get('/api/properties', [
    		'query' => [
	    		'api_key' => $_ENV['API_KEY'],
	    		'page[number]' => $args['page'] ?? 1,
	    		'page[size]' => $args['number'] ?? 30
    		]
    	]);
    	$body = $response->getBody();
    	return json_decode($body->getContents(), true);
    }
}
