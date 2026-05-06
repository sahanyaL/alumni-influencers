<!DOCTYPE html>
<html>
<head>
    <title>API Management</title>
</head>
<body>
    <h1>API Key & Usage Management</h1>
    <a href="<?php echo base_url('index.php/admin/dashboard'); ?>">Back to Dashboard</a> | 
    <a href="<?php echo base_url('index.php/admin/generate_key'); ?>" style="font-weight:bold; color:green;">+ Generate New API Key</a>
    <hr>

    <h3>Active & Revoked Keys</h3>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr style="background: #eee;">
            <th>Label</th>
            <th>Token</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach($api_keys as $key): ?>
        <tr>
            <td><?php echo $key->label; ?></td>
            <td><code><?php echo $key->token; ?></code></td>
            <td><?php echo $key->email; ?></td>
            <td><?php echo $key->is_active ? 'Active' : 'Revoked'; ?></td>
            <td>
                <?php if($key->is_active): ?>
                    <a href="<?php echo base_url('index.php/admin/revoke_key/'.$key->id); ?>" 
                       onclick="return confirm('Revoke this key? Target client will lose access immediately.');" 
                       style="color:red;">Revoke Access</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Detailed Usage Statistics</h3>
    <p>Monitoring timestamps and endpoint access </p>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr style="background: #eee;">
            <th>Timestamp</th>
            <th>Endpoint Accessed</th>
            <th>Client IP</th>
        </tr>
        <?php foreach($logs as $log): ?>
        <tr>
            <td><?php echo $log->accessed_at; ?></td>
            <td><code><?php echo $log->endpoint; ?></code></td>
            <td><?php echo $log->ip_address; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>