<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FundiMzii')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #111827;
            background: #eef2ff;
        }
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(99,102,241,0.14) 0%, rgba(255,255,255,0.86) 42%, #eff6ff 100%);
            color: #111827;
        }
        .page-shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem 3rem;
        }
        .page-header {
            padding: 2rem 1.5rem;
            border-radius: 28px;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 30px 80px rgba(15,23,42,0.08);
            border: 1px solid rgba(148,163,184,0.16);
            margin-bottom: 1.75rem;
        }
        .page-header .eyebrow {
            display: inline-flex;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            background: rgba(79,70,229,0.1);
            color: #4338ca;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.9rem;
        }
        .page-header h1 {
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            letter-spacing: -0.04em;
            margin-bottom: 0.75rem;
        }
        .page-header .lead {
            color: #4b5563;
            max-width: 760px;
            margin: 0 auto;
        }
        .card-modern {
            border: none;
            border-radius: 28px;
            box-shadow: 0 24px 64px rgba(15,23,42,0.08);
            overflow: hidden;
        }
        .card-modern .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: #334155;
        }
        .form-control,
        .form-select {
            border-radius: 16px;
            border-color: rgba(148,163,184,0.3);
            background: #fbfbff;
            box-shadow: inset 0 0 0 1px rgba(148,163,184,0.1);
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.18);
        }
        .btn-brand {
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            border: none;
            box-shadow: 0 16px 30px rgba(79,70,229,0.18);
        }
        .btn-brand:hover {
            background: linear-gradient(135deg, #4338ca, #1d4ed8);
        }
        .btn-outline-brand {
            border-color: #c7d2fe;
            color: #3730a3;
        }
        .table thead {
            background: rgba(99,102,241,0.08);
        }
        .table tbody tr:hover {
            background: rgba(99,102,241,0.06);
        }
        .stat-card {
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(148,163,184,0.18);
            box-shadow: 0 16px 32px rgba(15,23,42,0.06);
        }
        .stat-card .card-body {
            padding: 1.8rem;
        }
        .stat-label {
            color: #475569;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .stat-value {
            font-size: 2.75rem;
            font-weight: 700;
            color: #1f2937;
        }
        .accent-strip {
            height: 4px;
            width: 60px;
            border-radius: 999px;
            background: linear-gradient(90deg, #4f46e5, #2563eb);
            margin-bottom: 1rem;
        }
        .small-note {
            color: #64748b;
            font-size: 0.95rem;
        }
        @media (max-width: 767px) {
            .page-shell { padding: 1.25rem; }
            .page-header { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>