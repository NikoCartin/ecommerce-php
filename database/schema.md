# Esquema de Base de Datos - E-commerce Demo

## Descripción General

La base de datos `tienda` contiene las tablas necesarias para el funcionamiento completo del sistema de e-commerce.

## Tablas

### productos
Almacena la información del catálogo de productos.

| Campo | Tipo | Descripción | Restricciones |
|-------|------|-------------|---------------|
| codigo | INT | Identificador único del producto | PRIMARY KEY, AUTO_INCREMENT |
| nombre | VARCHAR(100) | Nombre del producto | NOT NULL |
| detalle | TEXT | Descripción detallada del producto | |
| precio | DECIMAL(10,2) | Precio del producto | NOT NULL |
| imagen | VARCHAR(255) | URL o ruta de la imagen | |

### consultas
Almacena las consultas y mensajes de contacto de los usuarios.

| Campo | Tipo | Descripción | Restricciones |
|-------|------|-------------|---------------|
| id | INT | Identificador único de la consulta | PRIMARY KEY, AUTO_INCREMENT |
| nombre | VARCHAR(100) | Nombre del usuario | NOT NULL |
| telefono | VARCHAR(20) | Teléfono de contacto | |
| email | VARCHAR(100) | Correo electrónico | NOT NULL |
| consulta | TEXT | Mensaje de la consulta | NOT NULL |
| fecha | TIMESTAMP | Fecha y hora de la consulta | DEFAULT CURRENT_TIMESTAMP |

### ordenes
Almacena la información principal de las órdenes de compra.

| Campo | Tipo | Descripción | Restricciones |
|-------|------|-------------|---------------|
| id | INT | Identificador único de la orden | PRIMARY KEY, AUTO_INCREMENT |
| nombre_cliente | VARCHAR(100) | Nombre completo del cliente | NOT NULL |
| email_cliente | VARCHAR(100) | Email del cliente | NOT NULL |
| telefono_cliente | VARCHAR(20) | Teléfono del cliente | |
| direccion_envio | TEXT | Dirección de envío | NOT NULL |
| metodo_envio | VARCHAR(50) | Método de envío seleccionado | NOT NULL |
| costo_envio | DECIMAL(10,2) | Costo del envío | DEFAULT 0.00 |
| total_productos | DECIMAL(10,2) | Total de los productos | NOT NULL |
| total_orden | DECIMAL(10,2) | Total final de la orden | NOT NULL |
| fecha_orden | TIMESTAMP | Fecha y hora de la orden | DEFAULT CURRENT_TIMESTAMP |
| estado | VARCHAR(20) | Estado de la orden | DEFAULT 'pendiente' |

### orden_detalle
Almacena los detalles de productos por cada orden.

| Campo | Tipo | Descripción | Restricciones |
|-------|------|-------------|---------------|
| id | INT | Identificador único del detalle | PRIMARY KEY, AUTO_INCREMENT |
| orden_id | INT | ID de la orden padre | FOREIGN KEY (ordenes.id) |
| producto_codigo | INT | Código del producto | NOT NULL |
| producto_nombre | VARCHAR(100) | Nombre del producto | NOT NULL |
| producto_precio | DECIMAL(10,2) | Precio unitario del producto | NOT NULL |
| cantidad | INT | Cantidad ordenada | NOT NULL |
| subtotal | DECIMAL(10,2) | Subtotal de la línea | NOT NULL |

## Relaciones

- `orden_detalle.orden_id` → `ordenes.id` (Muchos a Uno)
- Los productos en `orden_detalle` referencian a `productos` por código, pero no hay FK para permitir eliminación de productos sin afectar órdenes históricas.

## Índices Recomendados

```sql
-- Para mejorar el rendimiento
CREATE INDEX idx_ordenes_fecha ON ordenes(fecha_orden);
CREATE INDEX idx_ordenes_estado ON ordenes(estado);
CREATE INDEX idx_consultas_fecha ON consultas(fecha);
CREATE INDEX idx_productos_nombre ON productos(nombre);
```

## Datos de Ejemplo

El archivo `tienda.sql` incluye productos de ejemplo para poder probar inmediatamente la funcionalidad del sistema.

## Consideraciones de Seguridad

- Usar prepared statements para todas las consultas
- Validar y sanitizar todos los inputs de usuario
- Implementar tokens CSRF para formularios
- Limitar el acceso directo a archivos de configuración

## Migración y Mantenimiento

Para futuras versiones, considerar:
- Tabla de usuarios/clientes registrados
- Sistema de inventario
- Categorías de productos
- Sistema de descuentos/cupones
- Historial de estados de órdenes
