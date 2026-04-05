<!DOCTYPE html>
<html>
<head>
    <title>Alumni Influencers API Documentation</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@3/swagger-ui.css">
</head>
<body>
    <div id="swagger-ui"></div>
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