<?php

class Cart
{

    public static function addProduct($id)
    {
        $id = intval($id);

        $productsInCart = array();
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;
        
        return self::countItems();
    }

    public static function countItems()
    {
        $count = 0;
        // в сессии есть массив отложенных в корзину товаров
        if (isset($_SESSION['products'])) {
            // перебираем все товары и суммируем их количество
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
        }
        return  $count;
    }
    
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();
        $total = 0;
        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }
}
