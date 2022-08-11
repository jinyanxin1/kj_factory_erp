<?php
/**
 * Created by PhpStorm.
 * User: huhui
 * Date: 2019/7/2 0002
 * Time: 16:14
 */

namespace backend\controllers;


use common\library\helper\Code;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii;

class UploadController extends BaseController
{
    //    上传图片
    public function actions()
    {
        return array(
            'ueditor-upload' => array(
                'class' => 'common\kjlib\ueditor\UeditorFun',
            ),
        );

    }
    
    /**
     * 上传图片
     */
    public function actionImages() {
        $file = UploadedFile::getInstanceByName('img');

        $checkFileType = $this->checkFileType($file, array('jpg', 'png', 'jpeg'));
        if($checkFileType === false){
            return $this->renderApiJson(Code::PARAM_ERR, '上传文件格式错误');
        }
        //对象转数组
        $file = Json::encode($file);
        $file = Json::decode($file,true);
        //检查文件大小
        if(($file['size'] / 1024 / 1024) > 5){
            return $this->renderApiJson(Code::PARAM_ERR , '图片大小超出');
        }
        $accessKey = Yii::$app->params['qiniuAccessKey'];
        $secretKey = Yii::$app->params['qiniuSecretKey'];
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        $bucket = Yii::$app->params['bucket'];
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        //重命名filename
        $name = explode('.', $file['name']);
        $file['name'] = 'kj_erp'. date('mdis') .'.'. $name[1];
        //图片名称
        $key = Yii::$app->params['fileUrl']. date('Ymd') . '/' .$file['name'];
        //上传的图片地址
        $path = $file["tempName"];
        $mime  = 'image/jpeg';
        $response = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
        list($ret,$err) = $response;
        if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
            if(isset($ret['key'])){
                $url = '/'.$ret['key'];
                return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'imgUrl' => Yii::$app->params['imageUrl'] . $url));
            }
        }else{
            //如果出错了，则是一下是不是重名的bug了，则取时间戳加随机数命名
            $result = explode('.' , $file['name']);
            //图片名称
            $key = Yii::$app->params['fileUrl']. date('Ymd') . '/' . time() .rand(100,999). '.' .$result[count($result)-1];
            //上传的图片地址
            $path = $file["tempName"];
            $mime  = 'image/jpeg';
            list($ret,$err) = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
            if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
                if(isset($ret['key'])){
                    $url = '/'.$ret['key'];
                    return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'imgUrl' => Yii::$app->params['imageUrl'] . $url));
                }
            }
        }
        return $this->renderApiJson(Code::NORMAL_ERR,'上传失败');
    }
    
    
    /**
     * 上传视频
     */
    public function actionVideo() {
        $file = UploadedFile::getInstanceByName('video');
        
        $checkFileType = $this->checkFileType($file, array('mp4', '3gp'));
        if($checkFileType === false){
            return $this->renderApiJson(Code::PARAM_ERR, '上传文件格式错误');
        }
        //对象转数组
        $file = Json::encode($file);
        $file = Json::decode($file,true);
        //检查文件大小
        if(($file['size'] / 1024 / 1024) > 100){
            return $this->renderApiJson(Code::PARAM_ERR , '文件大小超出');
        }
        $accessKey = Yii::$app->params['qiniuAccessKey'];
        $secretKey = Yii::$app->params['qiniuSecretKey'];
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        $bucket = Yii::$app->params['bucket'];
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        //重命名filename
        $name = explode('.', $file['name']);
        $file['name'] = 'kj_cz_oa'. date('mdis') .'.'. $name[1];
        //图片名称
        $key = 'oa/cz/'. date('Ymd') . '/' .$file['name'];
        //上传的图片地址
        $path = $file["tempName"];
        $mime  = 'video/mp4';
        $response = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
        list($ret,$err) = $response;
        if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
            if(isset($ret['key'])){
                $url = '/'.$ret['key'];
                return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'videoUrl' => Yii::$app->params['imageUrl'] . $url));
            }
        }else{
            //如果出错了，则是一下是不是重名的bug了，则取时间戳加随机数命名
            $result = explode('.' , $file['name']);
            //图片名称
            $key = 'oa/cz/'. date('Ymd') . '/' . time() .rand(100,999). '.' .$result[count($result)-1];
            //上传的图片地址
            $path = $file["tempName"];
            $mime  = 'video/mp4';
            list($ret,$err) = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
            if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
                if(isset($ret['key'])){
                    $url = '/'.$ret['key'];
                    return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'videUrl' => Yii::$app->params['imageUrl'] . $url));
                }
            }
        }
        return $this->renderApiJson(Code::NORMAL_ERR,'上传失败');
    }
    
    
    /**
     * 检测图片类型
     * @param object $file
     * @param array $fileType
     * @return boolean
     */
    public function checkFileType($file, $fileType){
        if(empty($file)){
            return false;
        }
        $extension = $file->extension;
        if(!in_array($extension, $fileType)){
            return false;
        }
        return true;
    }



    /*
     * 上传文件
     * */
    public function actionUploadFile()
    {
        $file = UploadedFile::getInstanceByName('file');
        if(empty($file)){
            return $this->renderApiJson(Code::PARAM_ERR,'上传文件为空');
        }
        $fileType = $file->extension;
        Yii::info('-----frontend upload file type------'.$fileType);
        $file = Json::encode($file);
        $file = Json::decode($file,true);
        Yii::info('-----frontend upload file ------'.print_r($file,true));
        $mime = $file['type'];

        $accessKey = Yii::$app->params['qiniuAccessKey'];
        $secretKey = Yii::$app->params['qiniuSecretKey'];
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        $bucket = Yii::$app->params['bucket'];
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        //重命名filename
        $name = explode('.', $file['name']);
        $file['name'] = 'kj_erp'. date('mdis') .$name[0].'.'.$fileType;
        //图片名称
        $key = 'kj_erp/file/'. date('Ymd') . '/' .$file['name'];
        //上传的图片地址
        $path = $file["tempName"];

        $response = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
        list($ret,$err) = $response;
        if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
            if(isset($ret['key'])){
                $url = '/'.$ret['key'];
                return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'imgUrl' => Yii::$app->params['imageUrl'] . $url));
            }
        }else{
            //如果出错了，则是一下是不是重名的bug了，则取时间戳加随机数命名
            $result = explode('.' , $file['name']);
            //图片名称
            $key = 'kj_erp/file/'. date('Ymd') . '/' . time() .rand(100,999). '.' .$result[count($result)-1];
            //上传的图片地址
            $path = $file["tempName"];
            list($ret,$err) = $uploadMgr->putFile($token,$key,$path,null,$mime,false);
            if(empty($err)){//如果上传成功了，则改变图片地址，否则用本地的图片
                if(isset($ret['key'])){
                    $url = '/'.$ret['key'];
                    return $this->renderApiJson(Code::SUCCESS,'OK',array('url'=> $url , 'imgUrl' => Yii::$app->params['imageUrl'] . $url));
                }
            }
        }
        return $this->renderApiJson(Code::NORMAL_ERR,'上传失败');
    }

}