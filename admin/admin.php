<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration — Hôtel des Rêves Lucides</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-dark text-light">

<!-- HEADER -->
<div class="container-fluid bg-black py-3 mb-4 border-bottom border-secondary">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0">🌙 Hôtel des Rêves Lucides</h1>
            <small class="text-secondary">Panneau d'administration</small>
        </div>
        <span class="badge bg-warning text-dark fs-6">Administrateur</span>
    </div>
</div>

<div class="container pb-5">

    <!-- ══════════════════════════════════════════
         1. DEMANDES DE RÉSERVATION
    ══════════════════════════════════════════ -->
    <div class="card bg-secondary-subtle text-dark mb-5">
        <div class="card-header bg-dark text-warning">
            <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Demandes de réservation</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Personnes</th>
                        <th>Activités souhaitées</th>
                        <th>Chambres libres</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>Dupont</strong></td>
                        <td>dupont@email.com</td>
                        <td>01/05/2026</td>
                        <td>05/05/2026</td>
                        <td>2</td>
                        <td>Tennis, Méditation</td>
                        <td>
                            <span class="badge bg-success">Nuit Étoilée: 3</span>
                            <span class="badge bg-warning text-dark">Suite Lucide: 1</span>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm me-1"
                                onclick="validerReservation(1, 'Dupont', 'dupont@email.com', '01/05/2026', '05/05/2026')">
                                <i class="bi bi-check-lg me-1"></i>Valider
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-x-lg me-1"></i>Refuser
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Martin</strong></td>
                        <td>martin@email.com</td>
                        <td>10/05/2026</td>
                        <td>15/05/2026</td>
                        <td>4</td>
                        <td>Sortie bateau</td>
                        <td>
                            <span class="badge bg-success">Sensorielle: 2</span>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm me-1"
                                onclick="validerReservation(2, 'Martin', 'martin@email.com', '10/05/2026', '15/05/2026')">
                                <i class="bi bi-check-lg me-1"></i>Valider
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-x-lg me-1"></i>Refuser
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         2. GESTION DES CHAMBRES
    ══════════════════════════════════════════ -->
    <div class="card bg-secondary-subtle text-dark mb-5">
        <div class="card-header bg-dark text-warning">
            <h4 class="mb-0"><i class="bi bi-door-open me-2"></i>Gestion des chambres</h4>
        </div>
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-3">
                    <div class="card text-dark h-100">
                        <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=400" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Nuit Étoilée</h5>
                            <p class="mb-1"><span class="badge bg-success">Libres: 3</span></p>
                            <p class="mb-0"><span class="badge bg-danger">Réservées: 2</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-dark h-100">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Sensorielle</h5>
                            <p class="mb-1"><span class="badge bg-success">Libres: 2</span></p>
                            <p class="mb-0"><span class="badge bg-danger">Réservées: 3</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-dark h-100">
                        <img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?w=400" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Silence Absolu</h5>
                            <p class="mb-1"><span class="badge bg-warning text-dark">Libres: 1</span></p>
                            <p class="mb-0"><span class="badge bg-danger">Réservées: 4</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-dark h-100">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Suite Lucide</h5>
                            <p class="mb-1"><span class="badge bg-success">Libres: 2</span></p>
                            <p class="mb-0"><span class="badge bg-danger">Réservées: 1</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         3. FACTURATION PAR CLIENT
    ══════════════════════════════════════════ -->
    <div class="card bg-secondary-subtle text-dark mb-5">
        <div class="card-header bg-dark text-warning">
            <h4 class="mb-0"><i class="bi bi-receipt me-2"></i>Facturation</h4>
        </div>
        <div class="card-body">

            <!-- Sélection du client -->
            <div class="mb-3">
                <label class="form-label fw-bold">Client</label>
                <select class="form-select" id="clientFacture" onchange="afficherFacture()">
                    <option value="">-- Sélectionner un client --</option>
                    <option value="dupont">Dupont — 01/05 au 05/05 (4 nuits)</option>
                    <option value="martin">Martin — 10/05 au 15/05 (5 nuits)</option>
                </select>
            </div>

            <!-- Facture détaillée -->
            <div id="factureDetail" class="d-none">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Désignation</th>
                            <th class="text-end">Montant</th>
                        </tr>
                    </thead>
                    <tbody id="factureBody">
                    </tbody>
                    <tfoot>
                        <tr id="ligneArrhes" class="table-danger d-none">
                            <td><i class="bi bi-dash-circle me-1"></i>Arrhes reçues</td>
                            <td class="text-end text-danger fw-bold" id="montantArrhes">— 0 €</td>
                        </tr>
                        <tr id="ligneReduction" class="table-warning d-none">
                            <td><i class="bi bi-tag me-1"></i>Réduction appliquée</td>
                            <td class="text-end text-warning fw-bold" id="montantReduction">— 0 €</td>
                        </tr>
                        <tr class="table-dark fw-bold">
                            <td>TOTAL</td>
                            <td class="text-end" id="factureTotal">0 €</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Actions facturation -->
                <div class="row g-3 mt-1">

                    <!-- Arrhes -->
                    <div class="col-md-4">
                        <div class="card text-dark">
                            <div class="card-header bg-secondary text-white">
                                <i class="bi bi-cash-coin me-1"></i>Arrhes
                            </div>
                            <div class="card-body">
                                <p class="mb-2" id="arrheStatut">
                                    <span class="badge bg-danger">Non reçues</span>
                                </p>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="montantArrheInput" placeholder="Montant reçu">
                                </div>
                                <button class="btn btn-success w-100" onclick="appliquerArrhes()">
                                    <i class="bi bi-check-circle me-1"></i>Confirmer réception arrhes
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Réduction -->
                    <div class="col-md-4">
                        <div class="card text-dark">
                            <div class="card-header bg-secondary text-white">
                                <i class="bi bi-percent me-1"></i>Réduction sur prestations
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-2" id="selectReduction">
                                    <option value="0">Aucune réduction</option>
                                    <option value="10">-10%</option>
                                    <option value="20">-20%</option>
                                    <option value="50">-50%</option>
                                </select>
                                <button class="btn btn-warning w-100" onclick="appliquerReduction()">
                                    <i class="bi bi-tag me-1"></i>Appliquer
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- ══════════════════════════════════════════
         4. ACTIVITÉS — DEMANDES DU JOUR
    ══════════════════════════════════════════ -->
    <div class="card bg-secondary-subtle text-dark mb-5">
        <div class="card-header bg-dark text-warning d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-activity me-2"></i>Activités — Demandes du jour</h4>
            <input type="date" class="form-control w-auto" id="dateActivites" value="2026-05-01" onchange="filtrerActivites()">
        </div>
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" id="checkAll" onchange="toggleAll()"></th>
                        <th>Client</th>
                        <th>Activité</th>
                        <th>Créneau</th>
                        <th>Personnes</th>
                        <th>Note client</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody id="activitesBody">
                    <tr>
                        <td><input type="checkbox" class="checkActivite"></td>
                        <td>Dupont</td>
                        <td><i class="bi bi-trophy me-1"></i>Tennis</td>
                        <td>À l'heure — 14h00</td>
                        <td>2</td>
                        <td><em class="text-muted">Pas dès le premier jour svp</em></td>
                        <td><span class="badge bg-warning text-dark">En attente</span></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkActivite"></td>
                        <td>Martin</td>
                        <td><i class="bi bi-water me-1"></i>Sortie bateau</td>
                        <td>À la journée</td>
                        <td>6</td>
                        <td><em class="text-muted">Pas de baignade</em></td>
                        <td><span class="badge bg-warning text-dark">En attente</span></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkActivite"></td>
                        <td>Dupont</td>
                        <td><i class="bi bi-peace me-1"></i>Méditation</td>
                        <td>À la demi-journée — matin</td>
                        <td>Tout le groupe</td>
                        <td><em class="text-muted">—</em></td>
                        <td><span class="badge bg-success">Validée</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- Validation avec animateur -->
            <div class="card text-dark mt-3">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-person-check me-1"></i>Valider les demandes sélectionnées
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Animateur</label>
                            <select class="form-select" id="selectAnimateur">
                                <option>— Choisir un animateur —</option>
                                <option>Jean-Pierre (Tennis)</option>
                                <option>Sophie (Bateau)</option>
                                <option>Amira (Méditation)</option>
                                <option>Luc (Randonnée)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Clients pour match de tennis (2 min.)</label>
                            <select class="form-select" multiple id="selectClientsTennis">
                                <option>Dupont</option>
                                <option>Martin</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-success w-100" onclick="validerActivites()">
                                <i class="bi bi-check2-all me-1"></i>Valider la sélection
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- FOOTER -->
<footer class="bg-black text-center text-secondary py-3 border-top border-secondary">
    <small>© 2026 Hôtel des Rêves Lucides — Administration</small>
</footer>


<!-- ══════════════════════════════════════════
     MODAL — Mail de confirmation généré
══════════════════════════════════════════ -->
<div class="modal fade" id="modalMail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">
                    <i class="bi bi-envelope-check me-2 text-success"></i>
                    Réservation validée — Mail à envoyer au client
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <i class="bi bi-person-plus me-2"></i>
                    Compte client créé avec succès. Copiez le message ci-dessous dans votre logiciel de mail.
                </div>

                <!-- Récap credentials -->
                <div class="row mb-3 g-2">
                    <div class="col-md-4">
                        <div class="card text-dark text-center">
                            <div class="card-body py-2">
                                <small class="text-muted d-block">URL de connexion</small>
                                <strong id="infoUrl">—</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-dark text-center">
                            <div class="card-body py-2">
                                <small class="text-muted d-block">Identifiant (email)</small>
                                <strong id="infoEmail">—</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-dark text-center">
                            <div class="card-body py-2">
                                <small class="text-muted d-block">Mot de passe généré</small>
                                <strong class="text-warning" id="infoPassword">—</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Corps du mail -->
                <div class="card bg-light text-dark">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-envelope me-1"></i>Message prêt à copier-coller</span>
                        <button class="btn btn-sm btn-outline-dark" onclick="copierMail()">
                            <i class="bi bi-clipboard me-1"></i>Copier
                        </button>
                    </div>
                    <div class="card-body">
                        <pre id="mailContent" class="mb-0" style="white-space: pre-wrap; font-size: .9rem;"></pre>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-success" onclick="copierMail()">
                    <i class="bi bi-clipboard-check me-1"></i>Copier le mail
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// ─── Données de facturation ────────────────────────────────────────────────────
const facturesData = {
    dupont: {
        nom: "Dupont",
        email: "dupont@email.com",
        lignes: [
            { label: "Chambre Nuit Étoilée × 4 nuits", montant: 480 },
            { label: "Navette aéroport", montant: 45 },
            { label: "Petit-déjeuner × 4 jours", montant: 60 },
            { label: "Dîner × 2 soirs", montant: 80 },
            { label: "Tennis (activité validée)", montant: 30 },
        ],
        arrhes: 0,
        reduction: 0
    },
    martin: {
        nom: "Martin",
        email: "martin@email.com",
        lignes: [
            { label: "Chambre Sensorielle × 5 nuits", montant: 750 },
            { label: "Petit-déjeuner × 5 jours", montant: 75 },
            { label: "Sortie bateau (activité)", montant: 120 },
        ],
        arrhes: 0,
        reduction: 0
    }
};

// ─── Afficher la facture ───────────────────────────────────────────────────────
function afficherFacture() {
    const client = $("#clientFacture").val();
    if (!client) { $("#factureDetail").addClass("d-none"); return; }

    const data = facturesData[client];
    let html = "";
    let totalLignes = 0;

    data.lignes.forEach(l => {
        html += `<tr><td>${l.label}</td><td class="text-end">${l.montant} €</td></tr>`;
        totalLignes += l.montant;
    });

    $("#factureBody").html(html);
    $("#factureDetail").removeClass("d-none");

    // Arrhes — ligne en négatif si reçues
    if (data.arrhes > 0) {
        $("#ligneArrhes").removeClass("d-none");
        $("#montantArrhes").text(`— ${data.arrhes} €`);
        $("#arrheStatut").html(`<span class="badge bg-success">Reçues : ${data.arrhes} €</span>`);
    } else {
        $("#ligneArrhes").addClass("d-none");
        $("#arrheStatut").html(`<span class="badge bg-danger">Non reçues</span>`);
    }

    // Réduction — s'applique uniquement aux prestations (tout sauf la chambre)
    let montantReduction = 0;
    if (data.reduction > 0) {
        const totalPrestations = data.lignes.slice(1).reduce((s, l) => s + l.montant, 0);
        montantReduction = Math.round(totalPrestations * data.reduction / 100);
        $("#ligneReduction").removeClass("d-none");
        $("#montantReduction").text(`— ${montantReduction} € (${data.reduction}%)`);
    } else {
        $("#ligneReduction").addClass("d-none");
    }

    const total = totalLignes - data.arrhes - montantReduction;
    $("#factureTotal").text(`${total} €`);
}

// ─── Appliquer les arrhes ──────────────────────────────────────────────────────
function appliquerArrhes() {
    const client = $("#clientFacture").val();
    if (!client) { alert("Veuillez sélectionner un client."); return; }
    const montant = parseFloat($("#montantArrheInput").val());
    if (isNaN(montant) || montant <= 0) { alert("Entrez un montant valide."); return; }

    facturesData[client].arrhes = montant;
    afficherFacture();
    $("#montantArrheInput").val("");
}

// ─── Appliquer une réduction ───────────────────────────────────────────────────
function appliquerReduction() {
    const client = $("#clientFacture").val();
    if (!client) { alert("Veuillez sélectionner un client."); return; }
    facturesData[client].reduction = parseInt($("#selectReduction").val());
    afficherFacture();
}

// ─── Générer un mot de passe aléatoire ────────────────────────────────────────
function genererMotDePasse(longueur = 10) {
    const chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789!@#";
    let mdp = "";
    for (let i = 0; i < longueur; i++) {
        mdp += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return mdp;
}

// ─── Valider une réservation → popup mail ─────────────────────────────────────
function validerReservation(id, nom, email, arrivee, depart) {
    const motDePasse = genererMotDePasse();
    const url = "https://hotel-reves-lucides.fr/client";

    const mail =
`Bonjour ${nom},

Nous avons le plaisir de vous confirmer votre réservation à l'Hôtel des Rêves Lucides.

Dates de séjour : du ${arrivee} au ${depart}

Votre espace client est désormais accessible. Connectez-vous pour commander vos prestations (navette, petit-déjeuner, dîner, activités) et suivre votre facture.

URL : ${url}
Identifiant : ${email}
Mot de passe : ${motDePasse}

Nous vous recommandons de modifier votre mot de passe à la première connexion.

Au plaisir de vous accueillir prochainement,
L'équipe de l'Hôtel des Rêves Lucides`;

    $("#mailContent").text(mail);
    $("#infoUrl").text(url);
    $("#infoEmail").text(email);
    $("#infoPassword").text(motDePasse);

    new bootstrap.Modal(document.getElementById("modalMail")).show();
}

// ─── Copier le mail ────────────────────────────────────────────────────────────
function copierMail() {
    navigator.clipboard.writeText($("#mailContent").text()).then(() => {
        alert("Mail copié dans le presse-papier !");
    });
}

// ─── Cocher tout ──────────────────────────────────────────────────────────────
function toggleAll() {
    $(".checkActivite").prop("checked", $("#checkAll").prop("checked"));
}

// ─── Valider activités ────────────────────────────────────────────────────────
function validerActivites() {
    const animateur = $("#selectAnimateur").val();
    if (animateur === "— Choisir un animateur —") { alert("Veuillez choisir un animateur."); return; }
    const nb = $(".checkActivite:checked").length;
    if (nb === 0) { alert("Aucune activité sélectionnée."); return; }
    $(".checkActivite:checked").closest("tr").find(".badge")
        .removeClass("bg-warning text-dark").addClass("bg-success").text("Validée");
    $(".checkActivite:checked").prop("checked", false);
    alert(`${nb} activité(s) validée(s) avec ${animateur}.`);
}

// ─── Filtrer activités par date ────────────────────────────────────────────────
function filtrerActivites() {
    // À brancher avec le backend PHP
    console.log("Date sélectionnée :", $("#dateActivites").val());
}
</script>

</body>
</html>