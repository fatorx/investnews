<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;
use App\Http\Requests\CreateNewsRequest;
use Illuminate\Support\Facades\Validator;

class CreateNewsRequestTest extends TestCase
{
    /** @test */
    public function it_validates_the_news_request()
    {
        $request = new CreateNewsRequest();
        $newCategory = Category::factory()->create();

        $data = [
            'title' => 'Valid Title',
            'content' => 'Valid Content',
            'category_id' => $newCategory->id,
        ];

        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_fails_validation_if_title_is_missing()
    {
        $request = new CreateNewsRequest();

        $data = [
            'content' => 'Valid Content',
            'category_id' => 1,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    /** @test */
    public function it_fails_validation_if_content_is_missing()
    {
        $request = new CreateNewsRequest();

        $data = [
            'title' => 'Valid Title',
            'category_id' => 1,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('content', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_validation_if_category_id_is_missing()
    {
        $request = new CreateNewsRequest();

        $data = [
            'title' => 'Valid Title',
            'content' => 'Valid Content',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('category_id', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_validation_if_category_id_does_not_exist()
    {
        $request = new CreateNewsRequest();

        $data = [
            'title' => 'Valid Title',
            'content' => 'Valid Content',
            'category_id' => 999, // Assuming this ID does not exist in your database
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('category_id', $validator->errors()->toArray());
    }
}
