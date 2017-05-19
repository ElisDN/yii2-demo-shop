<?php

namespace shop\services\manage\Shop;

use shop\entities\Meta;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\repositories\BrandRepository;
use shop\repositories\CategoryRepository;
use shop\repositories\Shop\ProductRepository;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
    }

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $product->setPrice($form->price->new, $form->price->old);

        $this->products->save($product);

        return $product;
    }

    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}