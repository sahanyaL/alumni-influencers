<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        .result-item { border-bottom: 1px solid #ccc; padding: 15px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <a href="<?php echo base_url('index.php/home'); ?>">Back to Home</a>
    <h1>Search Results for: "<?php echo htmlspecialchars($query); ?>"</h1>

    <?php if(empty($results)): ?>
        <p>No alumni found matching your search.</p>
    <?php else: ?>
        <?php foreach($results as $row): ?>
            <div class="result-item">
                <h3><?php echo $row->full_name; ?></h3>
                <p><?php echo $row->bio; ?></p>
                <a href="<?php echo base_url('index.php/home/view_profile/' . $row->user_id); ?>">View Profile</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>