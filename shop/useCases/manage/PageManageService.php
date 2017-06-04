<?php

namespace shop\useCases\manage;

use shop\entities\Meta;
use shop\entities\Page;
use shop\forms\manage\PageForm;
use shop\repositories\PageRepository;

class PageManageService
{
    private $pages;

    public function __construct(PageRepository $pages)
    {
        $this->pages = $pages;
    }

    public function create(PageForm $form): Page
    {
        $parent = $this->pages->get($form->parentId);
        $page = Page::create(
            $form->title,
            $form->slug,
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $page->appendTo($parent);
        $this->pages->save($page);
        return $page;
    }

    public function edit($id, PageForm $form): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        $page->edit(
            $form->title,
            $form->slug,
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        if ($form->parentId !== $page->parent->id) {
            $parent = $this->pages->get($form->parentId);
            $page->appendTo($parent);
        }
        $this->pages->save($page);
    }

    public function moveUp($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        if ($prev = $page->prev) {
            $page->insertBefore($prev);
        }
        $this->pages->save($page);
    }

    public function moveDown($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        if ($next = $page->next) {
            $page->insertAfter($next);
        }
        $this->pages->save($page);
    }

    public function remove($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        $this->pages->remove($page);
    }

    private function assertIsNotRoot(Page $page): void
    {
        if ($page->isRoot()) {
            throw new \DomainException('Unable to manage the root page.');
        }
    }
}