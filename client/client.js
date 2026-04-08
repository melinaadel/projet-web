$(document).ready(function () {

    const PRIX_CHAMBRES = {
        "Nuit Étoilée": 120,
        "Sensorielle": 140,
        "Silence Absolu": 160,
        "Suite Lucide": 220
    };

    const PRIX_ACTIVITES = {
        "Méditation guidée": 20,
        "Yoga doux": 25,
        "Observation des étoiles": 30,
        "Initiation au rêve lucide": 35,
        "Sortie en bateau": 50,
        "Match de tennis": 40
    };

    const PRIX_PRESTATIONS = {
        "Navette": 25,
        "Petit déjeuner": 15,
        "Dîner": 30,
        "Massage": 60
    };

    let reservationCourante = null;

    function calculerNombreNuits(dateDebut, dateFin) {
        if (!dateDebut || !dateFin) return 0;
        const debut = new Date(dateDebut);
        const fin = new Date(dateFin);
        const diff = fin - debut;
        return diff > 0 ? Math.ceil(diff / (1000 * 60 * 60 * 24)) : 0;
    }

    function mettreAJourTotalReservation() {
        const chambre = $("#chambre").val();
        const dateDebut = $("#date-debut").val();
        const dateFin = $("#date-fin").val();
        const nbPersonnes = parseInt($("#nb-personnes").val()) || 0;

        let total = 0;
        const nuits = calculerNombreNuits(dateDebut, dateFin);

        if (chambre && PRIX_CHAMBRES[chambre]) {
            total += PRIX_CHAMBRES[chambre] * nuits * nbPersonnes;
        }

        $(".activite-reservation:checked").each(function () {
            const nom = $(this).val();
            total += PRIX_ACTIVITES[nom] || 0;
        });

        $("#reservation-total").text(total + "€");
    }

    function afficherEspaceClient() {
        $("#client-dashboard").removeClass("d-none");
    }

    function cacherEspaceClient() {
        $("#client-dashboard").addClass("d-none");
    }

    function viderResumeClient() {
        $("#client-nom").text("-");
        $("#client-email").text("-");
        $("#client-dates").text("-");
        $("#client-personnes").text("-");
        $("#client-chambre").text("-");
    }

    function viderActivitesClient() {
        $("#activite-select").html('<option value="">Choisir une activité</option>');
        $("#liste-activites-client").html("");
    }

    function viderFacture() {
        $("#facture-liste").html("");
        $("#facture-total").text("0€");
    }

    function afficherResumeClient(reservation) {
        $("#client-nom").text(reservation.nom || "-");
        $("#client-email").text(reservation.email || "-");
        $("#client-dates").text((reservation.date_debut || "-") + " → " + (reservation.date_fin || "-"));
        $("#client-personnes").text(reservation.nb_personnes || "-");
        $("#client-chambre").text(reservation.chambre || "-");
    }

    function remplirSelectActivites(reservation) {
        let select = $("#activite-select");
        select.html('<option value="">Choisir une activité</option>');

        if (!reservation.activites || !Array.isArray(reservation.activites)) {
            return;
        }

        reservation.activites.forEach(function (activite) {
            if (!activite.statut || activite.statut === "") {
                select.append(`
                    <option value="${activite.nom}">
                        ${activite.nom}
                    </option>
                `);
            }
        });
    }

    function afficherListeActivites(reservation) {
        let liste = $("#liste-activites-client");
        liste.html("");

        if (!reservation.activites || !Array.isArray(reservation.activites) || reservation.activites.length === 0) {
            liste.html(`
                <li class="list-group-item text-muted">
                    Aucune activité associée à votre réservation.
                </li>
            `);
            return;
        }

        reservation.activites.forEach(function (activite) {
            let badgeClass = "bg-secondary";
            let badgeText = "Pas encore demandée";

            if (activite.statut === "en_attente") {
                badgeClass = "bg-warning text-dark";
                badgeText = "En attente de validation";
            } else if (activite.statut === "validee") {
                badgeClass = "bg-success";
                badgeText = "Validée";
            } else if (activite.statut === "refusee") {
                badgeClass = "bg-danger";
                badgeText = "Refusée";
            }

            liste.append(`
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-medium">${activite.nom}</span>
                        <span class="badge ${badgeClass}">${badgeText}</span>
                    </div>
                    ${activite.date ? `<div class="small text-muted">Date : ${activite.date}</div>` : ""}
                    ${activite.creneau ? `<div class="small text-muted">Format : ${activite.creneau}</div>` : ""}
                    ${activite.participants ? `<div class="small text-muted">Nombre de personnes : ${activite.participants}</div>` : ""}
                    ${activite.message ? `<div class="small text-muted">Message : ${activite.message}</div>` : ""}
                    ${(activite.prix !== undefined) ? `<div class="small text-muted">Prix : ${activite.prix}€</div>` : ""}
                </li>
            `);
        });
    }

    function afficherFacture(reservation) {
        let liste = $("#facture-liste");
        liste.html("");

        if (!reservation) {
            $("#facture-total").text("0€");
            return;
        }

        let total = 0;
        const nuits = calculerNombreNuits(reservation.date_debut, reservation.date_fin);
        const nbPersonnes = parseInt(reservation.nb_personnes) || 0;
        const prixChambre = reservation.prix_chambre || PRIX_CHAMBRES[reservation.chambre] || 0;
        const totalChambre = nuits * prixChambre * nbPersonnes;

        liste.append(`
            <li class="list-group-item d-flex justify-content-between">
                <span>Chambre (${reservation.chambre}) - ${nuits} nuit(s) × ${nbPersonnes} personne(s)</span>
                <span>${totalChambre}€</span>
            </li>
        `);
        total += totalChambre;

        if (reservation.activites && Array.isArray(reservation.activites)) {
            reservation.activites.forEach(function (activite) {
                const prix = activite.prix || 0;
                liste.append(`
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Activité : ${activite.nom}</span>
                        <span>${prix}€</span>
                    </li>
                `);
                total += prix;
            });
        }

        if (reservation.prestations && Array.isArray(reservation.prestations)) {
            reservation.prestations.forEach(function (prestation) {
                const prix = prestation.prix || 0;
                liste.append(`
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Prestation : ${prestation.nom}</span>
                        <span>${prix}€</span>
                    </li>
                `);
                total += prix;
            });
        }

        $("#facture-total").text(total + "€");
    }

    function chargerDonneesClient() {
        $.ajax({
            url: "../api/getClientReservation.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let reservation = response.reservation;
                    reservationCourante = reservation;

                    afficherResumeClient(reservation);
                    remplirSelectActivites(reservation);
                    afficherListeActivites(reservation);
                    afficherFacture(reservation);
                } else {
                    reservationCourante = null;
                    viderResumeClient();
                    viderActivitesClient();
                    viderFacture();
                }
            },
            error: function () {
                reservationCourante = null;
                viderResumeClient();
                viderActivitesClient();
                viderFacture();
                console.log("Erreur lors du chargement des données client.");
            }
        });
    }

    function appliquerEtatConnecte() {
        $("#btn-login-toggle")
            .text("Se déconnecter")
            .removeAttr("data-bs-toggle")
            .removeAttr("data-bs-target");

        $("#btn-reserver").addClass("d-none");

        afficherEspaceClient();
        chargerDonneesClient();
    }

    function appliquerEtatDeconnecte() {
        $("#btn-login-toggle")
            .text("Se connecter")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#loginModal");
        
        $("#btn-reserver").removeClass("d-none");

        if ($("#form-login").length) {
            $("#form-login")[0].reset();
        }

        $("#login-message").html("");
        $("#activite-message").html("");
        $("#reservation-total").text("0€");

        reservationCourante = null;
        viderResumeClient();
        viderActivitesClient();
        viderFacture();
        cacherEspaceClient();
    }

    function verifierSession() {
        $.ajax({
            url: "../api/checkSession.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.connected) {
                    appliquerEtatConnecte();
                } else {
                    appliquerEtatDeconnecte();
                }
            },
            error: function () {
                appliquerEtatDeconnecte();
            }
        });
    }

    $("#chambre, #date-debut, #date-fin, #nb-personnes").on("change", function () {
        mettreAJourTotalReservation();
    });

    $(document).on("change", ".activite-reservation", function () {
        mettreAJourTotalReservation();
    });

    $("#form-reservation").on("submit", function (e) {
        e.preventDefault();

        $("#reservation-message").html("");

        $.ajax({
            url: "../api/reservations.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#reservation-message").html(`
                        <div class="alert alert-success mb-3">
                            ${response.message}
                        </div>
                    `);

                    $("#form-reservation")[0].reset();
                    $("#reservation-total").text("0€");
                    $(".activite-reservation").prop("checked", false);
                } else {
                    $("#reservation-message").html(`
                        <div class="alert alert-danger mb-3">
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function () {
                $("#reservation-message").html(`
                    <div class="alert alert-danger mb-3">
                        Erreur serveur lors de l'envoi de la réservation.
                    </div>
                `);
            }
        });
    });

    $("#form-login").on("submit", function (e) {
        e.preventDefault();

        $("#login-message").html("");

        $.ajax({
            url: "../api/login.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#login-message").html(`
                        <div class="alert alert-success">
                            ${response.message}
                        </div>
                    `);

                    appliquerEtatConnecte();

                    setTimeout(function () {
                        const modalElement = document.getElementById("loginModal");
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }, 800);
                } else {
                    $("#login-message").html(`
                        <div class="alert alert-danger">
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function () {
                $("#login-message").html(`
                    <div class="alert alert-danger">
                        Erreur serveur
                    </div>
                `);
            }
        });
    });

    $("#form-activite").on("submit", function (e) {
        e.preventDefault();

        $("#activite-message").html("");

        $.ajax({
            url: "../api/ajouterActivite.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#activite-message").html(`
                        <div class="alert alert-success">
                            ${response.message}
                        </div>
                    `);

                    $("#form-activite")[0].reset();
                    chargerDonneesClient();
                } else {
                    $("#activite-message").html(`
                        <div class="alert alert-danger">
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function () {
                $("#activite-message").html(`
                    <div class="alert alert-danger">
                        Erreur serveur lors de l'envoi de la demande d'activité.
                    </div>
                `);
            }
        });
    });

    $(document).on("click", ".btn-prestation", function () {
        const prestation = $(this).data("prestation");

        $.ajax({
            url: "../api/ajouterPrestation.php",
            type: "POST",
            data: { prestation: prestation },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    chargerDonneesClient();
                }
            },
            error: function () {
                alert("Erreur lors de l'ajout de la prestation.");
            }
        });
    });

    $("#btn-login-toggle").on("click", function (e) {
        if ($(this).text().trim() === "Se déconnecter") {
            e.preventDefault();

            $.ajax({
                url: "../api/logout.php",
                type: "POST",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        appliquerEtatDeconnecte();
                    }
                },
                error: function () {
                    alert("Erreur lors de la déconnexion.");
                }
            });
        }
    });

    verifierSession();
});