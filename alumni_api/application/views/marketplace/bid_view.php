<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Bidding Marketplace</title>
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
            <a class="navbar-brand fw-bold" href="#">Alumni Marketplace</a>
            <div class="ms-auto">
                <a href="<?php echo base_url('index.php/profile/dashboard'); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="modern-card p-4">
                    <h2 class="mb-4 text-center"><i class="bi bi-currency-dollar text-success me-2"></i>Blind Bidding Marketplace</h2>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4 bg-light p-3 rounded">
                        <h3 class="h5 mb-2">Place Your Bid</h3>
                        <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i>Note: You must bid higher than others to be featured on the homepage.</p>
                    </div>
                    
                    <?php echo form_open('marketplace/place_bid'); ?>
                        <div class="mb-4">
                            <label class="form-label text-muted fw-medium">Enter Bid Amount:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0 text-success">$</span>
                                <input type="number" name="amount" class="form-control border-start-0 ps-0" step="0.01" min="1" required placeholder="0.00">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="bi bi-check2-circle me-2"></i>Confirm Bid
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>