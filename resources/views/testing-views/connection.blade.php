<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form class="login-form" action="/connected" method="POST">
    <h2>Connexion</h2>
    <input type="email" name="email" placeholder="Votre adresse email" required>
    <input type="password" name="password" placeholder="Votre mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
</body>
</html>
