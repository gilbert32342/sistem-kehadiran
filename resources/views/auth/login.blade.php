<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LAB Coe</title>
    
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <style>
    
        .bg-image {
            background: url('image/bg_login.jpg') no-repeat center center;
            background-size: cover;
        }

        
        .fade-in {
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.8s forwards ease-out;
        }

        @keyframes fadeIn {
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-image flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white bg-opacity-90 p-6 rounded-lg shadow-md fade-in">
        <h2 class="text-center text-2xl font-bold mb-4 text-gray-800">Login</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">NIS/NIP</label>
                <div class="relative">
                    <input type="text" name="nis_nip" class="w-full p-2 border rounded pl-10" required placeholder="Masukkan NIS/NIP Anda">
                    <span class="absolute left-3 top-2.5 text-gray-500">
                        <i class="fas fa-user"></i>
                    </span>
                </div>                
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full p-2 border rounded pl-10 pr-10" required placeholder="Masukkan password Anda">
                    <span class="absolute left-3 top-2.5 text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <span class="absolute right-3 top-2.5 text-gray-500 cursor-pointer" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            
            <div class="flex justify-between items-center mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-600 text-sm">Ingat Saya</span>
                </label>
                <p class="mt-2">
                    <a href="{{ route('password.request') }}" class="text-blue-500">Lupa Password?</a>
                </p>                
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition btn-hover">Login</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-4">
            <a href="https://forms.gle/GZZ5YrBboMuYE3L49" class="text-blue-500 hover:underline">
                Silakan hubungi admin jika mengalami masalah login.
            </a>
        </p>            
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");

            togglePassword.addEventListener("click", function () {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = "password";
                    togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>
</body>
</html>
