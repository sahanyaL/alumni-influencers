<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Update Your Professional Profile</h2>
    <p><a href="<?php echo base_url('index.php/profile/dashboard'); ?>">← Back to Dashboard</a></p>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>
    <?php if($this->session->flashdata('success')): ?>
        <p style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <fieldset>
        <legend><h3>General Information</h3></legend>
        <?php echo form_open('profile/update'); ?>
            <label>Full Name:</label><br>
            <input type="text" name="full_name" value="<?php echo set_value('full_name', $profile->full_name); ?>" required><br><br>

            <label>Biography:</label><br>
            <textarea name="bio" rows="4" cols="50"><?php echo set_value('bio', $profile->bio); ?></textarea><br><br>

            <label>LinkedIn URL (e.g., https://linkedin.com/in/user):</label><br>
            <input type="text" name="linkedin_url" value="<?php echo set_value('linkedin_url', $profile->linkedin_url); ?>" required><br><br>

            <button type="submit">Update Basic Info</button>
        <?php echo form_close(); ?>
    </fieldset>

    <br><hr><br>

    <fieldset>
        <legend><h3>Add a Degree</h3></legend>
        <?php echo form_open('profile/add_degree'); ?>
            <label>Degree Name:</label><br>
            <input type="text" name="degree_name" placeholder="e.g. BEng (Hons) Software Engineering" required><br><br>

            <label>University Degree URL:</label><br>
            <input type="text" name="university_url" placeholder="URL to course page" required><br><br>

            <label>Completion Date:</label><br>
            <input type="date" name="completion_date" required><br><br>

            <button type="submit" style="background-color: #4CAF50; color: white;">Add Degree</button>
        <?php echo form_close(); ?>
    </fieldset>

</body>
</html>