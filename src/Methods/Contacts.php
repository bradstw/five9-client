<?php

namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;
use Bradstw\Five9\Defaults;

class Contacts implements MethodInterface
{
    /** API Client Connection @var */
    protected $client;
    
    /** Five9 API credentials @var array */
    protected $credentials;
    
    /** Constructor @param array $credentials is an array containing values for login & password */
    public function __construct($credentials)
    {
        $this->setClient($credentials);
    }
    
    /** setClient required for all api interactions @param array $credentials is an array containing values for login & password */
    public function setClient($credentials)
    {
        $connect = new Five9Client($credentials);
        $this->client = $connect->getClient();
    }
    
    public function addRecordToList($listName, $record)
    {
        $columnNumber = 1;
        $columns = [];
        $data = [];
        foreach ($contactFields as $field => $value) {
            $columns[] = [
                "columnNumber" => $columnNumber++,
                "fieldName"    => $field,
                "key"          => ($field == 'number1' ? true : false)
            ];
            array_push($data, $value);
        }
    }
}
