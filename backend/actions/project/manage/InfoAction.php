<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 16:14
 * PHP version 7
 */

namespace backend\actions\project\manage;


use backend\actions\BaseAction;
use backend\models\project\ProjectForm;
use common\library\helper\Code;

class InfoAction extends BaseAction
{

    /*
     * 项目详情
     * */
    public function run()
    {
        $id = intval($this->request()->post('id'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择项目');
        }
        $info = ProjectForm::getById($id,true);
        if(empty($info)){
            return $this->returnApi(Code::PARAM_ERR,'项目不存在');
        }
        $info['price'] = ProjectForm::amountToYuan(intval($info['price']));
        $info['receiptPrice'] = ProjectForm::amountToYuan(intval($info['receiptPrice']));
        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info]);
    }

}