<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Prophecy\Call\Call;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        factory(Category::class, 1)->create();
        $category = Category::all();
        $this->assertCount(1, $category);
        $categoryKey = array_keys($category->first()->getAttributes());
        $this->assertEqualsCanonicalizing([
            'id',
            'name',
            'description',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at'
        ], $categoryKey);
    }

    public function testCreate()
    {
        $category = Category::create([
            'name' => 'teste1'
        ]);

        $category->refresh();

        $this->assertEquals('teste1', $category->name);
        $this->assertNull($category->description);
        $this->assertTrue($category->is_active);

        $category = Category::create([
            'name' => 'teste1',
            'description' => null
        ]);

        $this->assertNull($category->description);

        $category = Category::create([
            'name' => 'teste1',
            'description' => 'teste description'
        ]);

        $this->assertEquals('teste description', $category->description);

        $category = Category::create([
            'name' => 'teste1',
            'is_active' => false
        ]);

        $this->assertFalse($category->is_active);

        $category = Category::create([
            'name' => 'teste1',
            'is_active' => true
        ]);

        $this->assertTrue($category->is_active);
    }

    public function testUpdate()
    {
        $category = factory(Category::class)->create([
            'description' => 'test_description'
        ])->first(); 
        
        $data = [
            'name' => 'test_name_updated',
            'is_active' => true,
            'description' => 'test_description_updated'
        ];

        $category->update($data);
        foreach($data as $key => $value){
            $this->assertEquals($value, $category->{$key});   
        }

    }
}