<?php

class Category
{

    public static function getCategoriesList()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT id, name FROM category ORDER BY sort_order ASC');

        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }

}