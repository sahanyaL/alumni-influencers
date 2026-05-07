<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
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
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-md-inline">Logged in as: <strong><?php echo $this->session->userdata('email'); ?></strong></span>
                <a href="<?php echo base_url('index.php/home'); ?>" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-house me-1"></i> View Home Page
                </a>
                <a href="<?php echo base_url('index.php/auth/logout'); ?>" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Alumni Dashboard</h1>
            <a href="<?php echo base_url('index.php/profile/edit'); ?>" class="btn btn-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit My Profile
            </a>
        </div>

        <div class="row">
            <!-- Left Column: Profile Card & Marketplace CTA -->
            <div class="col-lg-4 mb-4">
                <div class="modern-card p-4 text-center mb-4">
                    <div class="profile-header mb-3">
                        <img src="<?php echo base_url('uploads/profiles/' . ($profile->profile_image ? $profile->profile_image : 'default.png')); ?>" 
                            alt="Profile Image" 
                            class="rounded-circle img-thumbnail shadow-sm"
                            style="width:150px; height:150px; object-fit:cover; border: 3px solid #fff;">
                    </div>
                    <h2 class="h5 fw-bold mb-1"><?php echo $profile->full_name ? $profile->full_name : 'Not set'; ?></h2>
                    <p class="text-muted small mb-3"><?php echo $profile->bio ? $profile->bio : 'No biography added yet.'; ?></p>
                    
                    <?php if($profile->linkedin_url): ?>
                        <a href="<?php echo $profile->linkedin_url; ?>" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bi bi-linkedin me-2"></i>LinkedIn Profile
                        </a>
                    <?php else: ?>
                        <span class="badge bg-secondary">LinkedIn Not set</span>
                    <?php endif; ?>
                </div>

                <div class="modern-card p-4 border-start border-4 border-warning">
                    <h3 class="h5 mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Featured Visibility</h3>
                    <p class="text-muted small mb-4">Place a bid in the marketplace to compete for a top-3 spot on the homepage.</p>
                    <a href="<?php echo base_url('index.php/marketplace'); ?>" class="btn btn-dark w-100">
                        OPEN MARKETPLACE
                    </a>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="col-lg-8">
                <!-- Degrees -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-mortarboard me-2 text-primary"></i>Degrees</h3>
                    <?php if(empty($degrees)): ?>
                        <p class="text-muted small italic">No degrees added.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($degrees as $degree): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 fw-bold fs-6"><?php echo $degree->degree_name; ?></h5>
                                        <small class="text-muted">Completed: <?php echo $degree->completion_date; ?></small>
                                    </div>
                                    <small><a href="<?php echo $degree->university_url; ?>" target="_blank" class="text-decoration-none"><i class="bi bi-link-45deg"></i> Official Course Page</a></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Certifications -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-award me-2 text-success"></i>Professional Certifications</h3>
                    <?php if(empty($certifications)): ?>
                        <p class="text-muted small italic">No certifications added.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($certifications as $cert): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 fw-bold fs-6"><?php echo $cert->cert_name; ?></h5>
                                        <small class="text-muted">Date: <?php echo $cert->completion_date; ?></small>
                                    </div>
                                    <small><a href="<?php echo $cert->course_url; ?>" target="_blank" class="text-decoration-none"><i class="bi bi-link-45deg"></i> View Certificate/Course</a></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Licences -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-card-checklist me-2 text-info"></i>Professional Licences</h3>
                    <?php if(empty($licences)): ?>
                        <p class="text-muted small italic">No licences added.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($licences as $licence): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 fw-bold fs-6"><?php echo $licence->licence_name; ?></h5>
                                        <small class="text-muted">Issued: <?php echo $licence->completion_date; ?></small>
                                    </div>
                                    <small><a href="<?php echo $licence->awarding_body_url; ?>" target="_blank" class="text-decoration-none"><i class="bi bi-link-45deg"></i> Awarding Body</a></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Employment -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-3 border-bottom pb-2"><i class="bi bi-briefcase me-2 text-warning"></i>Employment History</h3>
                    <?php if(empty($employment)): ?>
                        <p class="text-muted small italic">No employment history added.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($employment as $job): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 fw-bold fs-6"><?php echo $job->job_title; ?> <span class="fw-normal text-muted">at</span> <?php echo $job->company_name; ?></h5>
                                        <small class="text-muted bg-light px-2 py-1 rounded">
                                            <?php echo $job->start_date; ?> to <?php echo $job->currently_working ? 'Present' : $job->end_date; ?>
                                        </small>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>