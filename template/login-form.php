<form class="form section-login" action="login.php" method="POST">
    
            <h2>Login</h2>

            <?php if(!empty($templateParams["errorelogin"])): ?>
            <p class="error"><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>

            <ul>
                <li>
                    <label for="email">Email:</label><input type="email" id="email" name="email" required />
                </li>
                <li>
                    <label for="password">Password:</label><input type="password" id="password" name="password" required />
                </li>
                <li>
                    <input type="submit" name="submit" value="Invia" />
                </li>
            </ul>
        </form>

  