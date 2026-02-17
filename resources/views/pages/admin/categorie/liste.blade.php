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
				<li class="breadcrumb-item"><a href="javascript:;" onclick="openAddModal()">Ajout</a></li>
			</ol>

			<h1 class="page-header">Gestion des Catégories</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des catégories</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-hover table-td-valign-middle">
						<thead class="bg-dark text-white">
							<tr>
								<th width="1%" class="text-center">#</th>
								<th class="text-nowrap">Nom</th>
								<th class="text-nowrap text-center">Projets</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $categorie)
                                <tr class="odd gradeX hover-highlight">
                                    <!-- Numéro d'ordre -->
                                    <td width="1%" class="f-w-600 text-inverse text-center">{{ $loop->iteration }}</td>

                                    <!-- Nom de la catégorie -->
                                    <td class="font-weight-bold">{{ $categorie->nom }}</td>


                                    <!-- Nombre de projets -->
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">
                                            <i class="fa fa-project-diagram"></i> {{ $categorie->projets_count }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td width="1%" class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-warning" title="Modifier"
                                                onclick="openEditModal({{ $categorie->id }})"
                                                data-nom="{{ $categorie->nom }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger" title="Supprimer" onclick="confirmDelete({{ $categorie->id }}, '{{ $categorie->nom }}')">
                                                <i class="fa fa-trash"></i>
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

		<!-- Section Config -->
        @include("sections.admin.config")

		<!-- Section scroll to top  -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<!-- Modal d'édition -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white" id="editModalLabel">
						<i class="fa fa-edit"></i> Modifier la catégorie
					</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="editForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body bg-white">

                        	<!-- Modification du nom -->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_nom" class="form-label text-dark">
										<i class="fa fa-code text-primary"></i> Nom de la catégorie *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-code"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_nom" name="nom" placeholder="Entrez le nom de la catégorie" required>
									</div>
								</div>
							</div>
						</div>


					</div>


					<div class="modal-footer bg-dark border-secondary">
						<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">
							<i class="fa fa-times-circle"></i> Annuler
						</button>
						<button type="button" class="btn btn-success btn-lg" onclick="confirmEdit()">
							<i class="fa fa-save"></i> Enregistrer les modifications
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal d'ajout -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white" id="addModalLabel">
						<i class="fa fa-plus"></i> Ajouter une nouvelle catégorie
					</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="addForm" method="POST" action="{{ route('categories.store') }}">
					@csrf
					<div class="modal-body bg-white">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="add_nom" class="form-label text-dark">
										<i class="fa fa-code text-primary"></i> Nom de la catégorie *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-code"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_nom" name="nom" placeholder="Entrez le nom de la catégorie" required>
									</div>
								</div>
							</div>


						</div>






					</div>
					<div class="modal-footer bg-dark border-secondary">
						<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">
							<i class="fa fa-times-circle"></i> Annuler
						</button>
						<button type="submit" class="btn btn-success btn-lg">
							<i class="fa fa-plus"></i> Ajouter la catégorie
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Section Script -->
    @include("sections.admin.script")

    <!-- SweetAlert2 -->
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

		.form-control {
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
			// Récupérer le bouton cliqué
			var button = event.target.closest('button');

			// Récupérer les données depuis les attributs data
			var nom = button.getAttribute('data-nom');

			// Remplir le formulaire avec les données
			document.getElementById('edit_nom').value = nom || '';

			// Mettre à jour l'action du formulaire
			document.getElementById('editForm').action = '/admin/categories/' + id;

			// Afficher le modal
			$('#editModal').modal('show');
		}

		function openAddModal() {
			// Réinitialiser le formulaire
			document.getElementById('addForm').reset();

			// Afficher le modal
			$('#addModal').modal('show');
		}

		// Fonction de confirmation pour supprimer une catégorie
		function confirmDelete(id, nom) {
			Swal.fire({
				title: 'Êtes-vous sûr ?',
				text: `Voulez-vous vraiment supprimer la catégorie "${nom}" ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Oui, supprimer !',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				if (result.isConfirmed) {
					// Créer un formulaire temporaire pour l'envoi
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = '/admin/categories/' + id;

					var csrfToken = document.createElement('input');
					csrfToken.type = 'hidden';
					csrfToken.name = '_token';
					csrfToken.value = '{{ csrf_token() }}';

					var methodField = document.createElement('input');
					methodField.type = 'hidden';
					methodField.name = '_method';
					methodField.value = 'DELETE';

					form.appendChild(csrfToken);
					form.appendChild(methodField);
					document.body.appendChild(form);
					form.submit();
				}
			});
		}

		// Fonction de confirmation pour modifier une catégorie
		function confirmEdit() {
			// Récupérer le nom depuis le formulaire
			var nom = document.getElementById('edit_nom').value;

			Swal.fire({
				title: 'Confirmer la modification',
				text: `Voulez-vous enregistrer les modifications pour la catégorie "${nom}" ?`,
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Oui, enregistrer !',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				if (result.isConfirmed) {
					// Soumettre le formulaire
					document.getElementById('editForm').submit();
				}
			});
		}
	</script>
</body>
</html>

