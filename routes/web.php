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
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post("checkAdmin" , "AuthController@postLogin");
$router->get("test" , 'test1@index');
$router->post("saveNewUser" , "Users@create");
//Groups APIs
$router->post("saveNewGroup" , "GroupController@store");
$router->get("retrieveGroups" , "GroupController@index");
$router->get("retrieveGroupsById/{id}" , "GroupController@edit");
$router->post("updateGroup" , "GroupController@update");
$router->post("destroyGroup" , "GroupController@destroy");

//students APIs

$router->post("storeStudent" , "studentController@store");
$router->get("retrieveStudents","studentController@index");
$router->get("retrieveStudentById/{id}" , "studentController@edit");
$router->post("updateStudent" , "studentController@update");
$router->post("destroyStudent" , "studentController@destroy");

//Tasks Apis
$router->get("retrieveTasks","taskController@index");
$router->post("createTask" , "taskController@store");
$router->get("retrieveTaskById/{id}" , "taskController@edit");
//$router->get("retrieveGroupsById/{id}" , "GroupController@edit");
//$router->post("updateGroup" , "GroupController@update");
//$router->post("destroyGroup" , "GroupController@destroy");
$router->post("findUser" , "Users@edit");
$router->post("updateUser" , "Users@update");

//Roles Apis
$router->post("storeRole" , "RolesController@store");
$router->get("retrieveRole" , "RolesController@index");
$router->get("retrieveRoleById/{id}" , "RolesController@edit");
$router->post("updateRole" , "RolesController@update");
$router->post("destroyRole" , "RolesController@destroy");

//Permissions Apis
$router->get("retrievePermissions" , "permissionsController@index");
$router->get("retrievePermissionById/{id}" , "permissionsController@edit");
$router->post("storePermission" , "permissionsController@store");
$router->post("updatePermission" , "permissionsController@update");
$router->post("destroyPermission" , "permissionsController@destroy");

$router->post("deleteUser" , "Users@destroy");



