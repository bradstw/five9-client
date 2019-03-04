<?php
namespace Bradstw\Five9\User;

use Bradstw\Five9\Five9Client;

/**
*  Five9 User Management
*
*  Access and Manage Users in Five9
*
*  @author Brad Stewart - https://github.com/bradstw
*/
class User
{
    /**
     * Get a specified users general information
     *
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
}
