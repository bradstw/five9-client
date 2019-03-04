<?php
namespace Bradstw\Five9;

/**
*  Five9 Web Service Client
*
*  Build connection to the Five9 Web Service API
*
*  @author Brad Stewart - https://github.com/bradstw
*/
class Five9Client
{
    # Default Five9 Web Services API endpoint
    const WSDL = "https://api.five9.com/wsadmin/AdminWebService?wsdl";
    protected $client;
    protected $credentials;
    
    /**
     * Create a new API client using the provided credentials.
     *
     * @param array $credentials is an array containing values for login & password
     *
     * @return $this
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
}
