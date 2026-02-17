  <section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>CV & Expérience</h2>
        <p>Mon parcours professionnel et mes formations.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <!-- Colonne gauche : résumé et contact -->
          <div class="col-lg-4">
            <div class="resume-side" data-aos="fade-right" data-aos-delay="100">
              <div class="profile-img mb-4">
                <img src="templates/templateVitrine/assets/img/profile/profile-square-2.webp" alt="{{ $user->nom }}" class="img-fluid rounded">
              </div>

              <h3>Résumé</h3>
              <p>{{ $user->description ?? 'Résumé professionnel...' }}</p>

              <h3 class="mt-4">Coordonnées</h3>
              <ul class="contact-info list-unstyled">
                @if(!empty($user->adresse))
                  <li><i class="bi bi-geo-alt"></i> {{ $user->adresse }}</li>
                @endif
                @if(!empty($user->email))
                  <li><i class="bi bi-envelope"></i> {{ $user->email }}</li>
                @endif
                @if(!empty($user->tel1))
                  <li><i class="bi bi-phone"></i> {{ $user->tel1 }}</li>
                @endif
              </ul>

              <div class="skills-animation mt-4">
                <h3>Compétences principales</h3>
                {{-- Commentaire étudiant : j'affiche les 4 premières compétences techniques --}}
                @forelse($competencesTechniques->take(4) as $comp)
                  <div class="skill-item">
                    <div class="d-flex justify-content-between">
                      <span>{{ $comp->nom }}</span>
                      <span>{{ $comp->niveau }}%</span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="{{ $comp->niveau }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $comp->niveau }}%;"></div>
                    </div>
                  </div>
                @empty
                  <p>Aucune compétence enregistrée.</p>
                @endforelse
              </div>
            </div>
          </div>

          <!-- Colonne droite : expériences et formations -->
          <div class="col-lg-8 ps-4 ps-lg-5">

            <!-- Section Expériences -->
            <div class="resume-section" data-aos="fade-up">
              <h3><i class="bi bi-briefcase me-2"></i>Expériences Professionnelles</h3>

              {{-- Commentaire étudiant : je boucle sur les expériences actives avec leurs entreprises --}}
              @forelse($experiences as $exp)
                <div class="resume-item">
                  <h4>{{ $exp->poste }}</h4>
                  <h5>{{ $exp->date_debut ?? 'Date' }} - {{ $exp->date_fin ?? 'Maintenant' }}</h5>
                  <p class="company"><i class="bi bi-building"></i> {{ $exp->entreprise->nom ?? 'Entreprise' }}</p>
                  <p>{{ $exp->description ?? 'Détails de l\'expérience...' }}</p>
                </div>
              @empty
                <p>Aucune expérience enregistrée.</p>
              @endforelse
            </div>

            <!-- Section Formations -->
            <div class="resume-section mt-5" data-aos="fade-up" data-aos-delay="200">
              <h3><i class="bi bi-book me-2"></i>Formations</h3>

              {{-- Commentaire étudiant : j'affiche les formations actives --}}
              @forelse($formations as $form)
                <div class="resume-item">
                  <h4>{{ $form->diplome }}</h4>
                  <h5>{{ $form->date_debut ?? 'Date' }} - {{ $form->date_fin ?? 'Fin' }}</h5>
                  <p class="company"><i class="bi bi-mortarboard"></i> {{ $form->entreprise->nom ?? 'École/Université' }}</p>
                  <p>{{ $form->description ?? 'Détails de la formation...' }}</p>
                </div>
              @empty
                <p>Aucune formation enregistrée.</p>
              @endforelse
            </div>

          </div>
        </div>

      </div>

    </section>


