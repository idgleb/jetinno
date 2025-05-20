# 🚀 Jetinno Argentina - Proyecto Web

![Jetinno Logo](img/virtud3.png)

## 📝 Descripción del Proyecto

Este proyecto es una plataforma web completa para Jetinno Argentina, desarrollada con un enfoque en la experiencia de usuario, seguridad y funcionalidad. La aplicación permite gestionar productos, usuarios y contenido, con un diseño moderno y responsivo.

## ✨ Características Principales

- 🔐 **Sistema de Autenticación**: Login y registro con validación en tiempo real
- 🔄 **Integración con Google**: Inicio de sesión simplificado mediante OAuth
- 📱 **Diseño Responsivo**: Adaptable a todos los dispositivos
- 🧩 **Arquitectura Modular**: Componentes reutilizables para fácil mantenimiento
- 👤 **Panel de Administración**: Gestión completa de usuarios y productos
- 📊 **Validación de Formularios**: Feedback instantáneo al usuario
- 🗺️ **Integración con Google Maps**: Visualización de ubicación en página de contacto

## 🛠️ Stack Tecnológico

### Frontend
- **HTML5** & **CSS3**: Estructura y estilos base
- **JavaScript (ES6+)**: Interactividad y validaciones del lado del cliente
- **Bootstrap 5**: Framework CSS para diseño responsivo
- **Font Awesome / Bootstrap Icons**: Iconografía
- **Validator.js**: Biblioteca para validación de formularios
- **Fetch API**: Comunicación asíncrona con el backend

### Backend
- **PHP 7+**: Lenguaje de servidor principal
- **MySQL**: Sistema de gestión de base de datos
- **Google API PHP Client**: Integración con servicios de Google
- **Sesiones PHP**: Gestión de autenticación y estado de usuario

### Herramientas de Desarrollo
- **Git**: Control de versiones
- **Composer**: Gestión de dependencias PHP
- **AJAX**: Comunicación asíncrona cliente-servidor

## 🔧 Estructura del Proyecto

```
jetinno/
├── api_post_*.php        # Endpoints para procesamiento de formularios
├── layout/               # Componentes reutilizables
│   ├── header.php        # Cabecera del sitio
│   ├── footer.php        # Pie de página
│   ├── enlases_menu.php  # Navegación principal
│   └── lista_productos.php # Componente de listado de productos
├── admin_*.php           # Páginas de administración
├── google-api-php-client/ # Biblioteca para integración con Google
├── img/                  # Recursos gráficos
├── funciones.php         # Funciones auxiliares PHP
├── index.php             # Página principal
├── contactos.php         # Formulario de contacto
├── login.php             # Página de inicio de sesión
└── registrar_usuario.php # Página de registro
```

## 📋 Flujo de Trabajo

### Autenticación de Usuario
1. **Registro de Usuario**:
   - Validación en tiempo real de campos (nombre, email, contraseña)
   - Opción de registro con Google OAuth
   - Almacenamiento seguro de credenciales

2. **Inicio de Sesión**:
   - Validación de credenciales
   - Manejo de sesiones PHP
   - Recuperación de datos de usuario

### Administración
1. **Gestión de Productos**:
   - CRUD completo (Crear, Leer, Actualizar, Eliminar)
   - Carga de imágenes
   - Validación de datos

2. **Gestión de Usuarios**:
   - Visualización de usuarios registrados
   - Modificación de permisos
   - Eliminación de cuentas

### Frontend
1. **Componentes Reutilizables**:
   - Header y footer consistentes
   - Sistema de navegación
   - Modales para información detallada

2. **Validación de Formularios**:
   - Feedback visual inmediato
   - Mensajes de error personalizados
   - Prevención de envío de datos inválidos

## 🚀 Instalación y Configuración

### Requisitos Previos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Composer

### Pasos de Instalación

1. **Clonar el repositorio**:
```bash
git clone https://github.com/tu-usuario/jetinno-argentina.git
cd jetinno-argentina
```

2. **Instalar dependencias**:
```bash
composer install
```

3. **Configurar base de datos**:
   - Crear base de datos MySQL
   - Importar estructura desde archivo SQL proporcionado
   - Configurar credenciales de conexión

4. **Configurar API de Google**:
   - Crear proyecto en Google Cloud Console
   - Habilitar API de OAuth
   - Configurar credenciales en `google_login.php`

5. **Configurar servidor web**:
   - Apuntar DocumentRoot al directorio del proyecto
   - Configurar permisos de archivos

## 📊 Patrones de Diseño Implementados

- **MVC Simplificado**: Separación de lógica, presentación y datos
- **Singleton**: Para conexiones a base de datos
- **Factory**: Creación de objetos complejos
- **Observer**: Para manejo de eventos y actualizaciones

## 🔍 Mejores Prácticas

- **Validación de Entrada**: Tanto en cliente como en servidor
- **Prevención de SQL Injection**: Uso de consultas preparadas
- **Cross-Site Scripting (XSS) Protection**: Escape de salida
- **Manejo de Errores**: Captura y registro de excepciones
- **Código Modular**: Funciones y componentes reutilizables

## 🤝 Contribución

1. Fork del repositorio
2. Crear rama de características (`git checkout -b feature/nueva-caracteristica`)
3. Commit de cambios (`git commit -m 'Añadir nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Crear Pull Request

## 📞 Contacto

Para más información sobre el desarrollo de este proyecto:

- 📧 Email: [argentinagleb73@gmail.com](mailto:argentinagleb73@gmail.com)
- 🌐 Sitio web: [https://jetinno.store](https://jetinno.store)
- 📱 LinkedIn: [Ursol Gleb](https://www.linkedin.com/in/gleb-ursol-855725326/)

---

⭐ **Desarrollado con pasión y café** ☕
