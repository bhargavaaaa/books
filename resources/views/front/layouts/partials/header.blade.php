<div class="site-header header-3  d-none d-lg-block">
    <div class="container">
        {{-- <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-8 flex-lg-right">
                <ul class="header-top-list">
                    </li>
                    <li class="dropdown-trigger language-dropdown"><a href=""><i class="icons-left fas fa-heart"></i>
                            wishlist (0)</a>
                    </li>
                    <li class="dropdown-trigger language-dropdown"><a href=""><i class="icons-left fas fa-user"></i>
                            My Account</a><i class="fas fa-chevron-down dropdown-arrow"></i>
                        <ul class="dropdown-box">
                            <li> <a href="">My Account</a></li>
                            <li> <a href="">Order History</a></li>
                            <li> <a href="">Transactions</a></li>
                            <li> <a href="">Downloads</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="icons-left fas fa-phone"></i> Contact</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
    <div class="header-middle pt--10 pb--10">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="{{ url('/') }}" class="site-brand">
                        <img src="{{ asset('public/front/image/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="header-search-block">
                        <input type="text" placeholder="Search entire store here">
                        <button>Search</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-navigation flex-lg-right">
                        <div class="cart-widget">
                            <div class="login-block">
                                <a href="{{ route('front.login-register') }}" class="font-weight-bold">Login</a> <br>
                                <span>or</span><a href="{{ route('front.login-register') }}">Register</a>
                            </div>
                            <div class="cart-block">
                                <div class="cart-total">
                                    <span class="text-number">
                                        1
                                    </span>
                                    <span class="text-item">
                                        Shopping Cart
                                    </span>
                                    <span class="price">
                                        £0.00
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </div>
                                <div class="cart-dropdown-block">
                                    <div class=" single-cart-block ">
                                        <div class="cart-product">
                                            <a href="product-details.html" class="image">
                                                <img src="{{ asset('public/front/image/products/cart-product-1.jpg') }}"
                                                    alt="">
                                            </a>
                                            <div class="content">
                                                <h3 class="title"><a href="product-details.html">Kodak PIXPRO
                                                        Astro Zoom AZ421 16 MP</a></h3>
                                                <p class="price"><span class="qty">1 ×</span> £87.34
                                                </p>
                                                <button class="cross-btn"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" single-cart-block ">
                                        <div class="btn-block">
                                            <a href="cart.html" class="btn">View Cart <i
                                                    class="fas fa-chevron-right"></i></a>
                                            <a href="checkout.html" class="btn btn--primary">Check Out <i
                                                    class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <!-- @include('menu.htm') --> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.layouts.partials.navbar')
</div>
<div class="site-mobile-menu">
    <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
        <div class="container">
            <div class="row align-items-sm-end align-items-center">
                <div class="col-md-4 col-7">
                    <a href="{{ url('/') }}" class="site-brand">
                        <img src="{{ asset('public/front/image/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-5 order-3 order-md-2">
                    <nav class="category-nav   ">
                        <div>
                            <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
                                categories</a>
                            <ul class="category-menu">
                                <li class="cat-item has-children">
                                    <a href="#">Arts & Photography</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Bags & Cases</a></li>
                                        <li><a href="#">Binoculars & Scopes</a></li>
                                        <li><a href="#">Digital Cameras</a></li>
                                        <li><a href="#">Film Photography</a></li>
                                        <li><a href="#">Lighting & Studio</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item has-children mega-menu"><a href="#">Biographies</a>
                                    <ul class="sub-menu">
                                        <li class="single-block">
                                            <h3 class="title">WHEEL SIMULATORS</h3>
                                            <ul>
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="single-block">
                                            <h3 class="title">WHEEL SIMULATORS</h3>
                                            <ul>
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="single-block">
                                            <h3 class="title">WHEEL SIMULATORS</h3>
                                            <ul>
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="single-block">
                                            <h3 class="title">WHEEL SIMULATORS</h3>
                                            <ul>
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="cat-item has-children"><a href="#">Business & Money</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brake Tools</a></li>
                                        <li><a href="">Driveshafts</a></li>
                                        <li><a href="">Emergency Brake</a></li>
                                        <li><a href="">Spools</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item has-children"><a href="#">Calendars</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brake Tools</a></li>
                                        <li><a href="">Driveshafts</a></li>
                                        <li><a href="">Emergency Brake</a></li>
                                        <li><a href="">Spools</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item has-children"><a href="#">Children's Books</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brake Tools</a></li>
                                        <li><a href="">Driveshafts</a></li>
                                        <li><a href="">Emergency Brake</a></li>
                                        <li><a href="">Spools</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item has-children"><a href="#">Comics</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brake Tools</a></li>
                                        <li><a href="">Driveshafts</a></li>
                                        <li><a href="">Emergency Brake</a></li>
                                        <li><a href="">Spools</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item"><a href="#">Perfomance Filters</a></li>
                                <li class="cat-item has-children"><a href="#">Cookbooks</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Brake Tools</a></li>
                                        <li><a href="">Driveshafts</a></li>
                                        <li><a href="">Emergency Brake</a></li>
                                        <li><a href="">Spools</a></li>
                                    </ul>
                                </li>
                                <li class="cat-item "><a href="#">Accessories</a></li>
                                <li class="cat-item "><a href="#">Education</a></li>
                                <li class="cat-item hidden-menu-item"><a href="#">Indoor Living</a></li>
                                <li class="cat-item"><a href="#" class="js-expand-hidden-menu">More
                                        Categories</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-3 col-5  order-md-3 text-right">
                    <div class="mobile-header-btns header-top-widget">
                        <ul class="header-links">
                            <li class="sin-link">
                                <a href="cart.html" class="cart-link link-icon"><i class="ion-bag"></i></a>
                            </li>
                            <li class="sin-link">
                                <a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i
                                        class="ion-navicon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--Off Canvas Navigation Start-->
    <aside class="off-canvas-wrapper">
        <div class="btn-close-off-canvas">
            <i class="ion-android-close"></i>
        </div>
        <div class="off-canvas-inner">
            <!-- search box start -->
            <div class="search-box offcanvas">
                <form>
                    <input type="text" placeholder="Search Here">
                    <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                </form>
            </div>
            <!-- search box end -->
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav class="off-canvas-nav">
                    <ul class="mobile-menu main-mobile-menu">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('front.product') }}">Shop</a>
                        </li>
                        <li><a href="{{ route('contactUs') }}">Contact</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
            <nav class="off-canvas-nav">
                <ul class="mobile-menu menu-block-2">
                    <li class="menu-item-has-children">
                        <a href="#">My Account <i class="fas fa-angle-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="">My Account</a></li>
                            <li><a href="">Order History</a></li>
                            <li><a href="">Transactions</a></li>
                            <li><a href="">Downloads</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="off-canvas-bottom">
                <div class="contact-list mb--10">
                    <a href="" class="sin-contact"><i class="fas fa-mobile-alt"></i>(12345) 78790220</a>
                    <a href="" class="sin-contact"><i class="fas fa-envelope"></i>examle@handart.com</a>
                </div>
                <div class="off-canvas-social">
                    <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="single-icon"><i class="fas fa-rss"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </aside>
    <!--Off Canvas Navigation End-->
</div>
<div class="sticky-init fixed-header common-sticky">
    <div class="container d-none d-lg-block">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <a href="{{ url('/') }}" class="site-brand">
                    <img src="{{ asset('public/front/image/logo.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-8">
                <div class="main-navigation flex-lg-right">
                    <ul class="main-menu menu-right ">
                        <li class="menu-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <!-- Shop -->
                        <li class="menu-item mega-menu">
                            <a href="{{ route('front.product') }}">shop</a>
                        </li>
                        <!-- Pages -->
                        <!-- Blog -->

                        <li class="menu-item">
                            <a href="{{ route('contactUs') }}">Contact</a>
                        </li>

                        <li class="menu-item has-children dropdown-trigger language-dropdown">
                            <a href="">
                            My Account</a>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                            <ul class="dropdown-box">
                                <li> <a href="">My Account</a></li>
                                <li> <a href="">Order History</a></li>
                                <li> <a href="">My Wishlist</a></li>
                                <li> <a href="">Transactions</a></li>
                                <li> <a href="">Downloads</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
