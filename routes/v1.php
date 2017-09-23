<?php

$api->version('v1', ['middleware' => 'api', 'prefix' => 'api', 'namespace' => 'App\Api\V1\Controllers'], function ($api) {
    $api->post('signup', 'AuthorizationController@signUp');
    $api->post('token', 'AuthorizationController@token');
    $api->post('refresh-token', 'AuthorizationController@refershToken')->middleware('jwt.refresh');

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->post('logout', 'AuthorizationController@logout');
        $api->get('me', 'AuthorizationController@me');
    });

    //test
    $api->get('hello', function () {
        return response()->json([
            'message' => 'hello world',
        ]);
    });
});
