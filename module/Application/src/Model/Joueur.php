<?php

namespace Application\Model;

use Application\Model\HcObj;

class Joueur extends HcObj {
    protected $joueur_id;
    protected $nom;
    protected $prenom;

    private $data = array();

    // GETTER
    public function getJoueur_id() {
        return $this->joueur_id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }

    // SETTER
    public function setJoueur_id($value) {
        $this->joueur_id = $value;
    }
    public function setNom($value) {
        $this->nom = $value;
    }
    public function setPrenom($value) {
        $this->prenom = $value;
    }

    public function initFromJson($jsonData)
    {
        $this->partie_id = $jsonData->partie_id;
        $this->nom = $jsonData->nom;
        $this->prenom = $jsonData->prenom;
    }

    public function getDataArray($bJoueurId = false)
    {
        if($bJoueurId) {
            $this->data["joueur_id"] = $this->__get("joueur_id");
        }
        
        $this->data["nom"] = $this->__get("nom");
        $this->data["prenom"] = $this->__get("prenom");

        return $this->data;
    }


    public function exchangeArray(array $data)
    {
        $this->joueur_id     = !empty($data['joueur_id']) ? $data['joueur_id'] : null;
        $this->nom = !empty($data['nom']) ? $data['nom'] : null;
        $this->prenom = !empty($data['prenom']) ? $data['prenom'] : null;
    }
}