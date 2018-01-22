<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\PartieType;
use Zend\Db\TableGateway\TableGatewayInterface;

class PartieTypeTable
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

    public function getPartieType($id)
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

    public function savePartieType(PartieType $partietype)
    {
        $id = (int) $partietype->id;

        if ($id === 0) {
            $this->tableGateway->insert($partietype->getDataArray());
            return;
        }

        if (! $this->getPartieType($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update PartieType with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($partietype-getDataArray(), ['id' => $id]);
    }

    public function deletePartieType($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}