<!-- @extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
    
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg rounded-lg text-center p-5">
            
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#198754" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>

            <h2 class="h3 font-weight-bold mb-3">¡Registro Exitoso!</h2>
            <p class="text-muted mb-4">Bienvenido a la plataforma. Tu cuenta está lista.</p>

            <div class="d-flex justify-content-center align-items-center p-3 bg-light rounded">
                <div class="spinner-border text-success mr-2 me-2" role="status">
                    <span class="sr-only visually-hidden">Cargando...</span>
                </div>
                
                <span class="text-dark font-weight-bold">
                    Redirigiendo en <span id="countdown">3</span> segundos
                </span>
            </div>

            <p class="small text-muted mt-3 mb-0">
                Si no eres redirigido, <a href="{{ url('/home') }}" class="text-success font-weight-bold">haz clic aquí</a>.
            </p>
        </div>
    </div>

</div>

<script>
    let seconds = 3;
    // IMPORTANTE: Aquí ponemos la ruta FINAL (Tu Dashboard real)
    const targetUrl = "{{ url('/home') }}"; 

    const countdownElement = document.getElementById('countdown');

    const interval = setInterval(() => {
        seconds--;
        countdownElement.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = targetUrl;
        }
    }, 1000);
</script>
@endsection -->