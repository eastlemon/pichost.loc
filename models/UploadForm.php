<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
use yii\imagine\Image;
use app\models\Picture;

class UploadForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'bmp, png, jpg', 'maxFiles' => 5],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            $target = Yii::getAlias('@webroot') . '/uploads';
            foreach ($this->files as $file) {
                $picture = new Picture();
                $picture->name = $this->checkName($target, $file);
                $picture->target = $target;
                $picture->ext = $file->extension;
                $picture->save();

                $originFile = $target . '/' . $picture->name . '.' . $picture->ext;
                $thumbnFile = $target . '/thumb-' . $picture->name . '.' . $picture->ext;

                $file->saveAs($originFile);
                Image::thumbnail($originFile, 120, 120)->save($thumbnFile, ['quality' => 50]);
            }
            return true;
        } else {
            return false;
        }
    }

    private function checkName($target, $file)
    {
        $i = 1;

        $baseName = Inflector::slug($file->baseName);
        
        if (!file_exists($target . '/' . $baseName . '.' . $file->extension)) return $baseName;
        
        while (file_exists($target . '/' . $baseName . '('. $i .').' . $file->extension)) $i++;
        
        return $baseName . '('. $i .')';
    }
}