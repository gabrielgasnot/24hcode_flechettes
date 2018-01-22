<?php

namespace Application\Model;

use Application\Model\HcObj;

class PartieType extends HcObj {
    protected $partietype_id;
    protected $type;

    private $data = array();

    // GETTER
    public function getPartieType_id() {
        return $this->partietype_id;
    }
    public function getType() {
        return $this->type;
    }

    // SETTER
    public function setPartieType_id($value) {
        $this->partietype_id = $value;
    }
    public function setType($value) {
        $this->type = $value;
    }
    
    public function initFromJson($jsonData)
    {
        $this->partietype_id = $jsonData->partietype_id;
        $this->type = $jsonData->type;
    }

    public function getDataArray($bPartieTypeId = false)
    {
        if($bPartieTypeId) {
            $this->data["partietype_id"] = $this->__get("partietype_id");
        }
        
        $this->data["type"] = $this->__get("type");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->partietype_id     = !empty($data['partietype_id']) ? $data['partietype_id'] : null;
        $this->type = !empty($data['type']) ? $data['type'] : null;
    }
}