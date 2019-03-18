<?php
namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;

class Campaign
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
        $connect = new Five9Client($credentials);
        $this->client = $connect->getClient();
    }
    
    /**
     * Get all DNIS associated with account
     * @return array of all DNIS
     */
    public function getAllDNIS()
    {
        $method = 'getDNISList';
        $get_list = [
            'selectUnassigned' => false
        ];
        $result = $this->client->$method($get_list);
        $response = get_object_vars($result);
        return $response;
    }
    
    /**
     * Get all DNIS not currently in use
     * @return array all available DNIS
     */
    public function getOpenDNIS()
    {
        $method = 'getDNISList';
        $get_list = [
            'selectUnassigned' => true
        ];
        $result = $this->client->$method($get_list);
        $response = get_object_vars($result);
        return $response;
    }
    
    /**
     * Get DNIS associated with a specific campaign
     * @param string valid campaign name
     *
     * @return array all DNIS assocaited with campaign
     */
    public function getCampaignDNISList($campaign)
    {
        $method = 'getCampaignDNISList';
        $campaign = [
            'campaignName' => $campaign
        ];
        $result = $this->client->$method($campaign);
        $response = get_object_vars($result);
        return $response;
    }
}
