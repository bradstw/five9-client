<?php

namespace Bradstw\Five9;

/**
*  Helper Class for simplifying default enviornement, data and field settings
*  @author Brad Stewart - https://github.com/bradstw
*/
class Defaults
{
    # BASIC USER SETTINGS
    /** @var bool $user_active whether the user account is active on creation */
    public static $user_active = true;
    /** @var bool $user_active whether the user has permission to change thier password */
    public static $user_change_password = true;
    /** @var bool $user_active whether the user must change password on login */
    public static $user_must_change_password = true;
    /** @var array $user_role default user role settings for voicemail, recording and email */
    public static $user_role = [
        'alwaysRecorded' => true,
        'sendEmailOnVm' => false,
        'attachVmToEmail' => false,
    ];
    
    # BASIC IMPORT SETTINGS
    /** @var bool $allowDataCleanup Whether to remove duplicate entries from a list */
    public static $allowDataCleanup = true;
    /** @var string $countryCode */
    public static $countryCode = 'US';
    /** @var bool $failOnFieldParseError Whether to stop the import if incorrect data is found: */
    public static $failOnFieldParseError = true;
    /** @var string $reportEmail Notification about import results is sent by email. Best if injected somewhere */
    public static $reportEmail = '';
    /** @var string $separator */
    public static $separator = ',';
    /** @var bool Whether to omit the top row that contains the names of the fields */
    public static $skipHeaderLine = false;
}
