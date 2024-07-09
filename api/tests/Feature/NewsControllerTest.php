<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\News;
use App\Models\Category;
use App\Services\NewsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $newsServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->newsServiceMock = Mockery::mock(NewsService::class);
        $this->app->instance(NewsService::class, $this->newsServiceMock);
    }

    /** @test */
    public function it_can_create_news()
    {
        $category = Category::factory()->create();
        $newsData = [
            'title' => 'Test News',
            'content' => 'Test Content',
            'category_id' => $category->id,
        ];

        $this->newsServiceMock->shouldReceive('createNews')
            ->once()
            ->with($newsData)
            ->andReturn(new News($newsData));

        $response = $this->postJson('/api/news', $newsData);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_show_news()
    {
        $news = News::factory()->create();

        $this->newsServiceMock->shouldReceive('getNewsById')
            ->once()
            ->with($news->id)
            ->andReturn($news);

        $response = $this->getJson("/api/news/{$news->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['id', 'title', 'content', 'category_id', 'created_at', 'updated_at']);
    }

    /** @test */
    public function it_can_update_news()
    {
        $news = News::factory()->create();
        $newCategory = Category::factory()->create();
        $updatedData = [
            'title' => 'Updated News',
            'content' => 'Updated Content',
            'category_id' => $newCategory->id,
        ];

        $this->newsServiceMock->shouldReceive('updateNews')
            ->once()
            ->with($news->id, $updatedData)
            ->andReturn(new News(array_merge(['id' => $news->id], $updatedData)));

        $response = $this->putJson("/api/news/{$news->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);
    }

    /** @test */
    public function it_can_delete_news()
    {
        $news = News::factory()->create();

        $this->newsServiceMock->shouldReceive('deleteNews')
            ->once()
            ->with($news->id);

        $response = $this->deleteJson("/api/news/{$news->id}");

        $response->assertStatus(204);
    }

    /** @test */
    public function it_can_list_all_news()
    {
        $newsCollection = News::factory()->count(5)->make();
        $this->newsServiceMock->shouldReceive('searchNews')
            ->once()
            ->andReturn($newsCollection);

        $response = $this->getJson('/api/news');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['title', 'content', 'category_id']
            ]);
    }
}
