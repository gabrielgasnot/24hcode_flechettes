<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Ghunti\HighchartsPHP\Highchart;
use Ghunti\HighchartsPHP\HighchartJsExpr;
use Ghunti\HighchartsPHP\HighchartOption;
use Ghunti\HighchartsPHP\HighchartOptionRenderer;


class IndexController extends AbstractActionController
{
    
private $_db;
private $_activeCurl = true;

  public function __construct($dbAdapter)  
  {
      $this->_db = $dbAdapter;
  }
    public function indexAction()
    {
        
        // recherche de la dernière partie en cours
        $sql = "SELECT * FROM partie WHERE en_cours = 1 ORDER BY date DESC";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $lastPartieId = 0;
        if(!is_null($myPartie)) {
            $lastPartieId = $myPartie['partie_id'];
        }

        $this->partieAction($lastPartieId);
        
        echo '<pre>';
        var_dump($lastPartieId);
        echo '</pre>';
exit;

$sql = "SELECT * FROM score";
$statement = $this->_db->query($sql);
$rs = $statement->execute();

$arr = array();
while($rs->next()) {
    $arr[] = $rs->current();
}
echo '<pre>';
var_dump($arr);
echo '</pre>';
        
exit;
        
//        return new ViewModel([
//            'flechetteresultats' => $this->table->fetchAll(),
//        ]);




        return new ViewModel();
    }
    
    public function partieAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        // recherche de la dernière partie en cours
        $sql = "SELECT * FROM partie WHERE partie_id = $id";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $lastStatut = 0;
        $newStatut = 0;
        if(!is_null($myPartie)) {
            $lastStatut = $myPartie['lancer_actif'];
            $newStatut = $lastStatut == 0 ? 1 : 0;
        }
        
        // recherche de la dernière partie en cours
        $sql = "SELECT 
    e.equipe_id equipe_equipe_id,
    e.partie_id equipe_partie_id,
    e.numero equipe_numero,

    ej.equipe_joueur_id equipejoueur_equipe_joueur_id,
    ej.equipe_id equipejoueur_equipe_id,
    ej.joueur_id equipejoueur_joueur_id,
    ej.position equipejoueur_position,

    j.joueur_id joueur_joueur_id,
    j.nom joueur_nom,
    j.prenom joueur_prenom,

    p.partie_id partie_partie_id,
    p.date partie_date,
    p.en_cours partie_en_cours,
    p.partie_type_id partie_partie_type_id,

    pt.partie_type_id partietype_partie_type_id,
    pt.type partietype_type,

    s.score_id score_score_id,
    s.partie_id score_partie_id,
    s.equipe_joueur_id score_equipe_joueur_id,
    s.tour score_tour,
    s.score score_score,
    s.points score_points

FROM partie p
INNER JOIN equipe e ON p.partie_id = e.partie_id
INNER JOIN equipejoueur ej ON ej.equipe_id = e.equipe_id
INNER JOIN joueur j ON j.joueur_id = ej.joueur_id
INNER JOIN partietype pt ON pt.partie_type_id = p.partie_type_id
INNER JOIN score s ON p.partie_id = s.partie_id AND s.equipe_joueur_id = ej.equipe_joueur_id
WHERE p.partie_id = $id
ORDER BY joueur_nom, joueur_prenom,score_tour";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        
        
        $chart = new Highchart(Highchart::HIGHCHART);

        $chart->chart = array(
            'renderTo' => 'container',
            'type' => 'column',
            'marginRight' => 130,
            'marginBottom' => 25
        );

        $chart->title = array(
            'text' => 'Nombre de points par coup',
            'x' => - 20
        );

        $chart->includeExtraScripts();

        $chart->xAxis->categories = array(
            'Tour 1',
            'Tour 2',
            'Tour 3',
            'Tour 4',
            'Tour 5',
            'Tour 6',
            'Tour 7',
            'Tour 8',
            'Tour 9',
            'Tour 10',
        );

        $chart->yAxis = array(
            'title' => array(
                'text' => 'Total des point par tour'
            ),
            'plotLines' => array(
                array(
                    'value' => 0,
                    'width' => 1,
                    'color' => '#808080'
                )
            )
        );
        $chart->legend = array(
            'layout' => 'vertical',
            'align' => 'right',
            'verticalAlign' => 'top',
            'x' => - 10,
            'y' => 100,
            'borderWidth' => 0
        );
        
        
        
        $chart2 = new Highchart(Highchart::HIGHCHART);

        $chart2->chart = array(
            'renderTo' => 'container2',
            'type' => 'line',
            'marginRight' => 130,
            'marginBottom' => 25
        );

        $chart2->title = array(
            'text' => 'Nombre de points par coup',
            'x' => - 20
        );

        $chart2->includeExtraScripts();

        $chart2->xAxis->categories = array(
            'Tour 1',
            'Tour 2',
            'Tour 3',
            'Tour 4',
            'Tour 5',
            'Tour 6',
            'Tour 7',
            'Tour 8',
            'Tour 9',
            'Tour 10',
        );

        $chart2->yAxis = array(
            'title' => array(
                'text' => 'Total des point par tour'
            ),
            'plotLines' => array(
                array(
                    'value' => 0,
                    'width' => 1,
                    'color' => '#808080'
                )
            )
        );
        $chart2->legend = array(
            'layout' => 'vertical',
            'align' => 'right',
            'verticalAlign' => 'top',
            'x' => - 10,
            'y' => 100,
            'borderWidth' => 0
        );
        
        
        $arr = array();
        $tableau_resultat = array();
        $partie_statut = '';
        while($rs->next()) {
            $arr[] = $rs->current();
            if(!isset($tableau_resultat[$rs->current()['joueur_joueur_id']])) {
                $tableau_resultat[$rs->current()['joueur_joueur_id']] = array_fill(1, 10, '');
            }
            $tableau_resultat[$rs->current()['joueur_joueur_id']]['nom'] = utf8_encode($rs->current()['joueur_nom']).' '.utf8_encode($rs->current()['joueur_prenom']);
            $tableau_resultat[$rs->current()['joueur_joueur_id']][$rs->current()['score_tour']] = array('score'  => $rs->current()['score_score'],
                                                                                                        'points' => $rs->current()['score_points'],);
            $partie_statut = $rs->current()['partie_en_cours'] == 1 ? 'en cours' : 'terminée';
            
        }
        foreach($tableau_resultat AS $value) {
        
            
            $chart->series[] = array(
                'name' => $value['nom'],
                'data' => array(
                    ($value[1]['score'] != '' ? intval($value[1]['score']) : ''),
                    ($value[2]['score'] != '' ? intval($value[2]['score']) : ''),
                    ($value[3]['score'] != '' ? intval($value[3]['score']) : ''),
                    ($value[4]['score'] != '' ? intval($value[4]['score']) : ''),
                    ($value[5]['score'] != '' ? intval($value[5]['score']) : ''),
                    ($value[6]['score'] != '' ? intval($value[6]['score']) : ''),
                    ($value[7]['score'] != '' ? intval($value[7]['score']) : ''),
                    ($value[8]['score'] != '' ? intval($value[8]['score']) : ''),
                    ($value[9]['score'] != '' ? intval($value[9]['score']) : ''),
                    ($value[10]['score'] != '' ? intval($value[10]['score']) : ''),
                )
            );
            
            $chart2->series[] = array(
                'name' => $value['nom'],
                'data' => array(
                    ($value[1]['score'] != '' ? intval($value[1]['score']) : ''),
                    ($value[2]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) : ''),
                    ($value[3]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) : ''),
                    ($value[4]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) : ''),
                    ($value[5]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) : ''),
                    ($value[6]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) + intval($value[6]['score']) : ''),
                    ($value[7]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) + intval($value[6]['score']) + intval($value[7]['score']) : ''),
                    ($value[8]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) + intval($value[6]['score']) + intval($value[7]['score']) + intval($value[8]['score']) : ''),
                    ($value[9]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) + intval($value[6]['score']) + intval($value[7]['score']) + intval($value[8]['score']) + intval($value[9]['score']) : ''),
                    ($value[10]['score'] != '' ? intval($value[1]['score']) + intval($value[2]['score']) + intval($value[3]['score']) + intval($value[4]['score']) + intval($value[5]['score']) + intval($value[6]['score']) + intval($value[7]['score']) + intval($value[8]['score']) + intval($value[9]['score']) + intval($value[10]['score']) : ''),
                )
            );

        }
        
        $chart->tooltip->formatter = new HighchartJsExpr(
            "function() {
            this.y
            if(this.y>1){
                point_text = ' points';
            } else{
                point_text = ' point';
            }

                return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y + point_text;
            }");
        $chart2->tooltip->formatter = new HighchartJsExpr(
            "function() {
            this.y
            if(this.y>1){
                point_text = ' points';
            } else{
                point_text = ' point';
            }

                return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y + point_text;
            }");

        return [
            'tableau_resultat' => $tableau_resultat,
            'partie_statut' => $partie_statut,
            "myChart" => $chart->render("sct_container"),
            "myChart2" => $chart2->render("sct_container"),
            'id_partie' => $id,
            'statutLancer' => $lastStatut == 1 ? 'Stopper Lancer' : 'Activer Lancer',
        ];
    }
    
    public function encoursAction() {
       
        
        // recherche de la dernière partie en cours
        $sql = "SELECT * FROM partie WHERE en_cours = 1 ORDER BY date DESC";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $lastPartieId = 0;
        if(!is_null($myPartie)) {
            $lastPartieId = $myPartie['partie_id'];
        }

        return $this->redirect()->toUrl('/partie/partie/'.$lastPartieId);
        
    }
    
    public function listeAction() {
        
        // recherche de la dernière partie en cours
        $sql = "SELECT DATE_FORMAT(date, '%d-%m-%Y %H:%i:%s') AS date, CASE WHEN en_cours = 1 THEN 'En cours' ELSE 'Terminée' END AS en_cours, partie_id FROM partie ORDER BY date DESC LIMIT 0,10";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $arr = array();
        while($rs->next()) {
            $arr[] = $rs->current();
        }
       
        return new ViewModel([
            'ancienne_partie' => $arr,
        ]);

    }
    
    public function nouvelleAction() {
        
        $request = $this->getRequest();

        // recherche de la liste des utilisateurs
// recherche de la dernière partie en cours
        $sql = "SELECT joueur_id, nom, prenom
FROM joueur
ORDER BY nom, prenom";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $arr = array();
        while($rs->next()) {
            $arr[] = array('id' => $rs->current()['joueur_id'], 
                           'nom' => utf8_encode($rs->current()['nom']).' '.utf8_encode($rs->current()['prenom']),
                           'radioOui' => (! $request->isPost()) ? ' checked' : (!is_null($this->getRequest()->getPost('joueur_'.$rs->current()['joueur_id'], null)) ? ' checked' : ''),
                           'radioNon' => (! $request->isPost()) ? ' ' : ($this->getRequest()->getPost('joueur_'.$rs->current()['joueur_id'], null) == 0 ? ' checked' : ''),
                        );
        }
        
        if (! $request->isPost()) {
            return ['joueurs' => $arr];
        }
        else {
            // je ferme les précédentes parties
            $sql = "UPDATE partie SET en_cours = 0";
            $statement = $this->_db->query($sql);
            $rs = $statement->execute();
            // ajout d'une nouvelle partie
            $sql = "INSERT INTO partie (date, en_cours, partie_type_id) VALUES (NOW(), 1, 1)";
            $statement = $this->_db->query($sql);
            $rs = $statement->execute();
            // récupération de l'id
            $sql = "SELECT * FROM partie WHERE en_cours = 1 ORDER BY date DESC";
            $statement = $this->_db->query($sql);
            $rs = $statement->execute();

            $myPartie = $rs->current();
            $lastPartieId = 0;
            if(!is_null($myPartie)) {
                $lastPartieId = $myPartie['partie_id'];
            }
            // ajout dans la table equipe
            $sql = "INSERT INTO equipe (partie_id, numero) VALUES ($lastPartieId, 1)";
            $statement = $this->_db->query($sql);
            $rs = $statement->execute();
            // récupération de l'id
            $sql = "SELECT * FROM equipe WHERE partie_id = $lastPartieId";
            $statement = $this->_db->query($sql);
            $rs = $statement->execute();

            $myEquipe = $rs->current();
            $lastEquipeId = 0;
            if(!is_null($myEquipe)) {
                $lastEquipeId = $myEquipe['equipe_id'];
            }
            // ajout des joueurs
            $joueurPosition = 1;
            foreach($arr AS $value) {
                if(!is_null($this->getRequest()->getPost('joueur_'.$value['id'], null)) && $this->getRequest()->getPost('joueur_'.$value['id'], null) != 0) {
                    $leJoueur = $value['id'];
                    $sql = "INSERT INTO equipejoueur (equipe_id, joueur_id, position) VALUES ($lastEquipeId, $leJoueur, $joueurPosition)";
                    $statement = $this->_db->query($sql);
                    $rs = $statement->execute();
                    $joueurPosition++;
                    
                    if($this->_activeCurl) {
                        $sql = "SELECT joueur_id, nom, prenom
    FROM joueur
    WHERE joueur_id = $leJoueur";
                        $statement = $this->_db->query($sql);
                        $rs = $statement->execute();

                        $myEquipe = $rs->current();
                        $leJoueurNom = '';
                        if(!is_null($myEquipe)) {
                            $leJoueurNom = $myEquipe['nom'];
                        }




                        $ch = curl_init();

                        if (!$ch)
                            throw new \Exception('failed to initialize');

                        $url = 'http://192.168.10.1/server-score/api/equipe?equipe='.$leJoueurNom.'-'.$lastPartieId;

                        // Config URL
                        curl_setopt($ch, CURLOPT_URL, is_null($url) ? self::SW_API_URL : $url);

                        // Pour éviter de dump la réponse directement dans la page.
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        // Si problème de certificat.
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                        curl_setopt($ch, CURLOPT_POST, 1);

                        // Récupération de l'appel curl
                        $result = curl_exec($ch);

                        // Décodage du résultat.
                        $decodedResult = json_decode($result);

                        // Fermeture de la session curl
                        curl_close($ch);
                    }
                    
                    
                }
            }
            // ajout des scores
            for($i = 1; $i <= 10; $i++) {
                $sql = "INSERT INTO score (partie_id, equipe_joueur_id, tour, score, update_done, points)
SELECT $lastPartieId, ej.equipe_joueur_id, $i, NULL, 0, ''
FROM equipejoueur ej
INNER JOIN equipe e ON ej.equipe_id = e.equipe_id
WHERE e.partie_id = $lastPartieId";
                $statement = $this->_db->query($sql);
                $rs = $statement->execute();
            }
   
            return $this->redirect()->toUrl('/partie/partie/'.$lastPartieId);
        }
    }
    


}
