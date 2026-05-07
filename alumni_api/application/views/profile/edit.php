<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .modern-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background-color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Alumni Portal</a>
            <div class="ms-auto">
                <a href="<?php echo base_url('index.php/profile/dashboard'); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Your Professional Profile</h1>
        </div>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                
                <!-- General Info -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">General Information</h3>
                    <?php echo form_open('profile/update'); ?>
                        <div class="mb-3">
                            <label class="form-label text-muted">Full Name:</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo set_value('full_name', $profile->full_name); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Biography:</label>
                            <textarea name="bio" rows="4" class="form-control"><?php echo set_value('bio', $profile->bio); ?></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted">LinkedIn URL (e.g., https://linkedin.com/in/user):</label>
                            <input type="text" name="linkedin_url" class="form-control" value="<?php echo set_value('linkedin_url', $profile->linkedin_url); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Update Basic Info</button>
                    <?php echo form_close(); ?>
                </div>

                <!-- Update Photo -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">Update Profile Photo</h3>
                    <?php echo form_open_multipart('profile/upload_photo'); ?>
                        <div class="mb-4">
                            <input type="file" name="userfile" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-upload me-2"></i>Upload Photo</button>
                    <?php echo form_close(); ?>
                </div>

                <!-- Add Degree -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">Add a Degree</h3>
                    <?php echo form_open('profile/add_degree'); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Degree Name:</label>
                                <input type="text" name="degree_name" class="form-control" placeholder="e.g. BEng (Hons) Software Engineering" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">University Degree URL:</label>
                                <input type="text" name="university_url" class="form-control" placeholder="URL to course page" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label text-muted">Completion Date:</label>
                                <input type="date" name="completion_date" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Add Degree</button>
                    <?php echo form_close(); ?>
                </div>

                <!-- Add Certification -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">Add a Professional Certification</h3>
                    <?php echo form_open('profile/add_certification'); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Certification Name:</label>
                                <input type="text" name="cert_name" class="form-control" placeholder="Certification Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Course URL:</label>
                                <input type="text" name="course_url" class="form-control" placeholder="Course URL" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label text-muted">Completion Date:</label>
                                <input type="date" name="completion_date" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Add Certification</button>
                    <?php echo form_close(); ?>
                </div>

                <!-- Add Licence -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">Add a Professional Licence</h3>
                    <?php echo form_open('profile/add_licence'); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Licence Name:</label>
                                <input type="text" name="licence_name" class="form-control" placeholder="Licence Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Awarding Body URL:</label>
                                <input type="text" name="awarding_body_url" class="form-control" placeholder="Awarding Body URL" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label text-muted">Completion Date:</label>
                                <input type="date" name="completion_date" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Add Licence</button>
                    <?php echo form_close(); ?>
                </div>

                <!-- Add Employment -->
                <div class="modern-card p-4 mb-4">
                    <h3 class="h5 mb-4 border-bottom pb-2">Add Employment History</h3>
                    <?php echo form_open('profile/add_employment'); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Company Name:</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Job Title:</label>
                                <input type="text" name="job_title" class="form-control" placeholder="e.g. Software Engineer" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Start Date:</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check mt-md-4">
                                    <input class="form-check-input" type="checkbox" name="currently_working" id="current_job" value="1">
                                    <label class="form-check-label text-muted" for="current_job">
                                        I currently work here
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4" id="end_date_section">
                                <label class="form-label text-muted">End Date:</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Add Employment</button>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('current_job').onchange = function() {
            document.getElementById('end_date_section').style.display = this.checked ? 'none' : 'block';
        };
    </script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>