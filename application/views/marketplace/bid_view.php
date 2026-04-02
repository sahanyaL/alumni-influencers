<!DOCTYPE html>
<html>
<head>
    <title>Alumni Bidding Marketplace</title>
    <style>
        .leaderboard { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        .leaderboard th, .leaderboard td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .leaderboard th { background-color: #f2f2f2; }
        .top-3 { background-color: #f9fcf9; font-weight: bold; } 
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Blind Bidding Marketplace</h1>
    <p><a href="<?php echo base_url('index.php/profile/dashboard'); ?>">Back to Dashboard</a></p>

    <?php if($this->session->flashdata('error')): ?>
        <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>
        <p class="success"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <h3>Current Top Bidders (Featured Spots)</h3>
    <table class="leaderboard">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Alumnus Name</th>
                <th>Bid Amount (LKR)</th>
                <th>Time Placed</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($top_bids)): ?>
                <tr><td colspan="4">No bids placed yet. Be the first!</td></tr>
            <?php else: ?>
                <?php $rank = 1; foreach($top_bids as $bid): ?>
                    <tr class="<?php echo ($rank <= 3) ? 'top-3' : ''; ?>">
                        <td><?php echo $rank; ?></td>
                        <td><?php echo $bid->full_name ? $bid->full_name : 'Anonymous'; ?></td>
                        <td>Rs. <?php echo number_format($bid->amount, 2); ?></td>
                        <td><?php echo date('H:i:s d-m-Y', strtotime($bid->bid_time)); ?></td>
                    </tr>
                <?php $rank++; endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <h3>Place Your Bid</h3>
    <p><small>Note: You must bid higher than the 3rd rank to be featured on the homepage.</small></p>
    
    <?php echo form_open('marketplace/place_bid'); ?>
        <label>Enter Bid Amount:</label><br>
        <input type="number" name="amount" step="0.01" min="1" required placeholder="0.00"><br><br>
        <button type="submit" style="padding: 10px 20px; background-color: #616264; color: white; border: none; cursor: pointer;">
            Confirm Bid
        </button>
    <?php echo form_close(); ?>

</body>
</html>