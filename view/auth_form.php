<div id="auth_block">
    <span id="error">
    <?php echo $errors?>
    </span>

    <form action="?controller=auth&action=" method="POST" id="auth_form">
        <input type="text" name="email" placeholder="E-mail"><br>
        <input type="text" name="password" placeholder="Password"><br>
        <input type="submit" name="signUp" id="signUp" value="Sign up">
        <input type="submit" name="signIn" id="signIn" value="Sign in">
    </form>
</div>
