-- ============================================================
-- SCRIPT DE RESTAURACIÓN DE DATOS BONVOY
-- ============================================================

-- 1. Desactivamos seguridad de llaves foráneas para limpiar sin errores
SET FOREIGN_KEY_CHECKS = 0;

-- 2. Limpiamos las tablas (TRUNCATE resetea los IDs a 1)
TRUNCATE TABLE imagenes;
TRUNCATE TABLE contenido;

-- 3. Reactivamos seguridad
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- INSERTAR CONTENIDOS (Destinos, Vuelos, Hoteles)
-- ============================================================
INSERT INTO contenido (id, titulo, descripcion, rating, tipo, precio, activo, created_at, updated_at) VALUES 
(1, 'Safari Premium Tanzania', 'Vive la aventura salvaje definitiva en el Serengueti con avistamiento de los 5 grandes.', 4.9, 'actividad', 18500.00, 1, NOW(), NOW()),
(2, 'Vuelo Clase Business Japón', 'Vuelo redondo directo a Tokyo con servicio premium y lounge incluido.', 4.8, 'destino', 24000.00, 1, NOW(), NOW()),
(3, 'Resort Gran Paladium Cancún', 'Experiencia todo incluido frente a las mejores playas del caribe mexicano.', 4.7, 'hospedaje', 4500.00, 1, NOW(), NOW()),
(4, 'Hotel Aurora Boreal Islandia', 'Hospedaje de lujo con techos de cristal para ver la aurora boreal desde tu cama.', 4.9, 'hospedaje', 6200.00, 1, NOW(), NOW()),
(5, 'Entrada General Disneyland', 'Acceso total a los dos parques temáticos más mágicos del mundo sin filas.', 5.0, 'actividad', 2800.00, 1, NOW(), NOW()),
(6, 'Vuelo Low Cost Madrid', 'La forma más económica de cruzar el charco y conocer Europa.', 4.3, 'destino', 12500.00, 1, NOW(), NOW());

-- ============================================================
-- INSERTAR IMÁGENES (Vinculadas y Corregidas)
-- ============================================================
-- Nota: Todas tienen ?auto=format&fit=crop... para que Unsplash las sirva rápido y sin errores.

INSERT INTO imagenes (contenido_id, ruta, es_principal, created_at, updated_at) VALUES 
-- 1. Tanzania (Leones)
(1, 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW()),

-- 2. Japón (Templo/Pagoda)
(2, 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW()),

-- 3. Cancún (Playa/Alberca)
(3, 'https://images.unsplash.com/photo-1571011272708-340268426021?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW()),

-- 4. Islandia (Nieve/Aurora)
(4, 'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW()),

-- 5. Disney (Castillo)
(5, 'https://images.unsplash.com/photo-1513807768511-9279b8c05758?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW()),

-- 6. Madrid (Arquitectura)
(6, 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?auto=format&fit=crop&w=800&q=80', 1, NOW(), NOW());