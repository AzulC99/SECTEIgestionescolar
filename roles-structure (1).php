# Estructura de directorios
```
/proyecto
    /app
        /config
            roles.php
            permissions.php
        /controllers
            /admin
                UserController.php
                SystemController.php
            /manager
                ConfigController.php
                TeamController.php
            /supervisor
                ReportController.php
                TaskManagementController.php
            /employee
                TaskController.php
                CalendarController.php
            /viewer
                DocumentController.php
            BaseController.php
        /middlewares
            AuthMiddleware.php
            RoleMiddleware.php
        /models
            /roles
                Role.php
                Permission.php
                UserRole.php
        /views
            /layouts
                /admin
                    dashboard.php
                /manager
                    dashboard.php
                /supervisor
                    dashboard.php
                /employee
                    dashboard.php
                /viewer
                    dashboard.php
            /components
                /sidebars
                    _admin_sidebar.php
                    _manager_sidebar.php
                    _supervisor_sidebar.php
                    _employee_sidebar.php
                    _viewer_sidebar.php
```

# /app/config/roles.php
```php

define('ROLES', [
    'SUPERADMIN' => [
        'id' => 1,
        'na<?phpme' => 'Super Administrador',
        'permissions' => ['all']
    ],
    'ADMIN' => [
        'id' => 2,
        'name' => 'Administrador',
        'permissions' => ['users.manage', 'system.config', 'reports.all']
    ],
    'MANAGER' => [
        'id' => 3,
        'name' => 'Gerente',
        'permissions' => ['system.view', 'reports.view', 'tasks.manage']
    ],
    'SUPERVISOR' => [
        'id' => 4,
        'name' => 'Supervisor',
        'permissions' => ['reports.view', 'tasks.manage', 'calendar.manage']
    ],
    'EMPLOYEE' => [
        'id' => 5,
        'name' => 'Empleado',
        'permissions' => ['tasks.view', 'calendar.view', 'documents.view']
    ],
    'VIEWER' => [
        'id' => 6,
        'name' => 'Visualizador',
        'permissions' => ['documents.view']
    ]
]);
```

# /app/middlewares/RoleMiddleware.php
```php
<?php
class RoleMiddleware {
    public function handle($role) {
        if (!isset($_SESSION['user_role'])) {
            redirect('/login');
        }

        $userRole = $_SESSION['user_role'];
        $roles = require_once '../app/config/roles.php';

        if ($userRole > $role) {
            redirect('/unauthorized');
        }

        return true;
    }
}
```

# /app/views/components/sidebars/_admin_sidebar.php
```php
<aside class="bg-gray-800 text-white w-64 min-h-screen flex flex-col">
    <div class="px-6 py-4 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <svg class="h-8 w-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            <span class="text-xl font-bold">Panel Administrativo</span>
        </div>
    </div>

    <nav class="flex-1 p-4">
        <ul class="space-y-1">
            <!-- Menú específico para administradores -->
            <li>
                <a href="/admin/users" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>Gestión de Usuarios</span>
                </a>
            </li>
            <!-- Más opciones específicas de admin -->
        </ul>
    </nav>
</aside>
```

# /app/controllers/admin/UserController.php
```php
<?php
class UserController extends BaseController {
    public function __construct() {
        $this->middleware(new RoleMiddleware(ROLES['ADMIN']['id']));
    }

    public function index() {
        return $this->view('admin/users/index');
    }

    public function create() {
        return $this->view('admin/users/create');
    }

    public function store() {
        // Lógica para crear usuario
    }
}
```

# /app/models/roles/Role.php
```php
<?php
class Role {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllRoles() {
        $this->db->query("SELECT * FROM roles ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getRolePermissions($roleId) {
        $this->db->query("SELECT p.* FROM permissions p 
                         JOIN role_permissions rp ON p.id = rp.permission_id 
                         WHERE rp.role_id = :role_id");
        $this->db->bind(':role_id', $roleId);
        return $this->db->resultSet();
    }
}
```

# /app/models/roles/Permission.php
```php
<?php
class Permission {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function checkPermission($userId, $permission) {
        $this->db->query("SELECT COUNT(*) as count FROM user_roles ur 
                         JOIN role_permissions rp ON ur.role_id = rp.role_id 
                         JOIN permissions p ON rp.permission_id = p.id 
                         WHERE ur.user_id = :user_id AND p.name = :permission");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':permission', $permission);
        return $this->db->single()->count > 0;
    }
}
```
