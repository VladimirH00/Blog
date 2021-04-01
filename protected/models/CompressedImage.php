<?php


class CompressedImage
{
    /**
     * @var $path string путь к файлу
     * @var $fileName string название файла
     * @var $filesize int Размер исходного изображения
     * @var $type string Тип зображения
     * @return bool если удалось сжать файл и записать его то вернет истину
     */
    public function resize_photo($path,$fileName,$fileSize, $type){
        $quality = 60; //Качество в процентах. В данном случае будет сохранено 60% от начального качества.
        $size = 10000;//10485760; //Максимальный размер файла в байтах. В данном случае приблизительно 10 МБ.

        ;
        if($fileSize > $size){
            switch($type){
                case 'image/jpeg': $source = imagecreatefromjpeg($path.$fileName); break; //Создаём изображения по
                case 'image/png': $source = imagecreatefrompng($path.$fileName); break;  //образцу загруженного
                case 'image/gif': $source = imagecreatefromgif($path.$fileName); break; //исходя из его формата
                default: return false;
            }
            imagejpeg($source, $path.'/compressedImages/'.$fileName, $quality); //Сохраняем созданное изображение по указанному пути в формате jpg
            imagedestroy($source);//Чистим память
            return true;
        }
        else return false;
    }
}