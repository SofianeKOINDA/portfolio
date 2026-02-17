    <!-- Section Header-->

<!DOCTYPE html>
<html lang="en">

@include('sections.vitrine.head')


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

