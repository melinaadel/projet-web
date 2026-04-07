$(document).ready(function () {

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
            let badgeText = "Sans statut";

            if (activite.statut === "en_attente") {
                badgeClass = "bg-warning text-dark";
                badgeText = "En attente";
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
                    ${activite.participants ? `<div class="small text-muted">Participants : ${activite.participants}</div>` : ""}
                    ${activite.message ? `<div class="small text-muted">Message : ${activite.message}</div>` : ""}
                </li>
            `);
        });
    }

    function chargerDonneesClient() {
        $.ajax({
            url: "../api/getClientReservation.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let reservation = response.reservation;

                    afficherResumeClient(reservation);
                    remplirSelectActivites(reservation);
                    afficherListeActivites(reservation);
                } else {
                    viderResumeClient();
                    viderActivitesClient();
                }
            },
            error: function () {
                viderResumeClient();
                viderActivitesClient();
                console.log("Erreur lors du chargement des données client.");
            }
        });
    }

    function appliquerEtatConnecte() {
        $("#btn-login-toggle")
            .text("Se déconnecter")
            .removeAttr("data-bs-toggle")
            .removeAttr("data-bs-target");

        afficherEspaceClient();
        chargerDonneesClient();
    }

    function appliquerEtatDeconnecte() {
        $("#btn-login-toggle")
            .text("Se connecter")
            .attr("data-bs-toggle", "modal")
            .attr("data-bs-target", "#loginModal");

        $("#form-login")[0].reset();
        $("#login-message").html("");
        $("#activite-message").html("");

        viderResumeClient();
        viderActivitesClient();
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