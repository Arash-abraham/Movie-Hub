<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Movie Hub</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#1a365d',
                            secondary: '#2d3748',
                            accent: '#e53e3e',
                        }
                    }
                }
            }
        </script>
        <style>
            body {
                background-color: #0f172a;
                color: #e2e8f0;
            }
            
            .movie-card {
                transition: transform 0.3s ease;
            }
            
            .movie-card:hover {
                transform: scale(1.05);
            }
            
            .news-card {
                transition: all 0.3s ease;
            }
            
            .news-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            }
            
            .hero-slider {
                height: 70vh;
                background: linear-gradient(to top, #0f172a, transparent), url('/opt/lampp/htdocs/Admin-Panel/img/john.jpg  ');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="bg-gray-900 text-white">

        <!-- Header -->
        <header class="bg-gray-800 sticky top-0 z-50 shadow-lg">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-red-600">Movie Hub</h1>
                </div>

                <!-- Navigation Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-red-500 transition">Home</a>
                    <a href="#" class="hover:text-red-500 transition">Movies</a>
                    <a href="#" class="hover:text-red-500 transition">Series</a>
                    <a href="#" class="hover:text-red-500 transition">News</a>
                    <a href="#" class="hover:text-red-500 transition">Categories</a>
                    <a href="#" class="hover:text-red-500 transition">Contact</a>
                </nav>

                <!-- Search and Login -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search for movies or series..." class="bg-gray-700 px-4 py-2 rounded-full text-sm w-40 md:w-64 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <button class="absolute right-3 top-2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-full text-sm transition">Login / Sign Up</button>
                </div>
            </div>
        </header>

        <!-- Hero Slider -->
        <section class="hero-slider relative">
            <div class="absolute bottom-0 left-0 right-0 p-12 bg-gradient-to-t from-gray-900 to-transparent">
                <div class="container mx-auto">
                    <h2 class="text-4xl font-bold mb-4">John Wick: Chapter 4</h2>
                    <p class="text-lg max-w-2xl mb-6">Starring Keanu Reeves, the legendary professional assassin faces even more powerful enemies in this sequel to his epic adventures.</p>
                    <div class="flex space-x-4">
                        <button class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-full font-medium transition flex items-center">
                            <i class="fas fa-play mr-2"></i> Play
                        </button>
                        <button class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded-full font-medium transition flex items-center">
                            <i class="fas fa-info-circle mr-2"></i> More Info
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">

            <!-- Popular Series -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3">Popular Series</h2>
                    <a href="#" class="text-red-500 hover:text-red-400 transition">View All <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Series Card -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_FMjpg_UX1000_.jpg" alt="Game of Thrones" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Game of Thrones</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2011-2019</span>
                                <span class="mr-2">IMDb: 9.2</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repeat similar cards -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="/opt/lampp/htdocs/Admin-Panel/img/wp6794318-breaking-bad-4k-wallpapers.jpg" alt="Breaking Bad" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Breaking Bad</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2008-2013</span>
                                <span class="mr-2">IMDb: 9.5</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 4 more cards -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="https://goldendiscs.ie/cdn/shop/products/MM00306950.jpg?v=1690704327" alt="Peaky Blinders" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Peaky Blinders</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2013-2022</span>
                                <span class="mr-2">IMDb: 8.8</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTnPXL0OklxeuT6B2J1jLwJX9Uhczxwa0SX27UiE6cj0GDFq0zO" alt="Dark" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Dark</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2017-2020</span>
                                <span class="mr-2">IMDb: 8.7</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800 hidden md:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BMDZkYmVhNjMtNWU4MC00MDQxLWE3MjYtZGMzZWI1ZjhlOWJmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg" alt="Stranger Things" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Stranger Things</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2016-2024</span>
                                <span class="mr-2">IMDb: 8.7</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800 hidden lg:block">
                        <img src="https://pbcdn1.podbean.com/imglogo/dir-logo/581162/581162_300x300.jpg" alt="Chernobyl" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Chernobyl</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2019</span>
                                <span class="mr-2">IMDb: 9.4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Latest News Section -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3">Latest News</h2>
                    <a href="#" class="text-red-500 hover:text-red-400 transition">View All <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- News Card -->
                    <div class="news-card bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1595769816263-9b910be24d5f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="Cinema News" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span class="text-red-500 text-sm font-medium">Entertainment</span>
                            <h3 class="font-bold text-lg my-2">New Marvel Series Announced for 2024</h3>
                            <p class="text-gray-400 text-sm mb-4">Marvel Studios has officially announced three new series coming to Disney+ in 2024, expanding the MCU with new characters and stories.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>May 15, 2023</span>
                                <a href="#" class="text-red-500 hover:text-red-400 transition">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repeat news cards -->
                    <div class="news-card bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1489599809505-f2e90e6e08e4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="Cinema News" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span class="text-red-500 text-sm font-medium">Industry</span>
                            <h3 class="font-bold text-lg my-2">Streaming Services See Record Growth</h3>
                            <p class="text-gray-400 text-sm mb-4">New data shows streaming platforms have seen a 35% increase in subscribers worldwide, with original content being the main driver.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>May 12, 2023</span>
                                <a href="#" class="text-red-500 hover:text-red-400 transition">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="news-card bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1594909122845-11baa439b7bf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="Cinema News" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span class="text-red-500 text-sm font-medium">Awards</span>
                            <h3 class="font-bold text-lg my-2">Oscars 2024: Early Predictions</h3>
                            <p class="text-gray-400 text-sm mb-4">Film critics are already making predictions for next year's Academy Awards, with several films emerging as early favorites.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>May 10, 2023</span>
                                <a href="#" class="text-red-500 hover:text-red-400 transition">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- New Movies -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3">New Movies</h2>
                    <a href="#" class="text-red-500 hover:text-red-400 transition">View All <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Movie Card -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="https://m.media-amazon.com/images/M/MV5BYjhiNjBlODctY2ZiOC00YjVlLWFlNzAtNTVhNzM1YjI1NzMxXkEyXkFqcGdeQXVyMjQxNTE1MDA@._V1_FMjpg_UX1000_.jpg" alt="Avatar: The Way of Water" class="w-full h-64 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Avatar: The Way of Water</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>Action, Adventure</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repeat similar cards -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800">
                        <img src="https://m.media-amazon.com/images/M/MV5BNTM4NjIxNmEtYWE5NS00NDczLTkyNWQtYThhNmQyZGQzMjM0XkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_FMjpg_UX1000_.jpg" alt="Black Panther: Wakanda Forever" class="w-full h-64 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Black Panther: Wakanda Forever</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>Action, Sci-Fi</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800 hidden md:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BNDYxNjQyMjAtNTdiOS00NGYwLWFmNTAtNThmYjU5ZGI2YTI1XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_FMjpg_UX1000_.jpg" alt="The Batman" class="w-full h-64 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">The Batman</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>Action, Crime</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-800 hidden md:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BZWMyYzFjYTYtNTRjYi00OGExLWE2YzgtOGRmYjAxZTU3NzBiXkEyXkFqcGdeQXVyMzQ0MzA0NTM@._V1_FMjpg_UX1000_.jpg" alt="Spider-Man: No Way Home" class="w-full h-64 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Spider-Man: No Way Home</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>Action, Adventure</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- IMDB Top Picks -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3">IMDB Top Picks</h2>
                    <a href="#" class="text-red-500 hover:text-red-400 transition">View All <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- IMDB Card -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex">
                        <div class="w-1/3 relative">
                            <img src="https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UX1000_.jpg" alt="The Dark Knight" class="h-full w-full object-cover">
                            <div class="absolute top-2 right-2 bg-yellow-600 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">
                                9.0
                            </div>
                        </div>
                        <div class="w-2/3 p-4">
                            <h3 class="font-bold text-lg mb-2">The Dark Knight</h3>
                            <p class="text-gray-400 text-sm mb-3">Batman must face a criminal mastermind who aims to create chaos in the city.</p>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>2008</span>
                                <span class="mx-2">•</span>
                                <span>152 min</span>
                                <span class="mx-2">•</span>
                                <span>Action</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repeat similar cards -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex">
                        <div class="w-1/3 relative">
                            <img src="https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg" alt="The Godfather" class="h-full w-full object-cover">
                            <div class="absolute top-2 right-2 bg-yellow-600 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">
                                9.2
                            </div>
                        </div>
                        <div class="w-2/3 p-4">
                            <h3 class="font-bold text-lg mb-2">The Godfather</h3>
                            <p class="text-gray-400 text-sm mb-3">The aging patriarch of a crime dynasty transfers control to his reluctant son.</p>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>1972</span>
                                <span class="mx-2">•</span>
                                <span>175 min</span>
                                <span class="mx-2">•</span>
                                <span>Crime</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden flex">
                        <div class="w-1/3 relative">
                            <img src="https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_FMjpg_UX1000_.jpg" alt="Parasite" class="h-full w-full object-cover">
                            <div class="absolute top-2 right-2 bg-yellow-600 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">
                                8.6
                            </div>
                        </div>
                        <div class="w-2/3 p-4">
                            <h3 class="font-bold text-lg mb-2">Parasite</h3>
                            <p class="text-gray-400 text-sm mb-3">A poor family schemes to become employed by a wealthy family.</p>
                            <div class="flex items-center text-sm text-gray-400">
                                <span>2019</span>
                                <span class="mx-2">•</span>
                                <span>132 min</span>
                                <span class="mx-2">•</span>
                                <span>Drama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3 mb-6">Categories</h2>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition">
                        <i class="fas fa-heart text-red-500 text-2xl mb-2"></i>
                        <span>Romance</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition">
                        <i class="fas fa-gun text-red-500 text-2xl mb-2"></i>
                        <span>Action</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition">
                        <i class="fas fa-ghost text-red-500 text-2xl mb-2"></i>
                        <span>Horror</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition">
                        <i class="fas fa-face-laugh text-red-500 text-2xl mb-2"></i>
                        <span>Comedy</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition hidden md:block">
                        <i class="fas fa-rocket text-red-500 text-2xl mb-2"></i>
                        <span>Sci-Fi</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-red-600 rounded-lg p-4 text-center transition hidden md:block">
                        <i class="fas fa-magnifying-glass text-red-500 text-2xl mb-2"></i>
                        <span>Mystery</span>
                    </a>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-red-600">Movie Hub</h3>
                        <p class="text-gray-400">The best destination for online streaming of movies and series with high quality and multiple language options.</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Useful Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Movies</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Series</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Account</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Profile</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">My List</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">History</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Settings</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Download App</h4>
                        <div class="flex space-x-2">
                            <button class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded flex items-center">
                                <i class="fab fa-google-play text-red-500 mr-2"></i>
                                <span>Google Play</span>
                            </button>
                            <button class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded flex items-center">
                                <i class="fab fa-apple text-red-500 mr-2"></i>
                                <span>App Store</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500">
                    <p>© 2023 Movie Hub. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Script for interactions -->
        <script>
            // Simple script for mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const menuBtn = document.getElementById('menu-btn');
                const mobileMenu = document.getElementById('mobile-menu');
                
                if (menuBtn) {
                    menuBtn.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    });
                }
            });
        </script>
    </body>
</html>
