<section id="about" class="about section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
      <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-image">
              <img src="{{ asset($user->photo ?? 'templates/templateVitrine/assets/img/profile/profile-square-3.webp') }}" alt="{{ $user->nom ?? 'Profile' }}" class="img-fluid">
            </div>
            <div class="profile-badge">
              <i class="bi bi-check-circle-fill"></i>
            </div>
          </div>

          <div class="profile-content">
            {{-- Commentaire étudiant : j'utilise les infos du modèle User pour remplir la carte --}}
            <h3>{{ $user->nom ?? 'Nom Prénom' }}</h3>
            <p class="profession">{{ $user->poste ?? ($user->slogan ?? 'Profession') }}</p>

            <div class="contact-links">
              @if(!empty($user->email))
                <a href="mailto:{{ $user->email }}" class="contact-item">
                  <i class="bi bi-envelope"></i>
                  {{ $user->email }}
                </a>
              @endif
              @if(!empty($user->tel1))
                <a href="tel:{{ $user->tel1 }}" class="contact-item">
                  <i class="bi bi-telephone"></i>
                  {{ $user->tel1 }}
                </a>
              @endif
              @if(!empty($user->adresse))
                <a href="#" class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  {{ $user->adresse }}
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
        <div class="about-content">
          <div class="section-header">
            <span class="badge-text">Get to Know Me</span>
            <h2>{{ $user->slogan ?? 'Passionné par la création numérique' }}</h2>
          </div>

          <div class="description">
            <p>{{ $user->description ?? 'Texte de présentation détaillé...' }}</p>
          </div>

          <div class="stats-grid">
            {{-- Exemples statiques ; on peut les remplacer par des compteurs depuis le backend si nécessaire --}}
            <div class="stat-item">
              <div class="stat-number">{{ $stats['total_projets'] ?? '0' }}</div>
              <div class="stat-label">Projets</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">{{ $stats['total_experiences'] ?? '0' }}</div>
              <div class="stat-label">Expériences</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">{{ $stats['total_formations'] ?? '0' }}</div>
              <div class="stat-label">Formations</div>
            </div>
          </div>

          <div class="cta-section">
            <a href="#" class="btn btn-primary">
              <i class="bi bi-download"></i>
              Télécharger CV
            </a>
            <a href="#contact" class="btn btn-outline">
              <i class="bi bi-chat-dots"></i>
              Me contacter
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>
