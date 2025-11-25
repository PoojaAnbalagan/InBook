<?php
/*  footer.php  –  Light-mode reusable footer (self-contained)  */
?>
<footer class="bg-gray-800 text-gray-700 py-12 mt-16 border-t border-gray-200">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Brand -->
        <div>
            <h3 class="text-gray-600 font-bold mb-5 text-lg">InBook</h3>
            <p class="text-sm text-gray-600">
                Your one-stop platform for booking premium indoor stadiums.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-gray-600 font-bold mb-5 text-lg">Quick Links</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="index.php" class="hover:text-[#2E8B58] transition">Home</a></li>
                <li><a href="#browse" class="hover:text-[#2E8B57] transition">Browse</a></li>
                <li><a href="#how-it-works" class="hover:text-[#2E8B57] transition">How It Works</a></li>
                <li><a href="#contact" class="hover:text-[#2E8B57] transition">Contact</a></li>
            </ul>
        </div>

        <!-- Sports -->
        <div>
            <h3 class="text-gray-600 font-bold mb-5 text-lg">Sports</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="#" class="hover:text-[#2E8B57] transition">Badminton</a></li>
                <li><a href="#" class="hover:text-[#2E8B57] transition">Basketball</a></li>
                <li><a href="#" class="hover:text-[#2E8B57] transition">Tennis</a></li>
                <li><a href="#" class="hover:text-[#2E8B57] transition">Football</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-gray-600 font-bold mb-5 text-lg">Contact</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="mailto:info@sportshub.com" class="hover:text-[#2E8B57] transition">info@sportshub.com</a></li>
                <li><a href="tel:+1234567890" class="hover:text-[#2E8B57] transition">+1 (234) 567-890</a></li>
            </ul>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="text-center mt-10 text-sm border-t border-gray-300 pt-6 text-gray-500">
        © <?php echo date('Y'); ?> InBook. All rights reserved.
    </div>
</footer>

<!-- ============================================= -->
<!--  TAILWIND CDN + BASIC FALLBACK (inside footer) -->
<!-- ============================================= -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#2E8B57',
        },
      },
    },
  };
</script>

<style>
  /* Fallback for older browsers / if CDN fails */
  .container { max-width: 1400px; margin: 0 auto; padding: 0 1rem; }
  .grid { display: grid; }
  .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
  @media (min-width: 768px) { .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
  .gap-8 { gap: 2rem; }
  .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
  .mt-16 { margin-top: 4rem; }
  .border-t { border-top-width: 1px; }
  .text-sm { font-size: 0.875rem; }
  .text-gray-600 { color: #718096; }
  .hover\:text-\[\#2E8B57\]:hover { color: #2E8B57; }
  .transition { transition: color .2s ease; }
</style>