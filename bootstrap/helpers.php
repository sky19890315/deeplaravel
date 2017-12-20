<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 2017/12/20
 * Time: 12:07
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}