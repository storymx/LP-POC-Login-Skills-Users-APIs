<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/',function () use ($app) {
    return $app->version();
});

$app->post('/base_uris','LPUrisController@getBaseURIs');
$app->post('/domain','LPDomainController@getDomain');
$app->post('/login', 'LPLoginController@login');

/*------------------------------[USERS API]----------------------------*/
$app->post('/getusers','LPUsersController@getUsers');
$app->post('/getuserbyid','LPUsersController@getUserById');
$app->post('/createUser' ,'LPUsersController@createUser');
// $app->post('/updateUsers','LPUsersController@updateUsers');
$app->post('/updateuser','LPUsersController@updateUser');
$app->post('/deleteUsers','LPUsersController@deleteUsers');
$app->post('/deleteUser','LPUsersController@deleteUser');
$app->post('/changeuserpassword','LPUsersController@changeUserPassword');
$app->post('/resetuserpassword','LPUsersController@resetUserPassword');

/*------------------------------[SKILLS API]----------------------------*/
$app->post('/getskills','LPSkillsController@getSkills');
$app->post('/getskillbyid','LPSkillsController@getSkillById');
$app->post('/createskill','LPSkillsController@createSkill');
// $app->post('/updateskill','LPSkillsController@updateSkills');
$app->post('/updateskill','LPSkillsController@updateSkill');
// $app->post('/deleteskills','LPSkillsController@deleteSkills');
$app->post('/deleteskill','LPSkillsController@deleteSkill');

/*------------------------------[AGENTS GROUPS API]----------------------------*/
$app->post('/getagentgroups','AgentGroupsAPIController@getAgentGroups');

/*------------------------------[AGENTS GROUPS API]----------------------------*/
$app->post('/getprofiles','LPProfilesController@getProfiles');
