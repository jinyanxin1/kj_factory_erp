<?php
namespace common\kjlib\weixin;

use yii;


/**
 * Created by 周滨.
 * Date: 2017/1/13
 * Time: 11:13
 */
class WxMsg
{
    //发送图文消息
    const  MAX_ARTICLES = 8;

    public static function sendMsgNews($openId, array $articles)
    {
        $count = count($articles);
        if ($count > 0 && $count < self::MAX_ARTICLES) {
            $data = array('touser' => $openId,
                'msgtype' => 'news',
                'news' => array(
                    'articles' => $articles
                ),
            );
            return yii::$app->wechat->sendMessage($data);
        } else {
            return false;
        }
    }

    public static function createArticle($title, $description, $url, $picurl)
    {
        return array(
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'picurl' => $picurl,
        );
    }

    //发送文本消息
    public static function sendTextMsg($openId,$text)
    {
        $data = array(
            'touser'=>$openId,
            'msgtype'=>'text',
            'text'=>array(
                'content'=>$text,
            ),
        );
        return yii::$app->wechat->sendMessage($data);
    }


}