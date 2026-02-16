    <!-- Section Header-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - SnapFolio Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="templates/templateVitrine/templates/templateVitrine/assets/img/favicon.png" rel="icon">
  <link href="templates/templateVitrine/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="templates/templateVitrine/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="templates/templateVitrine/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: SnapFolio
  * Template URL: https://bootstrapmade.com/snapfolio-bootstrap-portfolio-template/
  * Updated: Jul 21 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

        <!-- Section menu-->

@include("sections.vitrine.menu")


  <main class="main">

    <!-- Hero banniere-->

@include("sections.vitrine.banniere")

    <!-- Section à propos -->

@include("sections.vitrine.apropos")

    <!--Section chiffrage-->

@include("sections.vitrine.chiffrage")

    <!-- Section competence-->

@include("sections.vitrine.competence")

    <!--Section cv-->

@include("sections.vitrine.cv")

    <!-- Section projet-->

@include("sections.vitrine.projet")

    <!-- Section Services  -->

@include("sections.vitrine.service")

    <!-- Section temoignage-->

@include("sections.vitrine.temoignage")

    <!-- Section Contact  -->

@include("sections.vitrine.contact")


  </main>

    <!-- footer  -->

@include("sections.vitrine.footer")

  <!-- section Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- section Preloader -->
  <div id="preloader"></div>

  <!-- Section JS -->
@include("sections.vitrine.script")

 