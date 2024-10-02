
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="container">
        <div id="left-column">
            <img src="./img/bg2.jpeg" alt="Welcome Image">
        </div>
        <div id="right-column">
            <div id="form-container">
                
                <form action="login.php" method="POST" id="login-form">
                    <h2>Connexion</h2>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>

                    <a href="#" id="forgot-password">Mot de passe oublié ?</a>

                    <button type="submit">Se connecter</button>

                    <p>Vous n'avez pas de compte? <a href="#" id="register-link">S'inscrire</a></p>
                </form>

                <!-- Registration Form -->
                <form action="register.php" method="POST" id="register-form" style="display:none;">
                    <h2>S'inscrire</h2>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                    <br>
            
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                    <br>
            
                    <label for="confirm_password">Confirmez le mot de passe :</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <br>

                    <button type="submit">S'inscrire</button>

                    <p>Déjà un compte? <a href="#" id="login-link">Se connecter</a></p>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const registerLink = document.getElementById('register-link');
        const loginLink = document.getElementById('login-link');

        registerLink.addEventListener('click', () => {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });

        loginLink.addEventListener('click', () => {
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
        });
    </script>
</body>
</html>
