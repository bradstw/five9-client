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
    
    /**
     * Add Record to a list
     * @param array (list name, array(record to be added))
     *
     * @return array (info on request, # updated, added or failed)
     */
    public function addRecordToList($listName, $record)
    {
        $method = 'addRecordToList';
        
        # Build fields mapping and importdata objects
        $columnNumber = 1;
        $columns = [];
        $data = [];
        foreach ($record as $field => $value) {
            $columns[] = [
                "columnNumber" => $columnNumber++,
                "fieldName"    => $field,
                "key"          => ($field == 'number1' ? true : false),
            ];
            array_push($data, $value);
        }
        # Build object and send record to list
        #TODO create options in function for diff settings to be passed
        $list_update_settings = [
            'fieldsMapping' => $columns,
            'reportEmail' => 'dialer@silvertapllc.com',
            'skipHeaderLine' => false,
            'crmAddMode' => 'ADD_NEW',
            'crmUpdateMode' => 'UPDATE_FIRST',
            'listAddMode' => 'ADD_FIRST',
            'callNowMode' => 'ANY',
            'cleanListBeforeUpdate' => false,
        ];
        $xml_data = [
            'listName' => $listName,
            'listUpdateSettings' => $list_update_settings,
            'record' => $data,
        ];
        
        try {
            $result = $this->client->$method($xml_data);
            $vars = get_object_vars($result);
            $response = get_object_vars($vars['return']);
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}
