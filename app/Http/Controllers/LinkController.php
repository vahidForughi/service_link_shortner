<?php

namespace App\Http\Controllers;

use App\DTO\Orchestrator\Link\LinkStoreOrchInputDTO;
use App\Enums\ResponseStatusCodeEnum;
use App\Http\Requests\Link\ShowRequest;
use App\Http\Requests\Link\StoreRequest;
use App\Http\Resources\LinkResource;
use App\Orchestrator\Orchestrator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = resolve(Orchestrator::class)->getLinksList();

        return response()->successJson(
            data: LinkResource::collection($data)->toArray($request),
            statusCode: ResponseStatusCodeEnum::OK,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $validated_data = $request->validated();

        $data = resolve(Orchestrator::class)->storeLink(new LinkStoreOrchInputDTO(
            address: $validated_data['address'],
        ));

        return response()->successJson(
            data: LinkResource::make($data)->toArray($request),
            statusCode: ResponseStatusCodeEnum::Created,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request)
    {
        $validated_data = $request->validated();

        $data = resolve(Orchestrator::class)->showLink(
            linkID: $validated_data['link_id']
        );

        return response()->successJson(
            data: LinkResource::make($data)->toArray($request),
            statusCode: ResponseStatusCodeEnum::Created,
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
