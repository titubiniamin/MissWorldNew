@extends('website.layouts.app')
@section('main-container')
    <style>

        img {
            vertical-align: middle;
        }

        /* Position the image container (needed to position the left and right arrows) */
        .img-container {
            position: relative;
            width: 94%;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            width: 16.66%;
        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }
    </style>


    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->

                    <div class="single-post">
                        <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span>
                            <span>Jul 5th '22</span></div>
                        <h1 class="mb-5">13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h1>
                        <p><span class="firstcharacter">L</span>orem ipsum dolor sit, amet consectetur adipisicing elit.
                            Ratione officia sed, suscipit distinctio, numquam omnis quo fuga ipsam quis inventore
                            voluptatum recusandae culpa, unde doloribus saepe labore alias voluptate expedita? Dicta
                            delectus beatae explicabo odio voluptatibus quas, saepe qui aperiam autem obcaecati, illo
                            et! Incidunt voluptas culpa neque repellat sint, accusamus beatae, cumque autem tempore
                            quisquam quam eligendi harum debitis.</p>

                        <figure class="my-4">

                            <h2 style="text-align:center">Slideshow Gallery</h2>

                            <div class="img-container">

                                @for($i=1 ; $i<5 ; $i++)
                                    <div class="mySlides">
                                        <div class="numbertext">{{$i}} / 6</div>
                                        <img height="400px" width="100%"
                                             src="{{asset('website_assets/img/post-landscape-'.$i.'.jpg')}}">
                                    </div>
                                @endfor
                                <a class="prev" onclick="plusSlides(-1)">❮</a>
                                <a class="next" onclick="plusSlides(1)">❯</a>

                                <div class="caption-container">
                                    <p id="caption"></p>
                                </div>

                                <div class="row">
                                    @for($i=1 ; $i<5 ; $i++)
                                    <div class="column">
                                        <img class="demo cursor"
                                             src="{{asset('website_assets/img/post-landscape-'.$i.'.jpg')}}"
                                             style="width:100%" onclick="currentSlide({{$i}})" alt="The Woods">
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                            </figcaption>
                        </figure>
                        <p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur
                            ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas
                            expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis
                            reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil,
                            tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi
                            itaque numquam aliquam soluta.</p>
                        <p>Explicabo perspiciatis, laborum provident voluptates illum in nulla consectetur atque quaerat
                            excepturi quisquam, veniam velit ex pariatur quos consequuntur? Excepturi reiciendis
                            perferendis, cupiditate dolorem eos illum amet. Beatae voluptates nemo esse ratione
                            voluptate, nesciunt fugit magnam veritatis voluptas dignissimos doloribus maiores? Aliquam,
                            dolores natus exercitationem corrupti blanditiis, consequuntur nihil nobis sed voluptatibus
                            maiores sunt, illo provident aliquid laborum. Vitae, ut.</p>
                        <p>Reprehenderit aut sed doloribus blanditiis, aspernatur magni? In molestias rem, similique ut
                            esse repudiandae quod recusandae dolores neque earum omnis at, suscipit fuga? Minima qui
                            veniam deserunt quisquam error amet at ratione nesciunt porro quis placeat repudiandae
                            voluptatibus officiis fuga necessitatibus, expedita officia adipisci eaque labore accusamus?
                            Nesciunt repellat illo exercitationem facilis similique quaerat, quis sequi? Praesentium
                            nulla ipsam dolor.</p>
                        <p>Dolorum, incidunt! Adipisci harum itaque maxime dolores doloremque porro eligendi quis,
                            doloribus vel sit rerum sunt obcaecati nam suscipit nulla vitae alias blanditiis aliquam
                            debitis atque illo modi et placeat. Ratione iure eveniet provident. Culpa laboriosam sed ad
                            quia. Corrupti, earum, perferendis dolore cupiditate sint nihil maiores iusto tempora nobis
                            porro itaque est. Ut laborum culpa assumenda pariatur et perferendis?</p>
                        <p>Est soluta veritatis laboriosam, consequuntur temporibus asperiores, fugit id a ullam sed,
                            expedita sequi doloribus fugiat. Odio et necessitatibus enim nam, iste reprehenderit
                            cupiditate omnis ut iure aliquid obcaecati, repellendus nemo provident eveniet tempora
                            minus! Voluptates aut laboriosam, maiores nihil accusantium, a dolorum quaerat tenetur illo
                            eum culpa cum laudantium sunt doloremque modi possimus magni? Perferendis cum repudiandae
                            corrupti porro.</p>
                        <figure class="my-4">
                            <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
                            <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                            </figcaption>
                        </figure>
                        <p>Quis molestiae, dolorem consequuntur labore perferendis enim accusantium commodi optio, sequi
                            magnam ad consectetur iste omnis! Voluptatibus, quia officia esse necessitatibus magnam
                            tempore reprehenderit quo aspernatur! Assumenda, minus dolorem repellendus corporis corrupti
                            quia temporibus repudiandae in. Sit rem aut, consectetur repudiandae perferendis nemo alias,
                            iure ipsam omnis quam soluta, nobis animi quis aliquam blanditiis at. Dicta nemo vero sequi
                            exercitationem.</p>
                        <p>Architecto ex id at illum aperiam corporis, quidem magnam doloribus non eligendi delectus
                            laborum porro molestiae beatae eveniet dolor odit optio soluta dolores! Eaque odit a nihil
                            recusandae, error repellendus debitis ex autem ab commodi, maiores officiis doloribus
                            provident optio, architecto assumenda! Nihil cum laboriosam eos dolore aliquid perferendis
                            amet doloremque quibusdam odio soluta vero odit, ipsa, quisquam quod nulla.</p>
                        <p>Consequuntur corrupti fugiat quod! Ducimus sequi nemo illo ad necessitatibus amet nobis
                            corporis et quasi. Optio cum neque fuga. Ad excepturi magnam quisquam ex voluptatibus vitae
                            aut nam quidem doloribus, architecto perspiciatis sit consequatur pariatur alias animi
                            expedita quas? Et doloribus voluptatibus perferendis qui fugiat voluptatum autem facere
                            aspernatur quidem quae assumenda iste, sit similique, necessitatibus laborum magni. Ea,
                            dolores!</p>
                        <p>Possimus temporibus rerum illo quia repudiandae provident sed quas atque. Ipsam adipisci
                            accusamus iste optio illo aliquam molestias? Voluptatibus, veniam recusandae facilis nobis
                            perspiciatis rem similique, nisi ad explicabo ipsa voluptatum, inventore molestiae natus
                            adipisci? Fuga delectus quia assumenda totam aspernatur. Nobis hic ea rem, quaerat voluptate
                            vero illum laboriosam omnis aspernatur labore, natus ex iusto ducimus exercitationem a
                            officia.</p>
                    </div><!-- End Single Post Content -->


                </div>
                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <div class="aside-block">

                        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-popular" type="button" role="tab"
                                        aria-controls="pills-popular" aria-selected="true">Popular
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-trending" type="button" role="tab"
                                        aria-controls="pills-trending" aria-selected="false">Trending
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">Latest
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            <!-- Popular -->
                            <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                 aria-labelledby="pills-popular-tab">
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Sport</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video
                                            Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will
                                            Inspire Your New Haircut</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium
                                            Hair</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                                    </h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples
                                            Away)</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should
                                            Know</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div> <!-- End Popular -->

                            <!-- Trending -->
                            <div class="tab-pane fade" id="pills-trending" role="tabpanel"
                                 aria-labelledby="pills-trending-tab">
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will
                                            Inspire Your New Haircut</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium
                                            Hair</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                                    </h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Sport</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video
                                            Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples
                                            Away)</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should
                                            Know</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div> <!-- End Trending -->

                            <!-- Latest -->
                            <div class="tab-pane fade" id="pills-latest" role="tabpanel"
                                 aria-labelledby="pills-latest-tab">
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                                    </h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">The Best Homemade Masks for Face (keep the Pimples
                                            Away)</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">10 Life-Changing Hacks Every Working Mom Should
                                            Know</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Sport</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">How to Avoid Distraction and Stay Focused During Video
                                            Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span>
                                        <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will
                                            Inspire Your New Haircut</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="#">9 Half-up/half-down Hairstyles for Long and Medium
                                            Hair</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                            </div> <!-- End Latest -->

                        </div>
                    </div>

                    <div class="aside-block">
                        <h3 class="aside-title">Video</h3>
                        <div class="video-post">
                            <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
                                <span class="bi-play-fill"></span>
                                <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div><!-- End Video -->

                    <div class="aside-block">
                        <h3 class="aside-title">Categories</h3>
                        <ul class="aside-links list-unstyled">
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Culture</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Sport</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Food</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Politics</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Startups</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Travel</a></li>
                        </ul>
                    </div><!-- End Categories -->

                    <div class="aside-block">
                        <h3 class="aside-title">Tags</h3>
                        <ul class="aside-tags list-unstyled">
                            <li><a href="category.html">Business</a></li>
                            <li><a href="category.html">Culture</a></li>
                            <li><a href="category.html">Sport</a></li>
                            <li><a href="category.html">Food</a></li>
                            <li><a href="category.html">Politics</a></li>
                            <li><a href="category.html">Celebrity</a></li>
                            <li><a href="category.html">Startups</a></li>
                            <li><a href="category.html">Travel</a></li>
                        </ul>
                    </div><!-- End Tags -->

                </div>
            </div>
        </div>
    </section>
@endsection


<script>

    let slideIndex = 1;
    setTimeout(() => {
        showSlides(slideIndex);
    }, 1000)

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
