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

    <br><hr><br>

    <fieldset>
        <legend><h3>Add a Professional Certification</h3></legend>
        <?php echo form_open('profile/add_certification'); ?>
            <input type="text" name="cert_name" placeholder="Certification Name" required><br><br>
            <input type="text" name="course_url" placeholder="Course URL" required><br><br>
            <input type="date" name="completion_date" required><br><br>
            <button type="submit">Add Certification</button>
        <?php echo form_close(); ?>
    </fieldset>

    <br><hr><br>

    <fieldset>
        <legend><h3>Add a Professional Licence</h3></legend>
        <?php echo form_open('profile/add_licence'); ?>
            <input type="text" name="licence_name" placeholder="Licence Name" required><br><br>
            <input type="text" name="awarding_body_url" placeholder="Awarding Body URL" required><br><br>
            <input type="date" name="completion_date" required><br><br>
            <button type="submit">Add Licence</button>
        <?php echo form_close(); ?>
    </fieldset>

    <br><hr><br>
    <fieldset>
        <legend><h3>Add Employment History</h3></legend>
        <?php echo form_open('profile/add_employment'); ?>
            <input type="text" name="company_name" placeholder="Company Name" required><br><br>
            <input type="text" name="job_title" placeholder="Job Title (e.g. Software Engineer)" required><br><br>
            
            <label>Start Date:</label>
            <input type="date" name="start_date" required><br><br>

            <label>
                <input type="checkbox" name="currently_working" id="current_job" value="1"> I currently work here
            </label><br><br>

            <div id="end_date_section">
                <label>End Date:</label>
                <input type="date" name="end_date"><br><br>
            </div>

            <button type="submit">Add Employment</button>
        <?php echo form_close(); ?>
    </fieldset>

    <script>
        document.getElementById('current_job').onchange = function() {
            document.getElementById('end_date_section').style.display = this.checked ? 'none' : 'block';
        };
    </script>

    <br><hr><br>
    <fieldset>
        <legend><h3>Update Profile Photo</h3></legend>
        <?php echo form_open_multipart('profile/upload_photo'); ?>
            <input type="file" name="userfile" size="20" required /><br><br>
            <button type="submit">Upload Photo</button>
        <?php echo form_close(); ?>
    </fieldset>

</body>
</html>