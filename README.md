# Prueba Técnica Hitch - CRUD de Pagos

Prueba técnica para el equipo de Hitch, consistente en un sistema de gestión de pagos desarrollado en Laravel que permite el listado, creación, edición y eliminación de registros de pagos.

## ⚙️ Pasos para levantar el proyecto

Siga estos pasos detalladamente para ejecutar la aplicación en su entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd PRUEBA-HITCH-BERNARDO-CASTRO
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   Cree el archivo `.env` a partir del ejemplo y configure sus credenciales de base de datos. **Importante:** Asegúrese de tener creada una base de datos con el nombre `prueba_tecnica` (o el que defina en su configuración):
   ```bash
   cp .env.example .env
   ```

4. **Generar la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

6. **Generar documentación Swagger:**
   ```bash
   php artisan l5-swagger:generate
   ```

7. **Iniciar el servidor:**
   ```bash
   php artisan serve
   ```

## 📖 Documentación y Rutas

- **Ruta Principal**: [http://localhost:8000/pagos](http://localhost:8000/pagos)
- **Documentación Swagger (API)**: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
- **Punto Extra (Bonus API)**: [http://localhost:8000/punto-extra](http://localhost:8000/punto-extra)

---
**Autor:** Bernardo Castro - jcastro.jcv@gmail.com
