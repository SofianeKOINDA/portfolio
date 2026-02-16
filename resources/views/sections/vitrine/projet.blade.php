<section id="portfolio" class="portfolio section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Portfolio</h2>
    <p>Quelques-uns de mes projets récents.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

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

          {{-- Commentaire étudiant : j'affiche les projets actifs envoyés par le contrôleur --}}
          @forelse($projets as $projet)
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($projet->categorie->nom ?? 'autre') }}">
              <div class="portfolio-wrap">
                <img src="{{ asset($projet->photo1 ?? 'templates/templateVitrine/assets/img/portfolio/portfolio-portrait-1.webp') }}" class="img-fluid" alt="{{ $projet->nom }}" loading="lazy">
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">{{ $projet->categorie->nom ?? 'Autre' }}</span>
                    <h4>{{ $projet->nom }}</h4>
                    <div class="portfolio-links">
                      <a href="{{ asset($projet->photo1 ?? 'templates/templateVitrine/assets/img/portfolio/portfolio-portrait-1.webp') }}" class="glightbox" title="{{ $projet->nom }}"><i class="bi bi-plus-lg"></i></a>
                      @if(!empty($projet->url))
                        <a href="{{ $projet->url }}" title="Voir le projet" target="_blank"><i class="bi bi-arrow-right"></i></a>
                      @else
                        <a href="#" title="Plus de détails"><i class="bi bi-arrow-right"></i></a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
          @empty
            <p>Aucun projet à afficher pour le moment.</p>
          @endforelse

        </div><!-- End Portfolio Container -->
      </div>
    </div>

  </div>

</section>
