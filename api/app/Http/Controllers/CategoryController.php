<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Messages\CategoryMessages;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Exception;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        try {
            $categories = $this->categoryService->getAllCategories();
            return response()->json($categories);

        } catch (Exception $e) {
            $message = CategoryMessages::ERROR_PROCESS_QUERY;
            return $this->handleException($e, $message);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return response()->json($category);
        } catch (Exception $e) {
            $message = CategoryMessages::ERROR_PROCESS_QUERY;
            return $this->handleException($e, $message);
        }
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());
            return response()->json($category, 201);

        } catch (Exception $e) {
            $message = CategoryMessages::ERROR_CREATE_REGISTER;
            return $this->handleException($e, $message);
        }
    }

    public function update(CreateCategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->validated());
            return response()->json($category);

        } catch (Exception $e) {
            $message = CategoryMessages::ERROR_UPDATE_REGISTER;
            return $this->handleException($e, $message);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($id);
            return response()->json(null, 204);

        } catch (Exception $e) {
            $message = CategoryMessages::ERROR_DELETE_ITEM;
            return $this->handleException($e, $message);
        }
    }
}
