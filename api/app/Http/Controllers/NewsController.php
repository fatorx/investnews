<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Messages\NewsMessages;
use App\Services\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request): JsonResponse
    {
        try {

            /**
             * Keyword to search.
             * @example search
             * @default ''
             */
            $keyword = $request->query('keyword');

            /**
             * Category to search.
             * @example 1
             * @default ''
             */
            $categoryId = $request->query('category_id');

            $news = $this->newsService->searchNews($keyword, $categoryId);

            return response()->json($news);

        } catch (Exception $e) {
            $message = NewsMessages::ERROR_PROCESS_QUERY;
            return $this->handleException($e, $message);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $news = $this->newsService->getNewsById($id);

            return response()->json($news);

        } catch (Exception $e) {
            $message = NewsMessages::ERROR_PROCESS_QUERY;
            return $this->handleException($e, $message);
        }
    }

    public function store(CreateNewsRequest $request): JsonResponse
    {
        try {
            $news = $this->newsService->createNews($request->validated());

            return response()->json($news, 201);

        } catch (Exception $e) {
            $message = NewsMessages::ERROR_CREATE_REGISTER;
            return $this->handleException($e, $message);
        }
    }

    public function update(CreateNewsRequest $request, int $id): JsonResponse
    {
        try {
            $news = $this->newsService->updateNews($id, $request->validated());

            return response()->json($news);

        } catch (Exception $e) {
            $message = NewsMessages::ERROR_UPDATE_REGISTER;
            return $this->handleException($e, $message);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->newsService->deleteNews($id);

            return response()->json(null, 204);

        } catch (Exception $e) {
            $message = NewsMessages::ERROR_DELETE_ITEM;
            return $this->handleException($e, $message);
        }
    }
}
