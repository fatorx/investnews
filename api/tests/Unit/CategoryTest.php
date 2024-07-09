<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\News;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $category = Category::factory()->create(['name' => 'Test Category']);
        $this->assertEquals('Test Category', $category->name);
    }

    /** @test */
    public function it_has_many_news()
    {
        $category = Category::factory()->create();
        $news = News::factory()->count(3)->create(['category_id' => $category->id]);

        $this->assertCount(3, $category->news);
        $this->assertInstanceOf(News::class, $category->news->first());
    }
}
