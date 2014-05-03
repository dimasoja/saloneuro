<?php

defined('SYSPATH') or die('No direct script access.');

class ImageWork {

    static public $maxwidthpreview = 195;
    static public $maxheightpreview = 195;
    static public $maxwidthfull = 665;
    static public $maxheightfull = 416;

    static function getImageSize($address, $maxwidthpreview='', $maxheightpreview='', $maxwidthfull='',$maxheightfull='' ) {
        if($maxwidthpreview!='') {
            self::$maxwidthpreview = $maxwidthpreview;
            self::$maxheightpreview = $maxheightpreview;
            self::$maxwidthfull = $maxwidthfull;
            self::$maxheightfull = $maxheightfull;
        }
        $path_info = pathinfo($address);
        $ext = "." . $path_info['extension'];
        switch ($ext) {
            case '.jpg':
                $img = imagecreatefromjpeg($address);
                break;
            case '.jpeg':
                $img = imagecreatefromjpeg($address);
                break;
            case '.gif':
                $img = imagecreatefromgif($address);
                break;
            case '.png':
                $img = imagecreatefrompng($address);
                //$img = $this->imagetranstowhite($src);
                break;
            case '.':
                return false;
                break;
            default:
                if(file_exists($address)) {
                    if(imagecreatefromjpeg($address)){
                        $src = imagecreatefromjpeg($address);
                    }
                }
                break;
        }
        $width = imagesx($img);
        $height = imagesy($img);
        if ($height > $width) {
            $ratio = self::$maxheightpreview / $height;
            $newheight = round(self::$maxheightpreview);
            $newwidth = round($width * $ratio);
            $ratiofull = self::$maxheightfull / $height;
            $newheightfull = round(self::$maxheightfull);
            $newwidthfull = round($width * $ratiofull);
        } else {
            $ratio = self::$maxwidthpreview / $width;
            $newwidth = round(self::$maxwidthpreview);
            $newheight = round($height * $ratio);
            $ratiofull = self::$maxwidthfull / $width;
            $newwidthfull = round(self::$maxwidthfull);
            $newheightfull = round($height * $ratiofull);
        }

        return array(
            'newwidthfull' => $newwidthfull,
            'newheightfull' => $newheightfull,
            'newwidth' => $newwidth,
            'newheight' => $newheight,
            'width' => $width,
            'height' => $height
        );
    }

    static function uploadPhoto($image, $id_user) {
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        $directory = DOCROOT . 'uploads/' . $id_user . '/albumphoto/';
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                    ->resize(200, 200, Image::AUTO)
                    ->save($directory . $filename);
            unlink($file);
            return $filename;
        }

        return FALSE;
    }

    static function uploadEventPhoto($image, $path) {
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        $directory = DOCROOT . 'uploads/events/';
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)->resize(606, 406, Image::INVERSE)->crop(606, 406, 0, 0)
                    //->resize(200, 200, Image::AUTO)
                    ->save($directory . $filename);
            unlink($file);
            return '/uploads/events/' . $filename;
        }

        return FALSE;
    }

    static function uploadGift($image) {
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        $directory = DOCROOT . 'uploads/gift/';
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                    ->resize(200, 200, Image::AUTO)
                    ->save($directory . $filename);
            unlink($file);
            return $filename;
        }

        return FALSE;
    }

    static function uploadBadge($image) {
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        $directory = DOCROOT . 'uploads/badges/';
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                    ->resize(200, 200, Image::AUTO)
                    ->save($directory . $filename);
            unlink($file);
            return $filename;
        }

        return FALSE;
    }

    static function makeUserDir($id_user) {
        $directory = DOCROOT . 'uploads/' . $id_user . '/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
    }

    static function makeGiftDir() {
        $directory = DOCROOT . 'uploads/gift/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
    }

    static function makeBadgeDir() {
        $directory = DOCROOT . 'uploads/badges/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
    }

    static function makeAlbumDir($id_user) {
        $directory = DOCROOT . 'uploads/' . $id_user . '/albumphoto/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
    }

    static function generateFinalPath($user_id, $image) {
        return '/uploads/' . $user_id . '/albumphoto/' . $image;
    }

    static function generateFinalPathGift($path) {
        return '/uploads/gift/' . $path;
    }

    static function generateFinalPathBadge($path) {
        return '/uploads/badges/' . $path;
    }

    static function uploadConcertPhoto($image, $path) {
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        $directory = DOCROOT . 'uploads/concerts/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                    ->save($directory . $filename);
            unlink($file);
            return '/uploads/concerts/' . $filename;
        }

        return FALSE;
    }

    static function generateImageThumbConcert($image) {
        $directory = DOCROOT . 'uploads/concerts/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
        Image::factory('.' . $image)->resize(240, 230, Image::INVERSE)->crop(240, 230, 0, 0)
                ->save($directory . $filename);
        return '/uploads/concerts/' . $filename;
    }

    static function generateImageThumbPhotos($image) {        
        $directory = DOCROOT . 'uploads/concerts/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
        Image::factory('.' . $image)->resize(120, 120, Image::INVERSE)->crop(120, 120, 0, 0)
                ->save($directory . $filename);
        
        return '/uploads/concerts/' . $filename;
    }

    static function saveInfoImage($image) {
        $image = $image['image'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/information/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);
            return '/uploads/information/' . $filename;
        }
        return FALSE;
    }

    static function saveMassageImage($image) {
        $image = $image['image'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/massages/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);
            return '/uploads/massages/' . $filename;
        }
        return FALSE;
    }


    static function saveCertificateImage($image) {
        $image = $image['image'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/certificates/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);
            return '/uploads/certificates/' . $filename;
        }
        return FALSE;
    }

    static function saveGradeImage($image) {
        $image = $image['image'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/grades/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);
            return '/uploads/grades/' . $filename;
        }
        return FALSE;
    }

    static function saveNewCatalogImage($image) {
        $image = $image['uploadfile'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/catalogimages/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);
            $image = ORM::factory('images');
            $image->path = '/uploads/catalogimages/' . $filename;
            $image->type = 'catalog';
            $saving = $image->save();
            return $saving->id_image.'~'.'/uploads/catalogimages/' . $filename;
        }
        return FALSE;
    }

    static function saveNewInstructionImage($image, $id_product) {
        $image = $image['instruction'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif','pdf','doc','docx'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/instructions/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            //$filename = strtolower(Text::random('alnum', 20)) . '.jpg';
//            Image::factory($file)
//                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
//                ->save($directory . $filename);
//            unlink($file);

            $image = ORM::factory('images');
            $image->path = str_replace(DOCROOT, '', $file);
            $image->type = 'catalog';
            $saving = $image->save();
            $product = ORM::factory('catalog')->where('id','=',$id_product)->find();
            $product->instruction = str_replace(DOCROOT, '', $file);
            $product->save();
            return true;
        }
        return FALSE;
    }

    static function saveNewSchemeImage($image, $id_product) {
        $image = $image['scheme'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif', 'pdf','doc','docx'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/scheme/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
//            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
//            Image::factory($file)
//                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
//                ->save($directory . $filename);
//            unlink($file);
            $image = ORM::factory('images');
            $image->path = str_replace(DOCROOT, '', $file);
            $image->type = 'catalog';
            $saving = $image->save();
            $product = ORM::factory('catalog')->where('id','=',$id_product)->find();
            $product->scheme = str_replace(DOCROOT, '', $file);
            $product->save();
            return true;

        }
        return FALSE;
    }

    static function saveProductscatImage($image, $id_product) {
        $image = $image['image'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/grades/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                //->resize(484, 465, Image::INVERSE)->crop(484, 465, 0, 0)
                ->save($directory . $filename);
            unlink($file);

            $product = ORM::factory('productscat')->where('id','=',$id_product)->find();
            $product->image = '/uploads/grades/' . $filename;
            $product->save();
            return '/uploads/grades/' . $filename;
        }
        return FALSE;
    }

    static function saveNewMassageImage($image) {
        $image = $image['uploadfile'];
        if (
            !Upload::valid($image) OR
            !Upload::not_empty($image) OR
            !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }

        $directory = DOCROOT . 'uploads/massageimages/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777);
        }
        if ($file = Upload::save($image, NULL, $directory)) {
            $filename = strtolower(Text::random('alnum', 20)) . '.jpg';
            Image::factory($file)
                ->save($directory . $filename);
            unlink($file);
            $image = ORM::factory('images');
            $image->path = '/uploads/massageimages/' . $filename;
            $image->type = 'catalog';
            $saving = $image->save();
            return $saving->id_image.'~'.'/uploads/massageimages/' . $filename;
        }
        return FALSE;
    }



}

?>
