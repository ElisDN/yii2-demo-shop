<?php

namespace shop\tests\unit\entities\Shop\Tag;

use shop\entities\Shop\Tag;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'Name',
            $slug = 'slug'
        );

        $tag->edit($name = 'New Name', $slug = 'new-slug');
        
        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}
