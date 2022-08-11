<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/7/30
 * Time: 15:19
 */

namespace backend\actions\user;

use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\User;
use common\models\user\UserBackend;
use common\models\user\UserModel;

class ListAction extends BaseAction
{

    public function run()
    {

        $userName = $this->request()->post('userName');
        $userTel = $this->request()->post('tel');
        $page = $this->request()->post('page', 1);
        $pageSize = $this->request()->post('pageSize',10);

        $result = User::find()->select('id,tel,userName,userType,company,createTime')
            ->where(['isValid' => BaseModel::IS_VALID_OK]);


        if (!empty($userTel)) {
            $result->andWhere(['like','tel', $userTel]);
        }
        if (!empty($userName)) {
            $result->andWhere(['like','userName',$userName]);
        }

        $count = $result->count();
        $offSet = ($page - 1) * $pageSize;
        $list = $result->offset($offSet)->limit($pageSize)->all();
        $userBackend = new UserBackend();
        $data = $userBackend->handle($list);

        $pageInfo = $this->getPageInfo($count, $pageSize,$page);

        return $this->returnApi(Code::SUCCESS, 'ok', ['data' => $data, 'pageInfo' => $pageInfo]);
    }
}
