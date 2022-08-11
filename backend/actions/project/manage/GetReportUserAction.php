<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 9:09
 * PHP version 7
 */

namespace backend\actions\project\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\User;

class GetReportUserAction extends BaseAction
{
    /*
     * 项目报备人
     * */
    public function run()
    {
        $user = User::find()->select('id,userName')->where(['isValid'=>User::IS_VALID_OK])->asArray()->all();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$user
        ]);
    }

}