<?php
namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;

/**
*  Five9 Group Management
*  @author Brad Stewart - https://github.com/bradstw
*/
class Groups
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
     * Get a specified Agent Group information
     * @param string valid group name
     *
     * @return array containing group info (agents, description, id, name)
     */
    public function getAgentGroup($group_name)
    {
        $method = 'getAgentGroup';
        $group = [
            'groupName' => $group_name
        ];
        $result = $this->client->$method($group);
        $vars = get_object_vars($result);
        $response = get_object_vars($vars['return']);
        return $response;
    }
    
    /**
     * Get a specified Agent Group information
     * @param string valid group name
     *
     * @return string success or error message
     */
    public function deleteAgentGroup($group_name)
    {
        $method = 'deleteAgentGroup';
        $group = [
            'groupName' => $group_name
        ];
        try {
            $result = $this->client->$method($group);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
    
    /**
     * Search for groups
     * @param string regular expression name search is (R.*) 
     *
     * @return array matched groups from search 
     */
     public function searchGroups($group_name)
     {
         $method = 'getAgentGroups';
         $group = [
             'groupNamePattern' => $group_name
         ];
         $result = $this->client->$method($group);
         $response = get_object_vars($result);
         return $response;
     }
     
     /**
      * Get all groups
      * @return array all agent groups
      */
      public function allGroups()
      {
          $method = 'getAgentGroups';
          $group = [
              'groupNamePattern' => ".*"
          ];
          $result = $this->client->$method($group);
          $response = get_object_vars($result);
          return $response;
      }
}