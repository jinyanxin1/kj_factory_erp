<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 15:42
 * 人才招聘列表
 */

namespace frontend\actions\recruitment;


use Codeception\Module\Yii2;
use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use frontend\actions\BaseAction;
use  yii\base\Action;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\notice\NoticeModel;
use common\models\recruitment\RecruitmentModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\dgtxPlaces\DgtxPlacesModel;
use frontend\actions\WxAction;
use yii\helpers\Json;
use yii\web\Response;

class ListAction extends BaseAction
{
    public function run(){
        //接收参数
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        //查询模型
        $model = RecruitmentModel::find()
            ->select('clientId,post,minAge,maxAge,minSalary,maxSalary,cityId,recruitmentId')
            ->where(['isValid' => RecruitmentModel::IS_VALID_OK]);


        //判断查询结果
        if (empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }

        //分页
        $count = $model->count();
        $offset = intval(($page-1)*$pageSize);
        $list = $model->offset($offset)->limit($pageSize)->asArray()->all();

        //格式化数据
        if(!empty($list)){
            $cid = array_column($list,'clientId');
            $cityId = array_column($list,'cityId');
            $cname = ClientInfoModel::find()
                ->select('clientId,name,logo')
                ->where(['clientId' => $cid])
                ->indexBy('clientId')
                ->asArray()
                ->all();
            $cityName = DgtxPlacesModel::find()
                ->select('id,cname')
                ->where(['id' => $cityId])
                ->indexBy('id')
                ->asArray()
                ->all();
            foreach ($list as $key => $value){
                $list[$key]['clientName'] = isset($cname[$value['clientId']]['name'])?
                    $cname[$value['clientId']]['name'] : "";
                $list[$key]['clientLogo'] = isset( $cname[$value['clientId']]['logo'])?
                    \Yii::$app->params['imageUrl']. $cname[$value['clientId']]['logo'] : "";
                $list[$key]['cityName'] = isset($cityName[$value['cityId']]['cname']) ?
                    $cityName[$value['cityId']]['cname'] : "";
                $list[$key]['minSalary'] = $this->amountToYuan($list[$key]['minSalary']);
                $list[$key]['maxSalary'] = $this->amountToYuan($list[$key]['maxSalary']);
            }


        }

        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok',['list' => $list,
            'pageInfo' => $this->getPageInfo($count,$pageSize,$page)]);
        }

}