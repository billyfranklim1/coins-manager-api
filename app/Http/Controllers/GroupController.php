<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\AddRemoveCoinsRequest;
use App\Http\Requests\Group\CreateGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\MessageResource;
use App\Services\GroupService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    protected GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $groups = $this->groupService->listAll($request->all());
            return GroupResource::collection($groups)->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => 'Error listing groups',
                'error' => $e->getMessage(),
            ]))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function save(CreateGroupRequest $request): JsonResponse
    {
        try {
            $group = $this->groupService->saveGroup($request->validated());
            return (new GroupResource($group))->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error',
            ]))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $group = $this->groupService->findGroup($id);
            return (new GroupResource($group))->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => 'Error fetching group',
                'error' => $e->getMessage(),
            ]))->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateGroupRequest $request, int $id): JsonResponse
    {
        try {
            $group = $this->groupService->updateGroup($id, $request->validated());
            return (new GroupResource($group))->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => 'Error updating group',
                'error' => $e->getMessage(),
            ]))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->groupService->destroyGroup($id);
            return response()->json(['message' => 'Group successfully deleted']);
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => 'Error deleting group',
                'error' => $e->getMessage(),
            ]))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addCoins(AddRemoveCoinsRequest $request, int $groupId)
    {

        try {
            $this->groupService->addCoin($groupId, $request->coin_id);
            return (new MessageResource([
                'message' => 'Coin added to the group successfully.',
            ]))->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

    }

    public function removeCoins(AddRemoveCoinsRequest $request, int $groupId): JsonResponse
    {
        try {
            $this->groupService->removeCoin($groupId, $request->coin_id);
            return (new MessageResource([
                'message' => 'Coin removed from the group successfully.',
            ]))->response();
        } catch (Exception $e) {
            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

}
