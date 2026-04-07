$(document).ready(function () {
    chargerReservations();
});

function chargerReservations() {
    $.ajax({
        url: "../api/getReservations.php",
        method: "GET",
        success: function (data) {

            let reservations = JSON.parse(data);

            let html = "";

            reservations.forEach(function (r) {
                html += `
                    <div style="border:1px solid black; padding:10px; margin:10px;">
                        <p><b>Nom :</b> ${r.nom}</p>
                        <p><b>Email :</b> ${r.email}</p>
                        <p><b>Dates :</b> ${r.date_debut} → ${r.date_fin}</p>
                        <p><b>Personnes :</b> ${r.nb_personnes}</p>
                        <p><b>Statut :</b> ${r.statut}</p>

                        <button onclick="valider(${r.id})">Valider</button>
                    </div>
                `;
            });

            $("#reservations").html(html);
        }
    });
}
function valider(id) {
    $.ajax({
        url: "../api/ValiderReservation.php",
        method: "POST",
        data: { id: id },
        success: function (response) {
            alert(response);
            chargerReservations(); // refresh
        },
        error: function () {
            alert(" Erreur");
        }
    });
}