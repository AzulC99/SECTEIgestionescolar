<h1>Manage Users</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo htmlspecialchars($user->username); ?></td>
                <td><?php echo htmlspecialchars($user->email); ?></td>
                <td><?php echo htmlspecialchars($user->role); ?></td>
                <td><?php echo $user->is_active ? 'Active' : 'Inactive'; ?></td>
                <td>
                    <form action="<?php echo URLROOT; ?>/admin/updateUserStatus" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="1" <?php echo $user->is_active ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo !$user->is_active ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>