<?php

namespace Application\Model;

use Application\Model\HcObj;

class Score extends HcObj {
    protected $score_id;
    protected $partie_id;
    protected $equipe_joueur_id;
    protected $tour;
    protected $score;

    private $data = array();

    // GETTER
    public function getScore_id() {
        return $this->score_id;
    }
    public function getPartie_id() {
        return $this->partie_id;
    }
    public function getEquipe_joueur_id() {
        return $this->equipe_joueur_id;
    }
    public function getTour() {
        return $this->tour;
    }
    public function getScore() {
        return $this->Score;
    }

    // SETTER
    public function setScore_id($value) {
        $this->score_id = $value;
    }
    public function setPartie_id($value) {
        $this->partie_id = $value;
    }
    public function setEquipe_joueur_id($value) {
        $this->equipe_joueur_id = $value;
    }
    public function setTour($value) {
        $this->tour = $value;
    }
    public function setScore($value) {
        $this->score = $value;
    }
    
    public function initFromJson($jsonData)
    {
        $this->score_id = $jsonData->score_id;
        $this->partie_id = $jsonData->partie_id;
        $this->equipe_joueur_id = $jsonData->equipe_joueur_id;
        $this->tour = $jsonData->tour;
        $this->score = $jsonData->score;
    }

    public function getDataArray($bScoreId = false)
    {
        if($bScoreId) {
            $this->data["score_id"] = $this->__get("score_id");
        }
        
        $this->data["partie_id"] = $this->__get("partie_id");
        $this->data["equipe_joueur_id"] = $this->__get("equipe_joueur_id");
        $this->data["tour"] = $this->__get("tour");
        $this->data["score"] = $this->__get("score");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->score_id     = !empty($data['score_id']) ? $data['score_id'] : null;
        $this->partie_id = !empty($data['partie_id']) ? $data['partie_id'] : null;
        $this->equipe_joueur_id = !empty($data['equipe_joueur_id']) ? $data['equipe_joueur_id'] : null;
        $this->tour = !empty($data['tour']) ? $data['tour'] : null;
        $this->score = !empty($data['score']) ? $data['score'] : null;
    }
}