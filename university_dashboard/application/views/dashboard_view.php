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
<!-- Analytics & Chart Script (Live API Data) -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Grab the canvas element
    const ctx = document.getElementById('skillsGapChart').getContext('2d');

    fetch('http://127.0.0.1/ALUMNI-INFLUENCERS/alumni_api/Api/get_certification_trends')
        .then(response => response.json())
        .then(apiData => {
            
            // Extract labels (cert names) and counts from the JSON array
            const chartLabels = apiData.map(item => item.label);
            const chartCounts = apiData.map(item => parseInt(item.count)); // Parse to integer

            // 3. Draw the Chart using live data
            const skillsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Number of Alumni Graduates',
                        data: chartCounts,
                        backgroundColor: 'rgba(13, 110, 253, 0.8)', 
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1,
                        borderRadius: 4 
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false } 
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Total Certifications' }
                        }
                    }
                }
            });

            // 4. Update the "Key Insight" box dynamically
            if(chartCounts.length > 0) {
                const maxCount = Math.max(...chartCounts);
                const topIndex = chartCounts.indexOf(maxCount);
                const topCert = chartLabels[topIndex];

                const insightText = document.querySelector('.bg-primary .card-body p');
                insightText.innerHTML = `Based on live data, the #1 certification alumni are getting is <strong>${topCert}</strong> (${maxCount} alumni).`;
            }
            
        })
        .catch(error => {
            console.error("Error fetching API data:", error);
            document.querySelector('.bg-primary .card-body p').innerHTML = "Could not load insights. Ensure API is running.";
        });
});
</script>

</body>
</html>