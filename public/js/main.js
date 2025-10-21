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
