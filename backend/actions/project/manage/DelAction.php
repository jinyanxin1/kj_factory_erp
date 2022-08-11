<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 9:47
 * PHP version 7
 */

namespace backend\actions\project\manage;


use backend\actions\BaseAction;
use backend\models\project\ProjectForm;
use common\library\helper\Code;
use Yii;

class DelAction extends BaseAction
{
    /*
     * 项目删除
     * */
    public function run()
    {
        $id = $this->request()->post('id');
        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR,'请选择删除的数据');
        }
        $transaction = Yii::$app->db->beginTransaction();
        try{
            ProjectForm::updateAll(['isValid'=>ProjectForm::IS_VALID_NO],['id'=>$id]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            Yii::info('del project fail error msg：'.$e->getMessage());
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}