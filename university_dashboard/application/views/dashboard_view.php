<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Intelligence Dashboard</title>
    <!-- Bootstrap for Layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar { height: 100vh; background-color: #212529; color: white; padding-top: 20px; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover { color: white; background-color: #343a40; }
        .main-content { padding: 30px; background-color: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-2 sidebar">
            <h5 class="text-center mb-4">Uni-Analytics</h5>
            <a href="#" class="text-white bg-dark">Skills Gap Trends</a>
            <a href="#">Top Employers</a>
            <a href="#">Geographic Dist.</a>
            <hr class="bg-secondary">
            <small class="px-3 text-muted">Logged in as:<br><?= $admin_email; ?></small>
            <a href="<?= base_url('Auth/logout'); ?>" class="text-danger mt-3"> Logout</a>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Alumni Skills Gap Analysis</h2>
                <button class="btn btn-outline-primary">Export Report (PDF)</button>
            </div>

            <div class="row">
                <!-- The Chart Card -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Most Popular Certifications vs. Curriculum</strong>
                        </div>
                        <div class="card-body">
                            <!-- THIS IS WHERE OUR CHART WILL DRAW -->
                            <canvas id="skillsGapChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Insights Card -->
                <div class="col-md-4">
                    <div class="card shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h5>Key Insight</h5>
                            <p>Once we connect the API, this box will highlight the #1 certification alumni are forced to get after graduation.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>