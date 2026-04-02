<!DOCTYPE html>
<html>
<head>
    <title>Alumni Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $this->session->userdata('email'); ?></h1>
    
    <h3>Your Profile</h3>
    <p>Bio: <?php echo $profile->bio ? $profile->bio : 'Not set'; ?></p>
    <p>LinkedIn: <a href="<?php echo $profile->linkedin_url; ?>"><?php echo $profile->linkedin_url; ?></a></p>

    <h3>Your Degrees</h3>
    <ul>
        <?php foreach($degrees as $degree): ?>
            <li><?php echo $degree->degree_name; ?> (<?php echo $degree->completion_date; ?>)</li>
        <?php endforeach; ?>
    </ul>

    <a href="<?php echo base_url('index.php/profile/edit'); ?>">Edit Profile</a> | 
    <a href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>
</body>
</html>