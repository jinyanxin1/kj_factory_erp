<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/11/14
 * Time: 9:15
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\advancedConfig\AdvancedConfigModel;
use common\models\BaseForm;
use Yii;

class AdvancedConfigForm extends BaseForm
{
    public $advancedId  ;
    public $campusId    ;
    public $value       ;

    /**
     * 通过校区编号 初始化该校区的 高级配置
     * @param $campusId
     * @throws \Exception
     */
    public static function setCampus($campusId) {
        $autoList = AdvancedConfigModel::getCampusInitList();
        foreach ( $autoList as $value ) {
            $model = new AdvancedConfigModel() ;
            $model->name = $value['name'] ;
            $model->title = $value['title'] ;
            $model->value = $value['value'] ;
            $model->describe = $value['describe'] ;
            $model->autoStart = $value['autoStart'] ;
            $model->campusId = $campusId ;
            if ( !$model->save() ) {
                throw new \Exception("高级设置初始化失败");
            }
        }
    }

    /**
     * 通过校区编号查询列表
     * @param null $campusId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getList ($campusId = null) {
        $list = [] ;

        if (empty($campusId)) {
            $list = AdvancedConfigModel::getCommonList();
        } else {
            $list = AdvancedConfigModel::getCampusList($campusId);
        }
        return $list ;
    }

    /**
     * 修改
     * @return array
     */
    public function save () {
        $model = AdvancedConfigModel::getInfo($this->advancedId);
        if (empty($model)) {
            return ['code' => Code::PARAM_ERR , 'msg' => '无效数据'];
        }

        $model->value = $this->value ;

        if (!$model->save()) {
            return ['code' => Code::PARAM_ERR , 'msg' => '修改失败'];
        }
        return ['code' => Code::SUCCESS , 'msg' => '修改成功'];
    }


}