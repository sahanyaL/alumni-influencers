<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Influencers API Documentation</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Swagger UI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@3/swagger-ui.css">
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
        /* Customizing Swagger UI slightly to fit Inter font if possible */
        .swagger-ui {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">API Documentation</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="modern-card p-4">
            <div id="swagger-ui"></div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swagger UI Bundle -->
    <script src="https://unpkg.com/swagger-ui-dist@3/swagger-ui-bundle.js"></script>
    <script>
        const ui = SwaggerUIBundle({
            dom_id: '#swagger-ui',
            spec: {
                "openapi": "3.0.0",
                "info": { "title": "Alumni Influencers API", "version": "1.0.0" },
                "servers": [
                    {
                        "url": "http://localhost/alumni-influencers/index.php",
                        "description": "Local Development Server"
                    }
                ],
                "paths": {
                    "/api/featured_alumnus": {
                        "get": {
                            "summary": "Get Today's Featured Alumnus",
                            "responses": { "200": { "description": "Success" } },
                            "security": [{ "bearerAuth": [] }]
                        }
                    }
                },
                "components": {
                    "securitySchemes": {
                        "bearerAuth": { "type": "http", "scheme": "bearer" }
                    }
                }
            }
        });
    </script>
</body>
</html>