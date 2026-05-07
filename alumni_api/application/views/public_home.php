<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Influencers - Home</title>
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
            transition: transform 0.2s ease-in-out;
        }
        .modern-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>Alumni Influencers
            </a>
        </div>
    </nav>

    <!-- Hero / Auth Section -->
    <div class="container mb-5">
        <div class="p-5 text-center bg-white rounded-3 shadow-sm border-0 mb-5 position-relative overflow-hidden">
            <div class="position-relative z-index-1">
                <h1 class="display-5 fw-bold mb-3">Connecting Students with Successful Graduates</h1>
                <p class="lead text-muted mb-4">Discover career paths, seek guidance, and connect with top alumni.</p>
                
                <div class="d-inline-block bg-light p-4 rounded-3 border">
                    <?php if(!$this->session->userdata('logged_in')): ?>
                        <h3 class="h5 mb-3 fw-bold">Are you an Alumnus?</h3>
                        <p class="text-muted mb-3">Join the marketplace and boost your professional visibility.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?php echo base_url('index.php/auth/login'); ?>" class="btn btn-outline-primary px-4">Login</a>
                            <a href="<?php echo base_url('index.php/auth/register'); ?>" class="btn btn-primary px-4">Register</a>
                        </div>
                    <?php else: ?>
                        <p class="mb-0 fs-5">Welcome back! <a href="<?php echo base_url('index.php/profile/dashboard'); ?>" class="fw-bold text-decoration-none">Go to your Dashboard <i class="bi bi-arrow-right"></i></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="modern-card p-4">
                    <h3 class="h5 mb-3 text-center"><i class="bi bi-search me-2"></i>Find an Alumnus</h3>
                    <form action="<?php echo base_url('index.php/home/search'); ?>" method="GET" class="d-flex gap-2">
                        <input type="text" name="q" class="form-control form-control-lg" placeholder="Search by name, degree, or job..." required>
                        <button type="submit" class="btn btn-primary btn-lg px-4"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Featured Alumni -->
        <div class="mb-4">
            <h2 class="h3 fw-bold mb-4 text-center">Featured Alumni</h2>
            <div class="row justify-content-center">
                <?php if(empty($featured_alumni)): ?>
                    <div class="col-12 text-center text-muted">
                        <p>No featured alumni at the moment.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($featured_alumni as $alumnus): ?>
                        <div class="col-md-4 mb-4">
                            <div class="modern-card h-100 p-4 text-center d-flex flex-column">
                                <img src="<?php echo base_url('uploads/profiles/' . ($alumnus->profile_image ? $alumnus->profile_image : 'default.png')); ?>" 
                                     class="rounded-circle mx-auto mb-3 shadow-sm" 
                                     style="width:100px; height:100px; object-fit:cover; border: 3px solid #f8f9fa;">
                                <h3 class="h5 fw-bold mb-1"><?php echo $alumnus->full_name ? $alumnus->full_name : 'Anonymous'; ?></h3>
                                <p class="text-muted small mb-4 flex-grow-1">Professional Influencer</p>
                                <a href="<?php echo base_url('index.php/home/view_profile/' . $alumnus->user_id); ?>" class="btn btn-outline-primary w-100 mt-auto">
                                    View Full Profile
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>