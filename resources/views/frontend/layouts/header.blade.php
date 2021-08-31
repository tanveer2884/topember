<header class="sticky-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg">
                    <!-- Brand -->
                    <a class="navbar-brand" href="/">
                        <img src="/images/box-store-logo.png" alt="The Box Store" />
                    </a>

                    <!-- Toggler/collapsibe Button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                    </button>

                    <!-- Navbar links -->
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav navbar-left ml-auto mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('product.index') }}">Shop Boxes & Supplies</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Services
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('shipping-services')}}">Shipping Services</a>
                                    <a class="dropdown-item" href="{{url('packing-services')}}">Packing Services</a>
                                    <a class="dropdown-item" href="{{url('moving-consultations')}}">Moving Consultations</a>
                                    <a class="dropdown-item" href="{{url('valet-storage')}}">Valet Storage</a>
                                    <a class="dropdown-item" href="{{url('mail-box')}}">Mailbox Rentals</a>
                                    <a class="dropdown-item" href="{{url('amazon-package')}}">Amazon Package Pickup</a>
                                    <a class="dropdown-item" href="{{url('mail-box')}}">Conference Room</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="track-package">Track a Package</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="blog-listing">Resources</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about-us">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact-us">Contact</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-right ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" onclick="showSearch()" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="23" viewBox="0 0 23 23">
                                        <image width="23" height="23" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAADgKtSgAAABqUlEQVRIia2VMUhVYRTH/5q4CJaLIWK4RCUOgvPDQR2iIdqba4kSCYL3GtLhLS4ubSItRaDRWNLs4GK9IHhDRAQV2RA9GhKEn1z57uV4+O6971088IfDd87/9717v/ud1wcoJxYk3ZA0K2lS0jlJPyR9kPRW0qs8YxYJ3KkG7FIebeB2xJ/JLyzlIDvAn5zaZjfw+870HWgAs8AwMARcAe4C+673ZRF8xjW/CLDcRwaeOM+9PPgn07RdArV64Da44OE1U/zdAzjVjvE/9vCnpvioAty+0vcevmeK1yrAE30L/sNw+Cfr/ZIuhW++I+lL6cWIx8ewOihpIu1I4AMhPwqqEtY3YOE/Qz4iaawi/LLJU94JvBXyPknzFcDjkqZC/lnSQVYBbpoDbVc4zA3jX49dol+mYbUH8KK7RJMx+C3XtNQF+LrzPCwaXM9c82tgLgKddhcvjUYRPNHziOkr8A5442ZQLJpF8ETLwL8SiP21DbfWLIInugjUwz/SX2P8D7SANWDK9DdjG3TzRZwHrgbYaEGf32ClypAq0qkNsjlwRlEPc+aOpK1jJeo2xRDmj8QAAAAASUVORK5CYII=" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ auth()->check() ? route('user.my-account') : route('user.login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" viewBox="0 0 25 25">
                                        <image width="25" height="25"
                                            xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAACrUlEQVRIiZ2W3WvOYRjHP5uXPaMR5m09tJIRGopsORDKwWzlpbwcscKUwgkH4g9wJAfiYAci4kBkKAeeA++Zt1pL2uNtWbNJYzZk46u7rqfubvfv2bjq6v7d1/vv+l339/4VSGIIWg3UANVABVAC9ANtwEPgBnAzbwiXJIHrJbVqeJSVtDspVkw4UdI1L3SLpEOSqiUVm02RpKWSDkh64tlmJJUNlWSGpE5zaJdUFymiKCJbI+ml+X2RNDcpyRhJ3WZ4WdJoTzdJ0hlJA17VFyWlg2RnTddnPn8luWUGTYHjNEkdXvA33nOPpPLA/pzpmsMkm0zRFWlFxks+1ftu503+NOLz2nQNfpJcpasC43KTf0iYnKzpKwP5YpN/dvtCYDlQBrwCMsGEV9p6PeEEXLF1USB/ZjweWOuSbDbFqUiQLlvnJSSZb2t3RHfC1q14c74k0o5CG0lHWwJdjckHJaUivhWmb3ObXtuUJvR9gzdN7mMflHTak9Un+KVM/xPPuDjB2PFOqzik/Xl8HP929g4g+4CxQCnwKaH3OaoCZgIdwL0hbIuAH8DgSCALLDTnWJLJwDIrwg1KATAHmAX0AI+8AfEpbc/t7pVOWgv2Ba9aK+lqpEUxcoC6LvDfZnYXXLtW2vl4YaM6BWgE6qySAaAJaAE6bT8KmG4jXAukzNbdKw3AO+C+3UEbc1lzwHjEoEWGxjsSxtNnB6TbDbUdfZN02J773XcPXy1HxxIgPR+7M3U0Nn2+0wNTPP/H4CHfsTitMaifIOmrGTT+Z4LjHgqkY0mwG63Xq2TFMINXSXpsfgMhRMUcXAW3vb7elbTH4HycpBGSSiQtkLTLu28cuUSzw5j5qtsr6X3kTMTg5aNhWjTWcP671ttZcKe+3CDoO/AWaLa75hLwK+oN/AHXnR+QHA+eawAAAABJRU5ErkJggg==" />
                                    </svg>
                                    @auth
                                        <span class="account-owner">Hello! {{ auth()->user()->name }}</span>
                                    @endauth
                                </a>
                            </li>
                            <li class="nav-item">
                                <livewire:frontend.cart.cart-item-counter />
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- search -->
    <div class="search-main-wrapper d-none" id="search-show">
        <input type="search" class="form-control" id="exampleFormControlInput1" placeholder="Item Title">
        <div class="serach-over-flow-wrap">
            <div class="search-container">
                <div class="srch-pic-holder" style="background-image:url('/images/search-One.png');"></div>
                <div class="search-data-cont">
                    <h3>Item Title</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consec tet adipiscing elit,
                        sed diam nibh euismod tincidunt ut laoreet dolore magna cuim.
                    </p>
                    <a href="my-cart">Add to Cart &#8594;</a>
                </div>
                <div class="search-data-price">
                    <h4>$15.99</h4>
                </div>
            </div>
            <div class="search-arrow-set"></div>
            <div class="hr search-sp-hr"></div>
            <div class="search-container">
                <div class="srch-pic-holder" style="background-image:url('/images/search-Two.png');"></div>
                <div class="search-data-cont">
                    <h3>Item Title</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consec tet adipiscing elit,
                        sed diam nibh euismod tincidunt ut laoreet dolore magna cuim.
                    </p>
                    <a href="my-cart">Add to Cart &#8594;</a>
                </div>
                <div class="search-data-price">
                    <h4>$15.99</h4>
                </div>
            </div>
            <div class="hr search-sp-hr"></div>
            <div class="search-container">
                <div class="srch-pic-holder" style="background-image:url('/images/search-Three.png');"></div>
                <div class="search-data-cont">
                    <h3>Item Title</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consec tet adipiscing elit,
                        sed diam nibh euismod tincidunt ut laoreet dolore magna cuim.
                    </p>
                    <a href="my-cart">Add to Cart &#8594;</a>
                </div>
                <div class="search-data-price">
                    <h4>$15.99</h4>
                </div>
            </div>
        </div>

    </div>
</header>


<script>
    function showSearch() {
        let showSearch = document.getElementById('search-show');
        showSearch.classList.toggle('d-block');
    }
</script>
