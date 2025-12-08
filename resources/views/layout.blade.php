<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria Gourmet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: system-ui, sans-serif; margin:0; padding:0; background:#faf7f4; }
        header, footer { background:#4b2c20; color:#fff; padding:10px 16px; }
        main { padding:16px; max-width:960px; margin:0 auto; }
        .btn { display:inline-block; padding:8px 16px; border-radius:4px; border:none; background:#c47b56; color:#fff; text-decoration:none; }
        .btn-secondary { background:#777; }
        .card { background:#fff; border-radius:8px; padding:12px; margin-bottom:12px; box-shadow:0 1px 3px rgba(0,0,0,.08); }
    </style>
</head>
<body>
<header>
    <h1>Cafeteria Gourmet – Cupcakes</h1>
</header>

<main>
    @if(session('sucesso'))
        <div class="card" style="border-left:4px solid #2e7d32;">
            {{ session('sucesso') }}
        </div>
    @endif

    @yield('conteudo')
</main>

<footer>
    <small>&copy; {{ date('Y') }} Cafeteria Gourmet</small>
</footer>
</body>
</html>
