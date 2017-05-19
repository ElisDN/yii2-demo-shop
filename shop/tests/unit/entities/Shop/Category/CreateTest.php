<?php

namespace shop\tests\unit\entities\Shop\Category;

use Codeception\Test\Unit;
use shop\entities\Shop\Category;
use shop\entities\Meta;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $category = Category::create(
            $name = 'Name',
            $slug = 'slug',
            $title = 'Full header',
            $description = 'Description',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $category->name);
        $this->assertEquals($slug, $category->slug);
        $this->assertEquals($title, $category->title);
        $this->assertEquals($description, $category->description);
        $this->assertEquals($meta, $category->meta);
    }
}