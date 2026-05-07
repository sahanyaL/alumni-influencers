<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
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
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">System Administrator Dashboard</h1>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="modern-card p-4 h-100">
                    <h3 class="h5 mb-3"><i class="bi bi-code-slash me-2 text-success"></i>Developer & API Management</h3>
                    <p class="text-muted mb-3">Manage security tokens and monitor AR client usage statistics.</p>
                    
                    <div class="d-flex flex-column gap-3 mt-4">
                        <a href="<?php echo base_url('index.php/admin/manage_api'); ?>" class="btn btn-outline-primary text-start">
                            <i class="bi bi-key me-2"></i> Manage API Keys & View Usage Stats
                        </a>
                        <a href="<?php echo base_url('index.php/api/docs'); ?>" target="_blank" class="btn btn-outline-success text-start">
                            <i class="bi bi-file-earmark-text me-2"></i> Open Interactive API Documentation (Swagger UI)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>