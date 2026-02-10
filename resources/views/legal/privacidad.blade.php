<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - BonVoy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-700 antialiased">
    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-display text-bonvoy-navy uppercase tracking-tighter mb-4">Política de Privacidad</h1>
            <p class="text-gray-500">Tu privacidad es lo más importante para nosotros.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 space-y-8 leading-relaxed">
            
            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">1. Información que Recolectamos</h2>
                <p>En <strong>BonVoy</strong>, recolectamos información básica para que puedas gestionar tus viajes:</p>
                <ul class="list-disc ml-6 mt-2 space-y-1">
                    <li>Nombre completo y datos de contacto.</li>
                    <li>Historial de favoritos y búsquedas.</li>
                    <li>Información de transacciones y reservas.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">2. Uso de la Información</h2>
                <p>Utilizamos tus datos exclusivamente para:</p>
                <ul class="list-disc ml-6 mt-2 space-y-1">
                    <li>Procesar tus reservas con hoteles y aerolíneas.</li>
                    <li>Personalizar tus recomendaciones de viaje.</li>
                    <li>Enviarte notificaciones sobre el estado de tus viajes.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">3. Compartición con Terceros</h2>
                <p>Solo compartimos tus datos con los proveedores finales (por ejemplo, el hotel que reservaste) para garantizar el cumplimiento del servicio. No vendemos tus datos a empresas de publicidad.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">4. Seguridad</h2>
                <p>Implementamos medidas de seguridad técnicas como cifrado SSL y protección de base de datos para asegurar que tu información personal no sea accesible por personas no autorizadas.</p>
            </section>

            <div class="pt-8 border-t border-gray-100 flex justify-center">
                <a href="{{ route('register') }}" class="bg-bonvoy-main text-white px-10 py-3 rounded-full font-bold hover:bg-bonvoy-teal transition shadow-lg">
                    Aceptar y regresar
                </a>
            </div>
        </div>
    </div>
</body>
</html>