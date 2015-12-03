<?php

namespace chervand\bootstrap;

use Yii;

class Html extends \yii\bootstrap\Html
{
    public static function img($src, $options = [], $encode = false, $webroot = '@webroot')
    {
        if ($encode === true) {
            $file = Yii::getAlias($webroot . DIRECTORY_SEPARATOR . $src);
            $data = file_get_contents($file);
            if ($data !== false) {
                $src = 'data:' . mime_content_type($file) . ';base64,' . base64_encode($data);
            }
        }
        return parent::img($src, $options);
    }
}
