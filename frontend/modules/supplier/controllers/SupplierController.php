<?php
/**
 * User: cqj
 * Date: 2020/7/16
 * Time: 10:41 上午
 */
namespace frontend\modules\supplier\controllers;

use frontend\controllers\BaseController;

class SupplierController extends BaseController
{
    public function actions()
    {
        return [
            //新增供应商
            'supplier_add'=>[
                'class'=>'frontend\actions\supplierInfo\AddAction']
            ,
            //修改供应商
            'supplier_save'=>[
                'class'=>'frontend\actions\supplierInfo\SaveAction']
            ,
            //供应商详情
            'supplier_info'=>[
                'class'=>'frontend\actions\supplierInfo\InfoAction']
            ,
            //供应商列表
            'supplier_list'=>[
                'class'=>'frontend\actions\supplierInfo\ListAction']
            ,
            //供应商人才列表
            'supplier_job_list'=>[
                'class'=>'frontend\actions\supplierInfo\JobListAction']
            ,
            //供应商-新增合同
            'supplier_contract_add'=>[
                'class'=>'frontend\actions\supplierContract\AddAction']
            ,
            //供应商合同列表
            'supplier_contract_list'=>[
                'class'=>'frontend\actions\supplierContract\ListAction']
            ,
            //供应商合同详情
            'supplier_contract_info'=>[
                'class'=>'frontend\actions\supplierContract\InfoAction']
            ,
            //发单
            'supplier_record_add'=>[
                'class'=>'frontend\actions\supplierRecord\AddAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'frontend\actions\supplierInfo\SelectAction']
            ,
        ];
    }
}