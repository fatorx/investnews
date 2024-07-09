<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected CategoryService $categoryServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoryServiceMock = Mockery::mock(CategoryService::class);
        $this->app->instance(CategoryService::class, $this->categoryServiceMock);
    }

    /** @test */
    public function it_can_create_a_category()
    {
        $categoryData = ['name' => 'Test Category'];

        $this->categoryServiceMock->shouldReceive('createCategory')
            ->once()
            ->with($categoryData)
            ->andReturn(new Category($categoryData));

        $response = $this->postJson('/api/categories', $categoryData);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_show_a_category()
    {
        $category = Category::factory()->create();

        $this->categoryServiceMock->shouldReceive('getCategoryById')
            ->once()
            ->with($category->id)
            ->andReturn($category);

        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['id', 'name', 'created_at', 'updated_at']);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $updatedData = ['name' => 'Updated Category'];

        $this->categoryServiceMock->shouldReceive('updateCategory')
            ->once()
            ->with($category->id, $updatedData)
            ->andReturn(new Category(array_merge(['id' => $category->id], $updatedData)));

        $response = $this->putJson("/api/categories/{$category->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $this->categoryServiceMock->shouldReceive('deleteCategory')
            ->once()
            ->with($category->id);

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(204);
    }

    /** @test */
    public function it_can_list_all_categories()
    {
        $categoryCollection = Category::factory()->count(5)->make();

        $this->categoryServiceMock->shouldReceive('getAllCategories')
            ->once()
            ->andReturn($categoryCollection);

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
    }
}
