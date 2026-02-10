<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - BonVoy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-700 antialiased">
    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-display text-bonvoy-navy uppercase tracking-tighter mb-4">Términos y Condiciones</h1>
            <p class="text-gray-500">Última actualización: Febrero 2026</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 space-y-8 leading-relaxed">
            
            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">1. Aceptación de los Términos</h2>
                <p>Al acceder y utilizar la plataforma <strong>BonVoy</strong>, propiedad de NeoTrips, usted acepta cumplir con estos términos y condiciones. Si no está de acuerdo, le sugerimos abstenerse de usar nuestros servicios.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">2. Descripción del Servicio</h2>
                <p>BonVoy actúa como intermediario entre los usuarios y los proveedores de servicios turísticos (aerolíneas, hoteles, tours). Nuestra responsabilidad se limita a la facilitación de la reserva y la gestión de la plataforma.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">3. Reservas y Pagos</h2>
                <ul class="list-disc ml-6 space-y-2">
                    <li>Los precios mostrados están sujetos a cambios según disponibilidad.</li>
                    <li>La confirmación de la reserva solo es válida una vez procesado el pago completo.</li>
                    <li>BonVoy utiliza pasarelas de pago seguras para proteger su información financiera.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">4. Cancelaciones y Reembolsos</h2>
                <p>Cada proveedor (hotel o aerolínea) tiene sus propias políticas. BonVoy gestionará las solicitudes de reembolso basándose estrictamente en las condiciones del proveedor final. Los cargos por gestión de BonVoy no son reembolsables.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bonvoy-main mb-4">5. Protección de Datos</h2>
                <p>Su privacidad es prioridad. Los datos recolectados (nombre, email, preferencias) se utilizan exclusivamente para mejorar su experiencia de viaje y procesar sus reservas, de acuerdo con nuestra Política de Privacidad.</p>
            </section>

            <div class="pt-8 border-t border-gray-100 flex justify-center">
                <a href="{{ route('register') }}" class="bg-bonvoy-main text-white px-10 py-3 rounded-full font-bold hover:bg-bonvoy-teal transition shadow-lg">
                    Entendido, volver al registro
                </a>
            </div>
        </div>
    </div>
</body>
</html>