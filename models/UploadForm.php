<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
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
            $target = 'uploads';
            foreach ($this->files as $file) {
                $picture = new Picture();
                $picture->name = $this->checkName($target, $file);
                $picture->target = $target;
                $picture->ext = $file->extension;
                $picture->save();

                $file->saveAs($target . '/' . $picture->name . '.' . $picture->ext);
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