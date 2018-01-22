<?php

namespace Application\Model;

use Application\Model\HcObj;

class Equipe extends HcObj {
    protected $equipe_id;
    protected $partie_id;
    protected $numero;

    private $data = array();

    // GETTER
    public function getEquipe_id() {
        return $this->equipe_id;
    }
    public function getPartie_id() {
        return $this->partie_id;
    }
    public function getNumero() {
        return $this->numero;
    }

    // SETTER
    public function setEquipe_id($value) {
        $this->equipe_id = $value;
    }
    public function setPartie_id($value) {
        $this->partie_id = $value;
    }
    public function setNumero($value) {
        $this->numero = $value;
    }

    public function initFromJson($jsonData)
    {
        $this->partie_id = $jsonData->partie_id;
        $this->numero = $jsonData->numero;
        $this->starship_class = $jsonData->starship_class;
    }

    public function getDataArray($bEquipeId = false)
    {
        if($bEquipeId) {
            $this->data["equipe_id"] = $this->__get("equipe_id");
        }
        
        $this->data["partie_id"] = $this->__get("partie_id");
        $this->data["numero"] = $this->__get("numero");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->equipe_id     = !empty($data['equipe_id']) ? $data['equipe_id'] : null;
        $this->partie_id = !empty($data['partie_id']) ? $data['partie_id'] : null;
        $this->numero = !empty($data['numero']) ? $data['numero'] : null;
    }
}