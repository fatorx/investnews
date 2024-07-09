<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    public function getAllNews(): Collection
    {
        return News::all();
    }

    public function getNewsById(int $id): News
    {
        return News::findOrFail($id);
    }

    public function searchNews(string $keyword = null, int $categoryId = null): Collection
    {
        $query = News::query();

        if ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $query->orderByDesc('id');

        return $query->get();
    }

    public function createNews(array $data): News
    {
        return News::create($data);
    }

    public function updateNews(int $id, array $data): News
    {
        $news = News::findOrFail($id);
        $news->update($data);

        return $news;
    }

    public function deleteNews(int $id): void
    {
        $news = News::findOrFail($id);
        $news->delete();
    }
}
