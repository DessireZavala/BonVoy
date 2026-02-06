@extends('layouts.app')

<!-- @section('content') -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<style>
    /* Estilos Base */
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

    /* Wrapper flexible */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Tarjeta Cristal */
    .login-card {
        background-color: rgba(255, 255, 255, 0.94);
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        padding: 40px 30px;
        width: 100%;
        max-width: 380px;
        text-align: center;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .login-logo {
        height: 55px;
        width: auto;
        margin: 0 auto 15px auto;
        display: block;
        object-fit: contain;
    }

    .login-title {
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

    /* Botones Sociales */
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 25px;
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
        color: #333;
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
        margin: 25px 0;
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
        margin-bottom: 18px;
    }
    
    .input-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #444;
        margin-bottom: 6px;
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
        padding: 12px 20px;
        width: 100%;
        font-size: 1rem;
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
    
    .btn-login {
        background-color: #126e82;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 14px 0;
        width: 100%;
        font-size: 1.1rem;
        font-family: 'Red Hat Display', sans-serif;
        font-weight: 800;
        margin-top: 10px;
        box-shadow: 0 6px 20px rgba(18, 110, 130, 0.3);
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-login:hover { 
        background-color: #0d5666; 
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(18, 110, 130, 0.5);
    }

    .footer-link {
        margin-top: 25px;
        font-size: 0.9rem;
        color: #666;
    }
    .footer-link a {
        color: #126e82;
        font-weight: 800;
        text-decoration: none;
    }
    .footer-link a:hover { text-decoration: underline; }
    
    .forgot-link {
        display: block;
        text-align: right;
        font-size: 0.8rem;
        color: #126e82;
        font-weight: 600;
        margin-top: 5px;
        margin-right: 10px;
        text-decoration: none;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="login-logo">
        </a>
        
        <h1 class="login-title">INICIAR SESIÓN</h1>
        <p class="sub-title">Bienvenido de nuevo</p>

        <div class="social-icons">
            <a href="{{ url('auth/google') }}" class="social-btn" title="Entrar con Google">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
            </a>

            <a href="#" class="social-btn" title="Entrar con Outlook">
                <svg width="22" height="22" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#f35325" d="M1 1h10v10H1z"/>
                    <path fill="#81bc06" d="M12 1h10v10H12z"/>
                    <path fill="#05a6f0" d="M1 12h10v10H1z"/>
                    <path fill="#ffba08" d="M12 12h10v10H12z"/>
                </svg>
            </a>
        </div>

        <div class="divider">o usa tu correo</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                    Correo Electrónico
                </label>
                <input id="email" type="email" class="custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@correo.com">
                @error('email')
                    <span style="display:block; font-size: 0.75em; margin-left: 15px; margin-top:5px; color: #e3342f; font-weight: bold;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="input-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Contraseña
                </label>
                <input id="password" type="password" class="custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <span style="display:block; font-size: 0.75em; margin-left: 15px; margin-top:5px; color: #e3342f; font-weight: bold;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 20px; margin-left: 5px;">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #126e82; cursor: pointer;">
                <label for="remember" style="margin-left: 8px; font-size: 0.9rem; color: #555; cursor: pointer;">
                    Mantener sesión iniciada
                </label>
            </div>

            <button type="submit" class="btn-login">
                INGRESAR
            </button>
        </form>

        <div class="footer-link">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>

    </div>
</div>
@endsection