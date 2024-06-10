@extends('front.master-front')

@section('content')
    <div class="container-fluid mt-5 py-5 bg-warning overflow-hidden">
        <div class="swiper-container py-5 my-5">
            <div class="swiper-wrapper">
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
                <div class="swiper-slide p-3 d-flex flex-column justify-content-end">
                  <div class="bg-white w-100 p-2 mt-auto mb-0 opacity-75">
                    <h4 class="poppins-bold my-1 fs-6">Judul</h4>
                    <p class="my-1 lato-regular fs-6">Lorem Ipsum dolor sitamet</p>
                  </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            {{-- <div class="swiper-scrollbar"></div> --}}
        </div>
    </div>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center mt-0 shadow m-0 shadow-y-10 overflow-visible">
        <div class="container">

            <div class="row">
                <div class="col-md-4 position-relative px-auto">
                    <div class="card text-start card-badge-home shadow shadow-y-10">
                        <img class="card-img" src="{{ asset('front/img/pages/3.png')}}" alt="Title" />
                        <div class="card-footer position-absolute bottom-0 w-100 d-block bg-light opacity-75">
                            <h4 class="card-title float-start oswald-bold">Perumahan</h4>
                            <div class="float-end">
                            <a href="{{ url('data-table/perumahan')}}" class="btn btn-primary btn-sm float-right opacity-100">
                              Lihat Data <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </a>
                            </div>
                            {{-- <p class="card-text">Body</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 position-relative px-auto">
                    <div class="card text-start card-badge-home shadow shadow-y-10">
                        <img class="card-img" src="{{ asset('front/img/pages/4.png')}}" alt="Title" />
                        <div class="card-footer position-absolute bottom-0 w-100 d-block bg-light opacity-75">
                            <h4 class="card-title float-start oswald-bold">Pemukiman</h4>
                            <div class="float-end">
                            <a href="{{ url('data-table/perumahan')}}" class="btn btn-primary btn-sm float-right opacity-100">
                              Lihat Data <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </a>
                            </div>
                            {{-- <p class="card-text">Body</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 position-relative px-auto">
                    <div class="card text-start card-badge-home shadow shadow-y-10">
                        <img class="card-img" src="{{ asset('front/img/pages/5.png')}}" alt="Title" />
                        <div class="card-footer position-absolute bottom-0 w-100 d-block bg-light opacity-75">
                            <h4 class="card-title float-start oswald-bold">Sarana</h4>
                            <div class="float-end">
                            <a href="{{ url('data-table/perumahan')}}" class="btn btn-primary btn-sm float-right opacity-100">
                              Lihat Data <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </a>
                            </div>
                            {{-- <p class="card-text">Body</p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-3">
                <div class="col-lg-10 col-12 mx-auto d-flex flex-column justify-content-center">
                    {{-- <h1 data-aos="fade-up" class="poppins-light text-center text-color-4 fs-1">Selamat Datang di Website</h1> --}}
                    <h1 data-aos="fade-up" class="poppins-light text-center text-color-4 fs-4 mb-2">Sistem Informasi
                        Prasarana, Sarana dan Utilitas (SI-PSU)
                        Kalimantan Selatan</h1>
                    <p data-aos="fade-up" data-aos-delay="400" class="lato-light-italic fs-5  text-center">
                        Sistem yang digunakan untuk mengumpulkan, menyimpan, mengelola, dan menganalisis data terkait dengan
                        Prasarana, Sarana dan Utilitas di
                        wilayah Kalimantan Selatan.</p>
                    <!-- <div data-aos="fade-up" data-aos-delay="600">
                      <div class="text-center text-lg-start">
                        <a href="#about"
                          class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                          <span>Get Started</span>
                          <i class="bi bi-arrow-right"></i>
                        </a>
                      </div>
                    </div> -->
                </div>
                <!-- <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('storage/uploads/pages/image1 (3).jpeg')}}" class="img-fluid" alt="">
                  </div> -->
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <!-- <section id="about" class="about">

                <div class="container" data-aos="fade-up">
                  <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                      <div class="content">
                        <h3>Who We Are</h3>
                        <h2>Expedita voluptas omnis cupiditate totam eveniet nobis sint iste. Dolores est repellat corrupti
                          reprehenderit.</h2>
                        <p>
                          Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur
                          itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
                        </p>
                        <div class="text-center text-lg-start">
                          <a href="#"
                            class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Read More</span>
                            <i class="bi bi-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                      <img src="{{ asset('front/img/about.jpg')}}" class="img-fluid" alt="">
                    </div>

                  </div>
                </div>

              </section> --><!-- End About Section -->

        <!-- ======= Values Section ======= -->
        <!-- <section id="values" class="values">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Our Values</h2>
                    <p>Odit est perspiciatis laborum et dicta</p>
                  </header>

                  <div class="row">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                      <div class="box">
                        <img src="{{ asset('front/img/values-1.png"')}} class="img-fluid" alt="">
                        <h3>Ad cupiditate sed est odio</h3>
                        <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
                      </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                      <div class="box">
                        <img src="{{ asset('front/img/values-2.png"')}} class="img-fluid" alt="">
                        <h3>Voluptatem voluptatum alias</h3>
                        <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
                      </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                      <div class="box">
                        <img src="{{ asset('front/img/values-3.png"')}} class="img-fluid" alt="">
                        <h3>Fugit cupiditate alias nobis.</h3>
                        <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Values Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts shadowx py-5 m-0 my-5 bg-body-tertiaryx">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">
                    <header class="section-header">
                        <p>Rekapitulasi Data PSU</p>
                    </header>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-house"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                    class="purecounter"></span>
                                <p>Total Perumahan</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-building-fill-exclamation" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                    class="purecounter"></span>
                                <p>Total PSU</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-house-check-fill" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="1463"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Sudah BAST</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-house-slash-fill" style="color: #bb0852;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                                    class="purecounter"></span>
                                <p>Belum BAST</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features shadow shadow-y-10 py-5 m-0 my-5 bg-body-tertiaryx bg-white">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <!-- <h2>Features</h2> -->
                    <p>Jenis Data PSU</p>
                </header>

                <div class="row">

                    <div class="col-lg-6">
                        <img src="{{ asset('front/img/pages/2.png')}}" class="img-fluid" alt=""  data-aos="zoom-out" data-aos-delay="200">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>PSU Rumah Tapak </h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Rusun Sewa</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Jalan</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Drainase</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Air Limbah</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Persampahan</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Air Minum</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Penerangan Jalan Umum (PJU)</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Tempat Parkir Pada Rusun Sewa</h3>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> <!-- / row -->

                <!-- Feature Tabs -->
                <!-- <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                      <h3>Neque officiis dolore maiores et exercitationem quae est seda lidera pat claero</h3>

                      <!-- Tabs --/>
                      <ul class="nav nav-pills mb-3">
                        <li>
                          <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Saepe fuga</a>
                        </li>
                        <li>
                          <a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a>
                        </li>
                        <li>
                          <a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a>
                        </li>
                      </ul><!-- End Tabs -->

                <!-- Tab Content --/>
                      <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab1">
                          <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque
                            consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                          </div>
                          <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non
                            eveniet magni quaerat nemo et.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Incidunt non veritatis illum ea ut nisi</h4>
                          </div>
                          <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae
                            assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
                        </div><!-- End Tab 1 Content --/>

                        <div class="tab-pane fade show" id="tab2">
                          <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque
                            consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                          </div>
                          <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non
                            eveniet magni quaerat nemo et.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Incidunt non veritatis illum ea ut nisi</h4>
                          </div>
                          <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae
                            assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
                        </div><!-- End Tab 2 Content --/>

                        <div class="tab-pane fade show" id="tab3">
                          <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque
                            consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                          </div>
                          <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non
                            eveniet magni quaerat nemo et.</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check2"></i>
                            <h4>Incidunt non veritatis illum ea ut nisi</h4>
                          </div>
                          <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae
                            assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
                        </div><!-- End Tab 3 Content --/>

                      </div>

                    </div>

                    <div class="col-lg-6">
                      <img src="{{ asset('front/img/features-2.png"')}} class="img-fluid" alt="">
                    </div>

                  </div> --><!-- End Feature Tabs -->

                <!-- Feature Icons -->
                <!-- <div class="row feature-icons" data-aos="fade-up">
                    <h3>Ratione mollitia eos ab laudantium rerum beatae quo</h3>

                    <div class="row">

                      <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ asset('front/img/features-3.png"')}} class="img-fluid p-4" alt="">
                      </div>

                      <div class="col-xl-8 d-flex content">
                        <div class="row align-self-center gy-4">

                          <div class="col-md-6 icon-box" data-aos="fade-up">
                            <i class="ri-line-chart-line"></i>
                            <div>
                              <h4>Corporis voluptates sit</h4>
                              <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                            </div>
                          </div>

                          <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                            <i class="ri-stack-line"></i>
                            <div>
                              <h4>Ullamco laboris nisi</h4>
                              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                            </div>
                          </div>

                          <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                            <i class="ri-brush-4-line"></i>
                            <div>
                              <h4>Labore consequatur</h4>
                              <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                            </div>
                          </div>

                          <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                            <i class="ri-magic-line"></i>
                            <div>
                              <h4>Beatae veritatis</h4>
                              <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div>
                          </div>

                          <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                            <i class="ri-command-line"></i>
                            <div>
                              <h4>Molestiae dolor</h4>
                              <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>
                            </div>
                          </div>

                          <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                            <i class="ri-radar-line"></i>
                            <div>
                              <h4>Explicabo consectetur</h4>
                              <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>

                  </div> --><!-- End Feature Icons -->

            </div>

        </section><!-- End Features Section -->

        {{-- <!-- ======= Counts Section ======= -->
        <section class="section-space my-0 py-0">
            <div class="container-fluid mt-2"
                style="background-image: url(./uploads/pages/1.png);height: 100px;background-attachment: fixed;width: 100%;background-color: #9191910d;background-position: center;"
                data-aos="fade-in"></div>
        </section><!-- End Counts Section --> --}}

        <!-- ======= Services Section ======= -->
        <!-- <section id="services" class="services">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Services</h2>
                    <p>Veritatis et dolores facere numquam et praesentium</p>
                  </header>

                  <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                      <div class="service-box blue">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Nesciunt Mete</h3>
                        <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis
                          tempore et consequatur.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                      <div class="service-box orange">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Eosle Commodi</h3>
                        <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut
                          nesciunt dolorem.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                      <div class="service-box green">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Ledo Markt</h3>
                        <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos
                          earum corrupti.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                      <div class="service-box red">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Asperiores Commodi</h3>
                        <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident
                          adipisci neque.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                      <div class="service-box purple">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Velit Doloremque.</h3>
                        <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem
                          alias eius labore.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                      <div class="service-box pink">
                        <i class="ri-discuss-line icon"></i>
                        <h3>Dolori Architecto</h3>
                        <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae
                          ducimus enim.</p>
                        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Services Section -->

        <!-- ======= Pricing Section ======= -->
        <!-- <section id="pricing" class="pricing">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Pricing</h2>
                    <p>Check our Pricing</p>
                  </header>

                  <div class="row gy-4" data-aos="fade-left">

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                      <div class="box">
                        <h3 style="color: #07d5c0;">Free Plan</h3>
                        <div class="price"><sup>$</sup>0<span> / mo</span></div>
                        <img src="{{ asset('front/img/pricing-free.png"')}} class="img-fluid" alt="">
                        <ul>
                          <li>Aida dere</li>
                          <li>Nec feugiat nisl</li>
                          <li>Nulla at volutpat dola</li>
                          <li class="na">Pharetra massa</li>
                          <li class="na">Massa ultricies mi</li>
                        </ul>
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                      <div class="box">
                        <span class="featured">Featured</span>
                        <h3 style="color: #65c600;">Starter Plan</h3>
                        <div class="price"><sup>$</sup>19<span> / mo</span></div>
                        <img src="{{ asset('front/img/pricing-starter.png"')}} class="img-fluid" alt="">
                        <ul>
                          <li>Aida dere</li>
                          <li>Nec feugiat nisl</li>
                          <li>Nulla at volutpat dola</li>
                          <li>Pharetra massa</li>
                          <li class="na">Massa ultricies mi</li>
                        </ul>
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                      <div class="box">
                        <h3 style="color: #ff901c;">Business Plan</h3>
                        <div class="price"><sup>$</sup>29<span> / mo</span></div>
                        <img src="{{ asset('front/img/pricing-business.png"')}} class="img-fluid" alt="">
                        <ul>
                          <li>Aida dere</li>
                          <li>Nec feugiat nisl</li>
                          <li>Nulla at volutpat dola</li>
                          <li>Pharetra massa</li>
                          <li>Massa ultricies mi</li>
                        </ul>
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                      <div class="box">
                        <h3 style="color: #ff0071;">Ultimate Plan</h3>
                        <div class="price"><sup>$</sup>49<span> / mo</span></div>
                        <img src="{{ asset('front/img/pricing-ultimate.png"')}} class="img-fluid" alt="">
                        <ul>
                          <li>Aida dere</li>
                          <li>Nec feugiat nisl</li>
                          <li>Nulla at volutpat dola</li>
                          <li>Pharetra massa</li>
                          <li>Massa ultricies mi</li>
                        </ul>
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Pricing Section -->

        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq shadow shadow-y-10 py-5 m-0 my-5 bg-white">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>F.A.Q</h2>
                    <p>Pertanyaan Umum</p>
                </header>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- F.A.Q List 1-->
                        <div class="accordion accordion-flush" id="faqlist1">
                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingOne3">
                                        Jenis PSU apa saja yang wajib diserahkan oleh pengembang ke Pemerintah Daerah ?</b>
                                    </button>
                                </h2>
                                <div id="headingOne3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="card-body">
                                        <ul>
                                            <li>Jaringan Jalan</li>
                                            <li>Jaringan saluran pembuangan air hujan (drainase)</li>
                                            <li>Sarana pemakaman/tempat pemakaman</li>
                                            <li>Sarana pertamanan dan ruang terbuka hijau</li>
                                            <li>Sarana non-RTH (Fasos)</li>
                                            <li>Sarana penerangan jalan umum</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingTwo3">
                                        Bagaimana Alur Penyerahan PSU untuk Siteplan Baru ?
                                    </button>
                                </h2>
                                <div id="headingTwo3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="card-body">
                                        <img src="https://sipsu.dprkpp.web.id//images/faq1.png" width="100%">
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingThree3">
                                        Apa saja syarat syarat BAST Admin dalam penyerahan PSU ?
                                    </button>
                                </h2>
                                <div id="headingThree3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Fotocopy Kartu Tanda Penduduk (KTP) pemohon yang masih berlaku</li>
                                            <li>Fotocopy Akta Pendirian badan usaha/badan hukum penyelenggara
                                                perumahan/permukiman dan/atau
                                                perubahannya yang telah mendapat pengesahan dari pejabat yang berwenang</li>
                                            <li>Fotocopy bukti alas hak atas tanah pada lokasi yang akan dibangun perumahan
                                            </li>
                                            <li>rincian, spesifikasi, jenis, jumlah dan ukuran obyek yang akan diserahkan
                                                sesuai dengan standar
                                                teknis yang telah ditetapkan</li>
                                            <li>Daftar dan gambar rencana tapak (site plan, zoning dan lainlain) yang
                                                menjelaskan lokasi, jenis
                                                dan ukuran prasarana, sarana dan utilitas yang akan diserahkan kepada
                                                Pemerintah Daerah</li>
                                            <li>Jadwal/waktu penyelesaian pembangunan, masa pemeliharaan dan serah terima
                                                fisik prasarana,
                                                sarana dan utilitas</li>
                                            <li>Bukti setor/bukti pembayaran kompensasi berupa uang sebagai pengganti
                                                penyediaan tempat
                                                pemakaman umum apabila penyediaan tempat pemakaman umum dilakukan dengan
                                                cara menyerahkan
                                                kompensasi berupa uang kepada Pemerintah Daerah</li>
                                        </ol>
                                    </div>
                                </div><!-- collapse -->
                            </div>


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingFour3">
                                        Apa saja syarat syarat BAST Fisik dalam penyerahan PSU ?
                                    </button>
                                </h2>
                                <div id="headingFour3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Fotocopy Kartu Tanda Penduduk (KTP) pemohon yang masih berlaku</li>
                                            <li>Fotocopy Akta Pendirian badan usaha/badan hukum penyelenggara
                                                perumahan/permukiman dan/atau
                                                perubahannya yang telah mendapat kompensasi berupa uang kepada Pemerintah
                                                Daerah</li>
                                            <li>Fotocopy Surat Pemberitahuan Pajak Terutang Pajak Bumi dan Bangunan (SPPT
                                                PBB) dan Tanda Lunas
                                                Pajak Bumi dan Bangunan (PBB) tahun terakhir sesuai ketentuan yang berlaku
                                            </li>
                                            <li>Fotocopy sertipikat tanah atas nama pengembang yang peruntukkannya sebagai
                                                prasarana, sarana dan
                                                utilitas yang akan diserahkan kepada Pemerintah Daerah</li>
                                            <li>Daftar dan gambar rencana tapak (site plan, zoning dan lainlain) yang
                                                menjelaskan lokasi, jenis
                                                dan ukuran prasarana, sarana dan utilitas yang akan diserahkan kepada
                                                Pemerintah Daerah</li>
                                            <li>Fotocopy Berita Acara Serah Terima Administrasi</li>
                                            <li>Fotocopy akta notaris pernyataan pelepasan hak atas tanah dan/atau bangunan
                                                prasarana, sarana
                                                dan utilitas oleh Pemohon/Pengembang kepada Pemerintah Daerah</li>
                                        </ol>
                                    </div>
                                </div><!-- collapse -->
                            </div>


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingFourB3">
                                        Apakah Warga dapat menyerahkan PSU ke Pemerintah Daerah ?
                                    </button>
                                </h2>
                                <div id="headingFourB3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        Warga dapat menyerahkan PSU ke Pemerintah Daerah dalam hal pengembang tidak ada atau
                                        tidak diketahui
                                        keberadaanya.
                                    </div>
                                </div><!-- collapse -->
                            </div>


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingFive3">
                                        Bagaimana untuk tata cara penyerahan PSU jika pengembang tidak ada/ tidak diketahui
                                        ?
                                    </button>
                                </h2>
                                <div id="headingFive3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        <img src="https://sipsu.dprkpp.web.id//images/faq2.png" width="100%">
                                    </div>
                                </div><!-- collapse -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <!-- F.A.Q List 2-->
                        <div class="accordion accordion-flush" id="faqlist2">


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingSix3">
                                        Apakah Pengembang Perorangan wajib menyerahkan PSU ?
                                    </button>
                                </h2>
                                <div id="headingSix3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Untuk Pengembang Perorangan dapat menyerahkan PSU kepada Pemkot Surabaya melalui
                                        proses Hibah
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingSeven3">
                                        Berapa Luas Minimal Perumahan yang Wajib menyediakan dan menyerahkan PSU ?
                                    </button>
                                </h2>
                                <div id="headingSeven3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Sesuai dengan Perwali No. 14 Tahun 2016, yang wajib menyerahkan PSU adalah
                                        Pengembang yang berbadan
                                        hukum
                                        yang melakukan pembangunan perumahan dengan luas lebih besat atau sama dengan 1000
                                        m2 (seribu meter persegi) atau sampai dengan 10 (sepuluh) kavling atau badan
                                        usaha/badan hukum
                                        penyelenggara pembangunan
                                        perumahan, pemukiman, perdagangan dan/atau industri
                                    </div>
                                </div><!-- collapse -->
                            </div>


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingEight3">
                                        Bagaimana jika Pengembang tidak menyerahkan PSU ?
                                    </button>
                                </h2>
                                <div id="headingEight3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Sesuai dengan Perwali No. 14 Tahun 2016, Pengembang yang tidak menyediakan PSU,
                                        tidak menyerahkan PSU,
                                        dan
                                        tidak sanggup memperbaiki dan memelihara prasarana dan sarana yang tidak sesuai
                                        dengan syarat teknis
                                        yang
                                        ditetapkan, dapat diberikan sanksi administratif berupa :<br>
                                        <ul>
                                            <li>
                                                Dimasukkan ke dalam daftar hitam (black list)
                                            </li>
                                            <li>
                                                Pengumuman kepada media massa
                                            </li>
                                            <li>
                                                Denda administrasi sebesar Rp. 50.000.000 (lima puluh juta rupiah)
                                            </li>
                                            <li>
                                                Penundaan pemberian persetujuan dokumen dan/atau perizinan
                                            </li>
                                            <li>
                                                Peringatan tertulis
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- collapse -->
                            </div>


                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingNine3">
                                        Bagaimana warga dapat memanfaatkan lahan PSU yang sudah diserahkan ?
                                    </button>
                                </h2>
                                <div id="headingNine3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Warga bisa bersurat kepada Walikota terkait pemanfaatan lahan fasum pada perumahan
                                        yang dimaksud.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="accordion-item">

                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#headingTen3">
                                        Pertanyaan Anda Tidak ada dalam daftar ini ?
                                    </button>
                                </h2>
                                <div id="headingTen3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Silakan chat dengan petugas kami, dengan klik pada tombol lingkaran di kanan bawah
                                        layar.
                                    </div>
                                </div><!-- collapse -->
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End F.A.Q Section -->

        <!-- ======= Portfolio Section ======= -->
        <!-- <section id="portfolio" class="portfolio">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Portfolio</h2>
                    <p>Check our latest work</p>
                  </header>

                  <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                      <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                      </ul>
                    </div>
                  </div>

                  <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>App 1</h4>
                          <p>App</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-1.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Web 3</h4>
                          <p>Web</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-2.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-3.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>App 2</h4>
                          <p>App</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-3.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="App 2"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-4.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Card 2</h4>
                          <p>Card</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-4.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Card 2"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-5.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Web 2</h4>
                          <p>Web</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-5.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Web 2"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-6.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>App 3</h4>
                          <p>App</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-6.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="App 3"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-7.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Card 1</h4>
                          <p>Card</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-7.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Card 1"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-8.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Card 3</h4>
                          <p>Card</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-8.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Card 3"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                      <div class="portfolio-wrap">
                        <img src="{{ asset('front/img/portfolio/portfolio-9.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Web 3</h4>
                          <p>Web</p>
                          <div class="portfolio-links">
                            <a href="{{ asset('front/img/portfolio/portfolio-9.jpg')}}" data-gallery="portfolioGallery"
                              class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Portfolio Section -->

        {{-- <!-- ======= Counts Section ======= -->
        <section class="section-space my-0 py-0">
            <div class="container-fluid mt-2"
                style="background-image: url(./uploads/pages/1.png);height: 100px;background-attachment: fixed;width: 100%;background-color: #9191910d;background-position: center;"
                data-aos="fade-in"></div>
        </section><!-- End Counts Section --> --}}

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials bg-body-tertiary">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Perumahan</h2>
                    <p>Highlight Data Perumahan</p>
                </header>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (9).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (9).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Banjarmasin Barat</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (10).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (10).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Bakarangan</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (11).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (11).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Tanjung</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (12).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (12).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Tebing Tinggi</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (13).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (13).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Wanaraya</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (1).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (1).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Sungai Padan</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (2).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (2).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Salam Babaris</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/uploads/perumahan/perumahan (3).jpg')}}');">
                            <div class="testimonial-item">
                                <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('storage/uploads/perumahan/perumahan (3).jpg')}}"
                                            class="img-fluid" alt=""></div>
                                    <h3 class="post-title">Perumahan Banjang</h3>
                                    <h4 class="post-title">PT. Mulia Sejahtera</h4>
                                    <a class="btn btn-sm rounded-5 mt-2 btn-primary" href="#">
                                      Selengkapnya <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                                    </a>
                                    <!-- <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div><!-- End testimonial item -->


                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- End Testimonials Section -->

        <!-- ======= Team Section ======= -->
        <!-- <section id="team" class="team">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Team</h2>
                    <p>Our hard working team</p>
                  </header>

                  <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                      <div class="member">
                        <div class="member-img">
                          <img src="{{ asset('front/img/team/team-1.jpg')}}" class="img-fluid" alt="">
                          <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                          </div>
                        </div>
                        <div class="member-info">
                          <h4>Walter White</h4>
                          <span>Chief Executive Officer</span>
                          <p>Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum
                            exercitationem iure minima enim corporis et voluptate.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                      <div class="member">
                        <div class="member-img">
                          <img src="{{ asset('front/img/team/team-2.jpg')}}" class="img-fluid" alt="">
                          <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                          </div>
                        </div>
                        <div class="member-info">
                          <h4>Sarah Jhonson</h4>
                          <span>Product Manager</span>
                          <p>Quo esse repellendus quia id. Est eum et accusantium pariatur fugit nihil minima suscipit corporis.
                            Voluptate sed quas reiciendis animi neque sapiente.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                      <div class="member">
                        <div class="member-img">
                          <img src="{{ asset('front/img/team/team-3.jpg')}}" class="img-fluid" alt="">
                          <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                          </div>
                        </div>
                        <div class="member-info">
                          <h4>William Anderson</h4>
                          <span>CTO</span>
                          <p>Vero omnis enim consequatur. Voluptas consectetur unde qui molestiae deserunt. Voluptates enim aut
                            architecto porro aspernatur molestiae modi.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                      <div class="member">
                        <div class="member-img">
                          <img src="{{ asset('front/img/team/team-4.jpg')}}" class="img-fluid" alt="">
                          <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                          </div>
                        </div>
                        <div class="member-info">
                          <h4>Amanda Jepson</h4>
                          <span>Accountant</span>
                          <p>Rerum voluptate non adipisci animi distinctio et deserunt amet voluptas. Quia aut aliquid doloremque ut
                            possimus ipsum officia.</p>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Team Section -->

        <!-- ======= Clients Section ======= -->
        <!-- <section id="clients" class="clients">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Our Clients</h2>
                    <p>Temporibus omnis officia</p>
                  </header>

                  <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-1.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-2.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-3.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-4.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-5.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-6.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-7.png')}}" class="img-fluid" alt=""></div>
                      <div class="swiper-slide"><img src="{{ asset('front/img/clients/client-8.png')}}" class="img-fluid" alt=""></div>
                    </div>
                    <div class="swiper-pagination"></div>
                  </div>
                </div>

              </section> --><!-- End Clients Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <!-- <section id="recent-blog-posts" class="recent-blog-posts">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Blog</h2>
                    <p>Recent posts form our Blog</p>
                  </header>

                  <div class="row">

                    <div class="col-lg-4">
                      <div class="post-box">
                        <div class="post-img"><img src="{{ asset('front/img/blog/blog-1.jpg')}}" class="img-fluid" alt=""></div>
                        <span class="post-date">Tue, September 15</span>
                        <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit</h3>
                        <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                            class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="post-box">
                        <div class="post-img"><img src="{{ asset('front/img/blog/blog-2.jpg')}}" class="img-fluid" alt=""></div>
                        <span class="post-date">Fri, August 28</span>
                        <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
                        <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                            class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="post-box">
                        <div class="post-img"><img src="{{ asset('front/img/blog/blog-3.jpg')}}" class="img-fluid" alt=""></div>
                        <span class="post-date">Mon, July 11</span>
                        <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>
                        <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                            class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>

                  </div>

                </div>

              </section> --><!-- End Recent Blog Posts Section -->

        <!-- ======= Contact Section ======= -->
        <!-- <section id="contact" class="contact">

                <div class="container" data-aos="fade-up">

                  <header class="section-header">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                  </header>

                  <div class="row gy-4">

                    <div class="col-lg-6">

                      <div class="row gy-4">
                        <div class="col-md-6">
                          <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>A108 Adam Street,<br>New York, NY 535022</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>info@example.com<br>contact@example.com</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>Open Hours</h3>
                            <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="col-lg-6">
                      <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">

                          <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                          </div>

                          <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                          </div>

                          <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                          </div>

                          <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                          </div>

                          <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>

                            <button type="submit">Send Message</button>
                          </div>

                        </div>
                      </form>

                    </div>

                  </div>

                </div>

              </section> --><!-- End Contact Section -->

    </main><!-- End #main -->
    <!-- ======= Counts Section ======= -->
    {{-- <section class="section-space my-0 py-0">
        <div class="container-fluid mt-2"
            style="background-image: url(./uploads/pages/1.png);height: 200px;background-attachment: fixed;width: 100%;background-color: #9191910d;background-position: center;"
            data-aos="fade-in"></div>
    </section><!-- End Counts Section --> --}}
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" preload />
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}" />
@endsection
@section('js')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection
