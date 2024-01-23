<?php


namespace backend\widgets;


use common\models\OrderedProducts;
use yii\bootstrap4\Widget;

class UserOrderProductsWidget extends Widget
{
    public $orderId;

    public function run()
    {
        $models = OrderedProducts::find()->where(['user_order_id' => $this->orderId])->all();
        return $this->render('user-order-products',[
            'models' => $models
        ]);
    }
}