<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/11/1
 * Time: 10:04
 * 打印模板
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\printTemplates\PrintTemplatesModel;
use Yii;

class PrintTemplatesForm extends BaseForm
{
    public $type;
    public $format;
    public $h5;
    public $printTemplatesId;
    public function rules()
    {
        return [
            [['campusId','type','format'],'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'campusId' => '校区编号' ,
            'type' => '打印类型' ,
            'format' => '模板' ,
        ];
    }

    /**
     * 查看详情
     * @return PrintTemplatesModel|null
     */
    public function getInfo() {
        $info = PrintTemplatesModel::find()
            ->where([
                'campusId' => $this->campusId ,
                'type' => $this->type ,
                'format' => $this->format ,
                'isDelete' => PrintTemplatesModel::IS_VALID_OK])
            ->asArray()
            ->one();
        return $info ;
    }

    /**
     * 获得参数列表
     * @return array
     */
    public function getInfoList () {
        $data = [];
        switch ($this->type) {
            case 1 :
                $data = [
                    'BaseInfo' => PrintTemplatesModel::$BASE_INFO_CHARGE_RECEIPT,
                    'ListInfo' => PrintTemplatesModel::$LIST_INFO_CHARGE_RECEIPT
                ];
                break;
            case 2 :
                $data = [
                    'BaseInfo' => PrintTemplatesModel::$BASE_INFO_REFUND_RECEIPT,
                    'ListInfo' => PrintTemplatesModel::$LIST_INFO_REFUND_RECEIPT
                ];
                break;
            case 3 :
                $data = [
                    'BaseInfo' => PrintTemplatesModel::$BASE_INFO_PAYMENT_RECEIPT,
                    'ListInfo' => PrintTemplatesModel::$LIST_INFO_PAYMENT_RECEIPT
                ];
                break;
            case 4 :
                $data = [
                    'BaseInfo' => PrintTemplatesModel::$BASE_INFO_ATTEND_CLASS,
                    'ListInfo' => PrintTemplatesModel::$LIST_INFO_ATTEND_CLASS
                ];
                break;
        }
        return $data;
    }

    /**
     * 新增默认数据通过校区id
     * @param $campusId
     * @throws \Exception
     */
    public static function setCampus ($campusId) {
        foreach (PrintTemplatesModel::$TYPE_LIST as $key => $value) {
            foreach (PrintTemplatesModel::$FORMAT_LIST as $k => $v) {
                $model = new PrintTemplatesModel();
                $model->campusId = $campusId ;
                $model->type = $key ;
                $model->format = $k ;
                $model->h5 = PrintTemplatesModel::$HTML[$key] ; ;
                if(!$model->save()) {
                    throw new \Exception("打印模板初始化失败");
                }
            }
        }
    }

    /**
     * 编辑
     * @return array
     */
    public function update () {
        $model = PrintTemplatesModel::find()->where(['printTemplatesId' => $this->printTemplatesId ,
            'format' => $this->format,
            'type' => $this->type,
            'isDelete' => PrintTemplatesModel::IS_VALID_OK])->one();
        if(empty($model)){
            return ['code' => Code::PARAM_ERR , 'msg' => '无效数据'];
        }
        $model->h5 = $this->h5;

        if(!$model->save()) {
            return ['code' => Code::PARAM_ERR , 'msg' => '修改失败'];
        }
        return ['code' => Code::SUCCESS , 'msg' => '修改成功'];
    }
}