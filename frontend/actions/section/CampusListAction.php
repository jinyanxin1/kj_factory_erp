<?php
/**
 * Created by ljx.
 * User: ljx
 * Date: 2019/11/9
 * Time: 15:08
 */

namespace frontend\actions\section;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\system\section\SectionModel;

class CampusListAction extends WxAction
{

    public function run(){

        $name = $this->request()->post('name');


        $campus = SectionModel::find()
            ->select(['sectionId','name'])
            ->where(['isValid' => SectionModel::IS_VALID_OK]);

        if (!empty($name)) {
            $campus->andWhere(['like','name',$name]);
        }
        $list = $campus->asArray()->all();

        return $this->returnApi(Code::SUCCESS,'ok',['list' => $list]);
    }
}
