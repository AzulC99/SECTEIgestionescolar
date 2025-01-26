# Estructura de directorios completa
```
/proyecto
    /.htaccess
    /app
        /config
            config.php
            database.php
        /controllers
            Controller.php
            HomeController.php
        /helpers
            SessionHelper.php
            ValidationHelper.php
        /libraries
            Database.php
            Core.php
        /models
            User.php
        /views
            /layouts
                default.php
            /home
                index.php
            /components
                _header.php
                _footer.php
                _sidebar.php
                _nav.php
    /public
        /.htaccess
        /css
            styles.css
        /js
            app.js
        /img
        index.php
    /src
        /css
            /components
                _buttons.css
                _forms.css
                _cards.css
                _navigation.css
                _tables.css
            /layouts
                _container.css
                _grid.css
                _sidebar.css
            /utilities
                _animations.css
                _typography.css
                _spacing.css
            input.css
    /node_modules
    package.json
    tailwind.config.js
    postcss.config.js
```

# /proyecto/src/css/input.css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Importación de componentes personalizados */
@import "./components/_buttons.css";
@import "./components/_forms.css";
@import "./components/_cards.css";
@import "./components/_navigation.css";
@import "./components/_tables.css";

/* Importación de layouts */
@import "./layouts/_container.css";
@import "./layouts/_grid.css";
@import "./layouts/_sidebar.css";

/* Importación de utilidades */
@import "./utilities/_animations.css";
@import "./utilities/_typography.css";
@import "./utilities/_spacing.css";

# /proyecto/src/css/components/_buttons.css
@layer components {
    .btn {
        @apply px-4 py-2 rounded-lg font-medium transition-colors duration-200;
    }
    
    .btn-primary {
        @apply bg-blue-500 text-white hover:bg-blue-600;
    }
    
    .btn-secondary {
        @apply bg-gray-500 text-white hover:bg-gray-600;
    }
    
    .btn-danger {
        @apply bg-red-500 text-white hover:bg-red-600;
    }
}

# /proyecto/src/css/components/_forms.css
@layer components {
    .form-input {
        @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
    }
    
    .form-label {
        @apply block text-sm font-medium text-gray-700 mb-1;
    }
    
    .form-group {
        @apply mb-4;
    }
}

# /proyecto/app/views/layouts/default.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="<?php echo URLROOT; ?>/css/styles.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php require_once APPROOT . '/views/components/_nav.php'; ?>
    
    <div class="flex">
        <?php require_once APPROOT . '/views/components/_sidebar.php'; ?>
        
        <main class="flex-1 p-6">
            <?php require_once APPROOT . '/views/' . $view . '.php'; ?>
        </main>
    </div>

    <?php require_once APPROOT . '/views/components/_footer.php'; ?>
    <script src="<?php echo URLROOT; ?>/js/app.js"></script>
</body>
</html>

# /proyecto/app/views/components/_nav.php
<nav class="bg-white shadow">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <div class="text-xl font-semibold text-gray-700">
                <?php echo SITENAME; ?>
            </div>
            <div class="flex space-x-4">
                <a href="<?php echo URLROOT; ?>" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="<?php echo URLROOT; ?>/about" class="text-gray-600 hover:text-gray-900">About</a>
            </div>
        </div>
    </div>
</nav>

# /proyecto/tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./app/views/**/*.php",
        "./public/**/*.{html,js,php}",
        "./src/**/*.{html,js,php}"
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                },
                secondary: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}

# /proyecto/package.json
{
    "name": "mvc-php-tailwind",
    "version": "1.0.0",
    "description": "MVC PHP Framework with Tailwind CSS",
    "scripts": {
        "dev": "tailwindcss -i ./src/css/input.css -o ./public/css/styles.css --watch",
        "build": "tailwindcss -i ./src/css/input.css -o ./public/css/styles.css --minify"
    },
    "devDependencies": {
        "@tailwindcss/forms": "^0.5.3",
        "@tailwindcss/typography": "^0.5.9",
        "autoprefixer": "^10.4.14",
        "postcss": "^8.4.21",
        "tailwindcss": "^3.3.0"
    }
}

# /proyecto/postcss.config.js
module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    }
}
