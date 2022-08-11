<?php
namespace common\models\system\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
*/
use common\models\BaseForm;
use common\library\helper\Code;

class DgtxPlacesForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $id ;
	public $parent_id ;
	public $cname ;
	public $ctype ;
	public $creator ;
	public $updater ;
	public $createTime ;
	public $updateTime ;
	public $isValid ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new DgtxPlacesModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->parent_id = $this->parent_id ;
        $model->cname = $this->cname ;
        $model->ctype = $this->ctype ;
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
		$model = DgtxPlacesModel::getById($this->id) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->parent_id = $this->parent_id ;
        $model->cname = $this->cname ;
        $model->ctype = $this->ctype ;
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
		$this->info = DgtxPlacesModel::getById($this->id) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {


	    $children = DgtxPlacesModel::find()
            ->where(['isValid' => DgtxPlacesModel::IS_VALID_OK])
            ->andWhere(['parent_id' => $this->id])
            ->count();
	    if ($children > 0 ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'存在下级无法删除'] ;
        }
		if (DgtxPlacesModel::delById($this->id)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		DgtxPlacesModel::delByIds($this->id) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = DgtxPlacesModel::getPage(0, 0, $select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : [] ;
		return ['list' => $this->list , 'count' => $count] ;
	}

	/**
	*查询所有
	* @return array
	*/
	public function getAll() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = DgtxPlacesModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	public function getSelect() {
	    $this->getAll();
	    return $this->formatSelect();
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
            $item['value'] = $value['id'];
            $item['title'] = $value['cname'];
            $item['ctype'] = $value['ctype'];
            $item['parent_id'] = $value['parent_id'];
			$formatData[] = $item ;
		}
		return $formatData ;
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
		$formatData = $this->cation($this->list,1);
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
            if($v['parent_id'] == $num){
                $item['value'] = $v['id'];
                $item['title'] = $v['cname'];
                $item['label'] = $v['cname'];
                $item['ctype'] = $v['ctype'];
                $item['parent_id'] = $v['parent_id'];
                $item['children'] = $this->cation($arr,$v['id']);
                $list[] = $item;
            }
        }
        return $list;
    }
}