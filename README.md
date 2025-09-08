![Portada del Proyecto](assets/images/PortadaGithub/portada.jpg)

# E-commerce Demo - PHP & MySQL

Un sistema de comercio electrónico completo desarrollado en PHP vanilla con MySQL, diseñado para demostrar las funcionalidades principales de una tienda online.

## Características

- **Catálogo de productos** con imágenes y descripciones
- **Carrito de compras** con gestión de cantidades
- **Sistema de consultas** para atención al cliente
- **Proceso de checkout** completo
- **Diseño responsive** con Bootstrap 5
- **Gestión de sesiones** para mantener estado del carrito
- **Base de datos MySQL** para persistencia de datos

## Tecnologías Utilizadas

- **Backend:** PHP 7.4+
- **Base de datos:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **Servidor web:** Apache (XAMPP recomendado para desarrollo)

## Requisitos del Sistema

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web Apache
- Extensiones PHP: mysqli, session

## Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/NikoCartin/ecommerce-php.git
cd ecommerce-php
```

### 2. Configurar la base de datos
1. Importar el archivo `database/tienda.sql` en tu servidor MySQL
2. Crear una base de datos llamada `tienda`
3. Ejecutar el script SQL para crear las tablas y datos de ejemplo

### 3. Configurar la conexión a la base de datos
Edita el archivo `config/config.php` y ajusta los parámetros de conexión:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
define('DB_NAME', 'tienda');
```

### 4. Configurar el servidor web
- Coloca el proyecto en la carpeta del servidor web (ej: `htdocs` para XAMPP)
- Inicia Apache y MySQL
- Accede a `http://localhost/ecommerce-php`

## Estructura del Proyecto

```
ecommerce-php/
├── config/
│   └── config.php              # Configuración de base de datos
├── database/
│   ├── tienda.sql             # Script de base de datos
│   └── schema.md              # Documentación del esquema
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
│   ├── functions.php          # Funciones auxiliares
│   └── navbar.php            # Navegación común
├── pages/
│   ├── products/
│   ├── cart/
│   └── checkout/
├── public/
│   └── index.php             # Página principal
└── README.md
```

## Funcionalidades Principales

### Catálogo de Productos
- Visualización de productos en tarjetas responsivas
- Imágenes, nombres, descripciones y precios
- Botón para agregar al carrito con selección de cantidad

### Carrito de Compras
- Agregar productos con cantidades específicas
- Editar cantidades de productos existentes
- Eliminar productos individuales
- Vaciar carrito completo
- Cálculo automático de totales

### Sistema de Consultas
- Formulario de contacto para usuarios
- Validación de datos en frontend y backend
- Almacenamiento de consultas en base de datos

### Proceso de Compra
- Formulario de datos del cliente
- Selección de método de envío
- Cálculo de costos de envío
- Confirmación con modal antes de procesar
- Almacenamiento de órdenes en base de datos

## Base de Datos

### Tablas principales:
- **productos**: Catálogo de productos
- **consultas**: Mensajes de contacto de usuarios
- **ordenes**: Información de pedidos
- **orden_detalle**: Detalles de productos por orden

## Flujo de Usuario

1. **Explorar productos** → Vista de catálogo
2. **Agregar al carrito** → Selección de cantidad
3. **Gestionar carrito** → Editar/eliminar productos
4. **Iniciar compra** → Formulario de datos
5. **Confirmar orden** → Modal de confirmación
6. **Procesar pago** → Instrucciones de pago

## Contribuciones

Las contribuciones son bienvenidas. Para contribuir:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Autor

**Nícolas Cartín Reyes**
- **Ubicación:** San José, Costa Rica
- **Teléfono:** +506 6033-6576
- **Email:** nicolascartinreyes@gmail.com
- **LinkedIn:** [linkedin.com/in/nicolascartinreyes](https://linkedin.com/in/nicolascartinreyes)
- **GitHub:** [github.com/NikoCartin](https://github.com/NikoCartin)

## Soporte

Si tienes preguntas o necesitas ayuda, puedes:
- Abrir un issue en GitHub
- Contactar al desarrollador por email: nicolascartinreyes@gmail.com
- Conectar en LinkedIn: [Nícolas Cartín Reyes](https://linkedin.com/in/nicolascartinreyes)

---

Si este proyecto te fue útil, no olvides darle una estrella!
