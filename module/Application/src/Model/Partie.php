<?php

namespace Application\Model;

use Application\Model\HcObj;

class Partie extends HcObj {
    protected $partie_id;
    protected $date;
    protected $en_cours;
    protected $partie_type_id;

    private $data = array();

    // GETTER
    public function getPartie_id() {
        return $this->partie_id;
    }
    public function getDate() {
        return $this->date;
    }
    public function getEn_cours() {
        return $this->en_cours;
    }
    public function getPartie_type_id() {
        return $this->partie_type_id;
    }

    // SETTER
    public function setPartie_id($value) {
        $this->partie_id = $value;
    }
    public function setDate($value) {
        $this->date = $value;
    }
    public function setEn_cours($value) {
        $this->en_cours = $value;
    }
    public function setPartie_type_id($value) {
        $this->partie_type_id = $value;
    }
    
    public function initFromJson($jsonData)
    {
        $this->partie_id = $jsonData->partie_id;
        $this->date = $jsonData->date;
        $this->en_cours = $jsonData->en_cours;
        $this->partie_type_id = $jsonData->partie_type_id;
    }

    public function getDataArray($bPartieId = false)
    {
        if($bPartieId) {
            $this->data["partie_id"] = $this->__get("partie_id");
        }
        
        $this->data["date"] = $this->__get("date");
        $this->data["en_cours"] = $this->__get("en_cours");
        $this->data["partie_type_id"] = $this->__get("partie_type_id");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->partie_id     = !empty($data['partie_id']) ? $data['partie_id'] : null;
        $this->date = !empty($data['date']) ? $data['date'] : null;
        $this->en_cours = !empty($data['en_cours']) ? $data['en_cours'] : null;
        $this->partie_type_id = !empty($data['partie_type_id']) ? $data['partie_type_id'] : null;
    }
}