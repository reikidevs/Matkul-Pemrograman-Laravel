<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KostKu</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <rect width="40" height="40" rx="8" fill="#3B82F6"/>
                    <path d="M20 10L10 18V32H16V24H24V32H30V18L20 10Z" fill="white"/>
                </svg>
                <h1>KostKu</h1>
            </div>
            
            <h2>Selamat Datang</h2>
            <p class="subtitle">Silakan login untuk melanjutkan</p>
            
            @if($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 20px;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            
            <form action="{{ route('login.submit') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="nama@example.com" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-options">
                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="link">Lupa Password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <div class="register-link">
                <small style="color: var(--gray-500); display: block; margin-bottom: 8px;">Demo Login:</small>
                <small style="display: block; margin-bottom: 4px;"><strong>Pemilik:</strong> pemilik@kostku.com / pemilik123</small>
                <small style="display: block;"><strong>Penghuni:</strong> ani@test.com / penghuni123</small>
            </div>
        </div>
    </div>
</body>
</html>
