<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Adota Paraná</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
            <h3 class="text-center mb-4">Entrar</h3>

            <!-- Mensagens de sucesso/erro -->
            <?php if (\Lib\FlashMessage::hasMessages()): ?>
                <div>
                    <?php foreach (\Lib\FlashMessage::getMessages() as $message): ?>
                        <div class="alert alert-<?= $message['type'] ?> text-center">
                            <?= htmlspecialchars($message['text']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        placeholder="seuemail@email.com" 
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>

</body>
</html>
