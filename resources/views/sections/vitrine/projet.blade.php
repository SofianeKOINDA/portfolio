<section id="portfolio" class="portfolio section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Portfolio</h2>
    <p>Quelques-uns de mes projets récents.</p>
  </div><!-- End Section Title -->

<div class="container isotope-layout" data-layout="masonry" data-default-filter="*" data-sort="original-order" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-3 filter-sidebar">
        <div class="filters-wrapper" data-aos="fade-right" data-aos-delay="150">
          <ul class="portfolio-filters isotope-filters">
            <li data-filter="*" class="filter-active">Tous</li>
            @foreach($categories as $cat)
              <li data-filter=".filter-{{ Str::slug($cat->nom) }}">{{ $cat->nom }}</li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="row gy-4 portfolio-container isotope-container" data-aos="fade-up" data-aos-delay="200">

    {{-- j'affiche les projets actifs envoyés par le contrôleur --}}
        @forelse($projets as $projet)
    {{-- On calcule le slug pour le filtrage Isotope --}}
    @php
        $categorySlug = $projet->categorie ? Str::slug($projet->categorie->nom) : 'autre';
    @endphp

    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-{{ $categorySlug }}">
        <div class="portfolio-wrap">
            {{-- Utilisation de la logique de chemin d'image sécurisée --}}
            <img src="{{ $projet->photo1 ? asset('storage/' . $projet->photo1) : asset('templates/templateVitrine/assets/img/portfolio/default.webp') }}" class="img-fluid" alt="{{ $projet->nom }}">

            <div class="portfolio-info">
                <div class="content">
                    {{-- On affiche la catégorie comme dans l'admin --}}
                    <span class="category">{{ $projet->categorie->nom ?? 'Autre' }}</span>
                    <h4>{{ $projet->nom }}</h4>

                    <div class="portfolio-links">
                        {{-- Lien Zoom Lightbox --}}
                        <a href="{{ $projet->photo1 ? asset('storage/' . $projet->photo1) : '#' }}" class="glightbox" title="{{ $projet->nom }}">
                            <i class="bi bi-plus-lg"></i>
                        </a>

                        {{-- Lien vers le projet --}}
                        <a href="{{ $projet->url ?? '#' }}" target="_blank">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-center">Aucun projet actif à afficher.</p>
@endforelse

        </div><!-- End Portfolio Container -->
      </div>
    </div>

  </div>

</section>
