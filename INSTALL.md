# Guía de Instalación - E-commerce Demo

## Requisitos Previos

- PHP 7.4 o superior
- MySQL 5.7 o superior  
- Servidor web Apache
- XAMPP (recomendado para desarrollo local)

## Pasos de Instalación

### 1. Descargar el Proyecto

```bash
git clone https://github.com/NikoCartin/ecommerce-php.git
cd ecommerce-php
```

### 2. Configurar el Servidor Web

- Si usas XAMPP, copia el proyecto a la carpeta `htdocs`
- Asegúrate de que Apache y MySQL estén ejecutándose

### 3. Crear la Base de Datos

1. Abre phpMyAdmin en `http://localhost/phpmyadmin`
2. Crea una nueva base de datos llamada `tienda`
3. Importa el archivo `database/tienda.sql`

Alternativamente, desde línea de comandos:

```bash
mysql -u root -p
CREATE DATABASE tienda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda;
SOURCE database/tienda.sql;
```

### 4. Configurar la Conexión

1. Copia el archivo de configuración:
   ```bash
   cp config/config.php.example config/config.php
   ```

2. Edita `config/config.php` con tus datos:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'tu_usuario');
   define('DB_PASS', 'tu_contraseña');
   define('DB_NAME', 'tienda');
   ```

### 5. Configurar Permisos

Asegúrate de que el directorio `logs/` tenga permisos de escritura:

```bash
# En Linux/Mac
chmod 755 logs/

# En Windows con XAMPP generalmente no es necesario
```

### 6. Verificar la Instalación

1. Abre tu navegador
2. Ve a `http://localhost/ecommerce-php-demo`
3. Deberías ver el catálogo de productos

## Configuración Adicional

### Configuración de Desarrollo

Para activar el modo debug, edita `config/config.php`:

```php
define('DEBUG_MODE', true);
```

### Configuración de Producción

Para producción:

1. Cambia `DEBUG_MODE` a `false`
2. Usa credenciales seguras para la base de datos
3. Configura HTTPS
4. Revisa la configuración del servidor web

## Solución de Problemas

### Error de Conexión a la Base de Datos

- Verifica que MySQL esté ejecutándose
- Confirma las credenciales en `config/config.php`
- Asegúrate de que la base de datos `tienda` exista

### Errores de Permisos

- Verifica que PHP tenga permisos de escritura en `logs/`
- En Windows/XAMPP, ejecuta como administrador si es necesario

### Páginas en Blanco

- Revisa los logs de error de PHP
- Activa `DEBUG_MODE` temporalmente
- Verifica que todas las extensiones PHP requeridas estén instaladas

### Problemas con Sesiones

- Verifica que el directorio temporal de PHP tenga permisos correctos
- Asegúrate de que `session.save_path` esté configurado correctamente

## Datos de Prueba

El archivo SQL incluye productos de ejemplo. Para agregar más productos:

```sql
INSERT INTO productos (nombre, detalle, precio, imagen) VALUES 
('Producto Test', 'Descripción del producto', 99.99, 'ruta/imagen.jpg');
```

## Personalización

### Cambiar el Logo

Reemplaza `assets/images/NikoTech.jpg` con tu logo y actualiza las referencias en `includes/navbar.php`

### Modificar Estilos

Agrega tu CSS personalizado en `assets/css/custom.css` y enlázalo en las vistas.

### Configurar Email (Futuro)

Para implementar envío de emails, configura SMTP en `config/config.php`:

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'tu_email@gmail.com');
define('SMTP_PASS', 'tu_contraseña_app');
```

## Mantenimiento

### Respaldos

Realiza respaldos regulares de la base de datos:

```bash
mysqldump -u root -p tienda > backup_$(date +%Y%m%d).sql
```

### Logs

Revisa regularmente los archivos de log en el directorio `logs/`

### Actualizaciones

Mantén actualizado PHP, MySQL y las dependencias del proyecto.

## Soporte

Si encuentras problemas:

1. Revisa esta guía de instalación
2. Consulta la documentación en el README.md
3. Abre un issue en GitHub: https://github.com/NikoCartin/ecommerce-php/issues
4. Contacta al desarrollador: nicolascartinreyes@gmail.com
