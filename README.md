Five9 Client Library for PHP 
=========================
[![MIT license](http://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT) ![Packagist Version](https://img.shields.io/packagist/v/bradstw/five9-client.svg)

Installation
------------
composer require bradstw/five9-client


Features
--------
* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Comprehensive Guides and tutorial - Coming Soon

Current Supported Methods
-------------------------
#### User
* createUser
* deleteUser
* getUsersGeneralinfo
* getAllUsersInfo
* activeUser (de-activate or re-activate a user account)

#### Groups
* allAgentGroups
* getAgentGroup
* searchAgentGroups
* deleteAgentGroup
* createAgentGroup
* modifyAgentGroup (rename, addAgents, removeAgents)

#### Report
* runReport

#### Campaign
* getAllDNIS
* getCampaignDNISList
* getOpenDNIS

#### Lists
* createList
* deleteList
