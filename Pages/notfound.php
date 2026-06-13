<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <!-- Bootstrap 5 -->
    <link href="<?= URL_ROOT ?>Assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?= URL_ROOT ?>Assets/css/style.css" rel="stylesheet">

    <style>
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center mt-5 text-center">
    <div class="mt-5">
        <div class="error-code">404</div>

        <h3 class="mb-2">Page Not Found</h3>
        <p class="muted mb-4">
            The page you’re looking for doesn’t exist or has been moved.
        </p>

        <a href="<?= URL_ROOT ?>" class="btn btn-primary px-4 py-2">
            <i class="bi bi-house-door me-1"></i>
            Back to Home
        </a>
    </div>
</div>

</body>
</html>