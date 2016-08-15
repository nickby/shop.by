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
    
    public function actionCheckout()
    {
        // получаем список категорий
        $categories = array();
        $categories = Category::getCategoriesList();

        // статус успешного оформления заказа
        $result = false;
        
        // форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма на оформление отправлена
             
            // читаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            
            // валидируем данные
            $errors = false;
            if (!User::checkName($userName)) {
                $errors[] = 'Имя не должно быть короче 2 символов';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }
            
            
            if ($errors == false) {
                // форма заполнена корректно
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }
                
                // сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                // при успехе оповещаем администратора
                if ($result) {
                    $adminEmail = 'nick.mail@tut.by';
                    $subject = 'Новый заказ';
                    $message = "http://shop.by/admin/orders";
                    mail($adminEmail, $subject, $message);
                    
                    // чистим корзину
                    Cart::clear();
                }
                
            } else {
                // форма заполнена некорректно - выводим итоги и повторно оформляем
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
                
            }
            
            
        } else {
            // Форма не отправлена - просто вход на оформление заказа
            $productsInCart = Cart::getProducts();
            
            // проверяем корзину
            if ($productsInCart == false)  {

                // пустая корзина - отправляем на заполнение
                header("Location: /");
                
            } else {
                
                // непустая корзина - подбиваем бабки
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
                
                $userName = '';
                $userPhone = '';
                $userComment = '';
                
                // если пользователь авторизован - заполняем поля оформления
                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];
                }
                
            }
        }

        require_once ROOT . '/views/cart/checkout.php';
        return true;
    }
    
    public function actionDelete($id)
    {
        
        Cart::deleteProduct($id);
        
        header("Location: /cart/");
        return true;
    }
}
