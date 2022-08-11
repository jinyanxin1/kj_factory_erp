<?php
/**
 * 自动分配字段
 * Created by PhpStorm.
 * User: zhouky
 * Date: 2019/7/30
 * Time: 11:55
 */

namespace backend\actions\login;



use backend\actions\BaseAction;
use common\library\helper\Code;


class AutoAction extends BaseAction
{

    public function run()
    {
       //获取str
        $str = $this->strFilter($this->request()->post('str', ''));

        $phone = '';
        $name = '';
        $age = '';

        $size = mb_strlen($str);

        for ($i=0; $i < $size; $i++)
        {
            $match_str = mb_substr($str,$i,11);
            if (preg_match_all('/^1[123456789]\d{9}$/',$match_str)) {
                $phone = $match_str;
                break;
            }
        }
        if (empty($phone)) {
            return $this->returnApi(Code::PARAM_ERR,'手机号获取失败');
        }
        //去掉手机号
        $str = str_replace($phone,'',$str);

        $is_harder = false;
        for($i=0;$i<strlen($str);$i++)
        {
            if (is_numeric($str[$i])) {
                if ($i == 0) {
                    $is_harder = true;
                }
                $age .= $str[$i];
            }
        }
        if (empty($age)) {
            return $this->returnApi(Code::PARAM_ERR,'年龄获取失败');
        }
        //去除年龄
        $str = str_replace($age,'',$str);
        //判断姓岁的
        if ($is_harder) {
            $name = mb_substr($str,1,mb_strlen($str)-1);
        }else{
            $name = mb_substr($str,0,mb_strlen($str)-1);
        }
        if (empty($name)) {
            return $this->returnApi(Code::PARAM_ERR,'姓名获取失败');
        }
        return $this->returnApi(Code::SUCCESS , 'ok' , [
            'name' => $name,
            'phone' => $phone,
            'age' => intval($age)
        ]);

    }

    function strFilter($str){
        $str = str_replace('`', '', $str);
        $str = str_replace('·', '', $str);
        $str = str_replace('~', '', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('！', '', $str);
        $str = str_replace('@', '', $str);
        $str = str_replace('#', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('￥', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('……', '', $str);
        $str = str_replace('&', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('(', '', $str);
        $str = str_replace(')', '', $str);
        $str = str_replace('（', '', $str);
        $str = str_replace('）', '', $str);
        $str = str_replace('-', '', $str);
        $str = str_replace('_', '', $str);
        $str = str_replace('——', '', $str);
        $str = str_replace('+', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('【', '', $str);
        $str = str_replace('】', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('；', '', $str);
        $str = str_replace(':', '', $str);
        $str = str_replace('：', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('“', '', $str);
        $str = str_replace('”', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace('，', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('《', '', $str);
        $str = str_replace('》', '', $str);
        $str = str_replace('.', '', $str);
        $str = str_replace('。', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('、', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('？', '', $str);
        return trim($str);
    }
}