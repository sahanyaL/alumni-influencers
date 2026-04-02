<!DOCTYPE html>
<html>
<head>
    <title>Alumni Dashboard</title>
</head>
<body>
    <h1>Alumni Dashboard</h1>
    <p>Logged in as: <strong><?php echo $this->session->userdata('email'); ?></strong></p>
    <hr>

    <h2>Personal Information</h2>
    <p><strong>Full Name:</strong> <?php echo $profile->full_name ? $profile->full_name : 'Not set'; ?></p>
    <p><strong>Bio:</strong> <?php echo $profile->bio ? $profile->bio : 'No biography added yet.'; ?></p>
    <p><strong>LinkedIn:</strong> 
        <?php if($profile->linkedin_url): ?>
            <a href="<?php echo $profile->linkedin_url; ?>" target="_blank"><?php echo $profile->linkedin_url; ?></a>
        <?php else: ?>
            Not set
        <?php endif; ?>
    </p>

    <hr>

    <h2>Degrees</h2>
    <?php if(empty($degrees)): ?>
        <p>No degrees added.</p>
    <?php else: ?>
        <ul>
            <?php foreach($degrees as $degree): ?>
                <li>
                    <strong><?php echo $degree->degree_name; ?></strong> 
                    (Completed: <?php echo $degree->completion_date; ?>)<br>
                    <small><a href="<?php echo $degree->university_url; ?>" target="_blank">Official Course Page</a></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <hr>

    <h2>Professional Certifications</h2>
    <?php if(empty($certifications)): ?>
        <p>No certifications added.</p>
    <?php else: ?>
        <ul>
            <?php foreach($certifications as $cert): ?>
                <li>
                    <strong><?php echo $cert->cert_name; ?></strong> 
                    (Date: <?php echo $cert->completion_date; ?>)<br>
                    <small><a href="<?php echo $cert->course_url; ?>" target="_blank">View Certificate/Course</a></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <hr>

    <h2>Professional Licences</h2>
    <?php if(empty($licences)): ?>
        <p>No licences added.</p>
    <?php else: ?>
        <ul>
            <?php foreach($licences as $licence): ?>
                <li>
                    <strong><?php echo $licence->licence_name; ?></strong> 
                    (Issued: <?php echo $licence->completion_date; ?>)<br>
                    <small><a href="<?php echo $licence->awarding_body_url; ?>" target="_blank">Awarding Body</a></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Employment History</h2>
    <?php if(empty($employment)): ?>
        <p>No employment history added.</p>
    <?php else: ?>
        <ul>
            <?php foreach($employment as $job): ?>
                <li>
                    <strong><?php echo $job->job_title; ?></strong> at <?php echo $job->company_name; ?><br>
                    <?php echo $job->start_date; ?> to 
                    <?php echo $job->currently_working ? 'Present' : $job->end_date; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <br>
    <div style="margin-top: 20px; padding: 10px; background: #f4f4f4;">
        <a href="<?php echo base_url('index.php/profile/edit'); ?>">Edit My Profile</a> | 
        <a href="<?php echo base_url('index.php/auth/logout'); ?>" style="color: red;">Logout</a>
    </div>
</body>
</html>