




















































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>"> <!-- Link to your login.css -->
</head>
<body>
<img src="<?php echo e(asset('images/HealthBridgeLogo.png')); ?>" alt="Logo" class="logo">
<div class="contact-us-box">
    <img src="<?php echo e(asset('images/msg.png')); ?>" alt="Message Icon" class="contact-icon" style="height: 15px;">
    <a href="mailto:snehakhan52@gmail.com?subject=Support%20Request&body=Hi%20Team,%0A%0AI%20need%20help%20with..." class="contact-us-text">Contact</a>
</div>



<div class="container">
    <div class="card">
        
        
        
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('login.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="text" class="form-label"><?php echo e(__('Login ID')); ?></label>
                    <input type="text" class="form-control" id="Login_ID" name="Login_ID" required>


                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                    <input type="password" class="form-control" id="Log_Password" name="Log_Password" required>

                </div>

                <?php if($errors->has('login_error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e($errors->first('login_error')); ?>

                    </div>
                <?php endif; ?>
                
                
                
                
                









                <button type="submit" class="btn custom-btn w-50"><?php echo e(__('Login')); ?></button>

                    <div class="text-center mt-3">
                        <p class="custom-text">
                            Not registered yet? <a href="<?php echo e(route('register')); ?>" class="custom-signup-link">Create an account</a>
                        </p>
                    </div>
            </form>
        </div>
    </div>
</div>
<footer class="footer">
    <p>&copy; 2024 HealthBridge. All rights reserved.</p>
</footer>
</body>
</html>
<?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/auth/login.blade.php ENDPATH**/ ?>