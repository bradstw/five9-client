<?php
namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;
use Bradstw\Five9\Defaults;

/**
*  Five9 User Management
*  @author Brad Stewart - https://github.com/bradstw
*/
class User
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
        
        # DEFAULTS for new user creation if not specified
        $change_pass = !isset($new_user['can_change_password']) ? Defaults::$user_change_password : $new_user['can_change_password'];
        $must_change = !isset($new_user['must_change_password']) ? Defaults::$user_must_change_password : $new_user['must_change_password'];
        $active = !isset($new_user['active']) ? Defaults::$user_active : $new_user['active'];
        $recorded = !isset($new_user['alwaysRecorded']) ? Defaults::$user_role['alwaysRecorded'] : $new_user['alwaysRecorded'];
        $email_vm = !isset($new_user['sendEmailOnVm']) ? Defaults::$user_role['sendEmailOnVm'] : $new_user['sendEmailOnVm'];
        $attch_vm = !isset($new_user['attachVmToEmail']) ? Defaults::$user_role['attachVmToEmail'] : $new_user['attachVmToEmail'];
        
        
        $user_general_info = [
            'firstName' => $new_user['first_name'],
            'lastName' => $new_user['last_name'],
            'password' => $new_user['password'],
            'userName' => $new_user['user_name'],
            'EMail' => $new_user['email'],
            'userProfileName' => $new_user['user_profile'],
            'canChangePassword' => $change_pass,
            'mustChangePassword' => $must_change,
            'active' => $active,
        ];
        
        # DEFAULTS for agent role settings
        $agent_role_params = [
            'alwaysRecorded' => $recorded,
            'sendEmailOnVm' => $email_vm,
            'attachVmToEmail' => $attch_vm,
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
