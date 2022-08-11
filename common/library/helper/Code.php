<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 16:17
 */

namespace common\library\helper;


class Code
{
    const SUCCESS = 0;

    const NORMAL_ERR = 100;     //普通错误

    const PARAM_ERR = 200;      //参数错误

    const SYSTEM_ERR = 500;     //系统错误

    const USER_ERR = 501;       //用户登录错误

    const POWER_ERR = 403;      //权限错误

    const NOT_FOUND = 404;      //找不到接口或地址

    const LOGIN_ERR = 555;      //登录失败
}