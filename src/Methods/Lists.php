<?php

namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;
use Bradstw\Five9\Defaults;

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
    
    /**
     * Delete a list
     * @param string list name
     *
     * @return string success of error message
     */
    public function deleteList($name)
    {
        $method = 'deleteList';
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
    
    /**
     * Add Phone Numbers to the DNC List
     * @param string phone
     *
     * @return string success of error message
     */
    public function addNumberToDnc($numberToAdd)
    {
        $method = 'addNumbersToDnc';
        $number = [
            'numbers' => $numberToAdd,
        ];
        try {
            $result = $this->client->$method($number);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
    
    /**
     * Remove Phone Numbers from the DNC List
     * @param string phone
     *
     * @return string success of error message
     */
    public function removeNumbersFromDnc($numberToRemove)
    {
        $method = 'removeNumbersFromDnc';
        $number = [
            'numbers' => $numberToRemove,
        ];
        try {
            $result = $this->client->$method($number);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}
