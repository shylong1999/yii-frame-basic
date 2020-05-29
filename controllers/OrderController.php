<?php


namespace app\controllers;


use app\models\Category;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $products = Product::find()->asArray()->where(['>','p_amount', 0])->all();
        $order = $this->createNewOrder();

        $order_detail = new OrderDetail();
        if ($order_detail->load(\Yii::$app->request->post())) {
            $order_detail->order_id =$order->id;

            $p_id = \Yii::$app->request->post('OrderDetail')['product_id'];
            $quantity = \Yii::$app->request->post('OrderDetail')['quantity'];
            $product = Product::findOne($p_id);
            $p_price = $product['p_price'];
            $discount = $product['discount'];
            $total = $this->getTotal($quantity, $p_price, $discount);
            $amount = $product->p_amount - $quantity;
            if ($amount <= 0 ){
                Yii::$app->session->setFlash('error', 'Select the quantity less than or equal to the quantity in stock');
            }
            else{
                $order_detail->save();
                $order->payment = $total;
                $order->status = 1;
                $order->save();

                $product->p_amount = $amount;
                $product->save(false);
                return $this->redirect('/product/index');
            }
        }

        return $this->render('/orders/create', [
            'products' => $products,
            'order' => $order,
            'order_detail' => $order_detail,
        ]);
    }
    public function getTotal($quantity, $price,$discount){
        return ($quantity*$price)*(100 - ($discount/100));

    }
    public function createNewOrder(){
        $order = new Order();
        $order->user_id = \Yii::$app->user->getId();
        $order->status = 0  ;
        $order->date = date("Y-m-d H:i:s");;
        if ($order->validate()){
            $order->save();
            return $order;
        }
       return null;
    }
    public function actionManageOrder(){
        $orderdetails = OrderDetail::find()->asArray();
        $orderdetails->joinWith('orders');
        print_r($orderdetails->all());
        die();
//        $orders = Order::find()->asArray()->where(['status' => 1])->joinWith('orderDetails')->all();
//        print_r($orders);
//        die();
    }
}