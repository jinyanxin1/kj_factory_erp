<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 9:50
 * PHP version 7
 * 项目
 */

namespace backend\models\project;

use common\library\helper\Code;
use common\models\project\ProjectInfoModel;

class ProjectForm extends ProjectInfoModel
{
    public $page = 1;
    public $pageSize = 10;


    public function rules()
    {
        return [
            [['name'],'required','message'=>'{attribute}必填'],
            [['startTime', 'endTime', 'reportTime','price', 'receiptPrice'], 'safe'],
            [['id','projectLeader', 'projectScore', 'reportUserId', 'status', 'contractStatus', 'receiptStatus', 'belongCustomer','clientPersonId'], 'integer','message'=>'{attribute}为数字'],
            [['name', 'cycle', 'joinPersonal'], 'string', 'max' => 50],
            [['projectExplain', 'projectAddress', 'projectDescribe'], 'string', 'max' => 225],
            [['receiptPrice','price','expenditurePrice'],'number','min'=>0,'max'=>self::amountToYuan(self::INT_MAX)],
        ];
    }

    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }
        if($this->id){
            $project = self::getById($this->id,false);
            if(empty($project)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'项目不存在'];
            }
        }else{
            $existProject = self::find()->where(['name'=>$this->name,'isValid'=>self::IS_VALID_OK])->one();
            if(!empty($existProject)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'项目已报备'];
            }
            $project = new self();
        }
        $project->name = $this->name;
        $project->startTime = !empty($this->startTime) ?  date('Y-m-d',strtotime($this->startTime)) : '';
        $project->cycle = !empty($this->cycle) ? $this->cycle : '';
        $project->endTime = !empty($this->endTime) ?  date('Y-m-d',strtotime($this->endTime)) : '';
        $project->projectLeader = intval($this->projectLeader);
        $project->projectExplain = $this->projectExplain;
        $project->projectScore = intval($this->projectScore);
        $project->price = !empty($this->price) ? self::amountToCent($this->price) : 0;
        $project->receiptPrice = !empty($this->receiptPrice) ? self::amountToCent($this->receiptPrice) : 0;
        $project->reportUserId = intval($this->reportUserId);
        $project->reportTime = !empty($this->reportTime) ?  date('Y-m-d',strtotime($this->reportTime)) : '';
        $project->status = intval($this->status) > 0 ? $this->status : self::STATUS_EXAMINE_NO;
        $project->contractStatus = intval($this->contractStatus) > 0 ? $this->contractStatus : self::CONTRACT_NOT_SEND;
        $project->receiptStatus = intval($this->receiptStatus) > 0 ? $this->receiptStatus : self::RECEIPT_NOT;
        $project->joinPersonal = !empty($this->joinPersonal) ? $this->joinPersonal : '';
        $project->belongCustomer = $this->belongCustomer;
        $project->projectAddress = $this->projectAddress;
        $project->projectDescribe = $this->projectDescribe;

        if(!$project->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }


    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        //todo 条件查询

        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('id desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            foreach($data as $info){
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'name'=>$info['name'],
                    'price'=>self::amountToYuan(intval($info['price'])),
                    'receiptPrice'=>self::amountToYuan(intval($info['receiptPrice'])),
                    'expenditurePrice'=>self::amountToYuan(intval($info['expenditurePrice'])),
                    'startTime'=>$info['startTime'],
                    'cycle'=>$info['cycle']
                ];
            }
        }
        return $returnArr;
    }

}