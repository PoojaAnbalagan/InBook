<?php
// register.php – InBook Registration Form (No CSRF)
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>InBook – Register</title>

  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#2E8B57',
            accent : '#FF6B35',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          backdropBlur: { DEFAULT: '12px' },
        },
      },
    }
  </script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .glass {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border: 1px solid rgba(255, 255, 255, 0.5);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    }
    body {
      background: linear-gradient(135deg, #e0f2fe 0%, #fef3c7 100%);
      min-height: 100vh;
    }
    .input-focus:focus {
      outline: none;
      ring: 2px solid #2E8B57;
      border-color: #2E8B57;
    }
  </style>
</head>
<body class="font-sans antialiased text-gray-800">

<!-- ==================== FORM SECTION ==================== -->
<section class="min-h-screen flex items-center justify-center p-4">
  <div class="glass rounded-3xl p-8 w-full max-w-3xl shadow-xl">
    <h1 class="text-4xl font-bold text-center mb-8 text-primary">Create Your Account</h1>

    <!-- CSRF REMOVED -->
    <form method="post" action="/insertVoterInfo/" onsubmit="return validatePassword()" class="space-y-6">

      <div class="grid md:grid-cols-2 gap-6">
        <!-- NIC -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">NIC Number</label>
          <input type="text" name="NIC" id="NIC" required
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="e.g. 199912345678" pattern="\d{12}" title="12-digit NIC number">
        </div>

        <!-- First Name -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
          <input type="text" name="firstName" required maxlength="20"
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="John">
        </div>

        <!-- Last Name -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
          <input type="text" name="lastName" required maxlength="20"
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="Doe">
        </div>

        <!-- Middle Name -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Middle Name (Optional)</label>
          <input type="text" name="middleName" maxlength="20"
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="Middle">
        </div>

        <!-- Phone -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
          <input type="tel" name="phoneNo" required pattern="[0-9]{10}"
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="0712345678">
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
          <input type="email" name="email" required
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="john@example.com">
        </div>
      </div>

      <!-- Address -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Permanent Address</label>
        <textarea name="address" rows="3" required maxlength="150"
                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                  placeholder="123 Main St, Colombo, Sri Lanka"></textarea>
      </div>

      <!-- Username -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
        <input type="text" name="userName" required maxlength="20"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
               placeholder="johndoe123">
      </div>

      <!-- Password -->
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
          <input type="password" name="password" id="password" required minlength="10" maxlength="16"
                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).{10,}"
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="Enter strong password">
          <p class="text-xs text-gray-600 mt-2">
            Must include: 10+ chars, uppercase, lowercase, number, special char (@#$%^&+=!)
          </p>
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
          <input type="password" id="confirmPassword" required
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                 placeholder="Re-enter password">
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-4 mt-8">
        <button type="reset"
                class="px-8 py-3 border border-gray-400 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">
          Reset
        </button>
        <button type="submit"
                class="px-8 py-3 bg-primary text-white rounded-lg font-medium hover:bg-[#246d43] transition shadow-lg">
          Register
        </button>
      </div>
    </form>
  </div>
</section>

<!-- ==================== FOOTER ==================== -->
<?php include 'footer.php'; ?>

<!-- ==================== JS: Password Match ==================== -->
<script>
  function validatePassword() {
    const pass = document.getElementById('password').value;
    const confirm = document.getElementById('confirmPassword').value;

    if (pass !== confirm) {
      Swal.fire({
        icon: 'error',
        title: 'Passwords Don’t Match',
        text: 'Please make sure both passwords are identical.',
        confirmButtonColor: '#d33'
      });
      return false;
    }
    return true;
  }
</script>

</body>
</html>