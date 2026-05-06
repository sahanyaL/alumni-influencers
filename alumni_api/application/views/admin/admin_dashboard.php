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

    <hr>
    <div style="margin-top: 30px; padding: 20px; border: 1px solid #333; background: #f9f9f9;">
        <h3>Developer & API Management</h3>
        <p>Manage security tokens and monitor AR client usage statistics.</p>
        
        <ul style="line-height: 2;">
            <li>
                <a href="<?php echo base_url('index.php/admin/manage_api'); ?>" style="font-weight: bold; color: blue;">
                    Manage API Keys & View Usage Stats
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('index.php/api/docs'); ?>" target="_blank" style="font-weight: bold; color: green;">
                    Open Interactive API Documentation (Swagger UI)
                </a>
            </li>
        </ul>
    </div>
</body>
</html>