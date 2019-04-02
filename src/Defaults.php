<?php
namespace Bradstw\Five9;

/**
*  Class for default enviornement, data and field settings
*  @author Brad Stewart - https://github.com/bradstw
*/
class Defaults
{
    public static $user_active = true;
    public static $user_change_password = true;
    public static $user_must_change_password = true;
    
    public static $user_role = [
        'alwaysRecorded' => true,
        'sendEmailOnVm' => false,
        'attachVmToEmail' => false,
    ];
}
