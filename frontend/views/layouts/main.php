<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <link href="<?= Yii::getAlias('@web/images/catalog/cart.png') ?>" rel="icon"/>
    <?php $this->head() ?>
</head>
<body class="common-home">
<?php $this->beginBody() ?>
<nav id="top">
    <div class="container">
        <div class="pull-left">
            <form action="/index.php?route=common/currency/currency" method="post"
                  enctype="multipart/form-data" id="form-currency">
                <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <strong>$</strong>
                        <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound
                                Sterling
                            </button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US
                                Dollar
                            </button>
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="code" value=""/>
                <input type="hidden" name="redirect" value="/index.php?route=common/home"/>
            </form>
        </div>
        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li><a href="/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                    <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                <li class="dropdown"><a href="/index.php?route=account/account" title="My Account"
                                        class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span
                                class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="/index.php?route=account/register">Register</a></li>
                        <li><a href="/index.php?route=account/login">Login</a></li>
                    </ul>
                </li>
                <li><a href="/index.php?route=account/wishlist" id="wishlist-total"
                       title="Wish List (0)"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md">Wish List (0)</span></a>
                </li>
                <li><a href="/index.php?route=checkout/cart" title="Shopping Cart"><i
                                class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span></a>
                </li>
                <li><a href="/index.php?route=checkout/checkout" title="Checkout"><i
                                class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <a href="<?= Url::home() ?>"><img
                                src="<?= Yii::getAlias('@web/image/logo.png') ?>" title="Your Store" alt="Your Store"
                                class="img-responsive"/></a>
                </div>
            </div>
            <div class="col-sm-5">
                <div id="search" class="input-group">
                    <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg"/>
                    <span class="input-group-btn">
    <button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
  </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div id="cart" class="btn-group btn-block">
                    <button type="button" data-toggle="dropdown" data-loading-text="Loading..."
                            class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i>
                        <span id="cart-total">3 item(s) - $319.20</span></button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <table class="table table-striped">
                                <tr>
                                    <td class="text-center"><a
                                                href="/index.php?route=product/product&amp;product_id=30"><img
                                                    src="http://static.shop.dev/cache/products/canon_eos_5d_1-47x47.jpg"
                                                    alt="Canon EOS 5D" title="Canon EOS 5D" class="img-thumbnail"/></a>
                                    </td>
                                    <td class="text-left"><a
                                                href="/index.php?route=product/product&amp;product_id=30">Canon
                                            EOS 5D</a>
                                        <br/>
                                        -
                                        <small>Select Red</small>
                                    </td>
                                    <td class="text-right">x 2</td>
                                    <td class="text-right">$196.00</td>
                                    <td class="text-center">
                                        <button type="button" onclick="cart.remove('2');" title="Remove"
                                                class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a
                                                href="/index.php?route=product/product&amp;product_id=40"><img
                                                    src="http://static.shop.dev/cache/products/iphone_1-47x47.jpg"
                                                    alt="iPhone" title="iPhone" class="img-thumbnail"/></a>
                                    </td>
                                    <td class="text-left"><a
                                                href="/index.php?route=product/product&amp;product_id=40">iPhone</a>
                                    </td>
                                    <td class="text-right">x 1</td>
                                    <td class="text-right">$123.20</td>
                                    <td class="text-center">
                                        <button type="button" onclick="cart.remove('1');" title="Remove"
                                                class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li>
                            <div>
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                        <td class="text-right">$261.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                        <td class="text-right">$6.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>VAT (20%)</strong></td>
                                        <td class="text-right">$52.20</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Total</strong></td>
                                        <td class="text-right">$319.20</td>
                                    </tr>
                                </table>
                                <p class="text-right"><a
                                            href="/index.php?route=checkout/cart"><strong><i
                                                    class="fa fa-shopping-cart"></i> View Cart</strong></a>&nbsp;&nbsp;&nbsp;<a
                                            href="/index.php?route=checkout/checkout"><strong><i
                                                    class="fa fa-share"></i> Checkout</strong></a></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <nav id="menu" class="navbar">
        <div class="navbar-header"><span id="category" class="visible-xs">Categories</span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="/index.php?route=product/category&amp;path=20"
                                        class="dropdown-toggle" data-toggle="dropdown">Desktops</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=20_26">PC
                                        (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=20_27">Mac
                                        (1)</a></li>
                            </ul>
                        </div>
                        <a href="/index.php?route=product/category&amp;path=20" class="see-all">Show
                            All Desktops</a></div>
                </li>
                <li class="dropdown"><a href="/index.php?route=product/category&amp;path=18"
                                        class="dropdown-toggle" data-toggle="dropdown">Laptops &amp; Notebooks</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=18_46">Macs
                                        (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=18_45">Windows
                                        (0)</a></li>
                            </ul>
                        </div>
                        <a href="/index.php?route=product/category&amp;path=18" class="see-all">Show
                            All Laptops &amp; Notebooks</a></div>
                </li>
                <li class="dropdown"><a href="/index.php?route=product/category&amp;path=25"
                                        class="dropdown-toggle" data-toggle="dropdown">Components</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=25_29">Mice
                                        and Trackballs (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=25_28">Monitors
                                        (2)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=25_30">Printers
                                        (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=25_31">Scanners
                                        (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=25_32">Web
                                        Cameras (0)</a></li>
                            </ul>
                        </div>
                        <a href="/index.php?route=product/category&amp;path=25" class="see-all">Show
                            All Components</a></div>
                </li>
                <li><a href="/index.php?route=product/category&amp;path=57">Tablets</a></li>
                <li><a href="/index.php?route=product/category&amp;path=17">Software</a></li>
                <li><a href="/index.php?route=product/category&amp;path=24">Phones &amp; PDAs</a>
                </li>
                <li><a href="/index.php?route=product/category&amp;path=33">Cameras</a></li>
                <li class="dropdown"><a href="/index.php?route=product/category&amp;path=34"
                                        class="dropdown-toggle" data-toggle="dropdown">MP3 Players</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=34_43">test
                                        11 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_44">test
                                        12 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_47">test
                                        15 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_48">test
                                        16 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_49">test
                                        17 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=34_50">test
                                        18 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_51">test
                                        19 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_52">test
                                        20 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_53">test
                                        21 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_54">test
                                        22 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=34_55">test
                                        23 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_56">test
                                        24 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_38">test
                                        4 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_37">test
                                        5 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_39">test
                                        6 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="/index.php?route=product/category&amp;path=34_40">test
                                        7 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_41">test
                                        8 (0)</a></li>
                                <li><a href="/index.php?route=product/category&amp;path=34_42">test
                                        9 (0)</a></li>
                            </ul>
                        </div>
                        <a href="/index.php?route=product/category&amp;path=34" class="see-all">Show
                            All MP3 Players</a></div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Information</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/information&amp;information_id=4">About
                            Us</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=6">Delivery
                            Information</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=3">Privacy
                            Policy</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=5">Terms
                            &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/contact">Contact Us</a></li>
                    <li><a href="/index.php?route=account/return/add">Returns</a></li>
                    <li><a href="/index.php?route=information/sitemap">Site Map</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Extras</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=product/manufacturer">Brands</a></li>
                    <li><a href="/index.php?route=account/voucher">Gift Certificates</a></li>
                    <li><a href="/index.php?route=affiliate/account">Affiliates</a></li>
                    <li><a href="/index.php?route=product/special">Specials</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>My Account</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=account/account">My Account</a></li>
                    <li><a href="/index.php?route=account/order">Order History</a></li>
                    <li><a href="/index.php?route=account/wishlist">Wish List</a></li>
                    <li><a href="/index.php?route=account/newsletter">Newsletter</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p>Powered By <a href="http://www.opencart.com">OpenCart</a><br/> Your Store &copy; 2017</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
