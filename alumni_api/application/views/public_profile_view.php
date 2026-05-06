<!DOCTYPE html>
<html>
<head>
    <title><?php echo $profile->full_name; ?> - Profile</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 20px; }
        h2 { 
            border-bottom: 2px solid #333; 
            padding-bottom: 5px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <a href="<?php echo base_url('index.php/home'); ?>"> Back to Home</a>
    
    <h1><?php echo $profile->full_name; ?></h1>
    <p><em><?php echo $profile->bio; ?></em></p>
    <p><strong>LinkedIn:</strong> <a href="<?php echo $profile->linkedin_url; ?>" target="_blank">Connect on LinkedIn</a></p>

    <div class="section">
        <h2>Education</h2>
        <?php foreach($degrees as $d): ?>
            <p><strong><?php echo $d->degree_name; ?></strong><br>
            <small><a href="<?php echo $d->university_url; ?>">View Course Details</a></small></p>
        <?php endforeach; ?>
    </div>

    <div class="section">
        <h2>Experience</h2>
        <?php foreach($employment as $e): ?>
            <p><strong><?php echo $e->job_title; ?></strong> at <?php echo $e->company_name; ?><br>
            <?php echo $e->start_date; ?> - <?php echo $e->currently_working ? 'Present' : $e->end_date; ?></p>
        <?php endforeach; ?>
    </div>
</body>
</html>