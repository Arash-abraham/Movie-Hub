<?php
    // TODO
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page Not Found - Movie Hub</title>
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
            
            .hero-slider {
                height: 70vh;
                background: linear-gradient(to top, #0f172a, transparent), url('https://images.unsplash.com/photo-1489599809505-f2e90e6e08e4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80');
                background-size: cover;
                background-position: center;
            }
            
            .error-animation {
                animation: float 3s ease-in-out infinite;
            }
            
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
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

        <!-- 404 Content -->
        <section class="hero-slider relative flex items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
            <div class="container mx-auto px-4 text-center relative z-10">
                <div class="error-animation mb-8">
                    <i class="fas fa-film text-red-500 text-9xl"></i>
                </div>
                <h1 class="text-6xl md:text-8xl font-bold mb-4">404</h1>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Oops! Page Not Found</h2>
                <p class="text-xl max-w-2xl mx-auto mb-8 text-gray-300">
                    It seems like this movie scene has been cut from the final edit. The page you're looking for doesn't exist or has been moved.
                </p>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <a href="#" class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-full font-medium transition flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i> Go to Homepage
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded-full font-medium transition flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> Search Movies
                    </a>
                </div>
            </div>
        </section>

        <!-- Popular Movies Section -->
        <section class="py-12 bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3 mb-6">Popular Movies You Might Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Movie Card -->
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900">
                        <img src="https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UX1000_.jpg" alt="The Dark Knight" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">The Dark Knight</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2008</span>
                                <span class="mr-2">IMDb: 9.0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900">
                        <img src="https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg" alt="The Godfather" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">The Godfather</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">1972</span>
                                <span class="mr-2">IMDb: 9.2</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900">
                        <img src="https://m.media-amazon.com/images/M/MV5BMjExMjkwNTQ0Nl5BMl5BanBnXkFtZTcwNTY0OTk1Mw@@._V1_.jpg" alt="Inception" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Inception</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2010</span>
                                <span class="mr-2">IMDb: 8.8</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900 hidden md:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_FMjpg_UX1000_.jpg" alt="Parasite" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Parasite</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2019</span>
                                <span class="mr-2">IMDb: 8.6</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900 hidden lg:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BNDYxNjQyMjAtNTdiOS00NGYwLWFmNTAtNThmYjU5ZGI2YTI1XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_FMjpg_UX1000_.jpg" alt="The Batman" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">The Batman</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2022</span>
                                <span class="mr-2">IMDb: 7.8</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movie-card rounded-lg overflow-hidden shadow-lg bg-gray-900 hidden lg:block">
                        <img src="https://m.media-amazon.com/images/M/MV5BYjhiNjBlODctY2ZiOC00YjVlLWFlNzAtNTVhNzM1YjI1NzMxXkEyXkFqcGdeQXVyMjQxNTE1MDA@._V1_FMjpg_UX1000_.jpg" alt="Avatar: The Way of Water" class="w-full h-48 object-cover">
                        <div class="p-3">
                            <h3 class="font-medium mb-1">Avatar: The Way of Water</h3>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="mr-2">2022</span>
                                <span class="mr-2">IMDb: 7.6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
            // Simple animation for the 404 page
            document.addEventListener('DOMContentLoaded', function() {
                const errorIcon = document.querySelector('.error-animation');
                
                // Add click animation
                errorIcon.addEventListener('click', function() {
                    this.style.animation = 'none';
                    setTimeout(() => {
                        this.style.animation = 'float 3s ease-in-out infinite';
                    }, 10);
                });
            });
        </script>
    </body>
</html>