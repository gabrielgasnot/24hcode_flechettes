<?php

namespace Application\Model;

use Application\Model\HcObj;

class Flechetteresultats extends HcObj {
    protected $equipe_partie_id;
    protected $equipe_equipe_id;
    protected $equipe_numero;
    protected $equipejoueur_equipe_joueur_id;
    protected $equipejoueur_equipe_id;
    protected $equipejoueur_joueur_id;
    protected $equipejoueur_position;
    protected $joueur_joueur_id;
    protected $joueur_nom;
    protected $joueur_prenom;
    protected $partie_partie_id;
    protected $partie_date;
    protected $partie_en_cours;
    protected $partie_partie_type_id;
    protected $partietype_partie_type_id;
    protected $partietype_type;
    protected $score_score_id;
    protected $score_partie_id;
    protected $score_equipe_joueur_id;
    protected $score_tour;
    protected $score_score;


    private $data = array();

    // GETTER
    public function getEquipe_partie_id() {
       return $this->equipe_partie_id;
    }
    public function getEquipe_equipe_id() {
       return $this->equipe_equipe_id;
    }
    public function getEquipe_numero() {
       return $this->equipe_numero;
    }
    public function getEquipejoueur_equipe_joueur_id() {
       return $this->equipejoueur_equipe_joueur_id;
    }
    public function getEquipejoueur_equipe_id() {
       return $this->equipejoueur_equipe_id;
    }
    public function getEquipejoueur_joueur_id() {
       return $this->equipejoueur_joueur_id;
    }
    public function getEquipejoueur_position() {
       return $this->equipejoueur_position;
    }
    public function getJoueur_joueur_id() {
       return $this->joueur_joueur_id;
    }
    public function getJoueur_nom() {
       return $this->joueur_nom;
    }
    public function getJoueur_prenom() {
       return $this->joueur_prenom;
    }
    public function getPartie_partie_id() {
       return $this->partie_partie_id;
    }
    public function getPartie_date() {
       return $this->partie_date;
    }
    public function getPartie_en_cours() {
       return $this->partie_en_cours;
    }
    public function getPartie_partie_type_id() {
       return $this->partie_partie_type_id;
    }
    public function getPartietype_partie_type_id() {
       return $this->partietype_partie_type_id;
    }
    public function getPartietype_type() {
       return $this->partietype_type;
    }
    public function getScore_score_id() {
       return $this->score_score_id;
    }
    public function getScore_partie_id() {
       return $this->score_partie_id;
    }
    public function getScore_equipe_joueur_id() {
       return $this->score_equipe_joueur_id;
    }
    public function getScore_tour() {
       return $this->score_tour;
    }
    public function getScore_score() {
       return $this->score_score;
    }

    // SETTER
    public function setEquipe_partie_id($value) {
        $this->equipe_partie_id = $value;
    }
    public function setEquipe_equipe_id($value) {
        $this->equipe_equipe_id = $value;
    }
    public function setEquipe_numero($value) {
        $this->equipe_numero = $value;
    }
    public function setEquipejoueur_equipe_joueur_id($value) {
        $this->equipejoueur_equipe_joueur_id = $value;
    }
    public function setEquipejoueur_equipe_id($value) {
        $this->equipejoueur_equipe_id = $value;
    }
    public function setEquipejoueur_joueur_id($value) {
        $this->equipejoueur_joueur_id = $value;
    }
    public function setEquipejoueur_position($value) {
        $this->equipejoueur_position = $value;
    }
    public function setJoueur_joueur_id($value) {
        $this->joueur_joueur_id = $value;
    }
    public function setJoueur_nom($value) {
        $this->joueur_nom = $value;
    }
    public function setJoueur_prenom($value) {
        $this->joueur_prenom = $value;
    }
    public function setPartie_partie_id($value) {
        $this->partie_partie_id = $value;
    }
    public function setPartie_date($value) {
        $this->partie_date = $value;
    }
    public function setPartie_en_cours($value) {
        $this->partie_en_cours = $value;
    }
    public function setPartie_partie_type_id($value) {
        $this->partie_partie_type_id = $value;
    }
    public function setPartietype_partie_type_id($value) {
        $this->partietype_partie_type_id = $value;
    }
    public function setPartietype_type($value) {
        $this->partietype_type = $value;
    }
    public function setScore_score_id($value) {
        $this->score_score_id = $value;
    }
    public function setScore_partie_id($value) {
        $this->score_partie_id = $value;
    }
    public function setScore_equipe_joueur_id($value) {
        $this->score_equipe_joueur_id = $value;
    }
    public function setScore_tour($value) {
        $this->score_tour = $value;
    }
    public function setScore_score($value) {
        $this->score_score = $value;
    }
    
    public function initFromJson($jsonData)
    {
        $this->equipe_partie_id = $jsonData->equipe_partie_id;
        $this->equipe_equipe_id = $jsonData->equipe_equipe_id;
        $this->equipe_numero = $jsonData->equipe_numero;
        $this->equipejoueur_equipe_joueur_id = $jsonData->equipejoueur_equipe_joueur_id;
        $this->equipejoueur_equipe_id = $jsonData->equipejoueur_equipe_id;
        $this->equipejoueur_joueur_id = $jsonData->equipejoueur_joueur_id;
        $this->equipejoueur_position = $jsonData->equipejoueur_position;
        $this->joueur_joueur_id = $jsonData->joueur_joueur_id;
        $this->joueur_nom = $jsonData->joueur_nom;
        $this->joueur_prenom = $jsonData->joueur_prenom;
        $this->partie_partie_id = $jsonData->partie_partie_id;
        $this->partie_date = $jsonData->partie_date;
        $this->partie_en_cours = $jsonData->partie_en_cours;
        $this->partie_partie_type_id = $jsonData->partie_partie_type_id;
        $this->partietype_partie_type_id = $jsonData->partietype_partie_type_id;
        $this->partietype_type = $jsonData->partietype_type;
        $this->score_score_id = $jsonData->score_score_id;
        $this->score_partie_id = $jsonData->score_partie_id;
        $this->score_equipe_joueur_id = $jsonData->score_equipe_joueur_id;
        $this->score_tour = $jsonData->score_tour;
        $this->score_score = $jsonData->score_score;
    }

    public function getDataArray($bFlechetteresultatsId = false)
    {
        $this->data["equipe_partie_id"] = $this->__get("equipe_partie_id");
        $this->data["equipe_equipe_id"] = $this->__get("equipe_equipe_id");
        $this->data["equipe_numero"] = $this->__get("equipe_numero");
        $this->data["equipejoueur_equipe_joueur_id"] = $this->__get("equipejoueur_equipe_joueur_id");
        $this->data["equipejoueur_equipe_id"] = $this->__get("equipejoueur_equipe_id");
        $this->data["equipejoueur_joueur_id"] = $this->__get("equipejoueur_joueur_id");
        $this->data["equipejoueur_position"] = $this->__get("equipejoueur_position");
        $this->data["joueur_joueur_id"] = $this->__get("joueur_joueur_id");
        $this->data["joueur_nom"] = $this->__get("joueur_nom");
        $this->data["joueur_prenom"] = $this->__get("joueur_prenom");
        $this->data["partie_partie_id"] = $this->__get("partie_partie_id");
        $this->data["partie_date"] = $this->__get("partie_date");
        $this->data["partie_en_cours"] = $this->__get("partie_en_cours");
        $this->data["partie_partie_type_id"] = $this->__get("partie_partie_type_id");
        $this->data["partietype_partie_type_id"] = $this->__get("partietype_partie_type_id");
        $this->data["partietype_type"] = $this->__get("partietype_type");
        $this->data["score_score_id"] = $this->__get("score_score_id");
        $this->data["score_partie_id"] = $this->__get("score_partie_id");
        $this->data["score_equipe_joueur_id"] = $this->__get("score_equipe_joueur_id");
        $this->data["score_tour"] = $this->__get("score_tour");
        $this->data["score_score"] = $this->__get("score_score");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->equipe_partie_id     = !empty($data['equipe_partie_id']) ? $data['equipe_partie_id'] : null;
        $this->equipe_equipe_id     = !empty($data['equipe_equipe_id']) ? $data['equipe_equipe_id'] : null;
        $this->equipe_numero     = !empty($data['equipe_numero']) ? $data['equipe_numero'] : null;
        $this->equipejoueur_equipe_joueur_id     = !empty($data['equipejoueur_equipe_joueur_id']) ? $data['equipejoueur_equipe_joueur_id'] : null;
        $this->equipejoueur_equipe_id     = !empty($data['equipejoueur_equipe_id']) ? $data['equipejoueur_equipe_id'] : null;
        $this->equipejoueur_joueur_id     = !empty($data['equipejoueur_joueur_id']) ? $data['equipejoueur_joueur_id'] : null;
        $this->equipejoueur_position     = !empty($data['equipejoueur_position']) ? $data['equipejoueur_position'] : null;
        $this->joueur_joueur_id     = !empty($data['joueur_joueur_id']) ? $data['joueur_joueur_id'] : null;
        $this->joueur_nom     = !empty($data['joueur_nom']) ? $data['joueur_nom'] : null;
        $this->joueur_prenom     = !empty($data['joueur_prenom']) ? $data['joueur_prenom'] : null;
        $this->partie_partie_id     = !empty($data['partie_partie_id']) ? $data['partie_partie_id'] : null;
        $this->partie_date     = !empty($data['partie_date']) ? $data['partie_date'] : null;
        $this->partie_en_cours     = !empty($data['partie_en_cours']) ? $data['partie_en_cours'] : null;
        $this->partie_partie_type_id     = !empty($data['partie_partie_type_id']) ? $data['partie_partie_type_id'] : null;
        $this->partietype_partie_type_id     = !empty($data['partietype_partie_type_id']) ? $data['partietype_partie_type_id'] : null;
        $this->partietype_type     = !empty($data['partietype_type']) ? $data['partietype_type'] : null;
        $this->score_score_id     = !empty($data['score_score_id']) ? $data['score_score_id'] : null;
        $this->score_partie_id     = !empty($data['score_partie_id']) ? $data['score_partie_id'] : null;
        $this->score_equipe_joueur_id     = !empty($data['score_equipe_joueur_id']) ? $data['score_equipe_joueur_id'] : null;
        $this->score_tour     = !empty($data['score_tour']) ? $data['score_tour'] : null;
        $this->score_score     = !empty($data['score_score']) ? $data['score_score'] : null;
    }
}