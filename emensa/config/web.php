<?php
/**
 * Mapping of paths to controlls.
 * Note, that the path only support 1 level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as aspected
 */
return array(
    "/"            => "WerbeseiteController@index",
    "/demo"        => "DemoController@demo",
    '/dbconnect'   => 'DemoController@dbconnect',

    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4_6b_kategorie' => 'ExampleController@m4_6b_kategorie',
    '/m4_6c_gerichte' => 'ExampleController@m4_6c_gerichte',
    '/m4_6d_layout' => 'ExampleController@m4_6d_layout',
    '/wunschgericht' => 'WerbeseiteController@redirect'
);