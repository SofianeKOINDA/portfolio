<!-- Section Head -->
@include("sections.admin.head")
<body>
	<!-- Section Loader -->
	@include("sections.admin.loader")
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- Section Menu Haut -->
		@include("sections.admin.menu-haut")

		<!-- Section Menu Gauche -->
        @include("sections.admin.menu-gauche")

		<!-- Section Content -->
        <div id="content" class="content">

			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;" onclick="openAddModal()" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Nouveau Projet</a></li>
			</ol>

			<h1 class="page-header">Gestion des Projets</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des projets</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-hover table-td-valign-middle">
						<thead class="bg-dark text-white">
							<tr>
								<th width="1%" class="text-center">#</th>
								<th width="10%">Photos</th>
								<th class="text-nowrap">Nom / Client</th>
								<th class="text-nowrap text-center">Type & Catégorie</th>
								<th class="text-nowrap">Technologies</th>
								<th class="text-nowrap text-center">Date</th>
								<th class="text-nowrap text-center">État</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($projets as $projet)
                                <tr class="odd gradeX hover-highlight">
                                    <td class="f-w-600 text-inverse text-center">{{ $loop->iteration }}</td>

                                    <!-- Photos (Miniatures) -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            @if($projet->photo1)
                                                <img src="{{ asset('storage/'.$projet->photo1) }}" class="img-thumbnail m-1" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            @if($projet->photo2)
                                                <img src="{{ asset('storage/'.$projet->photo2) }}" class="img-thumbnail m-1" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Nom & Client -->
                                    <td>
                                        <div class="font-weight-bold text-primary">{{ $projet->nom }}</div>
                                        <small class="text-muted"><i class="fa fa-user m-r-5"></i>{{ $projet->client }}</small>
                                    </td>

                                    <!-- Type & Catégorie -->
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $projet->type }}</span><br>
                                        <small class="text-success f-w-600">{{ $projet->categorie->nom ?? 'Sans catégorie' }}</small>
                                    </td>

                                    <!-- Technologies -->
                                    <td>
                                        @if(is_array($projet->technologies))
                                            @foreach(array_slice($projet->technologies, 0, 3) as $tech)
                                                <span class="badge badge-secondary">{{ $tech }}</span>
                                            @endforeach
                                            @if(count($projet->technologies) > 3) ... @endif
                                        @else
                                            {{ Str::limit($projet->technologies, 30) }}
                                        @endif
                                    </td>

                                    <!-- Date -->
                                    <td class="text-center">
                                        <span class="text-muted">{{ \Carbon\Carbon::parse($projet->date)->format('d/m/Y') }}</span>
                                    </td>

                                    <!-- État -->
                                    <td class="text-center">
                                        <span class="badge badge-{{ $projet->etat == 'Actif' ? 'success' : 'danger' }} badge-pill">
                                            {{ $projet->etat }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-warning" title="Modifier"
                                                onclick="openEditModal({{ $projet->id }})"
                                                data-nom="{{ $projet->nom }}"
                                                data-client="{{ $projet->client }}"
                                                data-type="{{ $projet->type }}"
                                                data-date="{{ \Carbon\Carbon::parse($projet->date)->format('Y-m-d') }}"
                                                data-url="{{ $projet->url }}"
                                                data-technologies="{{ is_array($projet->technologies) ? implode(',', $projet->technologies) : $projet->technologies }}"
                                                data-description="{{ $projet->description }}"
                                                data-categorie_id="{{ $projet->categorie_id }}"
                                                data-etat="{{ $projet->etat }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-xs btn-{{ $projet->etat == 'Actif' ? 'danger' : 'success' }}"
                                                onclick="toggleStatus({{ $projet->id }}, '{{ $projet->nom }}', '{{ $projet->etat }}')">
                                                <i class="fa fa-{{ $projet->etat == 'Actif' ? 'trash' : 'check' }}"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

        @include("sections.admin.config")
	</div>

	<!-- Modal d'édition (Formulaire Complet) -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document"> <!-- Taille XL pour gérer tous les champs -->
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white"><i class="fa fa-edit"></i> Modifier le projet</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form id="editForm" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="modal-body bg-white text-dark">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Nom du projet *</label>
									<input type="text" class="form-control" id="edit_nom" name="nom" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Client / Entreprise *</label>
									<input type="text" class="form-control" id="edit_client" name="client" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" id="edit_type" name="type" required>
                                        <option value="Projet">Projet</option>
                                        <option value="Service">Service</option>
                                    </select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Date du projet *</label>
									<input type="date" class="form-control" id="edit_date" name="date" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Catégorie *</label>
									<select class="form-control" id="edit_categorie_id" name="categorie_id" required>
										@foreach($categories as $cat)
											<option value="{{ $cat->id }}">{{ $cat->nom }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Technologies (virgules pour séparer)</label>
                                    <input type="text" class="form-control" id="edit_technologies" name="technologies" placeholder="PHP, Laravel, Vuejs...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">URL du projet</label>
                                    <input type="url" class="form-control" id="edit_url" name="url" placeholder="https://...">
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Photo 1</label>
									<input type="file" class="form-control" name="photo1">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Photo 2</label>
									<input type="file" class="form-control" name="photo2">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Photo 3</label>
									<input type="file" class="form-control" name="photo3">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Description</label>
							<textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
						</div>
                        <div class="form-group">
                            <label class="form-label">État</label>
                            <select class="form-control" id="edit_etat" name="etat">
                                <option value="Actif">Actif</option>
                                <option value="Inactif">Inactif</option>
                            </select>
                        </div>
					</div>
					<div class="modal-footer bg-dark">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-success">Enregistrer les modifications</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal d'ajout (Action store) -->
	<!-- Modal d'ajout (Action store) -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header bg-black border-secondary">
                <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Ajouter un nouveau projet</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('projets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body bg-white text-dark">

                    {{-- Nom & Client --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nom du projet *</label>
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Client *</label>
                                <input type="text" class="form-control" name="client" required>
                            </div>
                        </div>
                    </div>

                    {{-- Type & Date --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Type *</label>
                                <select class="form-control" name="type" required>
                                    <option value="">Choisir...</option>
                                    <option value="Projet">Projet</option>
                                    <option value="Service">Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Catégorie *</label>
                                <select class="form-control" name="categorie_id" required>
                                    <option value="">Choisir...</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Technologies & URL --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Technologies</label>
                                <input type="text" class="form-control" name="technologies" placeholder="PHP, Laravel...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">URL du projet</label>
                                <input type="url" class="form-control" name="url" placeholder="https://...">
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                    {{-- Catégorie & État --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">État *</label>
                                <select class="form-control" name="etat" required>
                                    <option value="Actif">Actif</option>
                                    <option value="Inactif">Inactif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Photos --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Photo 1</label>
                                <input type="file" class="form-control" name="photo1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Photo 2</label>
                                <input type="file" class="form-control" name="photo2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Photo 3</label>
                                <input type="file" class="form-control" name="photo3">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer le projet</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @include("sections.admin.script")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
		/* Améliorations du design du tableau */
		.table-hover tbody tr:hover {
			background-color: #f8f9fa !important;
			transform: scale(1.01);
			transition: all 0.2s ease;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		}

		.badge-pill {
			border-radius: 50rem;
			padding: 0.5em 1em;
		}

		.table thead th {
			border-bottom: 2px solid #dee2e6;
			font-weight: 600;
			text-align: center;
			font-size: 0.9rem;
			letter-spacing: 0.3px;
		}

		.table tbody td {
			vertical-align: middle;
			padding: 1rem 0.75rem;
		}

		.btn-group .btn {
			margin: 0 2px;
			border-radius: 4px;
		}

		.text-muted {
			color: #6c757d !important;
		}

		.font-weight-bold {
			font-weight: 600 !important;
		}

		/* Animation pour les badges */
		.badge {
			transition: all 0.3s ease;
		}

		.badge:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
		}

		/* Améliorations du modal */
		.modal-content {
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.3);
		}

		.modal-header {
			border-radius: 15px 15px 0 0;
		}

		.modal-footer {
			border-radius: 0 0 15px 15px;
		}

		.input-group-text {
			border: none;
			font-weight: 600;
		}

		.input-group .form-control {
			border-left: none;
			border-radius: 0 5px 5px 0;
		}

		.form-control:focus {
			border-color: #80bdff;
			box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
		}

		.input-group-prepend .input-group-text {
			border-radius: 5px 0 0 5px;
		}

		.btn-lg {
			padding: 12px 24px;
			font-size: 16px;
			border-radius: 8px;
		}

		.form-label {
			font-weight: 600;
			margin-bottom: 8px;
		}

		.form-label i {
			margin-right: 8px;
		}

		/* Animation pour les champs */
		.form-control {
			transition: all 0.3s ease;
		}

		.form-control:focus {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.15);
		}

		/* Style pour la barre de progression */
		.progress {
			background-color: #e9ecef;
			border-radius: 10px;
		}

		.progress-bar {
			font-weight: bold;
			font-size: 12px;
			line-height: 25px;
		}
	</style>

	<script>
		function openEditModal(id) {
			var button = event.target.closest('button');

			// Mapping des données vers les champs
			document.getElementById('edit_nom').value = button.getAttribute('data-nom');
			document.getElementById('edit_client').value = button.getAttribute('data-client');
			document.getElementById('edit_type').value = button.getAttribute('data-type');
			document.getElementById('edit_date').value = button.getAttribute('data-date');
			document.getElementById('edit_url').value = button.getAttribute('data-url');
			document.getElementById('edit_technologies').value = button.getAttribute('data-technologies');
			document.getElementById('edit_description').value = button.getAttribute('data-description');
			document.getElementById('edit_categorie_id').value = button.getAttribute('data-categorie_id');
			document.getElementById('edit_etat').value = button.getAttribute('data-etat');

			document.getElementById('editForm').action = '/admin/projets/' + id;
			$('#editModal').modal('show');
		}

		function openAddModal() {
			$('#addModal').modal('show');
		}

		function toggleStatus(id, nom, currentStatus) {
			const action = currentStatus === 'Actif' ? 'désactiver' : 'activer';
			const color = currentStatus === 'Actif' ? '#d33' : '#28a745';

			Swal.fire({
				title: 'Confirmation',
				text: `Voulez-vous ${action} le projet "${nom}" ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: color,
				confirmButtonText: 'Oui, continuer'
			}).then((result) => {
				if (result.isConfirmed) {
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = currentStatus === 'Actif' ? '/admin/projets/' + id : '/admin/projets/' + id + '/activate';
					form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="${currentStatus === 'Actif' ? 'DELETE' : 'PATCH'}">`;
					document.body.appendChild(form);
					form.submit();
				}
			});
		}
	</script>
</body>
</html>
