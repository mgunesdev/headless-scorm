<?php

namespace EscolaLms\Scorm\Http\Controllers;

use EscolaLms\Scorm\Http\Controllers\Swagger\ScormControllerContract;
use EscolaLms\Scorm\Http\Requests\ScormDeleteRequest;
use EscolaLms\Scorm\Services\Contracts\ScormQueryServiceContract;
use EscolaLms\Scorm\Services\Contracts\ScormServiceContract;
use Exception;
use EscolaLms\Scorm\Http\Requests\ScormCreateRequest;
use EscolaLms\Scorm\Http\Requests\ScormListRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Peopleaps\Scorm\Model\ScormModel;

class ScormController extends BaseController
{
    private ScormServiceContract $scormService;

    private ScormQueryServiceContract $scormQueryService;

    public function __construct(
        ScormServiceContract $scormService,
        ScormQueryServiceContract $scormQueryService
    )
    {
        $this->scormService = $scormService;
        $this->scormQueryService = $scormQueryService;
    }

    public function upload(Request $request): RedirectResponse
    {
        $file = $request->file('zip');

        try {
            $data = $this->scormService->uploadScormArchive($file);
            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            return redirect()->back()->with('danger', 'İçerik Oluşturulurken Bir Hata Oluştu!'. $error->getMessage());
//            return $this->sendError($error->getMessage(), 422);
        }

        return redirect()->route('content.index')->with('success', 'İçerik Oluşturuldu');
//        return $this->sendResponse($data, "Scorm Package uploaded successfully");
    }

    public function parse(Request $request): JsonResponse
    {
        $file = $request->file('zip');

        try {
            $data = $this->scormService->parseScormArchive($file);
            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($data, "Scorm Package uploaded successfully");
    }

    public function show(string $uuid, Request $request): View
    {
        $data = $this->scormService->getScoViewDataByUuid(
            $uuid,
            $request->user() ? $request->user()->getKey() : null,
            $request->bearerToken()
        );

        return view('scorm::player', ['data' => $data]);
    }

    public function showConfig(string $uuid, Request $request): JsonResponse
    {
        $data = $this->scormService->getScoDataByUuid(
            $uuid,
            $request->user() ? $request->user()->getKey() : null,
            $request->bearerToken()
        );

        return $this->sendResponse($data);
    }

    public function index(ScormListRequest $request): JsonResponse
    {
        $list = $this->scormQueryService->get($request->pageParams(), ['*'], $request->searchParams());
        return $this->sendResponse($list, "Scorm list fetched successfully");
    }

    public function getScos(ScormListRequest $request): JsonResponse
    {
        $columns = [
            "id",
            "scorm_id",
            "uuid",
            "entry_url",
            "identifier",
            "title",
            "sco_parameters"
        ];

        $list = $this->scormQueryService->allScos($columns);
        return $this->sendResponse($list, "Scos list fetched successfully");
    }

    public function delete(ScormDeleteRequest $request, ScormModel $scormModel): JsonResponse
    {
        $this->scormService->deleteScormData($scormModel);
        return $this->sendSuccess("Scorm Package deleted successfully");
    }
}
