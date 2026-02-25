## 🚀 Requisitos Previos

Para correr este proyecto localmente, necesitarás:
* **Laragon** (Recomendado) o XAMPP con PHP 8.1+
* **Git:** Necesario para el control de versiones. Podés descargarlo en [git-scm.com](https://git-scm.com/).
* **Composer:** (Si utilizás XAMPP, debés instalarlo manualmente. Laragon lo incluye por defecto).
* **MySQL/MariaDB**

## 🛠️ Configuración del Entorno

1. **Base de Datos:**
   * Abrí el Dashboard de **Laragon** y hacé clic en el botón **Database**. Se abrirá **phpMyAdmin**.
   * Creá una nueva base de datos llamada `swimming_pool`.
   * Entrá a la carpeta `database/` en la raíz del proyecto e importá el archivo `swimming_pool.sql`.

2. **Variables de Entorno:**
   * Renombrá el archivo `.env.template` a `.env`.
   * Editá las variables según tu configuración local. Es fundamental configurar correctamente la `BASE_URL` (ej: `http://localhost/gestion-natacion`) y las credenciales SMTP para que el sistema de correos funcione.

## 📚 Documentación y Recursos Útiles

| Tecnología | Recurso | Utilidad |
| :--- | :--- | :--- |
| **Git** | [Git Documentation](https://git-scm.com/doc) | Guía de comandos básicos y flujo de trabajo. |
| **PHP** | [Manual Oficial](https://www.php.net/manual/es/) | Consulta de funciones y PDO. |
| **JavaScript** | [MDN Web Docs](https://developer.mozilla.org/es/docs/Web/JavaScript) | Guía de JS y Fetch API. |
| **Bootstrap 5** | [W3Schools BS5](https://www.w3schools.com/bootstrap5/) | Referencia de componentes y grilla. |
| **Diseño** | [Coolors.co](https://coolors.co/) | Generación de paletas de colores. |

---
*Este proyecto busca simular un entorno profesional de desarrollo. El uso de Git y la lectura de documentación técnica son parte integral de la formación.*