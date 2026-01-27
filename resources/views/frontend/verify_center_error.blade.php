<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Error</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; width: 90%; text-align: center; }
        .error-icon { color: #dc3545; font-size: 48px; margin-bottom: 1rem; }
        h1 { font-size: 24px; color: #333; margin-bottom: 0.5rem; }
        p { color: #666; margin: 0.5rem 0; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="card">
        <div class="error-icon">✕</div>
        <h1>Verification Failed</h1>
        <p>{{ $message ?? 'The requested center could not be verified.' }}</p>
        <a href="/" class="btn">Go Home</a>
    </div>
</body>
</html>
