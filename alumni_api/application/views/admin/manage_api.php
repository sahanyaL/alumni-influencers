<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Management</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .modern-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background-color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Portal</a>
            <div class="ms-auto">
                <a href="<?php echo base_url('index.php/admin/dashboard'); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">API Key & Usage Management</h1>
            <a href="<?php echo base_url('index.php/admin/generate_key'); ?>" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Generate New API Key
            </a>
        </div>

        <div class="modern-card p-4 mb-4">
            <h3 class="h5 mb-4">Active & Revoked Keys</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Label</th>
                            <th>Token</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($api_keys as $key): ?>
                        <tr>
                            <td><span class="fw-medium"><?php echo $key->label; ?></span></td>
                            <td><code class="bg-light px-2 py-1 rounded text-dark border"><?php echo $key->token; ?></code></td>
                            <td><?php echo $key->email; ?></td>
                            <td>
                                <span class="badge <?php echo $key->is_active ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $key->is_active ? 'Active' : 'Revoked'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($key->is_active): ?>
                                    <a href="<?php echo base_url('index.php/admin/revoke_key/'.$key->id); ?>" 
                                       onclick="return confirm('Revoke this key? Target client will lose access immediately.');" 
                                       class="btn btn-outline-danger btn-sm">
                                       <i class="bi bi-x-circle me-1"></i> Revoke Access
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modern-card p-4">
            <h3 class="h5 mb-2">Detailed Usage Statistics</h3>
            <p class="text-muted mb-4">Monitoring timestamps and endpoint access</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Timestamp</th>
                            <th>Endpoint Accessed</th>
                            <th>Client IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($logs as $log): ?>
                        <tr>
                            <td><span class="text-muted"><i class="bi bi-clock me-2"></i><?php echo $log->accessed_at; ?></span></td>
                            <td><code class="text-primary"><?php echo $log->endpoint; ?></code></td>
                            <td><span class="badge bg-light text-dark border"><i class="bi bi-globe me-1"></i><?php echo $log->ip_address; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>