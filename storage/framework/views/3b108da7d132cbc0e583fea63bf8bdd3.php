<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="<?php echo e(route('register')); ?>" method="POST">
        <?php echo csrf_field(); ?>  <!-- Token to protect against CSRF attacks -->
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
<?php /**PATH D:\Xampp\htdocs\HealthBridge\resources\views/auth/register.blade.php ENDPATH**/ ?>