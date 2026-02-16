<section id="skills" class="skills section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Compétences</h2>
    <p>Voici mes compétences techniques et mes soft skills.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
      <div class="col-lg-6">
        <div class="skills-category" data-aos="fade-up" data-aos-delay="200">
          <h3>Techniques</h3>
          <div class="skills-animation">
            {{-- Commentaire étudiant : je boucle sur les compétences techniques fournies par le contrôleur --}}
            @forelse($competencesTechniques as $competence)
              <div class="skill-item">
                <div class="d-flex justify-content-between align-items-center">
                  <h4>{{ $competence->nom }}</h4>
                  <span class="skill-percentage">{{ $competence->niveau }}%</span>
                </div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $competence->niveau }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $competence->niveau }}%;"></div>
                </div>
                @if(!empty($competence->description))
                  <div class="skill-tooltip">{{ $competence->description }}</div>
                @endif
              </div>
            @empty
              <p>Aucune compétence technique disponible pour le moment.</p>
            @endforelse
          </div>
        </div><!-- End Techniques -->
      </div>

      <div class="col-lg-6">
        <div class="skills-category" data-aos="fade-up" data-aos-delay="300">
          <h3>Soft Skills</h3>
          <div class="skills-animation">
            {{-- Commentaire étudiant : boucle pour les soft skills --}}
            @forelse($competencesSoftSkills as $soft)
              <div class="skill-item">
                <div class="d-flex justify-content-between align-items-center">
                  <h4>{{ $soft->nom }}</h4>
                  <span class="skill-percentage">{{ $soft->niveau }}%</span>
                </div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $soft->niveau }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $soft->niveau }}%;"></div>
                </div>
                @if(!empty($soft->description))
                  <div class="skill-tooltip">{{ $soft->description }}</div>
                @endif
              </div>
            @empty
              <p>Aucune soft skill disponible pour le moment.</p>
            @endforelse
          </div>
        </div><!-- End Soft Skills -->
      </div>
    </div>

  </div>

</section>
