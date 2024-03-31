<?php

namespace App\Services;
use App\Contracts\IGroupRepository;

class GroupService
{
    protected IGroupRepository $groupRepository;

    public function __construct(IGroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function listAll(array $params)
    {
        return $this->groupRepository->listAll($params);
    }

    public function saveGroup(array $data)
    {
        return $this->groupRepository->save($data);
    }

    public function findGroup(int $id)
    {
        return $this->groupRepository->find($id);
    }

    public function updateGroup(int $id, array $data)
    {
        return $this->groupRepository->update($data, $id);
    }

    public function destroyGroup(int $id)
    {
        return $this->groupRepository->destroy($id);
    }

    public function addCoin(int $groupId, int $coinId)
    {
        return $this->groupRepository->addCoin($groupId, $coinId);
    }

    public function removeCoin(int $groupId, int $coinId)
    {
        return $this->groupRepository->removeCoin($groupId, $coinId);
    }

}
