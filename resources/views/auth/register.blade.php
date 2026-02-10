@extends('layouts.app')

<!-- @section('content') -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<style>
    /* Estilos Consistentes */
    body {
        background-image: url("{{ asset('assets/img/body.png') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: 'Red Hat Display', sans-serif; /* Tipografía Correcta */
        margin: 0;
        min-height: 100vh;
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .register-card {
        background-color: rgba(255, 255, 255, 0.94);
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        padding: 40px 30px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .register-logo {
        height: 50px;
        width: auto;
        margin: 0 auto 10px auto;
        display: block;
        object-fit: contain;
    }

    .register-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2.5rem;
        color: #1a3c4d;
        margin: 0;
        line-height: 1;
        letter-spacing: 1px;
    }
    
    .sub-title {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 20px;
        font-weight: 600;
    }

    /* Social Icons */
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .social-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .social-btn:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        border-color: #126e82;
    }

    .divider {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        margin: 20px 0;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .divider::before, .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background-color: #ddd;
        margin: 0 15px;
    }

    .form-group {
        text-align: left;
        margin-bottom: 15px;
    }
    
    .input-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #444;
        margin-bottom: 5px;
        margin-left: 12px;
        display: flex;
        align-items: center;
    }
    .input-label svg {
        margin-right: 6px;
        width: 16px;
        height: 16px;
        color: #126e82;
    }

    .custom-input {
        background-color: #f3f6f8;
        border: 2px solid transparent;
        border-radius: 50px;
        padding: 10px 20px;
        width: 100%;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.3s;
        box-sizing: border-box;
        color: #333;
        font-family: 'Red Hat Display', sans-serif;
    }
    .custom-input:focus {
        background-color: #fff;
        border-color: #126e82;
        box-shadow: 0 0 0 4px rgba(18, 110, 130, 0.1);
    }

    .btn-register {
        background-color: #126e82;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 14px 0;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 800;
        font-family: 'Red Hat Display', sans-serif;
        margin-top: 15px;
        box-shadow: 0 6px 20px rgba(18, 110, 130, 0.3);
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-register:hover { 
        background-color: #0d5666; 
        transform: translateY(-2px);
    }

    .footer-link {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #666;
    }
    .footer-link a {
        color: #126e82;
        font-weight: 800;
        text-decoration: none;
    }
    .footer-link a:hover { text-decoration: underline; }
</style>

<div class="register-wrapper">
    <div class="register-card">
        
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="register-logo">
        </a>
        
        <h1 class="register-title">CREAR CUENTA</h1>
        <p class="sub-title">Únete a la experiencia BonVoy</p>

        <div class="social-icons">
            <a href="{{ url('auth/google') }}" class="social-btn" title="Registro con Google">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
            </a>
            <a href="#" class="social-btn" title="Registro con Outlook">
                <svg width="22" height="22" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#f35325" d="M1 1h10v10H1z"/>
                    <path fill="#81bc06" d="M12 1h10v10H12z"/>
                    <path fill="#05a6f0" d="M1 12h10v10H1z"/>
                    <path fill="#ffba08" d="M12 12h10v10H12z"/>
                </svg>
            </a>
        </div>

        <div class="divider">o usa tu correo</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Nombre Completo
                </label>
                <input id="name" type="text" class="custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ej. Juan Pérez">
                @error('name')
                    <span style="display:block; font-size: 0.75em; margin-left: 15px; margin-top: 3px; color: #e3342f; font-weight: bold;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                    Correo Electrónico
                </label>
                <input id="email" type="email" class="custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="tu@email.com">
                @error('email')
                    <span style="display:block; font-size: 0.75em; margin-left: 15px; margin-top: 3px; color: #e3342f; font-weight: bold;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Contraseña
                </label>
                <input id="password" type="password" class="custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Crea una contraseña">
                @error('password')
                    <span style="display:block; font-size: 0.75em; margin-left: 15px; margin-top: 3px; color: #e3342f; font-weight: bold;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Confirmar Contraseña
                </label>
                <input id="password-confirm" type="password" class="custom-input" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
            </div>

            <button type="submit" class="btn-register">
                REGISTRARSE
            </button>
            <div class="mt-4">
    <label for="terms" class="inline-flex items-center">
        <input type="checkbox" name="terms" id="terms" class="rounded border-gray-300 text-bonvoy-main shadow-sm focus:ring-bonvoy-teal" required>
        <span class="ml-2 text-sm text-gray-600">
            Estoy de acuerdo con los 
            <a target="_blank" href="{{ route('terms') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                Términos de servicio
            </a> y 
            <a target="_blank" href="{{ route('privacy') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                Política de privacidad
            </a>
        </span>
    </label>
</div>
        </form>

        <div class="footer-link">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>

    </div>
</div>
@endsection