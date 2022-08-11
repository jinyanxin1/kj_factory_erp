<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:10
 * PHP version 7
 */

namespace common\models\goods;

class GoodsCategoryForm extends GoodsCategoryModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['number'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 20],
        ];
    }

}