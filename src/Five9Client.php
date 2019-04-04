<?php

namespace Bradstw\Five9;

/**
*  Five9 Web Service Client
*  @author Brad Stewart - https://github.com/bradstw
*/
class Five9Client
{
    # Default Five9 Web Services API endpoint
    const WSDL = "https://api.five9.com/wsadmin/AdminWebService?wsdl";
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
    public function __construct($credentials = [])
    {
        try {
            $this->client = new \SoapClient(self::WSDL, $credentials);
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
    
    /**
   * @return \SoapClient
   */
    public function getClient()
    {
        return $this->client;
    }
}
