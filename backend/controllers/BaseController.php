<?php
/**
 *
 * User: jinyanxin
 * Date: 2020/4/23
 * Time: 16:49
 */

namespace backend\controllers;

use common\library\helper\Code;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Response;

class BaseController  extends Controller
{

    public $enableCsrfValidation = false;
    public function __construct($id, $module = null, array $config = [])
    {
        parent::__construct($id, $module, $config);
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->request->enableCookieValidation = false;

        $accessToken = \Yii::$app->request->headers->get('token');
        /*if(empty($accessToken)) {
            $accessToken = Yii::$app->request->post('token');
            if(empty($accessToken)){
                $accessToken = Yii::$app->request->get('token');
                if(empty($accessToken)) {
                    echo Json::encode($this->renderApiJson(Code::LOGIN_ERR, '请先登录1'));
                    exit;
                }
            }
        }

        if (Yii::$app->user->isGuest) {
            echo Json::encode($this->renderApiJson(Code::LOGIN_ERR, '请先登录2'));
            exit;
        }

        $key = base64_decode($accessToken);
        Yii::info('登录'. $key);
        $data = Yii::$app->cache->get($key);
        Yii::info('登录取值'. Json::encode($data));
        if(empty($data)){
            echo Json::encode($this->renderApiJson(Code::LOGIN_ERR, '请先登录3'));
            exit;
        }
        $data = Json::decode($data);
        if (!isset($data['value']) | empty($data['value']) | $data['value'] != Yii::$app->user->identity->getAuthKey() ) {
            echo Json::encode($this->renderApiJson(Code::LOGIN_ERR, '请先登录4'));
            exit;
        }

        Yii::$app->cache->set($key, Json::encode($data) , 10 * 24 * 3600);*/
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