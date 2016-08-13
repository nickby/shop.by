<?php

class Product
{

    const SHOW_BY_DEFAULT = 3;

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

}
