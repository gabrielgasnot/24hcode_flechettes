<?php

namespace Retournejson\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
//use JpGraph\JpGraph as jpGraph;
use Ghunti\HighchartsPHP\Highchart;
use Ghunti\HighchartsPHP\HighchartJsExpr;
use Ghunti\HighchartsPHP\HighchartOption;
use Ghunti\HighchartsPHP\HighchartOptionRenderer;
use Retournejson\Model\Starship;
use Retournejson\Model\StarshipTable;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class RetournejsonController extends AbstractActionController
{
    const SW_API_URL = "https://swapi.co/api/starships/";

    // Add this property:
    private $swTable;

private $_activeCurl = true;

    
    private $_db;
  public function __construct($dbAdapter)  
  {
      $this->_db = $dbAdapter;
  }
    
    public function indexAction()
    {
/* 
        // JPGRAPH
        $yData = array(40,21,17,14,23);

        // Load modules
        jpGraph::load();
        jpGraph::module('pie');

        // Some data
        $data = array(40,21,17,14,23);

        // Create the Pie Graph.
        $graph = new \PieGraph(350,250);

        $theme_class="DefaultTheme";

        // Set A title for the plot
        $graph->title->Set("A Simple Pie Plot");
        $graph->SetBox(true);

        // Create
        $p1 = new \PiePlot($data);
        $graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
        $graph->Stroke();
        
        if(!is_dir('/Travail/24hcode-master/public/tmp')){
            mkdir('/Travail/24hcode-master/public/tmp', 0777, true);
        }
        if(file_exists('/Travail/24hcode-master/public/tmp/myimage.png')){
            unlink('/Travail/24hcode-master/public/tmp/myimage.png');
        }
 */
 
        // HIGHTCHART
        $chart = new Highchart(Highchart::HIGHCHART);

        $chart->chart = array(
            'renderTo' => 'container',
            'type' => 'line',
            'marginRight' => 130,
            'marginBottom' => 25
        );

        $chart->title = array(
            'text' => 'Monthly Average Temperature',
            'x' => - 20
        );
        $chart->subtitle = array(
            'text' => 'Source: WorldClimate.com',
            'x' => - 20
        );
        $chart->includeExtraScripts();

        $chart->xAxis->categories = array(
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        );

        $chart->yAxis = array(
            'title' => array(
                'text' => 'Temperature (°C)'
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

        $chart->series[] = array(
            'name' => 'Tokyo',
            'data' => array(
                7.0,
                6.9,
                9.5,
                14.5,
                18.2,
                21.5,
                25.2,
                26.5,
                23.3,
                18.3,
                13.9,
                9.6
            )
        );
        $chart->series[] = array(
            'name' => 'New York',
            'data' => array(
                - 0.2,
                0.8,
                5.7,
                11.3,
                17.0,
                22.0,
                24.8,
                24.1,
                20.1,
                14.1,
                8.6,
                2.5
            )
        );
        $chart->series[] = array(
            'name' => 'Berlin',
            'data' => array(
                - 0.9,
                0.6,
                3.5,
                8.4,
                13.5,
                17.0,
                18.6,
                17.9,
                14.3,
                9.0,
                3.9,
                1.0
            )
        );
        $chart->series[] = array(
            'name' => 'London',
            'data' => array(
                3.9,
                4.2,
                5.7,
                8.5,
                11.9,
                15.2,
                17.0,
                16.6,
                14.2,
                10.3,
                6.6,
                4.8
            )
        );
        
        $chart->tooltip->formatter = new HighchartJsExpr(
            "function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y +'°C';}");
        
/*
        return new ViewModel([
            "myChart" => $chart->render("sct_container"),
            "myJs"    => $chart->printScripts(true)
        ]);
*/
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data',
            'data' => [
                'full_name' => 'John Doe',
                'address' => '51 Middle st.'
            ]
        ]);
    }

    public function autoLoadStarshipsAction()
    {
        $arrStarships = array();

        // Get Starships from API
        $arr = $this->curlCallSwApi();

        // Store starships in array
        $arrStarships = array_merge($arrStarships, $arr->results);

        // Call Api while there is still datas to fetch.
        while(!is_null($arr->next))
        {
            $arr = $this->curlCallSwApi($arr->next);
            $arrStarships = array_merge($arrStarships,$arr->results);
        }
     
        // Build return array
        $arrItemStarship = array();

        foreach($arrStarships as $item)
        {
            $starShip = new Starship();
            $starShip->initFromJson($item);

            // Insert starships to database
            $this->swTable->saveStarship($starShip);

            $arrItemStarship[] = $starShip->getDataArray(true);
        }

        return new JsonModel([
            "status" => "SUCCESS",
            "message" => "SW Starships",
            "data" => $arrItemStarship
        ]);
    }

    public function getAction()
    {
        $allItems = $this->swTable->fetchAll();
        $arr = array();
        foreach($allItems as $starShip){
            $arr[] = $starShip->getDataArray();
        }
        return new JsonModel([
            "status" => "SUCCESS",
            "message" => "SW Starships",
            "data" => $arr
        ]);
    }

    private function curlCallSwApi($url = null)
    {
        // Initialisation
        $ch = curl_init();
        
        if (!$ch)
            throw new \Exception('failed to initialize');

        // Config URL
        curl_setopt($ch, CURLOPT_URL, is_null($url) ? self::SW_API_URL : $url);
        
        // Pour éviter de dump la réponse directement dans la page.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Si problème de certificat.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Récupération de l'appel curl
        $result = curl_exec($ch);
        if (!$result)
            throw new \Exception(curl_error($ch), curl_errno($ch));

        // Décodage du résultat.
        $decodedResult = json_decode($result);

        // Fermeture de la session curl
        curl_close($ch);

        return $decodedResult;
    }
    
    public function activelancerAction() {

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
        
        // mise à jour du statut de la partie
        $sql = "UPDATE partie SET lancer_actif = $newStatut WHERE partie_id = $id";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data',
            'data' => [
                'precedentStatut' => $lastStatut,
                'nouveauStatut' => $newStatut,
            ]
        ]);

    }
    
    public function statutlancerAction() {

        // recherche de la dernière partie en cours
        $sql = "SELECT * FROM partie ORDER BY partie_id DESC LIMIT 0, 1";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $currentStatut = 0;
        if(!is_null($myPartie)) {
            $currentStatut = $myPartie['lancer_actif'];
        }
        
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data',
            'data' => [
                'statut' => $currentStatut,
            ]
        ]);

    }
    
    public function newresultatAction() {
        $chainePoints = $this->params()->fromRoute('id', 0);
        $aChainePoints = explode('.', $chainePoints);
        $point_total = $aChainePoints[0];
        $point_lancer1 = $aChainePoints[1];
        $point_lancer2 = $aChainePoints[2];
        $point_lancer3 = $aChainePoints[3];

        // récupération de la partie active
        $sql = "SELECT * FROM partie WHERE en_cours = 1 ORDER BY date DESC";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $lastPartieId = 0;
        if(!is_null($myPartie)) {
            $lastPartieId = $myPartie['partie_id'];
        }
        
        // récupération du prochain lancer
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
WHERE p.partie_id = $lastPartieId
    AND s.update_done = 0
ORDER BY score_id LIMIT 0, 1";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();

        $myPartie = $rs->current();
        $nextScoreId = 0;
        $nomjoueur = '';
        if(!is_null($myPartie)) {
            $nextScoreId = $myPartie['score_score_id'];
            $nomjoueur = $myPartie['joueur_nom'];
        }
        
        // mise à jour du résultat du prochain lancer
        $sql = "UPDATE score SET score = $point_total, points = '\"$point_lancer1\",\"$point_lancer2\",\"$point_lancer3\"', update_done = 1 WHERE score_id = $nextScoreId";
        $statement = $this->_db->query($sql);
        $rs = $statement->execute();
        
        // envoi du résultat vers le serveur sopra
        if($this->_activeCurl) {
            // Initialisation
            $ch = curl_init();


            $url = 'http://192.168.10.1/server-score/api/score?equipe='.$nomjoueur.'-'.$lastPartieId.'&score='.$point_total;
            //$data = array('equipe' => $nomjoueur.'-'.$lastPartieId, 'score' => $point_total);
            // Config URL

            curl_setopt($ch, CURLOPT_URL, is_null($url) ? self::SW_API_URL : $url);

            // Pour éviter de dump la réponse directement dans la page.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Si problème de certificat.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);

            // Récupération de l'appel curl
            $result = curl_exec($ch);

            // Fermeture de la session curl
            curl_close($ch);
        }

        
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data',
            'data' => [
                'statut' => 'done',
            ]
        ]);
    }

}
