<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\Flechetteresultats;
use Zend\Db\TableGateway\TableGatewayInterface;

class FlechetteresultatsTable
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

    public function getFlechetteresultats($id)
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

    public function saveFlechetteresultats(Flechetteresultats $flechetteresultats)
    {
        $id = (int) $flechetteresultats->id;

        if ($id === 0) {
            $this->tableGateway->insert($flechetteresultats->getDataArray());
            return;
        }

        if (! $this->getFlechetteresultats($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Flechetteresultats with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($flechetteresultats-getDataArray(), ['id' => $id]);
    }

    public function deleteFlechetteresultats($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}