<?php

class CartController
{
    public function actionAdd($id)
    {
        Cart::addProduct($id);
        
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }

    public function actionAddAjax($id)
    {
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionIndex()
    {
        // получаем список категорий
        $categories = array();
        $categories = Category::getCategoriesList();
        
        // получаем перечень товаров из корзины
        $productsInCart = false;
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart) {
            // получаем детальную информацию по товарам из корзины по их id
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            
            // считаем сумму по товарам
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once ROOT . '/views/cart/index.php';
        return true;
    }
}
