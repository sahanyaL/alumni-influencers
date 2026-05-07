<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $profile->full_name; ?> - Profile</title>
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
            <a class="navbar-brand fw-bold" href="#">Alumni Directory</a>
            <div class="ms-auto">
                <a href="<?php echo base_url('index.php/home'); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Profile Header -->
                <div class="modern-card p-5 mb-4 text-center">
                    <h1 class="fw-bold mb-3"><?php echo $profile->full_name; ?></h1>
                    <p class="lead text-muted fst-italic mb-4">"<?php echo $profile->bio; ?>"</p>
                    <?php if($profile->linkedin_url): ?>
                        <a href="<?php echo $profile->linkedin_url; ?>" target="_blank" class="btn btn-primary">
                            <i class="bi bi-linkedin me-2"></i>Connect on LinkedIn
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Education -->
                <div class="modern-card p-4 mb-4">
                    <h2 class="h4 border-bottom pb-3 mb-4"><i class="bi bi-mortarboard me-2 text-primary"></i>Education</h2>
                    <?php if(empty($degrees)): ?>
                        <p class="text-muted">No education details provided.</p>
                    <?php else: ?>
                        <div class="d-flex flex-column gap-3">
                        <?php foreach($degrees as $d): ?>
                            <div class="p-3 bg-light rounded border">
                                <h3 class="h6 fw-bold mb-1"><?php echo $d->degree_name; ?></h3>
                                <a href="<?php echo $d->university_url; ?>" target="_blank" class="text-decoration-none small">
                                    <i class="bi bi-link-45deg"></i> View Course Details
                                </a>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Experience -->
                <div class="modern-card p-4">
                    <h2 class="h4 border-bottom pb-3 mb-4"><i class="bi bi-briefcase me-2 text-warning"></i>Experience</h2>
                    <?php if(empty($employment)): ?>
                        <p class="text-muted">No experience details provided.</p>
                    <?php else: ?>
                        <div class="timeline position-relative ps-4 border-start border-2 border-primary">
                        <?php foreach($employment as $e): ?>
                            <div class="mb-4 position-relative">
                                <span class="position-absolute bg-primary rounded-circle" style="width: 12px; height: 12px; left: -29px; top: 5px;"></span>
                                <h3 class="h6 fw-bold mb-1"><?php echo $e->job_title; ?> <span class="text-muted fw-normal">at</span> <?php echo $e->company_name; ?></h3>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-calendar3 me-1"></i> 
                                    <?php echo $e->start_date; ?> - <?php echo $e->currently_working ? 'Present' : $e->end_date; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>