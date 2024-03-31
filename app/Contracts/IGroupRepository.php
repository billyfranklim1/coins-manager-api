<?php

namespace App\Contracts;

interface IGroupRepository
{
    public function listAll(array $params);
    public function save(array $data);
    public function find(int $id);
    public function update(array $data, int $id);
    public function destroy(int $id);
    public function addCoin(int $groupId, int $coinId);
    public function removeCoin(int $groupId, int $coinId);

}
