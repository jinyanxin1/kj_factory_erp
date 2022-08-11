<?php
/**
 * User: cqj
 * Date: 2020/7/30
 * Time: 2:29 下午
 */

namespace frontend\controllers;


use yii\base\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    public function __construct($id, $module = null, array $config = [])
    {
        parent::__construct($id, $module, $config);
        \Yii::$app->response->format = Response::FORMAT_JSON;
    }
    /**
     * 返回json数据
     * @param int $ret
     * @param string $msg
     * @param array $data
     */
    protected function renderApiJson($code = 1, $msg = '', $data = array())
    {
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
    }
}
