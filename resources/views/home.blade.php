<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portail Intranet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex">

    <!-- Début de la Sidebar -->
    <aside class="bg-gray-200 w-64 min-h-screen flex flex-col items-center py-5 shadow-md mr-7"> <!-- Ajout de la marge à droite -->
       <!-- Logo -->
        <a href="#" class="mb-10 inline-block overflow-hidden">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-23 transform transition-transform duration-400 hover:scale-130">
        </a>


        <!-- Liens de navigation -->
        <div class="flex flex-col items-center space-y-4 mb-auto">

            <div class="flex items-center space-x-3 mb-5">
                <img src="{{ asset('images/user.png') }}" alt="Utilisateur" class="w-10 h-10 rounded-full">
                <span class="text-blue-700 font-semibold">Hiba_Ghallabi</span>
            </div>

            <a href="/" class="text-blue-700 flex items-center space-x-2">
                <i class="fas fa-list"></i>
                <span>Annonces</span>
            </a>
            <a href="#" class="text-blue-700 flex items-center space-x-2">
                <i class="fas fa-comment"></i>
                <span>Chats</span>
            </a>
            <a href="#" class="text-blue-700 flex items-center space-x-2">
                <i class="fas fa-users"></i>
                <span>Forum</span>
            </a>
            <a href="#" class="text-blue-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1c0-2 2-3 4-3s4 1 4 3c0 1-1 1-1 1H3zm7-3c-1.5 0-2-1-2-1s.5-1 2-1c1.5 0 2 1 2 1s-.5 1-2 1zm-3-4c-.5 0-1-.5-1-1s.5-1 1-1 1 .5 1 1-.5 1-1 1z"/>
                </svg>
                <span>Profil</span>
            </a>
        </div>


        <!-- Lien de déconnexion en bas -->
        <div class="mt-auto">
            <a href="{{ route('logout') }}" class="text-blue-700 flex items-center space-x-2">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 container mx-auto py-5"> <!-- Contenu principal à droite avec un peu de marge -->
         <!-- Conteneur pour la barre de recherche et le bouton "Publier une annonce" -->
    <div class="flex items-center justify-between space-x-4">
        <!-- Barre de recherche -->
        <form class="flex items-center relative" action="{{ route('annonces.search') }}" method="GET">
            <input type="search" name="query" placeholder=" Rechercher..." class="px-4 py-2 rounded-lg border border-gray-300 w-96 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11 6a5 5 0 1 0-2.707 4.551l3.853 3.853a1 1 0 0 0 1.414-1.414l-3.853-3.853A5 5 0 0 0 11 6zm-9 0a4 4 0 1 1 8 0 4 4 0 0 1-8 0z"/>
                </svg>
            </button>
        </form>

        <!-- Bouton pour afficher le formulaire d'ajout d'annonce -->
        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none transition-transform transform hover:scale-105 flex items-center gap-2" onclick="toggleForm()">
            <!-- Icône "plus" -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 1a6 6 0 1 1 0 12A6 6 0 0 1 8 2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5V7h2.5a.5.5 0 0 1 0 1H8.5v2.5a.5.5 0 0 1-1 0V8H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z"/>
            </svg>
            Publier une annonce
        </button>

    </div>

        <!-- Formulaire pour créer une annonce -->
        <div class="form-container hidden bg-white p-6 rounded-lg shadow-lg mt-5 w-1/2 mx-auto" id="createAnnonceForm">
            <h2 class="text-2xl font-semibold text-gray-900 mb-5">Créer une nouvelle annonce</h2>
            <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titre" class="block text-lg font-medium text-gray-700">Titre de l'annonce</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="titre" name="titre" required placeholder="Titre de l'annonce">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                    <textarea class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="description" name="description" rows="5" required placeholder="Entrez la description de l'annonce"></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-lg font-medium text-gray-700">Ajouter une image (facultatif)</label>
                    <input type="file" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="image" name="image" accept="image/*">
                </div>

                <div class="mb-4 flex justify-between space-x-4">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
                        Publier l'annonce
                    </button>
                    <button type="button" onclick="toggleForm()" class="w-full bg-gray-300 text-gray-800 py-2 rounded-lg hover:bg-gray-400 focus:outline-none">
                        Annuler
                    </button>
                </div>

            </form>
        </div>

        <!-- Liste des annonces existantes -->
        <section class="space-y-5 mt-10"> <!-- Ajout de marge au-dessus de la liste -->
            @foreach ($annonces as $annonce)
            <div class="bg-white p-5 rounded-lg shadow-md max-w-3xl mx-auto">
                <div class="relative">
                    <!-- Bouton trois points -->
                    <button onclick="toggleDropdown({{ $annonce->id }})" class="absolute top-0 right-0 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <!-- Menu déroulant -->
                    <div id="dropdown-{{ $annonce->id }}" class="hidden absolute top-6 right-0 bg-white border border-gray-300 rounded shadow-md z-10">
                        <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div class="flex items-center space-x-3 mb-3">
                        <img src="{{ asset('images/user.png') }}" alt="Utilisateur" class="w-8 h-8 rounded-full">
                        <span class="text-gray-800 font-medium">
                            Hiba
                        </span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $annonce->titre }}</h2>
                    <p class="text-gray-700 mt-2">{{ $annonce->description }}</p>
                    @if ($annonce->image_path)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $annonce->image_path) }}" alt="{{ $annonce->titre }}" class="max-w-[850px] max-h-[450px] object-cover rounded-lg mt-3 mx-auto">
                        </div>
                    @endif
                    <p class="text-sm text-gray-500 mt-2"><small>Publié le : {{ $annonce->created_at->format('d/m/Y') }}</small></p>
                    <!-- Barre des réactions -->
                <div class="flex items-center space-x-6 mt-4 border-t pt-4">
                    <!-- Bouton J'aime -->
                    <button class="flex items-center text-blue-500 hover:text-blue-700 focus:outline-none">
                        <i class="fas fa-thumbs-up mr-2"></i>
                        <span>J'aime</span>
                    </button>

                    <!-- Bouton pour commenter -->
                    <button onclick="toggleCommentForm({{ $annonce->id }})" class="flex items-center text-green-500 hover:text-green-700 focus:outline-none">
                        <i class="fas fa-comment-alt mr-2"></i>
                        <span>Commenter</span>
                    </button>
                </div>

                <!-- Formulaire pour ajouter un commentaire caché au départ -->
                <div id="comment-form-{{ $annonce->id }}" class="hidden mt-4">
                    <form action="" method="POST" class="flex flex-col space-y-3">
                        @csrf
                        <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                        <textarea name="contenu" rows="2" placeholder="Écrire un commentaire..." class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <button type="submit" class="self-end bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            Publier
                        </button>
                    </form>
                </div>

                </div>
            @endforeach
        </section>
    </main>

    <script>
        // Fonction pour afficher ou cacher le formulaire d'ajout d'annonce
        function toggleForm() {
            var form = document.getElementById('createAnnonceForm');
            form.classList.toggle('hidden');
        }
        function toggleCommentForm(id) {
            var form = document.getElementById('comment-form-' + id);
            form.classList.toggle('hidden');
        }
    </script>
    <script>
        function toggleDropdown(id) {
            const menu = document.getElementById('dropdown-' + id);
            // Ferme tous les autres menus
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el !== menu) el.classList.add('hidden');
            });
            // Toggle celui qu'on a cliqué
            menu.classList.toggle('hidden');
        }

        // Ferme le menu si on clique en dehors
        document.addEventListener('click', function (e) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (!el.contains(e.target) && !e.target.closest('button[onclick^="toggleDropdown"]')) {
                    el.classList.add('hidden');
                }
            });
        });
    </script>


</body>

</html>
