<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $key = "editormd-image-file";
        $validator = Validator::make(
            $request->all(),
            [
                $key => 'required|mimes:jpeg,png,bmp,tiff |max:4096',
            ],
            [
                'required' => '上传图片为空！',
                'mimes' => '只允许上传 jpeg, png, bmp,tiff 格式图片.'
            ]
        );

        if (!$validator->passes()) {
            return ['success' => 0, 'message' => $validator->getMessageBag()->all(),];
        }

        $uploadTo = sprintf("upload/%s", today()->format("Y/m/d"));
        $path = $request->file($key)->store($uploadTo);
        if (!$path) {
            return ['success' => 0, 'message' => "Fail",];
        }

        return ['success' => 1, 'message' => "Success", 'url' => url($path),];
    }
}
