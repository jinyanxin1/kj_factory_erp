<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,

    'uploadImageSize'=>5*1024*1024, //5M
    'maxHeight' => 500,//图片的最大高度
    'maxWidth' => 500,//图片的最大宽度
    'pageSize'=>10,

    'str'=>256,//保存多张图片转换成字符串数的最大值

    'int-max-number'=>2147483647, //数据库中int最大值

    'WeiXinPageSize'=>15,
    'frontendUrl'=>'**',

    //七牛云上传图片信息
    'fileUrl' => '**',
    'imgUrl'=>'**',
    'imageUrl' => '**',
    'qiniuAccessKey' => '**',
    'qiniuSecretKey' => '**',
    'bucket' => '**',
];
