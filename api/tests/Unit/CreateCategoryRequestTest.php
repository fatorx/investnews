<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Validator;

class CreateCategoryRequestTest extends TestCase
{
    /** @test */
    public function it_validates_the_category_request()
    {
        $request = new CreateCategoryRequest();

        $data = [
            'name' => 'Valid Category',
        ];
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_fails_validation_if_name_is_missing()
    {
        $request = new CreateCategoryRequest();

        $data = [
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('name', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_validation_if_name_is_too_long()
    {
        $request = new CreateCategoryRequest();

        $data = [
            'name' => str_repeat('a', 256),
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('name', $validator->errors()->toArray());
    }
}
