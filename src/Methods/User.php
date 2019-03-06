<?php
namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;

/**
*  Five9 User Management
*  @author Brad Stewart - https://github.com/bradstw
*/
class User
{
    protected $client;
    protected $credentials;
    
    public function __construct($credentials)
    {
        $connect = new Five9Client($credentials);
        $this->client = $connect->getClient();
    }
    /**
     * Get a specified users general information
     * @param string $user_name a valid user name
     *
     * @return array containing user info (active, canChangePassword, EMail, extension, federationId, firstName, lastName, fullName, id, locale)
     */
    public function getUsersGeneralInfo($user_name)
    {
        $method = 'getUsersGeneralInfo';
        $user = [
            'username' => [
                'userNamePattern' => $user_name,
            ]
        ];
        $result = $this->client->__soapCall($method, $user);
        $vars = get_object_vars($result);
        $response = get_object_vars($vars['return']);
        return $response;
    }
    
    /**
     * Get all of a specified users info, including general info
     * @param string $user_name a valid user name
     *
     * @return array containing user info (active, canChangePassword, EMail, extension, federationId, firstName, lastName, fullName, id, locale, roles, skills, permissions)
     */
    public function getAllUsersInfo($user_name)
    {
        $method = 'getUsersInfo';
        $user = [
            'username' => [
                'userNamePattern' => $user_name,
            ]
        ];
        $result = $this->client->__soapCall($method, $user);
        $vars = get_object_vars($result);
        $response = get_object_vars($vars['return']);
        return $response;
    }
    
    /**
     * Create a Five9 User Account
     * @param array (general info, roles)
     *
     * @return array containing user info (active, canChangePassword, EMail, extension, federationId, firstName, lastName, fullName, id, locale)
     */
    public function createUser($new_user)
    {
        $method = 'createUser';
        
        # DEFAULTS for new user creation
        $change_pass = !isset($new_user['can_change_password']) ? true : $new_user['can_change_password'];
        $must_change = !isset($new_user['must_change_password']) ? true : $new_user['must_change_password'];
        
        $user_general_info = [
            'firstName' => $new_user['first_name'],
            'lastName' => $new_user['last_name'],
            'password' => $new_user['password'],
            'userName' => $new_user['user_name'],
            'EMail' => $new_user['email'],
            'userProfileName' => $new_user['user_profile'],
            'canChangePassword' => $change_pass,
            'mustChangePassword' => $must_change,
            'active' => true,
        ];
        
        # DEFAULTS for agent role settings
        $agent_role_params = [
            'alwaysRecorded' => true,
            'sendEmailOnVm' => false,
            'attachVmToEmail' => false,
        ];
        
        $new_user_build = [
            'userInfo' => [
                'generalInfo' => $user_general_info,
                'roles' => [
                    'agent' => $agent_role_params,
                ],
            ],
        ];
        
        try {
            $result = $this->client->$method($new_user_build);
            $vars = get_object_vars($result);
            $response = get_object_vars($vars['return']);
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
    
    /**
     * Delete a Five9 User Account
     * @param string five9 user name
     *
     * @return string success or error string
     */
    public function deleteUser($user_name)
    {
        $method = 'deleteUser';
        $user = [
            'userName' => $user_name
        ];
        
        try {
            $result = $this->client->$method($user);
            $response = 'success';
            return $response;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}
