<section id="hero" class="hero section">

  <div class="background-elements">
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
  </div>

  <div class="hero-content">
    <div class="container">
      <div class="row align-items-center">

        {{-- j'affiche l'intro avec les données de l'utilisateur récupérées côté backend --}}
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
          <div class="hero-text">
            <h1>{{ $user->nom ?? 'Mon Nom' }}<span class="accent-text"> Portfolio</span></h1>
            <h2>{{ $user->poste ?? ($user->slogan ?? 'Développeur / Designer') }}</h2>
            <p class="lead">{{ $user->slogan ?? 'Je construis des interfaces et des expériences.' }}</p>
            <p class="description">{{ $user->description ?? 'Description courte du profil...' }}</p>

            <div class="hero-actions">
              <a href="#portfolio" class="btn btn-primary">Voir mes projets</a>
              <a href="#contact" class="btn btn-outline">Me contacter</a>
            </div>

                <div class="social-links">
                  <a href="https://www.facebook.com/share/1ANcCaRp5G/?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a>
                  <a href="https://github.com/SofianeKOINDA"><i class="bi bi-github"></i></a>
                  <a href="https://www.tiktok.com/@sk_sama4real?_r=1&_t=ZS-940vyRFN3yS"><i class="bi bi-tiktok"></i></a>
                  <a href="https://www.linkedin.com/in/benewende-sofiane-koinda-58704a258/"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

        {{-- Visuel profil --}}
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
          <div class="hero-visual">
            <div class="profile-container">
              <div class="profile-background"></div>
              <img src= "templates/templateVitrine/assets/img/profile/WhatsApp Image 2026-02-17 at 22.10.52.jpeg" alt="{{ $user->nom ?? 'Profil' }}" class="profile-image">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>
