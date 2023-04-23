<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Batang Toru-Tapanuli Selatan</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Impact - v1.1.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <section id="topbar" class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">batangtoru@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+628</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com/tp.pkk_kec.batangtoru?igshid=YmMyMTA2M2Y=" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </section><!-- End Top Bar -->

    <header id="header" class="header d-flex align-items-center">

        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <img src="<?= base_url(); ?>/assets/img/favicon.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">

                <h1>SIDABORU<span>.</span></h1>

            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hero">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Program PKK</a></li>
                    <li><a href="#portfolio">Galeri</a></li>
                    <li><a href="#team">Tim Kami</a></li>
                    <li><a href="#footer">kontak</a></li>
                </ul>
            </nav><!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">

                    <h2>Selamat Datang<span></span></h2>
                    <p>Sistem Aplikasi Pendataan Anggota Dasawisma di Kecamatan BatangToru Kabupaten Tapanuli Selatan.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started">Mulai</a>
                        <?php if (user_id()) { ?>
                            <a href="/dashboard" class="btn-get-started"><i class="bi bi-house-heart"></i><span> Beranda</span></a>

                        <?php } else { ?>
                            <a href="/login" class="btn-get-started"><i class="bi bi-box-arrow-in-left"></i><span> Masuk</span></a>
                        <?php }; ?>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="<?= base_url(); ?>/assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-easel"></i></div>
                            <h4 class="title"><a href="/login" class="stretched-link">Usaha Peningkatan Pendapatan Keluarga (UP2K)</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-house-heart"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Pemanfaat Lahan Pekarangan</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Industri Rumah Tangga</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-briefcase"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Kerja Bakti</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Tentang</h2>
                    <p align="justify">&emsp;&emsp;Dasawisma adalah kelompok ibu berasal dari 10 KK (kepala keluarga) rumah yang bertetangga untuk mempermudah jalannya suatu program. Pengumpulan dana, kuesioner, tertib administrasi, adalah beberapa contoh tanggungjawab ketua dawis, untuk kemudian hasilnya diteruskan ke ketua PKK. Kegiatannya diarahkan pada peningkatan kesehatan keluarga. Bentuk kegiatannya seperti arisan (PKK), pembuatan jamban, sumur, kembangkan dana sehat (PMT, pengobatan ringan, membangun sarana sampah dan kotoran). Kelompok Dasa Wisma adalah kelompok yang terdiri dari 10 – 20 kepala keluarga (KK) dalam satu RT. Setelah terbentuk kelompok, maka diangkatlah satu orang yang memiliki tanggung jawab sebagai ketua.
                    </p>
                    <p align="justify">&emsp;&emsp;Pengembangan Desa Siaga dilaksanakan melalui pembentukan Poskesdes, yaitu salah satu upaya kesehatan bersumberdaya masyarakat ( UKBM ) yang dibentuk di desa dalam rangka mendekatkan / menyediakan pelayanan kesehatan dasar bagi masyarakat desa yang meliputi kegiatan peningkatan hidup sehat ( promotif ), pencegahan penyakit ( preventif ), pengobatan (kuratif) yang dilaksanakan oleh tenaga kesehatan ( terutama bidan ) dengan melibatkan kader atau tenaga sukarela lainnya. Desa Siaga dikembangkan melalui penyiapan masyarakat, pengenalan masalah, perumusan tindak lanjut pencapaian khususnya kesepakatan pembentukan Poskesdes dan dukungan sumberdaya.
                    </p>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-6">
                        <h3>Tujuan Dasawisma</h3>
                        <img src="<?= base_url(); ?>/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p align="justify">&emsp;&emsp;Tujuan kelompok Dasa Wisma ini adalah membantu kelancaran tugas-tugas pokok dan program PKK kelurahan. Kegiatannya diarahkan pada peningkatan kesehatan keluarga. Bentuk kegiatannya seperti arisan, pembuatan jamban, sumur, kembangkan dana sehat (PMT, pengobatan ringan, membangun sarana sampah dan kotoran)
                        </p>
                        <p align="justify">&emsp;&emsp;Secara umum tujuan dari kegiatan tersebut yang berbasis masyarakat adalah terciptanya sistem kewaspadaan dan kesiapsiagaan dini di masyarakat terhadap kemungkinan terjadinya penyakit dan masalah-masalah kesehatan yang akan mengancam dan merugikan masyarakat yang bersangkutan.
                            Dasa Wisma sebagai salah satu wadah kegiatan masyarakat memiliki peran yang sangat penting dalam pelaksanaan program-program kegiatan gerakan PKK di tingkat desa,yang nantinya akan berpengaruh pula pada kegiatan gerakan PKK di tingkat Kecamatan dan Kabupaten.</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic" align="justify">
                                Kerangka pikir pertama adalah bahwa Desa Siaga akan dapat terwujud apabila manajemen dalam pelaksanaan pengembangannya diselenggarakan secara paripurna oleh berbagai pihak (unit-unit kesehatan dan pemangku kepentingan lain yang terkait).
                                Hasil pemantauan oleh masyarakat diinformasikan kepada petugas kesehatan atau unit yang bertanggung jawab untuk dapatnya diambil tindakan penanggulangan secara efektif dan efisien. Kegiatan yang dilakukan oleh masyarakat merupakan kegiatan dalam rangka kewaspadaan dini terhadap ancaman muncul atau berkembangnya penyakit/masalah kesehatan yang disebabkan antara lain oleh status gizi, kondisi lingkungan dan perilaku masyarakat (surveilans).
                            </p>
                            <ul>
                                Beberapa masalah kesehatan yang menjadi jangkauan kerja dari anggota dasawisma sebagai berikut :
                                <br>
                                <li><i class="bi bi-check-circle-fill"></i> Usaha perbaikan gizi keluarga.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masalah pertumbuhan anak.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Makanan sehat bagi keluarga.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masalah kebersihan lingkungan.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masalah bencana dan kegawatdaruratan kesehatan termasuk resikonya.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masalah kesehatan ibu, bayi dan balita.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Masalah penyakit.</li>
                            </ul>

                            <div class="position-relative mt-4">
                                <img src="<?= base_url(); ?>/assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                                <a href="https://www.youtube.com/watch?v=GkIHwJsJ6LI" class="glightbox play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="zoom-out">

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a href="https://tapselkab.go.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-1.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://batangtoru.tapselkab.go.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-5.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-2.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://batuhula.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-3.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://satahi.go.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-4.png" class="img-fluid" alt=""></a></div>

                        <div class="swiper-slide"><a href="https://muarahutaraja.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-6.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://napa.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-7.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://telo.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-8.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://sumuran.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-9.png" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a href="https://aekpining.batangtoru.id/"><img src="<?= base_url(); ?>/assets/img/clients/client-10.png" class="img-fluid" alt=""></a></div>



                    </div>
                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Stats Counter Section ======= -->
        <section id="stats-counter" class="stats-counter">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 align-items-center">

                    <div class="col-lg-6">
                        <img src="<?= base_url(); ?>/assets/img/stats-img.svg" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6">

                        <div class="stats-item d-flex align-items-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $countBalita ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Jumlah Balita</strong> di Kecamatan Batangtoru</p>
                        </div><!-- End Stats Item -->

                        <div class="stats-item d-flex align-items-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $countPUS + $countPUS; ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>PUS</strong> di Kecamatan Batangtoru</p>
                        </div><!-- End Stats Item -->

                        <div class="stats-item d-flex align-items-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $countWUS + $countWUS1; ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>WUS</strong> di Kecamatan Batangtoru</p>
                        </div><!-- End Stats Item -->

                        <div class="stats-item d-flex align-items-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?= $countLU + $countLU1; ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Lansia</strong> di Kecamatan Batangtoru</p>
                        </div><!-- End Stats Item -->
                    </div>

                </div>

            </div>
        </section><!-- End Stats Counter Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action" class="call-to-action">
            <div class="container text-center" data-aos="zoom-out">
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                <h3>Profil Batangtoru</h3>
                <p> Batang Toru adalah sebuah kecamatan yang berada di Kabupaten Tapanuli Selatan, provinsi Sumatra Utara, Indonesia. Ibu kota kecamatan ini berada di Batang Toru, tepatnya di kelurahan Wek I. Kecamatan Batang Toru berbatasan dengan dua kecamatan dan kabupaten, yaitu kecamatan Sibabangun, Tapanuli Tengah dan kecamatan Purba Tua, Tapanuli Utara</p>
                <a class="cta-btn" href="#">Kembali</a>
            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= Our Services Section ======= -->
        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>10 Program Pokok PKK</h2>
                    <p>Untuk melaksanakan 10 Program Pokok PKK tersebut, mulai dari tahap perencanaan, pelaksanaan, pembinaan sampai fasilitasi, telah dilakukan oleh 4 Kelompok Kerja secara luwes dan koordinatif, yaitu :</p>
                </div>

                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="bi bi-1-circle"></i>
                            </div>
                            <h3>PROGRAM POKJA I</h3>
                            <p align="justify">Pokja I mengelola Program Penghayatan dan Pengamalan Pancasila dan Program Gotong Royong.</p>
                            <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-2-circle"></i>
                            </div>
                            <h3>PROGRAM POKJA II</h3>
                            <p align="justify">Pokja II mengelola Program Pendidikan dan Keterampilan serta Pengembangan Kehidupan Berkoperasi.</p>
                            <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-3-circle"></i>
                            </div>
                            <h3>PROGRAM POKJA III</h3>
                            <p align="justify">Pokja III mengelola program pangan, sandang, perumahan dan tata laksana rumah tangga.</p>
                            <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-4-circle"></i>
                            </div>
                            <h3>PROGRAM POKJA IV</h3>
                            <p align="justify">Mengelola Program Kesehatan, Kelestarian Lingkungan Hidup dan Perencanaan Sehat.</p>
                            <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>
        </section><!-- End Our Services Section -->


        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Galeri</h2>
                    <p>Galeri-galeri kegiatan PKK Kecamatan Batangtoru</p>
                </div>

                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                    <div>
                        <ul class="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-bkmt">BKMT</li>
                            <li data-filter=".filter-bank">Bank Sampah</li>
                            <li data-filter=".filter-bantuan">Bantuan</li>
                            <li data-filter=".filter-kesehatan">Kesehatan</li>
                        </ul><!-- End Portfolio Filters -->
                    </div>

                    <div class="row gy-4 portfolio-container">

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bkmt">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bkmt-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bkmt-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">BKMT</a></h4>
                                    <p>Kegiatan BKMT Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-kesehatan">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/kesehatan-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/kesehatan-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Kesehatan</a></h4>
                                    <p>Kegiatan Bantuan Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bantuan">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bantuan-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bantuan-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Bantuan</a></h4>
                                    <p>Kegiatan Bantuan Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bkmt">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bkmt-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bkmt-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">BKMT</a></h4>
                                    <p>Kegiatan BKMT Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bantuan">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bantuan-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bantuan-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Bantuan</a></h4>
                                    <p>Kegiatan BKMT Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-kesehatan">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/kesehatan-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/kesehatan-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Kesehatan</a></h4>
                                    <p>Kegiatan Bank Sampah Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bkmt">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bkmt-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bkmt-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">BKMT</a></h4>
                                    <p>Kegiatan BKMT Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-bank">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/bank-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/bank-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Bank Sampah</a></h4>
                                    <p>Kegiatan Bank Sampah Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-kesehatan">
                            <div class="portfolio-wrap">
                                <a href="<?= base_url(); ?>/assets/img/portfolio/kesehatan-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="<?= base_url(); ?>/assets/img/portfolio/kesehatan-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Kesehatan</a></h4>
                                    <p>Kegiatan Bank Sampah Kecamatan Batangtoru</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                    </div><!-- End Portfolio Container -->

                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Tim Kami</h2>
                    <p>Tim dasawisma Kecamatan Batangtoru</p>
                </div>

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                            <h4>Mara Tinggi, SAP., MM</h4>
                            <span>Camat Batangtoru</span>
                            <div class="social">

                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>

                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                            <h4>Ny. Diana Mara Tinggi</h4>
                            <span>Ketua PKK Kec. Batangtoru</span>
                            <div class="social">

                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>

                            </div>
                        </div>
                    </div><!-- End Team Member -->


                </div>

            </div>
        </section><!-- End Our Team Section -->


        <!-- ======= Recent Blog Posts Section ======= -->



    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span>E-Dasawisma</span>
                    </a>
                    <p>Aplikasi Dasawisma Online di Kecamatan Batangtoru Kabupaten Tapanuli Selatan.</p>
                    <div class="social-links d-flex mt-4">
                        <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Link Halaman</h4>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Tentang</a></li>
                        <li><a href="#">Program PKK</a></li>
                        <li><a href="#">Galeri</a></li>
                        <li><a href="#">Tim</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Kegiatan E-Dasawisma</h4>
                    <ul>
                        <li><a href="#">UP2K</a></li>
                        <li><a href="#">Pemanfaat Lahan Pekarangan</a></li>
                        <li><a href="#">Industri Rumah Tangga</a></li>
                        <li><a href="#">Kerja Bakti</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Kontak</h4>
                    <p>
                        Jl. Merdeka No.21, <br>
                        Wek I Batang Toru, Kec. Batang Toru, <br>
                        Kabupaten Tapanuli Selatan, Sumatera Utara 22738 <br>
                        <strong>Website:</strong> http://batangtoru.tapselkab.go.id<br>
                        <strong>Email:</strong> batangtoru.tapselkab@gmail.com<br>
                    </p>

                </div>

            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>E-Dasawisma</span></strong>. Batangtoru
            </div>
            <div class="credits">
                Batang Toru<a href="#">Tapanuli Selatan</a>
            </div>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assets/js/main.js"></script>

</body>

</html>