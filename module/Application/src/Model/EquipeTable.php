<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\Equipe;
use Zend\Db\TableGateway\TableGatewayInterface;

class EquipeTable
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

    public function getEquipe($id)
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

    public function saveEquipe(Equipe $equipe)
    {
        $id = (int) $equipe->id;

        if ($id === 0) {
            $this->tableGateway->insert($equipe->getDataArray());
            return;
        }

        if (! $this->getEquipe($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Equipe with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($equipe-getDataArray(), ['id' => $id]);
    }

    public function deleteEquipe($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}