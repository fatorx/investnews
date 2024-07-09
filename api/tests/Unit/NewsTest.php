<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\News;
use App\Models\Category;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_title()
    {
        $news = News::factory()->create(['title' => 'Test Title']);
        $this->assertEquals('Test Title', $news->title);
    }

    /** @test */
    public function it_has_content()
    {
        $news = News::factory()->create(['content' => 'Test Content']);
        $this->assertEquals('Test Content', $news->content);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $news = News::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $news->category);
        $this->assertEquals($category->id, $news->category->id);
    }
}
