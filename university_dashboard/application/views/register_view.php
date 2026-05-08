<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Staff Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }
        .modern-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background-color: white;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">University Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="modern-card p-4">
                    <h3 class="mb-2 text-center fw-bold">Staff Registration</h3>
                    <p class="text-center text-muted mb-4 small">Access restricted to @westminster.ac.uk accounts</p>
                    
                    <?php if(validation_errors()): ?>
                        <div class="alert alert-danger small">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('Auth/register'); ?>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">University Email Address:</label>
                            <input type="email" name="email" class="form-control form-control-lg" 
                                   placeholder="name@westminster.ac.uk"
                                   value="<?php echo set_value('email'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Create Password:</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                            <div class="form-text small">Minimum 8 characters with complexity.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control form-control-lg" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                            <a href="<?php echo site_url('Auth'); ?>" class="btn btn-link btn-sm text-decoration-none">Already have an account? Login</a>
                        </div>
                        
                    <?php echo form_close(); ?>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; 2026 University Dashboard</p>
            </div>
        </div>
    </div>
</body>
</html>