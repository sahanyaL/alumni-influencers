<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
            <a class="navbar-brand fw-bold" href="#">Alumni Portal</a>
            <div class="ms-auto">
                <a href="<?php echo base_url('index.php/home'); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h1 class="h3 mb-4 text-gray-800">Search Results for: "<span class="text-primary"><?php echo htmlspecialchars($query); ?></span>"</h1>

        <?php if(empty($results)): ?>
            <div class="modern-card p-5 text-center">
                <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                <p class="mt-3 text-muted fs-5">No alumni found matching your search.</p>
            </div>
        <?php else: ?>
            <div class="row">
            <?php foreach($results as $row): ?>
                <div class="col-md-6 mb-4">
                    <div class="modern-card p-4 h-100 d-flex flex-column">
                        <h3 class="h5 mb-2 fw-bold"><?php echo $row->full_name; ?></h3>
                        <p class="text-muted flex-grow-1"><?php echo $row->bio; ?></p>
                        <div class="mt-3">
                            <a href="<?php echo base_url('index.php/home/view_profile/' . $row->user_id); ?>" class="btn btn-primary btn-sm">
                                View Profile <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>