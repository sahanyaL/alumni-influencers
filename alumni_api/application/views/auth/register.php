<!DOCTYPE html>
<html>
<head>
    <title>Alumni Registration</title>
</head>
<body>
    <h2>Alumni Registration</h2>
    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>
    <?php echo form_open('auth/register'); ?>
        
        <label>University Email:</label><br>
        <input type="email" name="email" value="<?php echo set_value('email'); ?>" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">Register</button>
        
    <?php echo form_close(); ?>
</body>
</html>