@extends('layout.main')
@section('title', 'Pemulung')

@section('content')
<main id="main">
    <!-- ======= profile Section ======= -->
    <section id="profile" class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-2 photo">
                    <img src="{{ url('images/'.Auth::guard('pemulung')->user()->photo_collector) }}"><br>
                </div>

                <div class="col-md-7">
                    <h2>{{ Auth::guard('pemulung')->user()->username }}</h2>
                    <p>{{ Auth::guard('pemulung')->user()->email_collector }}</p>
                    <p>{{ Auth::guard('pemulung')->user()->phone_collector }}</p>
                </div>

                <!--div class="col-md-3">
                    <div class="row">
                    <div class="col">
                        <a href="{{ url('collector/edit') }}" method="get">
                            <i><img src="{{ url('assets/img/profile/edit.png') }}" width="50%">
                            <br></i>Edit Profil</a>
                    </div>
                    <div class="col">
                        <a href="{{ url('pemulung/salesreq') }}" method="get">
                            <i><img src="{{ url('assets/img/profile/sales.png') }}" width="75%">
                            <br></i>Request Order</a>
                    </div>
                    </div>
                </div-->
            </div>
        </div>
    </section>
    <!-- End profile Section -->

    <hr>

    <!-- Start Blog Area -->
    <section id="blog" class="blog-area">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Latest News</h2>
            </div>

            <div class="row">
                <!-- Start Left Blog -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog">
                        <div class="single-blog-img">
                            <a href="/blog">
                                <img src="{{ asset('assets/img/blog/1.jpg') }}" alt="" width="100%">
                            </a>
                        </div>
                        <div class="blog-meta">
                            <span class="comments-type">
                                <i class="fa fa-comment-o"></i>
                                <a href="#">13 comments</a>
                            </span>
                            <span class="date-type">
                                <i class="fa fa-calendar"></i>
                                <a href="#">2016-03-05 / 09:10:16</a>
                            </span>
                        </div>
                        <div class="blog-text">
                            <h4>
                                <a href="/blog">Assumenda repud eum veniam</a>
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio
                                modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda
                                repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                            </p>
                        </div>
                        <span>
                            <a href="/blog" class="ready-btn">Read more</a>
                        </span>
                    </div>
                    <!-- Start single blog -->
                </div>
                <!-- End Left Blog-->
                <!-- Start Left Blog -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog">
                        <div class="single-blog-img">
                            <a href="/blog">
                                <img src="{{ asset('assets/img/blog/2.jpg') }}" alt="" width="100%">
                            </a>
                        </div>
                        <div class="blog-meta">
                            <span class="comments-type">
                                <i class="fa fa-comment-o"></i>
                                <a href="#">130 comments</a>
                            </span>
                            <span class="date-type">
                                <i class="fa fa-calendar"></i>
                                <a href="#">2016-03-05 / 09:10:16</a>
                            </span>
                        </div>
                        <div class="blog-text">
                            <h4>
                                <a href="/blog">Explicabo magnam quibusdam.</a>
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio
                                modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda
                                repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                            </p>
                        </div>
                        <span>
                            <a href="/blog" class="ready-btn">Read more</a>
                        </span>
                    </div>
                    <!-- Start single blog -->
                </div>
                <!-- End Left Blog-->
                <!-- Start Right Blog-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog">
                        <div class="single-blog-img">
                            <a href="/blog">
                                <img src="{{ asset('assets/img/blog/3.jpg') }}" alt="" width="100%">
                            </a>
                        </div>
                        <div class="blog-meta">
                            <span class="comments-type">
                                <i class="fa fa-comment-o"></i>
                                <a href="#">10 comments</a>
                            </span>
                            <span class="date-type">
                                <i class="fa fa-calendar"></i>
                                <a href="#">2016-03-05 / 09:10:16</a>
                            </span>
                        </div>
                        <div class="blog-text">
                            <h4>
                                <a href="/blog">Lorem ipsum dolor sit amet</a>
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio
                                modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda
                                repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                            </p>
                        </div>
                        <span>
                            <a href="/blog" class="ready-btn">Read more</a>
                        </span>
                    </div>
                </div>
                <!-- End Right Blog-->
            </div>
        </div>
    </section>
    <!-- End Blog -->
    
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.
                    Quia fugiat sit
                    in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box iconbox-blue">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174">
                                </path>
                            </svg>
                            <i class="bx bx-trash"></i>
                        </div>
                        <h4><a href="">Waste Collecting</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="icon-box iconbox-orange ">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426">
                                </path>
                            </svg>
                            <i class="bx bx-dollar"></i>
                        </div>
                        <h4><a href="">Waste Monetization</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box iconbox-pink">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781">
                                </path>
                            </svg>
                            <i class="bx bx-coin-stack"></i>
                        </div>
                        <h4><a href="">Waste Measurement</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box iconbox-yellow">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813">
                                </path>
                            </svg>
                            <i class="bx bx-line-chart"></i>
                        </div>
                        <h4><a href="">Waste Analytics</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box iconbox-red">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572">
                                </path>
                            </svg>
                            <i class="bx bx-shopping-bag"></i>
                        </div>
                        <h4><a href="">Waste Donation</a></h4>
                        <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box iconbox-teal">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                    d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762">
                                </path>
                            </svg>
                            <i class="bx bx-recycle"></i>
                        </div>
                        <h4><a href="">Waste Transformation</a></h4>
                        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= type Section ======= -->
    <section id="type" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Types of Waste</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-pvc">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/pet.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>PET & PETE</h4>
                            <p>Polythylene Terepthalate</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/pet.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="PET"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/pet" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-hdpe">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/hdpe.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>HDPE</h4>
                            <p>High Density Polyethylene</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/hdpe.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="HDPE"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/hdpe" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-pet">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/pvc.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>PVC</h4>
                            <p>Polyvinyl Chloride</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/pvc.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="PVC"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/pvc" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-pvc">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/ldpe.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>LDPE</h4>
                            <p>Low Density Polyethylene</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/ldpe.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="LDPE"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/ldpe" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-hdpe">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/pp.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>PP</h4>
                            <p>Polypropylene</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/pp.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="PP"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/pp" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-pet">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/ps.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>PS</h4>
                            <p>Polystyrene</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/ps.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="PS"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/ps" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox"
                                    title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-pet">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/img/types/other.jpg') }}" class="img-fluid" alt="" width="100%">
                        <div class="portfolio-info">
                            <h4>Others</h4>
                            <p>Acrylic, Polycarbonate, Polyatics Fibers, Nylon, Fiberglass</p>
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/img/types/other.jpg') }}" data-gall="portfolioGallery"
                                    class="venobox" title="Others"><i class="bx bx-plus" width="100%"></i></a>
                                <a href="/other" data-gall="portfolioDetailsGallery" data-vbtype="iframe"
                                    class="venobox" title="Portfolio Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End type Section -->

    <!-- ======= Scale Section ======= -->
    <section id="scale" class="skills section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Scale of Waste</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row skills-content">

                <div class="col-lg-6">

                    <div class="progress">
                        <span class="skill">PET & PETE <i class="val">100%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">HDPE <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">PVC <i class="val">75%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">LDPE <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="progress">
                        <span class="skill">PP <i class="val">55%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">PS <i class="val">20%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">Others <i class="val">98%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Scale Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Facts</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-graffiti"></i>
                        <span data-toggle="counter-up">1,463</span>
                        <p>PET & PETE</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="icofont-water-bottle"></i>
                        <span data-toggle="counter-up">521</span>
                        <p>HDPE</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-plugin"></i>
                        <span data-toggle="counter-up">232</span>
                        <p>PVC</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-jacket"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>LDPE</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-lunch"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>PP</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-retro-music-disk"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>PS</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="icofont-baby-milk-bottle"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>Others</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Facts Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.
                    Quia fugiat sit
                    in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">
                <div class="col-lg-2 text-center">
                    <img src="{{ asset('assets/img/about.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-8 pt-4 pt-lg-0 content">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li>
                                    <h3>Vision</h3>
                                </li>
                                <li>
                                    <p class="icofont-rounded-right">Change trash to become surplus</p>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <ul>
                                <li>
                                    <h3>Mission</h3>
                                </li>
                                <li>
                                    <p class="icofont-rounded-right">Generating people to collecting the waste</p>
                                </li>
                                <li>
                                    <p class="icofont-rounded-right">Making value of waste</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <p>
                    Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt
                    adipisci omnis et
                    ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis.
                    Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus
                    itaque neque.
                    Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni
                    laudantium dolores.
                </p>
            </div>
        </div>
    </section>
    <!-- End About Section -->

</main>
@endsection