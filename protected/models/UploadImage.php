<?php



class UploadImage extends CFormModel
{
    /**
     * @var UploadedFile
     * @var $imageFile CUploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return array(
            array('imageFile', 'required'),
            array('imageFile','file', 'types'=>'jpg, gif, png'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'imageFile' => 'Загрузка картинки',
        );
    }

    public function upload()
    {
        if ($this->validate()) {
            $criteria = new CDbCriteria();
            $criteria->limit =1;
            $criteria->order=' `id` DESC';
            $id = Article::model()->find($criteria);
            $this->imageFile->saveAs(Yii::app()->getBasePath().'/../upload/'  .$id['id']. $this->imageFile->getName());
            return true;
        } else {
            return false;
        }
    }

}