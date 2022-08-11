<?php
/**
 * action基础类
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/27
 * Time: 16:59
 */

namespace backend\actions;


use common\library\helper\Code;
use common\models\User;
use yii\base\Action;
use \Yii;
use yii\helpers\Json;
use yii\web\Response;

class BaseAction extends Action
{
    public $userId;
    public $loginUserName;

    public function init()
    {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $path = Yii::$app->request->getPathInfo();
        if(($path === 'site/sign') || ($path === 'site/login')){

        }else{
            //需要验证登录
            if(Yii::$app->user->isGuest){
                echo Json::encode($this->returnApi(Code::LOGIN_ERR, '请先登录'));
                exit;
            }
            $this->userId = Yii::$app->user->identity['id'];
            $userInfo = User::find()->where(['id'=>$this->userId,'isValid'=>User::IS_VALID_OK])->one();
            if(empty($userInfo)){
                echo Json::encode($this->returnApi(Code::LOGIN_ERR, '用户未找到'));
                exit;
            }
            $this->loginUserName = $userInfo->userName;
        }

    }


    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        echo Json::encode($result);
        exit;
    }

    public function getErrorResponse($model){
        $errors=$model->errors;
        $firstItem = reset($errors);
        return $firstItem[0];

    }

    protected function request(){
        return Yii::$app->request;
    }

    /**
     * 得到分页信息
     * @param $count
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    protected function getPageInfo($count , $pageSize = 0, $page = 1 ){
        if(empty($pageSize)){
            $pageSize = Yii::$app->params['pageSize'];
        }
        $pageSum = ceil($count/$pageSize);
        return [
            'page' => $page,
            'pageSum' => $pageSum,
            'pageSize' => $pageSize,
            'count' => $count
        ];
    }

    /**]
     * @param $page
     * @param $pageSize
     * @return int
     */
    protected function getOffset($page,$pageSize) {
        return intval(($page-1) * $pageSize);

    }
    
    protected function removeSpace($data){
        return preg_replace('# #', '', $data);
    }


    private function getMenuButton(){

    }

    /**
     * @author  ziv
     * @duty 将金额转为分为单位
     * @param float $amount
     * @return integer
     */
    public static function amountToCent($amount){
        return intval(round(floatval($amount) * 100000));
    }

    /**
     * @author  ziv
     * @duty 将金额转为元为单位,并保留两位小数
     * @param integer $amount
     * @return float
     */
    public static function amountToYuan($amount){
        return  sprintf("%.5f",$amount/100000);
    }

    public function exportData($data,$fileName,$headList)
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.CSV"');
        header('Cache-Control: max-age=0');
        //打开PHP文件句柄,php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        //输出Excel列名信息
        foreach ($headList as $key => $value) {
            //CSV的Excel支持GBK编码，一定要转换，否则乱码
            $headList[$key] = iconv('utf-8', 'gbk', $value);
        }
        //将数据通过fputcsv写到文件句柄
        fputcsv($fp, $headList);

        //每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;

        //逐行取出数据，不浪费内存
        foreach ($data as $k => $v) {
            //刷新一下输出buffer，防止由于数据过多造成问题
            if ($k % $limit == 0 && $k!=0) {
                ob_flush();
                flush();
            }
            $row = $data[$k];
            if(!empty($row)){
                foreach ($row as $key => $value) {
                    if( !empty($value) ){
                        $row[$key] = iconv('utf-8', 'gbk//ignore', $value)."\t";
                    }
                    \Yii::info('-----------------------------');
                }
                fputcsv($fp, $row);
            }
        }
    }
}