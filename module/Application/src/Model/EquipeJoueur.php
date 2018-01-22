<?php

namespace Application\Model;

use Application\Model\HcObj;

class EquipeJoueur extends HcObj {
    protected $equipe_joueur_id;
    protected $equipe_id;
    protected $joueur_id;
    protected $position;

    private $data = array();

    // GETTER
    public function getEquipe_joueur_id() {
        return $this->equipe_joueur_id;
    }
    public function getEquipe_id() {
        return $this->equipe_id;
    }
    public function getJoueur_id() {
        return $this->joueur_id;
    }
    public function getPosition() {
        return $this->position;
    }

    // SETTER
    public function setEquipe_joueur_id($value) {
        $this->equipe_joueur_id = $value;
    }
    public function setEquipe_id($value) {
        $this->equipe_id = $value;
    }
    public function setJoueur_id($value) {
        $this->joueur_id = $value;
    }
    public function setPosition($value) {
        $this->position = $value;
    }

    public function initFromJson($jsonData)
    {
        $this->partie_id = $jsonData->partie_id;
        $this->equipe_id = $jsonData->equipe_id;
        $this->joueur_id = $jsonData->joueur_id;
        $this->position = $jsonData->position;
    }

    public function getDataArray($bEquipeJoueurId = false)
    {
        if($bEquipeJoueurId) {
            $this->data["equipe_joueur_id"] = $this->__get("equipe_joueur_id");
        }
        
        $this->data["equipe_id"] = $this->__get("equipe_id");
        $this->data["joueur_id"] = $this->__get("joueur_id");
        $this->data["position"] = $this->__get("position");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->equipe_joueur_id     = !empty($data['equipe_joueur_id']) ? $data['equipe_joueur_id'] : null;
        $this->equipe_id = !empty($data['equipe_id']) ? $data['equipe_id'] : null;
        $this->joueur_id = !empty($data['joueur_id']) ? $data['joueur_id'] : null;
        $this->position = !empty($data['position']) ? $data['position'] : null;
    }
}