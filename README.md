 # Sistema de Gestión de Préstamos

Un sistema completo de gestión de préstamos desarrollado con tecnologías modernas para administrar clientes, préstamos, pagos y generar reportes detallados.

## 🚀 Características Principales

- **Gestión de Clientes**: Registro y administración completa de información de clientes
- **Control de Préstamos**: Creación y seguimiento de préstamos con diferentes tasas de interés
- **Sistema de Pagos**: Registro de pagos con cálculo automático de saldos
- **Reportes Detallados**: Generación de reportes en PDF con información completa
- **Interfaz Moderna**: UI responsive con Tailwind CSS
- **Base de Datos Robusta**: PostgreSQL con Prisma ORM

## 🛠️ Tecnologías Utilizadas

### Backend
- **Node.js** - Entorno de ejecución
- **Express** - Framework web
- **Prisma** - ORM para base de datos
- **PostgreSQL** - Base de datos relacional
- **PDFKit** - Generación de documentos PDF

### Frontend
- **EJS** - Motor de plantillas
- **Tailwind CSS** - Framework de estilos
- **JavaScript** - Interactividad del cliente

## 📋 Prerequisitos

- Node.js (v14 o superior)
- PostgreSQL (v12 o superior)
- npm o yarn

## 🔧 Instalación

1. **Clonar el repositorio**
```bash
git clone <url-del-repositorio>
cd prestamoQua
```

2. **Instalar dependencias**
```bash
npm install
```

3. **Configurar variables de entorno**

Crear un archivo `.env` en la raíz del proyecto:
```env
DATABASE_URL="postgresql://usuario:contraseña@localhost:5432/nombre_bd"
PORT=3000
```

4. **Configurar la base de datos**
```bash
# Generar el cliente de Prisma
npx prisma generate

# Ejecutar migraciones
npx prisma migrate dev

# (Opcional) Poblar la base de datos
npx prisma db seed
```

5. **Iniciar el servidor**
```bash
# Modo desarrollo
npm run dev

# Modo producción
npm start
```

El servidor estará disponible en `http://localhost:3000`

## 📁 Estructura del Proyecto

```
prestamoQua/
│
├── prisma/
│   ├── schema.prisma      # Esquema de base de datos
│   └── migrations/        # Migraciones de BD
│
├── public/
│   ├── css/              # Archivos CSS
│   └── js/               # JavaScript del cliente
│
├── views/
│   ├── clientes/         # Vistas de clientes
│   ├── prestamos/        # Vistas de préstamos
│   ├── pagos/            # Vistas de pagos
│   └── partials/         # Componentes reutilizables
│
├── routes/
│   ├── clientes.js       # Rutas de clientes
│   ├── prestamos.js      # Rutas de préstamos
│   └── pagos.js          # Rutas de pagos
│
├── controllers/
│   ├── clienteController.js
│   ├── prestamoController.js
│   └── pagoController.js
│
├── utils/
│   └── pdfGenerator.js   # Utilidad para generar PDFs
│
├── app.js                # Configuración principal
├── package.json
└── .env                  # Variables de entorno
```

## 🗄️ Modelo de Base de Datos

### Cliente
- Información personal (nombre, CI, teléfono, dirección)
- Referencias personales
- Historial de préstamos

### Prestamo
- Monto del préstamo
- Tasa de interés
- Fecha de inicio y vencimiento
- Estado del préstamo
- Relación con cliente

### Pago
- Monto pagado
- Fecha de pago
- Saldo restante
- Relación con préstamo

## 🔗 Rutas Principales

### Clientes
- `GET /clientes` - Lista de clientes
- `GET /clientes/nuevo` - Formulario nuevo cliente
- `POST /clientes` - Crear cliente
- `GET /clientes/:id` - Detalle del cliente
- `PUT /clientes/:id` - Actualizar cliente
- `DELETE /clientes/:id` - Eliminar cliente

### Préstamos
- `GET /prestamos` - Lista de préstamos
- `GET /prestamos/nuevo` - Formulario nuevo préstamo
- `POST /prestamos` - Crear préstamo
- `GET /prestamos/:id` - Detalle del préstamo
- `PUT /prestamos/:id` - Actualizar préstamo
- `DELETE /prestamos/:id` - Eliminar préstamo

### Pagos
- `GET /pagos` - Lista de pagos
- `GET /pagos/nuevo` - Formulario nuevo pago
- `POST /pagos` - Registrar pago
- `GET /pagos/:id` - Detalle del pago

### Reportes
- `GET /reportes/prestamo/:id` - Generar PDF del préstamo

## 💡 Funcionalidades Clave

### Cálculo de Intereses
El sistema calcula automáticamente:
- Interés simple o compuesto según configuración
- Pagos parciales y totales
- Saldo pendiente actualizado
- Fechas de vencimiento

### Generación de PDF
Los reportes incluyen:
- Información completa del cliente
- Detalles del préstamo
- Historial de pagos
- Saldo actual y estado

## 🚧 Scripts Disponibles

```bash
# Iniciar en desarrollo
npm run dev

# Iniciar en producción
npm start

# Ejecutar migraciones
npm run migrate

# Resetear base de datos
npm run db:reset

# Abrir Prisma Studio
npm run studio
```

## 🔒 Seguridad

- Validación de datos en servidor
- Sanitización de inputs
- Protección contra inyección SQL (Prisma ORM)
- Variables de entorno para datos sensibles

## 📝 Licencia

Este proyecto está bajo la Licencia MIT.

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📧 Contacto

Para preguntas o sugerencias, por favor abre un issue en el repositorio.

---

Desarrollado con ❤️ para facilitar la gestión de préstamos