<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>University Analytics - Login</title>
    <!-- Using Bootstrap for a professional layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white text-center">
                        <h4>University Dashboard</h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Show Errors -->
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Login Form -->
                        <?= form_open('Auth/do_login'); ?>
                            <div class="mb-3">
                                <label>Staff Email (@westminster.ac.uk)</label>
                                <input type="email" name="email" class="form-control" required placeholder="#####@westminster.ac.uk">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Secure Login</button>
                        <?= form_close(); ?>

                        <hr class="mt-4">
                        <div class="text-center">
                            <p class="text-muted small mb-2">New University Staff member?</p>
                            <a href="<?= site_url('Auth/register'); ?>" class="btn btn-outline-secondary btn-sm">Create Staff Account</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>