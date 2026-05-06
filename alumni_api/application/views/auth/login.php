<!DOCTYPE html>
<html>
<head>
    <title>Alumni Login</title>
</head>
<body>
    <h2>Alumni Login</h2>

    <?php if($this->session->flashdata('error')): ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <?php echo form_open('auth/login'); ?>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    <?php echo form_close(); ?>

    <p>Don't have an account? <a href="<?php echo base_url('index.php/auth/register'); ?>">Register here</a></p>
</body>
</html>