<?php defined('SYSPATH') or die('No direct script access.');

class Model_Certificates extends ORM {

    protected $_table_name  = 'certificates';
    protected $_primary_key = 'id';

    public function saveCertificate($data) {
        $data['time'] = time();
        if(isset($data['featured'])) {
            $data['featured'] = 'on';
        } else {
            $data['featured'] = 'off';
        }
        return $this->values($data)->save()->id;
    }

    public function saveImage($image, $id) {
        $certificate = ORM::factory('certificates', $id);
        $certificate->image = $image;
        return $certificate->save();
    }

    public function editCertificate($data, $id) {
        $data['time'] = time();
        if(isset($data['featured'])) {
            $data['featured'] = 'on';
        } else {
            $data['featured'] = 'off';
        }
        $certificate = ORM::factory('certificates', $id);
        $certificate->description = $data['description'];
        $certificate->featured = $data['featured'];
        $certificate->save();
    }


}