<?php

<?php

namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;
use Bradstw\Five9\Defaults;

class Contacts implements MethodInterface
{
    #go here
}

$listUpdateSettings = array( "fieldsMapping" => array(
                        array( "columnNumber" => '1', 
                        "fieldName" => "number1",
                         "key" => true ),
array( "columnNumber" => '2', "fieldName" => "first_
name", "key" => false ),
array( "columnNumber" => '3', "fieldName" => "last_
name", "key" => false) ),
"reportEmail" => "email@email.com",
"separator" => ',',
"skipHeaderLine" => false,
"callNowMode" => "ANY", //optional
"callNowColumnNumber" => 4, //optional
"cleanListBeforeUpdate" => false,
"crmAddMode" => "ADD_NEW",
"crmUpdateMode" => "UPDATE_SOLE_MATCHES",
"listAddMode" => "ADD_IF_SOLE_CRM_MATCH" );
$data = array( array( "5555776754" , "Don" , "Draper", "YES" ),
array( "5551112244" , "Betty" , "Smith", "NO" ));
$xml_data = array('listName' => "asdf", 'listUpdateSettings' =>
$listUpdateSettings, 'importData' => $data); //request parameters
