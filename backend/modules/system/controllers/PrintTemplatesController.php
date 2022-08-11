<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:09
 * PHP version 7
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class PrintTemplatesController extends BaseController
{

    /*
     * 打印模板设置
     * */

    public function actions()
    {
        return [
            'info'=>['class'=>'backend\actions\system\printTemplates\InfoAction'],
            'save'=>['class'=>'backend\actions\system\printTemplates\SaveAction']
        ];
    }

}