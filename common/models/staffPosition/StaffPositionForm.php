<?php

namespace common\models\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/
use common\models\staffPosition\StaffPositionModel;
use common\models\BaseForm;
use common\library\helper\Code;

class StaffPositionForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $positionId ;
	public $parentId ;
	public $name ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new StaffPositionModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->parentId = $this->parentId ;
        $model->name = $this->name ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = StaffPositionModel::getById($this->positionId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->parentId = $this->parentId ;
        $model->name = $this->name ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编辑失败'] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = StaffPositionModel::getById($this->positionId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
        $children = StaffPositionModel::find()
            ->where(['isValid' => StaffPositionModel::IS_VALID_OK])
            ->andWhere(['parentId' => $this->positionId])
            ->count();
        if ($children > 0 ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'存在下级无法删除'] ;
        }
		if (StaffPositionModel::delById($this->positionId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		StaffPositionModel::delByIds($this->positionId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = StaffPositionModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : [] ;
		return ['list' => $this->list , 'count' => $count] ;
	}
    public function getSelect() {
        $this->getAll();
        return $this->formatSelect();
    }

    /**
     *格式化所有数据
     * @return array
     */
    public function formatSelect() {
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        $formatData = $this->cation($this->list,0);
        return $formatData ;
    }

    /**
     * 递归三级
     * @param $arr
     * @param int $num
     * @return array
     */
    function cation($arr,$num=0)
    {
        $list = [];
        foreach ($arr as $k => $v) {
            if($v['parentId'] == $num){
                $item['value'] = $v['positionId'];
                $item['title'] = $v['name'];
                $item['parentId'] = $v['parentId'];
                $item['children'] = $this->cation($arr,$v['positionId']);
                $list[] = $item;
            }
        }
        return $list;
    }

	/**
	*查询所有
	* @return array
	*/
	public function getAll() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = StaffPositionModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		return $formatData ;
	}
	/**
	*格式化分页数据
	* @return array
	*/
	public function formatPage() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}
	/**
	*格式化所有数据
	* @return array
	*/
	public function formatAll() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}
}