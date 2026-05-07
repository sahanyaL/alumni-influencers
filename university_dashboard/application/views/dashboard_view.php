<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Intelligence Dashboard</title>
    <!-- Bootstrap for Layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap for Layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Chart.js for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Chart.js for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        /* Global Softer Background */
        body { background-color: #f4f7fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Modern Sidebar */
        .sidebar { height: 100vh; background: linear-gradient(180deg, #212529 0%, #15181a 100%); color: white; padding-top: 20px; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; margin: 5px 10px; border-radius: 8px; transition: all 0.2s ease-in-out; }
        .sidebar a:hover:not(.active) { color: white; background-color: rgba(255,255,255,0.05); transform: translateX(5px); }
        .sidebar a.active { color: white; background-color: #0d6efd; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.4); }
        
        /* Floating Cards */
        .main-content { padding: 40px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .card-header { border-bottom: 1px solid rgba(0,0,0,0.05); font-weight: 600; color: #495057; border-top-left-radius: 12px !important; border-top-right-radius: 12px !important; }
        
        /* Insight Box Glow */
        .insight-box { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-2 sidebar">
            <h5 class="text-center mb-4 fw-bold tracking-wide">Uni-Analytics</h5>
            <a href="#skillsRow" class="dash-link active"><i class="bi bi-bar-chart-fill me-2"></i> Skills Gap</a>
            <a href="#employersRow" class="dash-link"><i class="bi bi-pie-chart-fill me-2"></i> Top Employers</a>
            <a href="#employersRow" class="dash-link"><i class="bi bi-globe-americas me-2"></i> Geographic Dist.</a>
            <hr class="bg-secondary opacity-25 mt-4 mb-4">
            <small class="px-3 text-muted d-block text-truncate">Logged in as:<br><?= $admin_email; ?></small>
            <a href="<?= base_url('Auth/logout'); ?>" class="text-danger mt-3 hover-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-10 main-content" id="dashboardContent">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Alumni Skills Gap Analysis</h2>
                <button id="exportPdfBtn" class="btn btn-outline-primary"><i class="bi bi-file-earmark-pdf me-2"></i>Export Report (PDF)</button>
            </div>

            <div class="row" id="skillsRow">
                <!-- The Chart Card -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Most Popular Certifications vs. Curriculum</strong>
                        </div>
                        <div class="card-body">
                            <canvas id="skillsGapChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Insights Card -->
                <div class="col-md-4">
                    <div class="card insight-box text-white shadow-lg h-100">
                        <div class="card-body p-4 d-flex flex-column justify-content-center">
                            <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2 text-warning"></i> Key Insight</h5>
                            <p class="mb-0 fs-6 lh-lg">Once we connect the API, this box will highlight the #1 certification alumni are forced to get after graduation.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second Row: Additional Analytics -->
            <div class="row mt-4" id="employersRow">
                
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-white">
                            <strong><i class="bi bi-pie-chart-fill me-2 text-primary"></i> Top Alumni Employers</strong>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="employersChart" style="max-height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-white">
                            <strong><i class="bi bi-globe-americas me-2 text-success"></i> Geographic Distribution</strong>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="geoChart" style="max-height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
$env_path = FCPATH . '.env';

if (file_exists($env_path)) {
    $env = parse_ini_file($env_path);
    $api_url = $env['API_BASE_URL'];
    $api_token = $env['API_TOKEN'];
} else {
    $api_url = "ERROR_ENV_MISSING";
    $api_token = "ERROR_ENV_MISSING";
}
?>

<script>
// 3. Inject the secure variables into Javascript
const API_URL = "<?= $api_url ?>";
const API_TOKEN = "<?= $api_token ?>";

document.addEventListener("DOMContentLoaded", function() {
    
    // ==========================================
    // 1. SKILLS GAP BAR CHART
    // ==========================================
    const ctx = document.getElementById('skillsGapChart').getContext('2d');

    // Use the dynamic variables instead of hardcoded strings
    fetch(API_URL + 'get_certification_trends', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + API_TOKEN,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error(`API rejected request: ${response.status}`);
        return response.json();
    })
    .then(apiData => {
        const chartLabels = apiData.map(item => item.label);
        const chartCounts = apiData.map(item => parseInt(item.count));

        new Chart(ctx, {
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
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { maxRotation: 0, minRotation: 0 } },
                    y: { beginAtZero: true, title: { display: true, text: 'Total Certifications' } }
                }
            }
        });

        if(chartCounts.length > 0) {
            const maxCount = Math.max(...chartCounts);
            const topIndex = chartCounts.indexOf(maxCount);
            const topCert = chartLabels[topIndex];

            const insightText = document.querySelector('.insight-box .card-body p');
            insightText.innerHTML = `Based on live secure data, the #1 certification alumni are getting is <strong>${topCert}</strong> (${maxCount} alumni).`;
        }
    })
    .catch(error => console.error("Error fetching Certs:", error));

    // ==========================================
    // 2. TOP EMPLOYERS DOUGHNUT CHART
    // ==========================================
    const ctxEmployers = document.getElementById('employersChart').getContext('2d');

    // Use the dynamic variables
    fetch(API_URL + 'get_top_employers', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + API_TOKEN,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(apiData => {
        const empLabels = apiData.map(item => item.label);
        const empCounts = apiData.map(item => parseInt(item.count));

        new Chart(ctxEmployers, {
            type: 'doughnut',
            data: {
                labels: empLabels,
                datasets: [{
                    data: empCounts,
                    backgroundColor: ['rgba(13, 110, 253, 0.9)', 'rgba(25, 135, 84, 0.9)', 'rgba(255, 193, 7, 0.9)', 'rgba(220, 53, 69, 0.9)', 'rgba(13, 202, 240, 0.9)'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'right' } } }
        });
    })
    .catch(error => console.error("Error loading employers:", error));

    // ==========================================
    // 3. GEOGRAPHIC DISTRIBUTION CHART
    // ==========================================
    const ctxGeo = document.getElementById('geoChart').getContext('2d');

    // Use the dynamic variables
    fetch(API_URL + 'get_geographic_distribution', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + API_TOKEN,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(apiData => {
        const geoLabels = apiData.map(item => item.label);
        const geoCounts = apiData.map(item => parseInt(item.count));

        new Chart(ctxGeo, {
            type: 'bar', 
            data: {
                labels: geoLabels,
                datasets: [{
                    label: 'Alumni Count',
                    data: geoCounts,
                    backgroundColor: 'rgba(25, 135, 84, 0.8)', 
                    borderColor: 'rgba(25, 135, 84, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    })
    .catch(error => console.error("Error loading geographic data:", error));

    // ==========================================
    // 4. PDF EXPORT FUNCTIONALITY
    // ==========================================
    document.getElementById('exportPdfBtn').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Generating...';
        btn.classList.add('disabled'); 

        const element = document.getElementById('dashboardContent');
        const originalWidth = element.style.width;
        element.style.width = '1200px';

        const opt = {
            margin:       0.3, 
            filename:     'Alumni_Analytics_Report.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 2, useCORS: true, windowWidth: 1200 },
            pagebreak:    { mode: 'avoid-all' },
            jsPDF:        { unit: 'in', format: 'a3', orientation: 'landscape' } 
        };

        html2pdf().set(opt).from(element).save().then(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('disabled');
            element.style.width = originalWidth; 
        });
    });

    // ==========================================
    // 5. SIDEBAR NAVIGATION LOGIC
    // ==========================================
    const navLinks = document.querySelectorAll('.dash-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
        });
    });

});
</script>

</body>
</html>