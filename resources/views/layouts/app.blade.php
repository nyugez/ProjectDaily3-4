<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Alumni</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* NAVBAR */
        nav {
            background: #1a237e;
            color: white;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 56px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        nav .brand {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        nav .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 14px;
        }

        nav .nav-right span {
            opacity: 0.85;
        }

        nav .btn-logout {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 6px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
        }

        nav .btn-logout:hover {
            background: rgba(255,255,255,0.25);
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            margin: 28px auto;
            padding: 0 16px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .card h2 {
            font-size: 20px;
            color: #1a237e;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e8eaf6;
        }

        /* ALERT */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        /* FORM */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
            transition: border-color 0.2s;
            background: #fafafa;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3f51b5;
            background: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #3f51b5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 20px 0 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e8eaf6;
        }

        .invalid-feedback {
            color: #c62828;
            font-size: 12px;
            margin-top: 4px;
        }

        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 9px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #1a237e;
            color: white;
        }

        .btn-primary:hover { background: #283593; }

        .btn-success {
            background: #2e7d32;
            color: white;
        }

        .btn-success:hover { background: #388e3c; }

        .btn-warning {
            background: #f57c00;
            color: white;
            padding: 5px 12px;
            font-size: 12px;
        }

        .btn-warning:hover { background: #fb8c00; }

        .btn-danger {
            background: #c62828;
            color: white;
            padding: 5px 12px;
            font-size: 12px;
        }

        .btn-danger:hover { background: #d32f2f; }

        .btn-secondary {
            background: #607d8b;
            color: white;
        }

        .btn-secondary:hover { background: #546e7a; }

        .btn-actions {
            display: flex;
            gap: 8px;
            margin-top: 24px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table th {
            background: #e8eaf6;
            color: #1a237e;
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: top;
        }

        table tr:hover td {
            background: #f5f5ff;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-pns      { background: #e3f2fd; color: #1565c0; }
        .badge-swasta   { background: #e8f5e9; color: #2e7d32; }
        .badge-wirausaha{ background: #fff3e0; color: #e65100; }

        /* SEARCH BAR */
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .search-bar input {
            flex: 1;
            padding: 9px 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #3f51b5;
        }

        /* PAGINATION */
        .pagination-wrapper {
            margin-top: 16px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 4px;
            list-style: none;
        }

        .pagination-wrapper .page-link {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 13px;
            color: #1a237e;
            text-decoration: none;
        }

        .pagination-wrapper .page-item.active .page-link {
            background: #1a237e;
            color: white;
            border-color: #1a237e;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .text-muted { color: #999; font-style: italic; }
    </style>
</head>
<body>

<nav>
    <div class="brand">🎓 Sistem Data Alumni</div>
    @auth
    <div class="nav-right">
        <span>👤 {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
    @endauth
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
