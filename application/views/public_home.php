<!DOCTYPE html>
<html>
<head>
    <title>Alumni Influencers - Home</title>
    <style>
        .featured-container { display: flex; gap: 20px; margin-top: 20px; }
        .alumnus-card { border: 2px solid #333; padding: 15px; width: 30%; }
        .search-box { margin: 30px 0; padding: 20px; background: #f4f4f4; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Alumni Influencers Platform</h1>
    <p>Connecting students with successful graduates.</p>

    <hr>

    <h2>Featured Alumni</h2>
    <div class="featured-container">
        <?php if(empty($featured_alumni)): ?>
            <p>No featured alumni at the moment.</p>
        <?php else: ?>
            <?php foreach($featured_alumni as $alumnus): ?>
                <div class="alumnus-card">
                    <img src="<?php echo base_url('uploads/profiles/' . ($alumnus->profile_image ? $alumnus->profile_image : 'default.png')); ?>" style="width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom:10px;">
                    <h3><?php echo $alumnus->full_name ? $alumnus->full_name : 'Anonymous'; ?></h3>
                    <p>Professional Influencer</p>
                    <a href="<?php echo base_url('index.php/home/view_profile/' . $alumnus->user_id); ?>">View Full Profile</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="search-box">
        <h3>Find an Alumnus</h3>
        <form action="<?php echo base_url('index.php/home/search'); ?>" method="GET">
            <input type="text" name="q" placeholder="Search by name, degree, or job..." required>
            <button type="submit">Search</button>
        </form>
    </div>

    <p><a href="<?php echo base_url('index.php/auth/login'); ?>">Alumni Login</a></p>
</body>
</html>