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
    public function searchAgentGroups($group_name)
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
    public function allAgentGroups()
    {
        $method = 'getAgentGroups';
        $group = [
            'groupNamePattern' => ".*"
        ];
        $result = $this->client->$method($group);
        $response = get_object_vars($result);
        return $response;
    }
      
    /**
    * Create agent group
    * @param array (name, description, id)
    * @param array agents to be added to the group upon creation
    *
    * @return array agentgroup
    */
    public function createAgentGroup($group, $users = [])
    {
        $method = 'createAgentGroup';
        $new_group = [
            'group' => [
                'id' => $group['id'],
                'name' => $group['name'],
                'description' => $group['description'],
                'agents' => $users,
            ],
        ];
        
        try {
            $result = $this->client->$method($new_group);
            $vars = get_object_vars($result);
            $response = get_object_vars($vars['return']);
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
    
    /**
     * Modify agent group
     * @param string action to be performned, addAgents, removeAgents, renameGroup
     * @param array agents to be removed or added ir action is addAgents or removeAgents
     *
     * @return string success or error string
     */
    public function modifyAgentGroup($action, $users, $group_name = null)
    {
        $method = 'modifyAgentGroup';
        
        # Validate variables
        if (is_null($group_name)) {
            return 'Group name cannot be null';
        }
        if (!is_array($users) && $action <> 'rename') {
            return 'Users must be data type array';
        }
        
        $valid_actions = [
            'addAgents',
            'addagents',
            'removeAgents',
            'removeagents',
            'rename',
        ];
        
        if (!in_array($action, $valid_actions)) {
            return 'Invalid action';
        }
        switch ($action) {
            case 'rename':
                $add_agents = [];
                $remove_agents = [];
                $new_group_name = $group_name;
                break;
            case 'addAgents':
            case 'addagents':
                $add_agents = $users;
                $remove_agents = [];
                break;
            case 'removeAgents':
            case 'removeagents':
                $add_agents = [];
                $remove_agents = $users;
                break;
            default:
                $add_agents = [];
                $remove_agents = [];
                $new_group_name = '';
                break;
        }
        
        $update_group = [
            'addAgents' => $add_agents,
            'removeAgents' => $remove_agents,
            'group' => [
                'name' => $group_name,
            ],
        ];
        
        try {
            $result = $this->client->$method($update_group);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}