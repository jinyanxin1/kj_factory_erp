<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:12
 * PHP version 7
 */

namespace backend\actions\system\printTemplates;


use backend\actions\BaseAction;
use common\models\system\printTemplates\PrintTemplatesForm;


class SaveAction extends BaseAction
{

    public function run()
    {
        $post = $this->request()->post();

        $print = new PrintTemplatesForm();
        $print->attributes = $post;
        $result = $print->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}