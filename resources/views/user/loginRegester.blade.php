<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #f2f4f7;
            font-family: 'Segoe UI', sans-serif;
        }

        .auth-wrapper {
            max-width: 400px;
            margin: 60px auto;
        }

        .form-container {
            display: none;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .form-container.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .form-title {
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.85rem;
        }

        .switch-link {
            text-align: center;
            margin-top: 15px;
        }

        .switch-link a {
            text-decoration: none;
            color: #007bff;
        }

        .switch-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Login Form -->
    <div class="form-container loginform {{ $errors->has('loginEmail') || $errors->has('loginPassword') ? 'active' : (count($errors) === 0 ? 'active' : '') }}">
        @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
    
        <h2 class="form-title">Login</h2>
        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="email" class="form-control"  value="{{ Cookie::get('email') }}"  name="loginEmail" id="loginEmail" placeholder="Enter email" required>
                @error('loginEmail')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" name="loginPassword" id="loginPassword" placeholder="Enter password" required>
                @error('loginPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
            <input type="checkbox" name="remember_me" id="" >
            <label for="remeber_me">Remeber me</label>
            <div>
                <a href="{{route('forget.password.get')}}">Forgot Password ?</a>
            </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="switch-link mt-3">Don't have an account? <a href="#" id="showRegister">Register</a></div>
    </div>

    <!-- Register Form -->
    <div class="form-container regesterform {{ $errors->has('regesterEmail') || $errors->has('regesterPassword') || $errors->has('avatar') || $errors->has('name') ? 'active' : '' }}">
        <h2 class="form-title">Register</h2>
        <form action="/register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter password" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="regesterEmail">Email</label>
                <input type="email" class="form-control" name="regesterEmail" id="regesterEmail" placeholder="Enter email" required>
                @error('regesterEmail')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="regesterPassword">Password</label>
                <input type="password" class="form-control" name="regesterPassword" id="regesterPassword" placeholder="Enter password" required>
                @error('regesterPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control" name="avatar" id="avatar" required>
                @error('avatar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <div class="switch-link mt-3">Already have an account? <a href="#" id="showLogin">Login</a></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const loginForm = document.querySelector('.loginform');
        const registerForm = document.querySelector('.regesterform');
        const showRegisterLink = document.getElementById('showRegister');
        const showLoginLink = document.getElementById('showLogin');

        showRegisterLink.addEventListener('click', function (e) {
            e.preventDefault();
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
        });

        showLoginLink.addEventListener('click', function (e) {
            e.preventDefault();
            registerForm.classList.remove('active');
            loginForm.classList.add('active');
        });
    });
</script>
</body>
</html>
