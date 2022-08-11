<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:48
 * PHP version 7
 */

namespace backend\actions\purchase\wareHouse;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\purchase\WarehouseModel;

class DelAction extends BaseAction
{

    public function run()
    {
        $id = $this->request()->post('id');

        $tran = \Yii::$app->db->beginTransaction();
        try{
            WarehouseModel::updateAll(
                ['isValid'=>WarehouseModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],
                ['id'=>$id]
            );
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            \Yii::info('del wareHouse fail error msg----'.$e->getMessage());
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}