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

			<h1 class="page-header">Gestion des Contacts <small>Messages reçus</small></h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Boîte de réception</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-hover table-td-valign-middle">
						<thead class="bg-dark text-white">
							<tr>
								<th width="1%" class="text-center">#</th>
								<th class="text-nowrap">Expéditeur</th>
								<th class="text-nowrap">Sujet</th>
								<th class="text-nowrap">Message</th>
								<th class="text-nowrap text-center">Statut</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
                                <tr class="odd gradeX hover-highlight {{ $contact->lu ? '' : 'f-w-700' }}" style="{{ $contact->lu ? '' : 'background-color: #f0f4ff;' }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>

                                    <!-- Expéditeur -->
                                    <td>
                                        <div>{{ $contact->nom }}</div>
                                        <small class="text-primary">{{ $contact->email }}</small>
                                    </td>

                                    <!-- Sujet -->
                                    <td>
                                        <span class="label label-default">{{ $contact->sujet }}</span>
                                    </td>

                                    <!-- Message (Aperçu) -->
                                    <td>
                                        <small class="text-muted">{{ Str::limit($contact->message, 60) }}</small>
                                    </td>

                                    <!-- Statut (Lu & Répondu) -->
                                    <td class="text-center">
                                        @if($contact->lu)
                                            <span class="badge badge-success" title="Message lu"><i class="fa fa-eye"></i> Lu</span>
                                        @else
                                            <span class="badge badge-warning animated flash infinite" title="Nouveau message"><i class="fa fa-envelope"></i> Nouveau</span>
                                        @endif

                                        @if($contact->repondu)
                                            <span class="badge badge-info"><i class="fa fa-reply"></i> Répondu</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <!-- Bouton Voir / Lire -->
                                            <button type="button" class="btn btn-xs btn-primary" title="Lire le message"
                                                onclick="openViewModal({{ $contact->id }})"
                                                data-nom="{{ $contact->nom }}"
                                                data-email="{{ $contact->email }}"
                                                data-sujet="{{ $contact->sujet }}"
                                                data-message="{{ $contact->message }}"
                                                data-reponse="{{ $contact->reponse }}"
                                                data-repondu="{{ $contact->repondu }}">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <!-- Bouton Supprimer -->
                                            <button type="button" class="btn btn-xs btn-danger" title="Supprimer"
                                                onclick="confirmDelete({{ $contact->id }}, '{{ $contact->nom }}')">
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

        @include("sections.admin.config")
	</div>

	<!-- Modal de Lecture et Réponse -->
	<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content border-0">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title"><i class="fa fa-envelope-open"></i> Détails du message</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form id="replyForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body bg-light">
                        <!-- Infos Expéditeur -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>De :</strong> <span id="view_nom"></span></p>
                                        <p class="mb-0"><strong>Email :</strong> <span id="view_email" class="text-primary"></span></p>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <p class="mb-0"><strong>Sujet :</strong> <span id="view_sujet" class="badge badge-secondary"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenu du Message -->
                        <div class="form-group">
                            <label class="font-weight-bold">Message reçu :</label>
                            <div id="view_message" class="p-3 bg-white border rounded" style="min-height: 100px; white-space: pre-wrap;"></div>
                        </div>

                        <hr>

                        <!-- Section Réponse -->
                        <div class="form-group">
                            <label class="font-weight-bold text-success"><i class="fa fa-reply"></i> Votre réponse :</label>
                            <textarea class="form-control" name="reponse" id="view_reponse" rows="5" placeholder="Écrivez votre réponse ici..."></textarea>
                        </div>
					</div>
					<div class="modal-footer bg-white">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-success" id="btn_repondre">
                            <i class="fa fa-paper-plane"></i> Envoyer la réponse
                        </button>
					</div>
				</form>
			</div>
		</div>
	</div>

    @include("sections.admin.script")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		function openViewModal(id) {
			var button = event.target.closest('button');

			// Remplissage des données
			document.getElementById('view_nom').innerText = button.getAttribute('data-nom');
			document.getElementById('view_email').innerText = button.getAttribute('data-email');
			document.getElementById('view_sujet').innerText = button.getAttribute('data-sujet');
			document.getElementById('view_message').innerText = button.getAttribute('data-message');

            // Gestion de la réponse existante
            var reponse = button.getAttribute('data-reponse');
            document.getElementById('view_reponse').value = (reponse !== "null" && reponse !== null) ? reponse : '';

			document.getElementById('replyForm').action = '/admin/contacts/' + id + '/reply';

            $('#viewModal').modal('show');

            // Marquer comme lu automatiquement via AJAX (optionnel mais recommandé)
            markAsRead(id);
		}

        function markAsRead(id) {
            fetch(`/admin/contacts/${id}/mark-read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                // Optionnel : actualiser discrètement l'UI sans recharger
            });
        }

		function confirmDelete(id, nom) {
			Swal.fire({
				title: 'Supprimer ce message ?',
				text: `Le message de "${nom}" sera définitivement supprimé.`,
				icon: 'error',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				confirmButtonText: 'Oui, supprimer'
			}).then((result) => {
				if (result.isConfirmed) {
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = '/admin/contacts/' + id;
					form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
					document.body.appendChild(form);
					form.submit();
				}
			});
		}
	</script>

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
</body>
</html>
