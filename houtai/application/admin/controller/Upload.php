<?php

namespace app\admin\controller;
use think\Controller;
use think\File;
use think\Request;

class Upload extends Base
{
    //图片上传
    public function upload()
    {
        $file = request()->file('file');
        $info = $file->move('public' . DS . 'uploads' . DS . 'images');
        if ($info) {
            echo $info->getSaveName();
        } else {
            echo $file->getError();
        }
    }

    //会员头像上传
    public function uploadface()
    {
        $file = request()->file('file');
        $info = $file->move('uploads' . DS . 'face');
        if ($info && $info && $info->getPathname()) {
            $path = '/' . $info->getPathname();
            echo $path;
        } else {
            echo $file->getError();
        }
    }


    /**
     * [uploadOne  webUploader上传图片]
     * @author [忘尘]
     * @param string $folder 保存图片文件夹名
     */
    public function webUploaderImages($folder = 'images')
    {
        $folder = !empty(input('param.folder')) ? input('param.folder') : $folder;

        $file = request()->file('file');
        $info = $file->move('uploads' . DS . $folder);
        if ($info && $info->getPathname()) {
            $path = '/' . $info->getPathname();
            return admin_json(1, 'OK', ['path' => $path]);
        } else {
            return admin_json(-1, $file->getError());
        }
    }


}