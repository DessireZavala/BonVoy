#!/bin/bash

echo "🚀 Iniciando instalación automática de Bonvoy..."

# 1. Instalar dependencias de PHP
echo "📦 Instalando dependencias de Composer..."
composer install

# 2. Instalar dependencias de Node.js
echo "🎨 Instalando dependencias de NPM..."
npm install

# 3. Preparar el archivo de configuración (.env)
if [ ! -f .env ]; then
    echo "📄 Creando archivo .env desde el ejemplo..."
    cp .env.example .env
    php artisan key:generate
else
    echo "✅ El archivo .env ya existe."
fi

# 4. Compilar activos de Frontend
echo "🏗️ Compilando CSS y JS..."
npm run build

# 5. Ejecutar migraciones de Base de Datos
echo "🗄️ Corriendo migraciones..."
php artisan migrate --seed

echo "✨ ¡Instalación completada! Ejecuta 'php artisan serve' para iniciar."