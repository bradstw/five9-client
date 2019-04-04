<?php

namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;

class Lists implements MethodInterface
{
    /**
     * API Client Connection
     * @var
     */
    protected $client;
    
    /**
     * Five9 API credentials
     * @var array
     */
    protected $credentials;
    
    /**
     * Constructor
     * @param array $credentials is an array containing values for login & password
     */
    public function __construct($credentials)
    {
        $this->setClient($credentials);
    }
    
    /**
     * setClient required for all api interactions
     * @param array $credentials is an array containing values for login & password
     */
    public function setClient($credentials)
    {
        $connect = new Five9Client($credentials);
        $this->client = $connect->getClient();
    }
    
    /**
     * Create a new list
     * @param string list name
     *
     * @return string success of error message
     */
    public function createList($name)
    {
        $method = 'createList';
        $list = [
            'listName' => $name
        ];
        
        try {
            $result = $this->client->$method($list);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}
