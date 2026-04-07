<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtel des Rêves Lucides</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Cliens pour le style  -->
    <link rel="stylesheet" href="client.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- PRESENTATION -->
<section id="presentation" class="bg-dark text-white py-5">
    <div class="container">

        <div class="row align-items-center">

            <!-- TEXTE -->
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">
                    Hôtel des Rêves Lucides
                </h1>

                <p class="lead">
                    Plongez dans un univers entre réalité et imagination, où le sommeil devient une expérience immersive.
                </p>

                <p>
                    Situé au cœur d’un environnement naturel préservé, notre hôtel vous invite à ralentir, vous détendre et explorer vos rêves.
                </p>

                <button id="btn-reserver" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
                    Réserver maintenant
                </button>
            </div>

            <!-- MODAL RESERVATION -->
            <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="reservationModalLabel">Demande de réservation</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>

                        <div class="modal-body">
                            <form id="form-reservation">

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
                                            <option value="Nuit Étoilée">Nuit Étoilée</option>
                                            <option value="Sensorielle">Sensorielle</option>
                                            <option value="Silence Absolu">Silence Absolu</option>
                                            <option value="Suite Lucide">Suite Lucide</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label d-block">Activités souhaitées</label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Méditation guidée" id="activite1" name="activites[]">
                                            <label class="form-check-label" for="activite1">Méditation guidée</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Yoga doux" id="activite2" name="activites[]">
                                            <label class="form-check-label" for="activite2">Yoga doux</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Observation des étoiles" id="activite3" name="activites[]">
                                            <label class="form-check-label" for="activite3">Observation des étoiles</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Initiation au rêve lucide" id="activite4" name="activites[]">
                                            <label class="form-check-label" for="activite4">Initiation au rêve lucide</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Sortie en bateau" id="activite5" name="activites[]">
                                            <label class="form-check-label" for="activite5">Sortie en bateau</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Match de tennis" id="activite6" name="activites[]">
                                            <label class="form-check-label" for="activite6">Match de tennis</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label">Message complémentaire</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Précisez vos souhaits, contraintes ou préférences..."></textarea>
                                    </div>
                                </div>

                                <div id="reservation-message" class="mt-3"></div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" form="form-reservation" class="btn btn-primary">Envoyer la demande</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- IMAGE du lieu  -->
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470"
                     class="img-fluid rounded shadow"
                     alt="Nature et ciel étoilé">
            </div>
        </div>
    </div>
</section>

<!-- CHAMBRES -->
<section class="py-5 bg-light" id="chambres-section">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Nos Chambres Immersives</h2>
            <p class="text-muted">
                Des univers uniques pour vivre une expérience entre rêve et réalité.
            </p>
        </div>

        <div class="row g-4">

            <!-- Chambre Nuit Étoilée -->
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
                        <p class="card-text text-muted">
                            Dormez sous un ciel étoilé projeté sur les murs et le plafond pour une immersion totale.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Chambre Sensorielle -->
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
                        <p class="card-text text-muted">
                            Lumières douces et ambiance sonore relaxante pour accompagner votre endormissement.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Chambre Silence Absolu -->
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
                        <p class="card-text text-muted">
                            Une chambre isolée pour une déconnexion totale et un repos profond.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Suite Lucide -->
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
                        <p class="card-text text-muted">
                            Une suite haut de gamme avec contrôle personnalisé de l’ambiance pour une expérience unique.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<script src="./client.js"></script>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>