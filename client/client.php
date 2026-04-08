<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtel des Rêves Lucides</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="client.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- PRESENTATION -->
<section id="presentation" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Hôtel des Rêves Lucides</h1>

                <p class="lead">
                    Plongez dans un univers entre réalité et imagination, où le sommeil devient une expérience immersive.
                </p>

                <p>
                    Situé au cœur d’un environnement naturel préservé, notre hôtel vous invite à ralentir, vous détendre et explorer vos rêves.
                </p>

                <button id="btn-reserver" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
                    Réserver maintenant
                </button>

                <button id="btn-login-toggle" class="btn btn-outline-light ms-2" data-bs-toggle="modal" data-bs-target="#loginModal" type="button">
                    Se connecter
                </button>
            </div>

            <!-- MODAL RESERVATION -->
            <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-dark">

                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="reservationModalLabel">Demande de réservation</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>

                        <div class="modal-body">
                            <form id="form-reservation">

                                <div id="reservation-message" class="mb-3"></div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="date-debut" class="form-label">Date de début</label>
                                        <input type="date" class="form-control" id="date-debut" name="date_debut" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="date-fin" class="form-label">Date de fin</label>
                                        <input type="date" class="form-control" id="date-fin" name="date_fin" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nb-personnes" class="form-label">Nombre de personnes</label>
                                        <input type="number" class="form-control" id="nb-personnes" name="nb_personnes" min="1" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="chambre" class="form-label">Chambre souhaitée</label>
                                        <select class="form-select" id="chambre" name="chambre" required>
                                            <option value="">Choisir une chambre</option>
                                            <option value="Nuit Étoilée">Nuit Étoilée - 120€ / nuit</option>
                                            <option value="Sensorielle">Sensorielle - 140€ / nuit</option>
                                            <option value="Silence Absolu">Silence Absolu - 160€ / nuit</option>
                                            <option value="Suite Lucide">Suite Lucide - 220€ / nuit</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label d-block">Activités souhaitées</label>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Méditation guidée" id="activite1" name="activites[]">
                                            <label class="form-check-label" for="activite1">Méditation guidée - 20€</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Yoga doux" id="activite2" name="activites[]">
                                            <label class="form-check-label" for="activite2">Yoga doux - 25€</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Observation des étoiles" id="activite3" name="activites[]">
                                            <label class="form-check-label" for="activite3">Observation des étoiles - 30€</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Initiation au rêve lucide" id="activite4" name="activites[]">
                                            <label class="form-check-label" for="activite4">Initiation au rêve lucide - 35€</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Sortie en bateau" id="activite5" name="activites[]">
                                            <label class="form-check-label" for="activite5">Sortie en bateau - 50€</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input activite-reservation" type="checkbox" value="Match de tennis" id="activite6" name="activites[]">
                                            <label class="form-check-label" for="activite6">Match de tennis - 40€</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label">Message complémentaire</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Précisez vos souhaits, contraintes ou préférences..."></textarea>
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-light border mb-0">
                                            <div class="d-flex justify-content-between">
                                                <span>Total prévisionnel</span>
                                                <strong id="reservation-total">0€</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" form="form-reservation" class="btn btn-primary">Envoyer la demande</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- MODAL CONNEXION -->
            <div class="modal fade" id="loginModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">

                        <div class="modal-header">
                            <h5 class="modal-title">Connexion client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form id="form-login">
                                <div id="login-message" class="mb-3"></div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" form="form-login" class="btn btn-primary">Se connecter</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6 text-center">
                <img
                    src="https://images.unsplash.com/photo-1501785888041-af3ef285b470"
                    class="img-fluid rounded shadow"
                    alt="Nature et ciel étoilé"
                >
            </div>
        </div>
    </div>
</section>

<!-- CHAMBRES -->
<section class="py-5 bg-light" id="chambres-section">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Nos Chambres Immersives</h2>
            <p class="text-muted">Des univers uniques pour vivre une expérience entre rêve et réalité.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-xl-3">
                <div class="card h-100 shadow-sm border-0">
                    <div id="carouselEtoilee" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-top">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEtoilee" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselEtoilee" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nuit Étoilée</h5>
                        <p class="fw-bold text-primary">120€ / nuit</p>
                        <p class="card-text text-muted">Dormez sous un ciel étoilé projeté sur les murs et le plafond pour une immersion totale.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card h-100 shadow-sm border-0">
                    <div id="carouselSensorielle" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-top">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSensorielle" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselSensorielle" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sensorielle</h5>
                        <p class="fw-bold text-primary">140€ / nuit</p>
                        <p class="card-text text-muted">Lumières douces et ambiance sonore relaxante pour accompagner votre endormissement.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card h-100 shadow-sm border-0">
                    <div id="carouselSilence" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-top">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSilence" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselSilence" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Silence Absolu</h5>
                        <p class="fw-bold text-primary">160€ / nuit</p>
                        <p class="card-text text-muted">Une chambre isolée pour une déconnexion totale et un repos profond.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card h-100 shadow-sm border-0">
                    <div id="carouselSuite" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-top">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=900&q=80" class="d-block w-100 chambre-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSuite" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselSuite" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Suite Lucide</h5>
                        <p class="fw-bold text-primary">220€ / nuit</p>
                        <p class="card-text text-muted">Une suite haut de gamme avec contrôle personnalisé de l’ambiance pour une expérience unique.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ACTIVITES PUBLIQUES -->
<section class="py-5 bg-white" id="activites-section">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">Nos Activités Oniriques</h2>
            <p class="text-muted mb-0">
                Des expériences uniques pour prolonger votre voyage entre rêve, détente et imagination.
            </p>
        </div>

        <div class="row g-4">

            <!-- Méditation guidée -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Méditation guidée"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Méditation guidée</h5>
                            <span class="badge text-bg-primary fs-6">20€</span>
                        </div>
                        <p class="card-text text-muted">
                            Une séance apaisante pour ralentir le rythme, se recentrer et préparer le corps et l’esprit à une immersion profonde.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Yoga doux -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Yoga doux"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Yoga doux</h5>
                            <span class="badge text-bg-primary fs-6">25€</span>
                        </div>
                        <p class="card-text text-muted">
                            Des mouvements lents et harmonieux pour détendre le corps, améliorer la respiration et installer une sensation de calme durable.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Observation des étoiles -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Observation des étoiles"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Observation des étoiles</h5>
                            <span class="badge text-bg-primary fs-6">30€</span>
                        </div>
                        <p class="card-text text-muted">
                            Profitez d’un ciel nocturne pur et sans pollution lumineuse pour contempler les étoiles dans une atmosphère magique.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Initiation au rêve lucide -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1495195134817-aeb325a55b65?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Initiation au rêve lucide"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Initiation au rêve lucide</h5>
                            <span class="badge text-bg-primary fs-6">35€</span>
                        </div>
                        <p class="card-text text-muted">
                            Découvrez les bases du rêve lucide grâce à des techniques simples pour apprendre à reconnaître et guider vos rêves.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sortie en bateau -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Sortie en bateau"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Sortie en bateau</h5>
                            <span class="badge text-bg-primary fs-6">50€</span>
                        </div>
                        <p class="card-text text-muted">
                            Une escapade paisible sur l’eau pour profiter du paysage, du silence et d’un moment suspendu hors du temps.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Match de tennis -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?auto=format&fit=crop&w=900&q=80"
                        class="card-img-top"
                        alt="Match de tennis"
                        style="height: 240px; object-fit: cover;"
                    >
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">Match de tennis</h5>
                            <span class="badge text-bg-primary fs-6">40€</span>
                        </div>
                        <p class="card-text text-muted">
                            Une activité sportive encadrée pour partager un moment dynamique, convivial et ressourçant au cœur du séjour.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ESPACE CLIENT -->
<section id="client-dashboard" class="py-5 bg-light d-none">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Espace Client</h2>
            <p class="text-muted">Gérez votre séjour et vos activités</p>
        </div>

        <div class="row g-4">

            <!-- RESUME -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-4">Votre séjour</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Nom</span>
                            <span id="client-nom" class="fw-medium">-</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Email</span>
                            <span id="client-email" class="fw-medium">-</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dates</span>
                            <span id="client-dates" class="fw-medium">-</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Personnes</span>
                            <span id="client-personnes" class="fw-medium">-</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Chambre</span>
                            <span id="client-chambre" class="fw-medium text-primary">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRESTATIONS -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-semibold mb-1">Prestations</h5>
                                <p class="text-muted mb-0">Ajoutez des services complémentaires à votre séjour</p>
                            </div>
                        </div>

                        <div class="row g-4">

                            <div class="col-md-6 col-xl-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=900&q=80" class="card-img-top" alt="Navette" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold mb-2">Navette - 25€</h6>
                                        <p class="text-muted small mb-3">Service de transport depuis la gare ou l’aéroport pour rejoindre l’hôtel en toute sérénité.</p>
                                        <button class="btn btn-outline-primary mt-auto btn-prestation" data-prestation="Navette">Ajouter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?auto=format&fit=crop&w=900&q=80" class="card-img-top" alt="Petit déjeuner" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold mb-2">Petit déjeuner - 15€</h6>
                                        <p class="text-muted small mb-3">Un réveil gourmand avec une sélection de boissons chaudes, fruits, viennoiseries et produits frais.</p>
                                        <button class="btn btn-outline-primary mt-auto btn-prestation" data-prestation="Petit déjeuner">Ajouter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=900&q=80" class="card-img-top" alt="Dîner" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold mb-2">Dîner - 30€</h6>
                                        <p class="text-muted small mb-3">Un repas du soir raffiné dans une ambiance calme et immersive, inspirée par l’univers du rêve.</p>
                                        <button class="btn btn-outline-primary mt-auto btn-prestation" data-prestation="Dîner">Ajouter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=900&q=80" class="card-img-top" alt="Massage" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="fw-bold mb-2">Massage - 60€</h6>
                                        <p class="text-muted small mb-3">Une parenthèse de relaxation profonde pour relâcher les tensions et prolonger l’expérience sensorielle.</p>
                                        <button class="btn btn-outline-primary mt-auto btn-prestation" data-prestation="Massage">Ajouter</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVITE -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">

                        <h5 class="fw-semibold mb-4">Demande d’activité</h5>

                        <form id="form-activite">

                            <div class="mb-3">
                                <label class="form-label text-muted small">Type d’activité</label>
                                <select id="activite-select" name="activite_nom" class="form-select form-select-lg">
                                    <option value="">Choisir une activité</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Format de réservation</label>
                                <select id="activite-creneau" name="creneau" class="form-select">
                                    <option value="">Choisir un format</option>
                                    <option value="heure">À l’heure</option>
                                    <option value="demi-journee">Demi-journée</option>
                                    <option value="journee">Journée</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Date souhaitée</label>
                                <input id="activite-date" type="date" name="date" class="form-control form-control-lg">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Nombre de personnes concernées</label>
                                <input
                                    id="activite-participants"
                                    type="number"
                                    name="participants"
                                    class="form-control"
                                    min="1"
                                    placeholder="Ex : 2"
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Message</label>
                                <textarea id="activite-message-input" name="message" class="form-control" rows="4" placeholder="Ex : je préfère ne pas faire cette activité dès le premier jour..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill">
                                Envoyer la demande
                            </button>
                        </form>

                        <div id="activite-message" class="mt-3"></div>

                    </div>
                </div>
            </div>

            <!-- LISTE ACTIVITES -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-4">Vos activités</h5>
                        <ul id="liste-activites-client" class="list-group list-group-flush"></ul>
                    </div>
                </div>
            </div>

            <!-- FACTURE -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-4">Facture</h5>
                        <ul id="facture-liste" class="list-group list-group-flush mb-3"></ul>
                        <div class="text-end">
                            <h4 class="fw-bold">
                                Total :
                                <span id="facture-total" class="text-primary">0€</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS -->
<script src="./client.js"></script>

</body>
</html>