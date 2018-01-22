<?php

namespace Application\Model;

use RuntimeException;
use Application\Model\Score;
use Zend\Db\TableGateway\TableGatewayInterface;

class ScoreTable
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

    public function getScore($id)
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

    public function saveScore(Score $score)
    {
        $id = (int) $score->id;

        if ($id === 0) {
            $this->tableGateway->insert($score->getDataArray());
            return;
        }

        if (! $this->getScore($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Score with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($score-getDataArray(), ['id' => $id]);
    }

    public function deleteScore($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}