<!DOCTYPE html>
<html>
<head>
    <title>Admin Control Panel</title>
</head>
<body>
    <h1>System Administrator Dashboard</h1>
    <hr>

    <?php if($this->session->flashdata('success')): ?>
        <p><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <div style="border: 2px solid black; padding: 20px; margin-top: 20px;">
        <h3>Marketplace Management</h3>
        <p>Clicking the button below will finalize the current bidding round.</p>
        <ul>
            <li>Top 3 bidders will be marked as "Winners."</li>
            <li>Their appearance count will increase by 1.</li>
            <li>All current bids will be deleted.</li>
        </ul>
        
        <form action="<?php echo base_url('index.php/admin/trigger_reset'); ?>" method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.');">
            <button type="submit" style="background: red; color: white; padding: 10px;">
                FINALIZE CYCLE & RESET BIDS
            </button>
        </form>
    </div>
</body>
</html>