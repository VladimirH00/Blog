<?php


class QueryCategory
{
    public function getCategories()
    {
        $arrayModel = Category::model()->findAll();
        $listCategories = array();
        foreach ($arrayModel as $item=>$value){
            $listCategories[$value['id']] = $value['category'];
        }
        return $listCategories;
    }

}