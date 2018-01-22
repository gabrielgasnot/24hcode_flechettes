<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\EquipeJoueur;
use Zend\Db\TableGateway\TableGatewayInterface;

class EquipeJoueurTable
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

    public function getEquipeJoueur($id)
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

    public function saveEquipeJoueur(EquipeJoueur $equipe_joueur)
    {
        $id = (int) $equipe_joueur->id;

        if ($id === 0) {
            $this->tableGateway->insert($equipe_joueur->getDataArray());
            return;
        }

        if (! $this->getEquipeJoueur($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Equipe Joueur with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($equipe_joueur-getDataArray(), ['id' => $id]);
    }

    public function deleteEquipeJoueur($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}