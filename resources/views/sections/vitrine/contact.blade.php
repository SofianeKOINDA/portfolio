<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>Besoin d'un coup de main ? Envoyez-moi un message.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row g-4 g-lg-5">
      <div class="col-lg-5">
        <div class="info-box">
          <h3>Contact Info</h3>
          <p>{{ $user->description ?? 'Informations de contact' }}</p>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div class="content">
              <h4>Adresse</h4>
              <p>{{ $user->adresse ?? 'Non renseignée' }}</p>
            </div>
          </div>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-telephone"></i>
            </div>
            <div class="content">
              <h4>Téléphone</h4>
              <p>{{ $user->tel1 ?? 'Non renseigné' }}</p>
            </div>
          </div>

          <div class="info-item">
            <div class="icon-box">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="content">
              <h4>Email</h4>
              <p>{{ $user->email ?? 'Non renseigné' }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-form">
          <h3>Me contacter</h3>
          <p>Remplissez le formulaire ci-dessous, je répondrai dès que possible.</p>

          {{-- Formulaire public qui envoie vers ContactControllerstorePublic --}}
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="nom" class="form-control" placeholder="Votre nom" value="{{ old('nom') }}" required>
                @error('nom') <div class="text-danger">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Votre email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
              </div>

              <div class="col-12">
                <input type="text" class="form-control" name="sujet" placeholder="Sujet" value="{{ old('sujet') }}" required>
                @error('sujet') <div class="text-danger">{{ $message }}</div> @enderror
              </div>

              <div class="col-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required>{{ old('message') }}</textarea>
                @error('message') <div class="text-danger">{{ $message }}</div> @enderror
              </div>

              <div class="col-12 text-center">
                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <button type="submit" class="btn">Envoyer</button>
              </div>

            </div>
          </form>

        </div>
      </div>

    </div>

  </div>

</section>
