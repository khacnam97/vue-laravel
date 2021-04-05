// App.vue

<template>
    <div class="">
        <header class="item header margin-top-0">
            <div class="wrapper">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <router-link to="/" class="nav-link">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/create" class="nav-link">Create Post</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/posts" class="nav-link">Posts</router-link>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="text-homeimage">
                                <div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
                                    Increase Digital Sales
                                </div>
                                <div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
                                    Boost revenue with Scorilo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
        <!-- FOOTER =============================-->
        <div class="footer text-center">
            <div class="container">
                <div class="row">
                    <p class="footernote">
                        Connect with Scorilo
                    </p>
                    <ul class="social-iconsfooter">
                        <li><a href="#"><i class="fa fa-phone"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                    <p>
                        &copy; 2017 Your Website Name<br/>
                        Scorilo - Free template by <a href="https://www.wowthemes.net/">WowThemesNet</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s
}
.fade-enter, .fade-leave-active {
    opacity: 0
}
</style>
