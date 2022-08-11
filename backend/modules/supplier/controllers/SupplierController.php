<?php
/**
 * User: cqj
 * Date: 2020/7/16
 * Time: 10:41 上午
 */
namespace backend\modules\supplier\controllers;

use backend\controllers\BaseController;

class SupplierController extends BaseController
{
    public function actions()
    {
        return [
            //新增供应商
            'supplier_add'=>[
                'class'=>'backend\actions\supplierInfo\AddAction']
            ,
            //修改供应商
            'supplier_save'=>[
                'class'=>'backend\actions\supplierInfo\SaveAction']
            ,
            //供应商详情
            'supplier_info'=>[
                'class'=>'backend\actions\supplierInfo\InfoAction']
            ,
            'supplier_del'=>[
                'class'=>'backend\actions\supplierInfo\DeleteAction']
            ,
            //供应商列表
            'supplier_list'=>[
                'class'=>'backend\actions\supplierInfo\ListAction']
            ,
            //供应商人才列表
            'supplier_job_list'=>[
                'class'=>'backend\actions\supplierInfo\JobListAction']
            ,
            //供应商-新增合同
            'supplier_contract_add'=>[
                'class'=>'backend\actions\supplierContract\AddAction']
            ,
            //供应商合同列表
            'supplier_contract_list'=>[
                'class'=>'backend\actions\supplierContract\ListAction']
            ,
            //供应商合同详情
            'supplier_contract_info'=>[
                'class'=>'backend\actions\supplierContract\InfoAction']
            ,
            //发单
            'supplier_record_add'=>[
                'class'=>'backend\actions\supplierRecord\AddAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'backend\actions\supplierInfo\SelectAction']
            ,
            //转移
            'supplier_shift'=>[
                'class'=>'backend\actions\supplierInfo\ShiftAction']
            ,
        ];
    }
}