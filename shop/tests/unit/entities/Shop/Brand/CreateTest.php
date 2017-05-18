<?php

namespace shop\tests\unit\entities\Shop\Brand;

use Codeception\Test\Unit;
use shop\entities\Shop\Brand;
use shop\entities\Meta;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $brand = Brand::create(
            $name = 'Name',
            $slug = 'slug',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $brand->name);
        $this->assertEquals($slug, $brand->slug);
        $this->assertEquals($meta, $brand->meta);
    }
}
