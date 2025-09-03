<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h3 class="card-title text-center mb-4">Login</h3>

            <?php if (!empty($flash)) : ?>
                <?php foreach ($flash as $type => $messages) : ?>
                    <?php foreach ($messages as $message) : ?>
                        <?php $alertClass = $type === 'success' ? 'alert-success' : 'alert-danger'; ?>
                        <div class="alert <?= htmlspecialchars($alertClass, ENT_QUOTES, 'UTF-8') ?> alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="mb-3">
                    <label for="login" class="form-label">Email ou telefone</label>
                    <input type="text" name="login" id="login" class="form-control" placeholder="Digite seu email ou telefone" required autocomplete="username">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
