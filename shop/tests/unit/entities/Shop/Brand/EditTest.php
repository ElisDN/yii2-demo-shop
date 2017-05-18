<?php

namespace shop\tests\unit\entities\Shop\Brand;

use shop\entities\Meta;
use shop\entities\Shop\Brand;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $brand = new Brand([
            'name' => 'Old Name',
            'slug' => 'old-slug'
        ]);

        $brand->edit(
            $name = 'New Name',
            $slug = 'new-slug',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $brand->name);
        $this->assertEquals($slug, $brand->slug);
        $this->assertEquals($meta, $brand->meta);
    }
}
