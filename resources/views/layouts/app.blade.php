<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laporan Kopi')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; color: #333; }
        nav { background: #3b2a1a; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: #fff; text-decoration: none; margin-right: 15px; }
        nav a:hover { text-decoration: underline; }
        .container { max-width: 1000px; margin: 20px auto; padding: 0 15px; }
        .card { background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px 10px; border: 1px solid #ddd; text-align: left; font-size: 14px; }
        th { background: #f0f0f0; }
        .btn { display: inline-block; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; }
        .btn-primary { background: #3b2a1a; color: #fff; }
        .btn-danger { background: #c0392b; color: #fff; }
        .btn-secondary { background: #888; color: #fff; }
        form label { display: block; margin-top: 10px; font-size: 14px; }
        form input, form select { width: 100%; padding: 6px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .alert-success { background: #d4edda; color: #155724; }
        .error { color: #c0392b; font-size: 13px; }
    </style>
</head>
<body>

    @auth
    <nav>
        <div>
            <strong>Laporan Kopi</strong>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('menu.index') }}">Menu</a>
                <a href="{{ route('laporan.index') }}">Laporan</a>
            @else
                <a href="{{ route('transaksi.index') }}">Index</a>
                <a href="{{ route('transaksi.history') }}">History</a>
            @endif
        </div>
        <div>
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="margin-left:10px;">Logout</button>
            </form>
        </div>
    </nav>
    @endauth

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

</body>
</html>
