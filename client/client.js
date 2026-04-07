$(document).ready(function () {

    // 🔹 RESERVATION
    $("#formReservation").submit(function (e) {
        e.preventDefault();

        let nom = $("#nom").val();
        let email = $("#email").val();
        let date_debut = $("#date_debut").val();
        let date_fin = $("#date_fin").val();
        let nb_personnes = $("#nb_personnes").val();

        $.ajax({
            url: "../api/reservations.php",
            method: "POST",
            data: {
                nom: nom,
                email: email,
                date_debut: date_debut,
                date_fin: date_fin,
                nb_personnes: nb_personnes
            },
            success: function (response) {
                $("#message").html(response);
            }
        });
    });

    // 🔐 LOGIN
    $("#formLogin").submit(function (e) {
        e.preventDefault();

        let login = $("#login").val();
        let password = $("#password").val();

        $.ajax({
            url: "../api/login.php",
            method: "POST",
            data: {
                login: login,
                password: password
            },
            success: function (response) {
                $("#clientArea").html(response);
            }
        });
    });

});