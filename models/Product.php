<?php

class Product
{

    const SHOW_BY_DEFAULT = 3;
    const SHOW_BY_DEFAULT_RECOMENDED_ITEMS = 6;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, price, is_new '
                . 'FROM product WHERE status=1 ORDER BY id DESC LIMIT ' . $count);

        $list = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            //$list[$i]['image'] = $row['image'];
            $list[$i]['price'] = $row['price'];
            $list[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $list;
    }

    public static function getRecomendedProducts($count = self::SHOW_BY_DEFAULT_RECOMENDED_ITEMS)
    {
        $count = intval($count);

        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, price, is_new '
                . 'FROM product '
                . 'WHERE status=1 AND is_recommended=1 '
                . 'ORDER BY id DESC LIMIT ' . $count);

        $list = array();
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['price'] = $row['price'];
            $list[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $list;
    }
    
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            
            $db = Db::getConnection();
            $result = $db->query('SELECT id, name, price, is_new FROM product '
                    . 'WHERE status=1 AND category_id=' . $categoryId . ' '
                    . 'ORDER BY id ASC LIMIT ' . self::SHOW_BY_DEFAULT . ' '
                    . 'OFFSET ' . $offset);

            $list = array();
            $i = 0;
            while ($row = $result->fetch()) {
                $list[$i]['id'] = $row['id'];
                $list[$i]['name'] = $row['name'];
                //$list[$i]['image'] = $row['image'];
                $list[$i]['price'] = $row['price'];
                $list[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $list;
        }
    }

    public static function getProductById($productId)
    {
        $productId = intval($productId);

        if ($productId) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id=' . $productId);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    
    public static function getTotalProductsInCategory($categoryId = 0)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status=1 AND category_id=' . $categoryId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $count = $result->fetch();

        return $count['count'];
    }

    public static function getProductsByIds($productsIds)
    {
        $products = array();
        $idsString = implode(',', $productsIds);

        $db = Db::getConnection();
        $sql = "SELECT * FROM product WHERE id IN ($idsString)";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
}
