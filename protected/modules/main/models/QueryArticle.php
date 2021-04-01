<?php


class QueryArticle
{
    private $COUNT_ARTICLE_ON_PAGE =6;
    public function getLastArticle()
    {
        $criteria = new CDbCriteria();
        $criteria->limit =1;
        $criteria->order=' `id` DESC';
        $model = Article::model()->find($criteria);
        return isset($model) ? $model : NULL;
    }
    public function searchDataProviderArticleIndex($category)
    {
        $criteria = new CDbCriteria();
        if (isset($category)){
            $criteria->join ='left join `tbl_assignment_category_article` as `t2` on `t`.`id` = `t2`.`articleid`
                                left join `tbl_category` as t3 on t2.categoryid = t3.id';
            $criteria->condition = 't3.id = :categoryid';
            $criteria->params = array(
                ':categoryid'   => $category
            );
        }
        return new CActiveDataProvider('Article', array(
            'criteria'      =>  $criteria,
            'pagination'    =>  array(
                'pageSize'=>$this->COUNT_ARTICLE_ON_PAGE,
            ),
        ));
    }
    public function searchDataProviderArticleAdmin()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'authorid = :authorid';
        $criteria->params = array(':authorid'=>Yii::app()->user->getId());
        return new CActiveDataProvider('Article', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>5,
            ),
        ));
    }
}