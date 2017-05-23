<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="panel panel-default">
    <div class="panel-body">
        <a href="/index.php?route=product/category&amp;path=20_26">PC (0)</a> | <a href="/index.php?route=product/category&amp;path=20_27">Mac (1)</a>
    </div>
</div>

<div class="row">
    <div class="col-md-2 col-sm-6 hidden-xs">
        <div class="btn-group btn-group-sm">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-group">
            <a href="/index.php?route=product/compare" id="compare-total" class="btn btn-link">Product Compare (0)</a>
        </div>
    </div>
    <div class="col-md-4 col-xs-6">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-sort">Sort By:</label>
            <select id="input-sort" class="form-control" onchange="location = this.value;">
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=p.sort_order&amp;order=ASC" selected="selected">Default</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=pd.name&amp;order=ASC">Name (A - Z)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=pd.name&amp;order=DESC">Name (Z - A)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=p.price&amp;order=ASC">Price (Low &gt; High)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=p.price&amp;order=DESC">Price (High &gt; Low)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=rating&amp;order=DESC">Rating (Highest)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=rating&amp;order=ASC">Rating (Lowest)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=p.model&amp;order=ASC">Model (A - Z)</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;sort=p.model&amp;order=DESC">Model (Z - A)</option>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-limit">Show:</label>
            <select id="input-limit" class="form-control" onchange="location = this.value;">
                <option value="/index.php?route=product/category&amp;path=20&amp;limit=15" selected="selected">15</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;limit=25">25</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;limit=50">50</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;limit=75">75</option>
                <option value="/index.php?route=product/category&amp;path=20&amp;limit=100">100</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=42"><img src="http://static.shop.dev/cache/products/apple_cinema_30-228x228.jpg" alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=42">Apple Cinema 30&quot;</a></h4>
                    <p>
                        The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed sp..</p>
                    <p class="price">
                        <span class="price-new">$110.00</span> <span class="price-old">$122.00</span>
                        <span class="price-tax">Ex Tax: $90.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('42', '2');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=30"><img src="http://static.shop.dev/cache/products/canon_eos_5d_1-228x228.jpg" alt="Canon EOS 5D" title="Canon EOS 5D" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=30">Canon EOS 5D</a></h4>
                    <p>
                        Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category', while we'r..</p>
                    <p class="price">
                        <span class="price-new">$98.00</span> <span class="price-old">$122.00</span>
                        <span class="price-tax">Ex Tax: $80.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('30', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('30');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('30');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=47"><img src="http://static.shop.dev/cache/products/hp_1-228x228.jpg" alt="HP LP3065" title="HP LP3065" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=47">HP LP3065</a></h4>
                    <p>
                        Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel ..</p>
                    <p class="price">
                        $122.00                                                      <span class="price-tax">Ex Tax: $100.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('47', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('47');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('47');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=28"><img src="http://static.shop.dev/cache/products/htc_touch_hd_1-228x228.jpg" alt="HTC Touch HD" title="HTC Touch HD" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=28">HTC Touch HD</a></h4>
                    <p>
                        HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high de..</p>
                    <p class="price">
                        $122.00                                                      <span class="price-tax">Ex Tax: $100.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('28', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('28');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('28');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=40"><img src="http://static.shop.dev/cache/products/iphone_1-228x228.jpg" alt="iPhone" title="iPhone" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=40">iPhone</a></h4>
                    <p>
                        iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a nam..</p>
                    <p class="price">
                        $123.20                                                      <span class="price-tax">Ex Tax: $101.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('40', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('40');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('40');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=48"><img src="http://static.shop.dev/cache/products/ipod_classic_1-228x228.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=48">iPod Classic</a></h4>
                    <p>


                        More room to move.

                        With 80GB or 160GB of storage and up to 40 hours of battery l..</p>
                    <p class="price">
                        $122.00                                                      <span class="price-tax">Ex Tax: $100.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('48', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('48');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('48');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=43"><img src="http://static.shop.dev/cache/products/macbook_1-228x228.jpg" alt="MacBook" title="MacBook" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=43">MacBook</a></h4>
                    <p>

                        Intel Core 2 Duo processor

                        Powered by an Intel Core 2 Duo processor at speeds up to 2.1..</p>
                    <p class="price">
                        $602.00                                                      <span class="price-tax">Ex Tax: $500.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('43', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('43');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('43');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=44"><img src="http://static.shop.dev/cache/products/macbook_air_1-228x228.jpg" alt="MacBook Air" title="MacBook Air" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=44">MacBook Air</a></h4>
                    <p>
                        MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don&rsquo;t lose..</p>
                    <p class="price">
                        $1,202.00                                                      <span class="price-tax">Ex Tax: $1,000.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('44', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('44');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('44');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=29"><img src="http://static.shop.dev/cache/products/palm_treo_pro_1-228x228.jpg" alt="Palm Treo Pro" title="Palm Treo Pro" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=29">Palm Treo Pro</a></h4>
                    <p>
                        Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to b..</p>
                    <p class="price">
                        $337.99                                                      <span class="price-tax">Ex Tax: $279.99</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('29', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('29');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('29');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=33"><img src="http://static.shop.dev/cache/products/samsung_syncmaster_941bw-228x228.jpg" alt="Samsung SyncMaster 941BW" title="Samsung SyncMaster 941BW" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=33">Samsung SyncMaster 941BW</a></h4>
                    <p>
                        Imagine the advantages of going big without slowing down. The big 19&quot; 941BW monitor combines..</p>
                    <p class="price">
                        $242.00                                                      <span class="price-tax">Ex Tax: $200.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('33', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('33');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('33');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="/index.php?route=product/product&amp;path=20&amp;product_id=46"><img src="http://static.shop.dev/cache/products/sony_vaio_1-228x228.jpg" alt="Sony VAIO" title="Sony VAIO" class="img-responsive" /></a></div>
            <div>
                <div class="caption">
                    <h4><a href="/index.php?route=product/product&amp;path=20&amp;product_id=46">Sony VAIO</a></h4>
                    <p>
                        Unprecedented power. The next generation of processing technology has arrived. Built into the new..</p>
                    <p class="price">
                        $1,202.00                                                      <span class="price-tax">Ex Tax: $1,000.00</span>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('46', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('46');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('46');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 text-left"></div>
    <div class="col-sm-6 text-right">Showing 1 to 12 of 12 (1 Pages)</div>
</div>

