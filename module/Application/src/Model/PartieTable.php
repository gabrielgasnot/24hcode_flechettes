<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\Partie;
use Zend\Db\TableGateway\TableGatewayInterface;

class PartieTable
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

    public function getPartie($id)
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

    public function savePartie(Partie $partie)
    {
        $id = (int) $partie->id;

        if ($id === 0) {
            $this->tableGateway->insert($partie->getDataArray());
            return;
        }

        if (! $this->getPartie($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Partie with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($partie-getDataArray(), ['id' => $id]);
    }

    public function deletePartie($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}