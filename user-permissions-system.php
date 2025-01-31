<?php
// app/config/permissions.php
class Permissions {
    const PERMISSIONS = [
        'admin' => [
            'dashboard_admin' => true,
            'manage_users' => true,
            'view_reports' => true,
            'edit_settings' => true,
            'manage_roles' => true,
            'view_logs' => true,
            'manage_permissions' => true
        ],
        'manager' => [
            'dashboard_manager' => true,
            'view_reports' => true,
            'manage_team' => true,
            'view_analytics' => true
        ],
        'supervisor' => [
            'dashboard_supervisor' => true,
            'view_team_reports' => true,
            'assign_tasks' => true
        ],
        'operator' => [
            'dashboard_operator' => true,
            'view_tasks' => true,
            'submit_reports' => true
        ],
        'analyst' => [
            'dashboard_analyst' => true,
            'view_analytics' => true,
            'generate_reports' => true
        ],
        'guest' => [
            'dashboard_guest' => true,
            'view_public_info' => true
        ]
    ];

    public static function hasPermission($role, $permission) {
        return isset(self::PERMISSIONS[$role][$permission]) && 
               self::PERMISSIONS[$role][$permission] === true;
    }
}

// app/models/User.php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function updateUserStatus($userId, $status) {
        $this->db->query('UPDATE users SET status = :status, updated_at = NOW() WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function getActiveUsers() {
        $this->db->query('SELECT * FROM users WHERE status = "active"');
        return $this->db->resultSet();
    }

    public function getInactiveUsers() {
        $this->db->query('SELECT * FROM users WHERE status = "inactive"');
        return $this->db->resultSet();
    }
}

// app/controllers/DashboardController.php
class DashboardController {
    private $userModel;

    public function __construct() {
        if (!isLoggedIn()) {
            redirect('/auth/login');
        }
        
        $this->userModel = new User();
    }

    // Método para verificar permisos
    private function checkPermission($permission) {
        if (!Permissions::hasPermission($_SESSION['user_role'], $permission)) {
            flash('error', 'No tienes permisos para acceder a esta sección', 'alert alert-danger');
            redirect('/dashboard');
            return false;
        }
        return true;
    }

    // Dashboard específico para cada rol
    public function index() {
        $role = $_SESSION['user_role'];
        $permission = "dashboard_" . $role;
        
        if (!$this->checkPermission($permission)) {
            return;
        }

        switch ($role) {
            case 'admin':
                $this->adminDashboard();
                break;
            case 'manager':
                $this->managerDashboard();
                break;
            case 'supervisor':
                $this->supervisorDashboard();
                break;
            case 'operator':
                $this->operatorDashboard();
                break;
            case 'analyst':
                $this->analystDashboard();
                break;
            default:
                $this->guestDashboard();
        }
    }

    private function adminDashboard() {
        $data = [
            'active_users' => $this->userModel->getActiveUsers(),
            'inactive_users' => $this->userModel->getInactiveUsers(),
            'total_users' => $this->userModel->getTotalUsers(),
            'system_logs' => $this->userModel->getSystemLogs(),
            'recent_activities' => $this->userModel->getRecentActivities()
        ];
        
        $this->view('dashboard/admin', $data);
    }

    private function managerDashboard() {
        $data = [
            'team_members' => $this->userModel->getTeamMembers(),
            'team_performance' => $this->userModel->getTeamPerformance(),
            'project_status' => $this->userModel->getProjectStatus(),
            'pending_approvals' => $this->userModel->getPendingApprovals()
        ];
        
        $this->view('dashboard/manager', $data);
    }

    private function supervisorDashboard() {
        $data = [
            'team_tasks' => $this->userModel->getTeamTasks(),
            'daily_reports' => $this->userModel->getDailyReports(),
            'task_statistics' => $this->userModel->getTaskStatistics()
        ];
        
        $this->view('dashboard/supervisor', $data);
    }

    private function operatorDashboard() {
        $data = [
            'my_tasks' => $this->userModel->getUserTasks($_SESSION['user_id']),
            'task_history' => $this->userModel->getTaskHistory($_SESSION['user_id']),
            'performance_metrics' => $this->userModel->getUserPerformance($_SESSION['user_id'])
        ];
        
        $this->view('dashboard/operator', $data);
    }

    private function analystDashboard() {
        $data = [
            'analytics_data' => $this->userModel->getAnalyticsData(),
            'report_templates' => $this->userModel->getReportTemplates(),
            'recent_reports' => $this->userModel->getRecentReports($_SESSION['user_id'])
        ];
        
        $this->view('dashboard/analyst', $data);
    }

    private function guestDashboard() {
        $data = [
            'public_reports' => $this->userModel->getPublicReports(),
            'public_announcements' => $this->userModel->getPublicAnnouncements()
        ];
        
        $this->view('dashboard/guest', $data);
    }

    // Gestión de usuarios (solo admin)
    public function manageUsers() {
        if (!$this->checkPermission('manage_users')) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_POST['user_id'];
            $action = $_POST['action'];
            
            switch ($action) {
                case 'activate':
                    $this->userModel->updateUserStatus($userId, 'active');
                    flash('success', 'Usuario activado correctamente');
                    break;
                case 'deactivate':
                    $this->userModel->updateUserStatus($userId, 'inactive');
                    flash('success', 'Usuario desactivado correctamente');
                    break;
                case 'delete':
                    if ($this->checkPermission('manage_users')) {
                        $this->userModel->deleteUser($userId);
                        flash('success', 'Usuario eliminado correctamente');
                    }
                    break;
            }
        }

        $data = [
            'active_users' => $this->userModel->getActiveUsers(),
            'inactive_users' => $this->userModel->getInactiveUsers()
        ];

        $this->view('users/manage', $data);
    }
}

// Vista ejemplo para dashboard de admin
// views/dashboard/admin.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 min-h-screen">
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <img src="<?php echo URLROOT; ?>/assets/img/logo.png" alt="Logo" class="h-8">
            </div>
            <nav class="mt-5">
                <?php if (Permissions::hasPermission($_SESSION['user_role'], 'manage_users')): ?>
                <a href="<?php echo URLROOT; ?>/dashboard/manageUsers" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Gestionar Usuarios</span>
                </a>
                <?php endif; ?>
                
                <?php if (Permissions::hasPermission($_SESSION['user_role'], 'view_logs')): ?>
                <a href="<?php echo URLROOT; ?>/dashboard/logs" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Logs del Sistema</span>
                </a>
                <?php endif; ?>
                
                <?php if (Permissions::hasPermission($_SESSION['user_role'], 'manage_roles')): ?>
                <a href="<?php echo URLROOT; ?>/dashboard/roles" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Gestionar Roles</span>
                </a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Administrador</h1>
                </div>
            </header>

            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">Usuarios Activos</h2>
                        <p class="text-3xl font-bold"><?php echo count($data['active_users']); ?></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">Usuarios Inactivos</h2>
                        <p class="text-3xl font-bold"><?php echo count($data['inactive_users']); ?></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">Total Usuarios</h2>
                        <p class="text-3xl font-bold"><?php echo $data['total_users']; ?></p>
                    </div>
                </div>

                <!-- Actividad Reciente -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Actividad Reciente</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuario
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acción
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($data['recent_activities'] as $activity): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo $activity->user_name; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo $activity->action; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo $activity->created_at; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
