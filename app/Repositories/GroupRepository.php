<?php

namespace App\Repositories;

use App\Contracts\IGroupRepository;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupRepository implements IGroupRepository
{
    protected Group $model;

    public function __construct(Group $coin)
    {
        $this->model = $coin;
    }


    public function listAll(array $params)
    {
        return $this->model->paginate($params['per_page'] ?? 10);
    }

    public function save(array $data)
    {
        $data['user_id'] = Auth::id();
        $group = $this->model->create($data);
        $group->coins()->attach($data['coins']);
        return $group;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @throws \Exception
     */
    public function update(array $data, int $id)
    {
        $group = $this->model->find($id);
        if ($group) {
            $group->update($data);
            return $group;
        }

        throw new \Exception('Group not found');
    }

    public function destroy(int $id)
    {
        return $this->model->find($id)->delete();
    }

    public function addCoin(int $groupId, int $coinId)
    {
       return $this->model->find($groupId)->coins()->attach($coinId);
    }

    public function removeCoin(int $groupId, int $coinId)
    {
        return $this->model->find($groupId)->coins()->detach($coinId);
    }
}
