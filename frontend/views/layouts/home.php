<?php

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-12">
        <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
            <div class="item">
                <a href="index.php?route=product/product&amp;path=57&amp;product_id=49"><img
                            src="http://static.shop.dev/cache/banners/iPhone6-1140x380.jpg"
                            alt="iPhone 6" class="img-responsive"/></a>
            </div>
            <div class="item">
                <img src="http://static.shop.dev/cache/banners/MacBookAir-1140x380.jpg"
                     alt="MacBookAir" class="img-responsive"/>
            </div>
        </div>
        <h3>Featured</h3>
        <div class="row">
            <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb transition">
                    <div class="image"><a
                                href="http://localhost:8080/index.php?route=product/product&amp;product_id=43"><img
                                    src="http://static.shop.dev/cache/products/macbook_1-200x200.jpg"
                                    alt="MacBook" title="MacBook" class="img-responsive"/></a></div>
                    <div class="caption">
                        <h4><a href="http://localhost:8080/index.php?route=product/product&amp;product_id=43">MacBook</a>
                        </h4>
                        <p>

                            Intel Core 2 Duo processor

                            Powered by an Intel Core 2 Duo processor at speeds up to 2.1..</p>
                        <p class="price">
                            $602.00 <span class="price-tax">Ex Tax: $500.00</span>
                        </p>
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="cart.add('43');"><i class="fa fa-shopping-cart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                        <button type="button" data-toggle="tooltip" title="Add to Wish List"
                                onclick="wishlist.add('43');"><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product"
                                onclick="compare.add('43');"><i class="fa fa-exchange"></i></button>
                    </div>
                </div>
            </div>
            <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb transition">
                    <div class="image"><a
                                href="http://localhost:8080/index.php?route=product/product&amp;product_id=40"><img
                                    src="http://static.shop.dev/cache/products/iphone_1-200x200.jpg"
                                    alt="iPhone" title="iPhone" class="img-responsive"/></a></div>
                    <div class="caption">
                        <h4>
                            <a href="http://localhost:8080/index.php?route=product/product&amp;product_id=40">iPhone</a>
                        </h4>
                        <p>
                            iPhone is a revolutionary new mobile phone that allows you to make a call by simply
                            tapping a nam..</p>
                        <p class="price">
                            $123.20 <span class="price-tax">Ex Tax: $101.00</span>
                        </p>
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="cart.add('40');"><i class="fa fa-shopping-cart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                        <button type="button" data-toggle="tooltip" title="Add to Wish List"
                                onclick="wishlist.add('40');"><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product"
                                onclick="compare.add('40');"><i class="fa fa-exchange"></i></button>
                    </div>
                </div>
            </div>
            <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb transition">
                    <div class="image"><a
                                href="http://localhost:8080/index.php?route=product/product&amp;product_id=42"><img
                                    src="http://static.shop.dev/cache/products/apple_cinema_30-200x200.jpg"
                                    alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;"
                                    class="img-responsive"/></a></div>
                    <div class="caption">
                        <h4><a href="http://localhost:8080/index.php?route=product/product&amp;product_id=42">Apple
                                Cinema 30&quot;</a></h4>
                        <p>
                            The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution.
                            Designed sp..</p>
                        <p class="price">
                            <span class="price-new">$110.00</span> <span class="price-old">$122.00</span>
                            <span class="price-tax">Ex Tax: $90.00</span>
                        </p>
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="cart.add('42');"><i class="fa fa-shopping-cart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                        <button type="button" data-toggle="tooltip" title="Add to Wish List"
                                onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product"
                                onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                    </div>
                </div>
            </div>
            <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb transition">
                    <div class="image"><a
                                href="http://localhost:8080/index.php?route=product/product&amp;product_id=30"><img
                                    src="http://static.shop.dev/cache/products/canon_eos_5d_1-200x200.jpg"
                                    alt="Canon EOS 5D" title="Canon EOS 5D" class="img-responsive"/></a></div>
                    <div class="caption">
                        <h4><a href="http://localhost:8080/index.php?route=product/product&amp;product_id=30">Canon
                                EOS 5D</a></h4>
                        <p>
                            Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category',
                            while we'r..</p>
                        <p class="price">
                            <span class="price-new">$98.00</span> <span class="price-old">$122.00</span>
                            <span class="price-tax">Ex Tax: $80.00</span>
                        </p>
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="cart.add('30');"><i class="fa fa-shopping-cart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                        <button type="button" data-toggle="tooltip" title="Add to Wish List"
                                onclick="wishlist.add('30');"><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product"
                                onclick="compare.add('30');"><i class="fa fa-exchange"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div id="carousel0" class="owl-carousel">
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/nfl-130x100.png" alt="NFL"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/redbull-130x100.png"
                     alt="RedBull" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/sony-130x100.png" alt="Sony"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/cocacola-130x100.png"
                     alt="Coca Cola" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/burgerking-130x100.png"
                     alt="Burger King" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/canon-130x100.png" alt="Canon"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/harley-130x100.png"
                     alt="Harley Davidson" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/dell-130x100.png" alt="Dell"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/disney-130x100.png"
                     alt="Disney" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/starbucks-130x100.png"
                     alt="Starbucks" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="http://static.shop.dev/cache/manufacturers/nintendo-130x100.png"
                     alt="Nintendo" class="img-responsive"/>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->registerJs('
$(\'#carousel0\').owlCarousel({
    items: 6,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->endContent() ?>