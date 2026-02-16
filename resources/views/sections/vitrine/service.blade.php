<section id="services" class="services section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Services</h2>
    <p>Les services que je propose pour vos projets.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="service-header">
      <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
          <div class="service-intro">
            <h2 class="service-heading">
              <div>Solutions</div>
              <div><span>professionnelles</span></div>
            </h2>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="service-summary">
            <p>
              {{ $user->description ?? 'Découvrez les services que je propose pour votre projet.' }}
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- Commentaire étudiant : je boucle sur les services actifs envoyés par le backend --}}
    <div class="row justify-content-center">
      {{-- Boucle sur les services actifs du backend --}}
      @forelse($services as $service)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
          <div class="service-card position-relative z-1">
            <div class="service-icon">
              <i class="bi bi-{{ $loop->index % 6 == 0 ? 'palette' : ($loop->index % 6 == 1 ? 'gem' : ($loop->index % 6 == 2 ? 'megaphone' : ($loop->index % 6 == 3 ? 'code-slash' : ($loop->index % 6 == 4 ? 'graph-up' : 'camera-video')))) }}"></i>
            </div>
            <a href="#" class="card-action d-flex align-items-center justify-content-center rounded-circle">
              <i class="bi bi-arrow-up-right"></i>
            </a>
            <h3>
              <a href="#">
                {{ $service->nom }}
              </a>
            </h3>
            <p>
              {{ $service->description ?? 'Description du service...' }}
            </p>
          </div>
        </div>
      @empty
        <p class="text-center">Aucun service disponible pour le moment.</p>
      @endforelse
        </div>

      </div>

    </section>
