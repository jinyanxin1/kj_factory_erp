<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/4/24
 * Time: 16:13
 * PHP version 7
 */

namespace common\library\helper;


use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\helpers\Json;

require __DIR__ .'/../../qncloud/autoload.php';
class UploadImg
{
    public $fileType = ['jpg', 'png', 'jpeg'];
    public $fileSize = 5;

    /*
     * 上传图片到七牛云
     *
     * */
    public function upload($file)
    {
        $file = Json::encode($file);
        $file = Json::decode($file,true);
//        $checkFile = $this->checkFileType($file['type']);
//        if($checkFile === false){
//            return ['code'=>0,'msg'=>'文件类型错误'];
//        }
        $checkSize = $this->checkSize($file['size']);
        if($checkSize === false){
            return ['code'=>0,'msg'=>'文件过大'];
        }

        //获取七牛云配置
        $qiniuConfig = \Yii::$app->params['qiniu'];
        $accessKey = $qiniuConfig['qiniuAccessKey'];
        $secretKey = $qiniuConfig['qiniuSecretKey'];
        $bucket = $qiniuConfig['bucket'];

        //初始化签权对象
        $auth = new Auth($accessKey, $secretKey);

        // 生成上传Token
        $qtoken = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        //图片名称
        $key = 'check_app_web/img/'. date('Ymd') . '/'. time() .rand(100,999) .$file['name'];
        //上传的图片地址
        $path = $file["tempName"];
        $mime  = 'image/jpeg';
        $response = $uploadMgr->putFile($qtoken,$key,$path,null,$mime,false);
        list($ret,$err) = $response;
        //删除服务器上临时文件
        unlink($path);
        if(empty($err)){
            if(isset($ret['key'])){
                $url = '/'.$ret['key'];
                return [
                    'code'=>0,
                    'msg'=>'ok',
                    'data'=>[
                        'url'=>$url,
                        'imgUrl'=>$qiniuConfig['imageUrl'].$url
                    ]
                ];
            }
        }
        return ['code'=>100,'msg'=>'上传失败'];
    }

    /*
     * 检查文件类型
     * */
    private function checkFileType($extension)
    {
        $checkType = $this->fileType;
        if(!in_array($extension,$checkType)){
            return false;
        }
        return true;
    }

    /*
     * 检查文件大小
     * */
    private function checkSize($size)
    {
        if(($size /1024/1024) > $this->fileSize){
            return false;
        }
        return true;
    }

}