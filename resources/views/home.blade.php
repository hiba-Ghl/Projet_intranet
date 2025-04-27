<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portail Intranet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar */
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-nav a {
            color: white !important;
        }

        .navbar-brand img {
            max-height: 40px;
        }

        /* Annonces */
        .annonces {
            margin-top: 30px;
        }

        .annonce {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .annonce h2 {
            font-size: 24px;
            color: #2c3e50;
        }

        .annonce p {
            font-size: 16px;
            color: #555;
        }

        .image-annonce img {
            width: 100%;
            border-radius: 8px;
            max-height: 300px;
            object-fit: cover;
            margin-top: 15px;
        }

        .announcement-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }

        .announcement-title {
            font-weight: bold;
            font-size: 18px;
        }

        .announcement-content {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Début du Header avec la Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/path/to/logo.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Annonces</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat') }}">Chats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Début du Body avec les Annonces -->
    <main class="container">
        <section class="annonces">
            <h1 class="my-4">Les Annonces</h1>

            @foreach ($annonces as $annonce)
                <div class="annonce">
                    <h2>{{ $annonce->titre }}</h2>
                    <p>{{ $annonce->description }}</p>

                    <!-- Affichage de l'image si elle existe -->
                    @if ($annonce->image_path)
                        <div class="image-annonce">
                            <img src="{{ asset('storage/' . $annonce->image_path) }}" alt="{{ $annonce->titre }}"
                                class="img-fluid">
                        </div>
                    @endif

                    <p><small class="text-muted">Publié le : {{ $annonce->created_at->format('d/m/Y') }}</small></p>
                </div>
            @endforeach
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
