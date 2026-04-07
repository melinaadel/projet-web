<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtel des Rêves Lucides</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Hôtel des Rêves Lucides</h1>

    <hr>

    <h2>Réserver</h2>

    <form id="formReservation">
        <input type="text" id="nom" placeholder="Nom" required><br><br>
        <input type="email" id="email" placeholder="Email" required><br><br>

        <label>Date début :</label>
        <input type="date" id="date_debut" required><br><br>

        <label>Date fin :</label>
        <input type="date" id="date_fin" required><br><br>

        <input type="number" id="nb_personnes" placeholder="Nombre de personnes" required><br><br>

        <button type="submit">Réserver</button>
    </form>

    <br>
    <div id="message"></div>

    <!-- 🔥 TON JS DOIT ÊTRE ICI -->
    <script src="./client.js"></script>
    <hr>

    <h2>Connexion</h2>

    <form id="formLogin">
        <input type="text" id="login" placeholder="Email"><br><br>
        <input type="password" id="password" placeholder="Mot de passe"><br><br>
        <button type="submit">Se connecter</button>
    </form>

    <div id="clientArea"></div>

</body>
</html>