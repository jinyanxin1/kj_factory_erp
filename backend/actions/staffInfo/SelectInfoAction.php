<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/29
 * Time: 16:22
 * PHP version 7
 */

namespace backend\actions\staffInfo;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\staffInfo\StaffInfoForm;

class SelectInfoAction extends BaseAction
{

    public function run() {
        $model = new StaffInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $ret = $model->getAll() ;
        $ret = $ret['list'];
        if (!empty($ret)) {
            foreach ($ret as $item) {
                $list[] = [
                    'staffId'=>intval($item['staffId']),
                    'name'=>$item['name'],
                    'wages'=>BaseModel::amountToYuan($item['wages'])
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'select' => $list ]) ;
    }

}