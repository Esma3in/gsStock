<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tailwind CSS</title>
    <!-- Link to Tailwind CSS (Use CDN for quick setup, or your own build) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Optional: You can customize Tailwind theme here if needed
      // tailwind.config = {
      //   theme: {
      //     extend: {
      //       colors: {
      //         primary: '#ff0000', // Example custom color
      //       }
      //     }
      //   }
      // }
    </script>
    <style>
        /* Optional: Slightly better baseline alignment for the icon button */
        .input-icon-button {
            line-height: 0; /* Prevents button taking extra height due to line-height */
        }
    </style>
</head>
<body class="bg-gray-100">

  <!-- Main Container - Full Height, Flex Centering -->
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <!-- Login Card -->
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">

      <!-- Header -->
      <div>
        <!-- Optional Logo - replace # with your logo path -->
        <!-- <img class="mx-auto h-12 w-auto" src="#" alt="Your Company"> -->
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
            start your 14-day free trial
          </a>
        </p>
      </div>

      <!-- Login Form -->
      <form class="mt-8 space-y-6" action="{{ route('user.login') }}" method="POST">
        @csrf
        <!-- We use a hidden input for CSRF protection in real apps -->
        <input type="hidden" name="remember" value="true">
        @if (session('notFound'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('notFound') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="rounded-md shadow-sm -space-y-px">

          <!-- Email Input -->
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email"  required value="{{ old('eamil') }}"
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                   placeholder="Email address">
                   @error('email')
                   <small class="text-danger">{{ $message }}</small>
                   @enderror
          </div>

          <!-- Password Input Wrapper (for positioning the button) -->
          <div class="relative">
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password"  required value="{{ old('password') }}"
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm pr-10" >

            
            <!-- Show/Hide Password Button -->
            <button type="button" id="togglePassword" aria-label="Show password as plain text. Warning: this will display your password on the screen." class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 input-icon-button text-gray-500 hover:text-gray-700 focus:outline-none">
              <!-- Eye Icon (Heroicons) -->
              <svg id="eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
              <!-- Eye Slash Icon (Heroicons) - Initially Hidden -->
              <svg id="eye-slash-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.291M14.12 14.12l3.29 3.29m-13.5-3.29a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243m-4.242-4.242L9.88 9.88" />
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19 12 19c.976 0 1.913-.163 2.79-.457M12 5c4.478 0 8.268 2.943 9.543 7a9.97 9.97 0 01-1.563 3.029m-2.177-1.023A3 3 0 0013.875 12"/>
              </svg>
            </button>
            @error('password')
                   <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me" name="remember" type="checkbox"
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              Remember me
            </label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
              Forgot your password?
            </a>
          </div>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit"
                  class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sign in
          </button>
        </div>
      </form>

    </div> <!-- End Login Card -->

  </div> <!-- End Main Container -->

  <script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeSlashIcon = document.getElementById('eye-slash-icon');

    togglePasswordButton.addEventListener('click', function (e) {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle the icon visibility
        eyeIcon.classList.toggle('hidden');
        eyeSlashIcon.classList.toggle('hidden');

        // Update aria-label for accessibility
        if (type === 'password') {
            togglePasswordButton.setAttribute('aria-label', 'Show password as plain text. Warning: this will display your password on the screen.');
        } else {
            togglePasswordButton.setAttribute('aria-label', 'Hide password.');
        }
    });
  </script>

</body>
</html>