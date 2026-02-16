 <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="stats-wrapper">
              {{-- Commentaire étudiant : j'affiche les statistiques envoyées par le backend depuis le contrôleur --}}
              <div class="stats-item" data-aos="zoom-in" data-aos-delay="150">
                <div class="icon-wrapper">
                  <i class="bi bi-folder"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $stats['total_projets'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projets</p>
              </div><!-- End Stats Item -->

              <div class="stats-item" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-wrapper">
                  <i class="bi bi-briefcase"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $stats['total_experiences'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Expériences</p>
              </div><!-- End Stats Item -->

              <div class="stats-item" data-aos="zoom-in" data-aos-delay="250">
                <div class="icon-wrapper">
                  <i class="bi bi-book"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $stats['total_formations'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Formations</p>
              </div><!-- End Stats Item -->

              <div class="stats-item" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-wrapper">
                  <i class="bi bi-star"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $stats['total_competences'] ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Compétences</p>
              </div><!-- End Stats Item -->
            </div>
          </div>
        </div>

      </div>

    </section>
