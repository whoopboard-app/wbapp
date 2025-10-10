<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | Railway</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" type="image/png">
    <link rel="icon" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

    <style>
        .coming-soon {
            width: 60%;
            max-width: 700px;
            margin: auto;
        }
        @media (max-width: 768px) {
            .coming-soon {
                width: 50%;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Main Section -->
<main class="flex-fill d-flex justify-content-center align-items-center">
    <div class="coming-soon">
        <div class="d-flex justify-content-between align-items-end">
            <div class="logo">
                @if(!empty($theme->feature_banner))
                    <img src="{{ asset('storage/' . $theme->feature_banner) }}" alt="Feature Banner" class="img-fluid">
                @else
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Railway" class="img-fluid">
                @endif
            </div>
            <div class="Coming-soon-text">
                <h5 class="fw-semibold text-primary">Coming Soon</h5>
            </div>
        </div>

        <div class="card theme-card mt-3">
            <h5 class="fw-semibold text-primary">Product Updates</h5>
            <p class="label">
                Manage Feature Requests, Roadmap, NPS, and in-app notifications alongside product announcements.
                Stay connected, gather feedback, and keep users informed—all in one platform.
            </p>
        </div>
        @if($theme->is_visible == 1 && $theme->is_password_protected == 1)
            <form action="{{ route('coming.soon.check', $tenant->custom_url) }}" method="POST">
            @csrf
            <div class="form-input mt-3 mb-3">
                <label for="password" class="input-label mb-1 fw-medium">Password</label>
                <input type="password" id="password" name="password" class="input-field w-100 rounded" placeholder="Placeholder" required>
                @if($errors->has('password'))
                    <div class="text-danger small mt-1">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="d-inline-block w-100">
                <button type="submit" class="form-btn theme-btn fw-semibold w-20 rounded border-0 mt-2">
                    Submit
                </button>
            </div>
        </form>
        @endif
    </div>
</main>

<!-- Footer -->
<footer class="footer mt-auto py-2">
    <p class="copyright-text text-center mb-0 fw-semibold">
        © 2025 InsightHQ. All rights reserved
    </p>
</footer>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
