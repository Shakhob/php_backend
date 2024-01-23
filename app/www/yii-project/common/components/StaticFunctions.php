<?php


namespace common\components;

use Yii;
use yii\db\Query;
use yii\helpers\FileHelper;

class StaticFunctions
{
    public static function saveImage($image,$modelType,$modelId){
        $fileName = "photo" . md5($image->baseName . time() . rand(1,100000));
        $fileName .= "." . $image->extension;
        $dir = Yii::getAlias("@frontend") . "/web/uploads/{$modelType}/{$modelId}/";
        if(!is_dir($dir)){
            FileHelper::createDirectory($dir);
        }
        if($image->saveAs($dir.$fileName)){
            return $fileName;
        }
    }
    public static function getImage($imageName,$modelType,$modelId)
    {
        $file = Yii::getAlias("@frontend") . "/web/uploads/{$modelType}/{$modelId}/{$imageName}";
        if(is_file($file)){
            return Yii::$app->params['frontend'] . "/uploads/{$modelType}/{$modelId}/{$imageName}";
        }
        return Yii::$app->params['backend'] . "/img/no_photo.png";
    }
    public static function deleteImage($model, $tableName,$fileName, $type = null)
    {
        switch ($type){
            case 'gallery':
                $file = Yii::getAlias('@frontend') . "/web/uploads/{$tableName}/{$model->product_id}/{$fileName}";
                if (is_file($file)){
                    @unlink($file);
                }
                break;
            default:
                $file = Yii::getAlias('@frontend') . "/web/uploads/{$tableName}/{$model}/{$fileName}";
                if (is_file($file)){
                    @unlink($file);
                }
                break;
        }
    }

    public static function getTableCounts($tableName)
    {
        $query = (new Query())
            ->from($tableName)
            ->count();

        return $query;
    }


    public static function debug($arr)
    {
        echo "<pre>" . print_r($arr, true) . "</pre>";
    }

    public static function formatPublishedDate($publishedDate)
    {
        $months = Yii::$app->params['months'];
        $englishMonth = Yii::$app->formatter->asDatetime($publishedDate, 'php:F');
        $russianMonth = isset($months[date('n', strtotime($publishedDate))]) ? $months[date('n', strtotime($publishedDate))] : $englishMonth;
        $formattedDate = Yii::$app->formatter->asDatetime($publishedDate, "php:d {$russianMonth} Y");
        $formattedDate = preg_replace('/(?<=\d)(st|nd|rd|th)\b/', '', $formattedDate);
        return $formattedDate;
    }
}
