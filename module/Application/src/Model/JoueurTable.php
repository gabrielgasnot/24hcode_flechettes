<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\Joueur;
use Zend\Db\TableGateway\TableGatewayInterface;

class JoueurTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getJoueur($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveJoueur(Joueur $joueur)
    {
        $id = (int) $joueur->id;

        if ($id === 0) {
            $this->tableGateway->insert($joueur->getDataArray());
            return;
        }

        if (! $this->getJoueur($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Joueur with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($joueur-getDataArray(), ['id' => $id]);
    }

    public function deleteJoueur($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}