<?php
session_start();

if (isset($_COOKIE['username'])) {
}

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['next'])) {
        if (isset($_POST['step']) && $_POST['step']  == 1) {
            $_SESSION['full_name'] = $_POST['full_name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['phone'] = $_POST['phone'];
        } else if (isset($_POST['step']) && $_POST['step'] == 2) {
            $_SESSION['degree'] = $_POST['degree'];
            $_SESSION['field_of_study'] = $_POST['field_of_study'];
            $_SESSION['institution'] = $_POST['institution'];
            $_SESSION['graduation_year'] = $_POST['graduation_year'];
        } else if (isset($_POST['step']) && $_POST['step'] == 3) {
            $_SESSION['job_title'] = $_POST['job_title'];
            $_SESSION['company_name'] = $_POST['company_name'];
            $_SESSION['experience_years'] = $_POST['experience_years'];
            $_SESSION['responsibilities'] = $_POST['responsibilities'];
        } else if (isset($_POST['step']) && $_POST['step'] == 4) {
            $application = [
                'full_name' => $_SESSION['full_name'],
                'email' => $_SESSION['email'],
                'phone' => $_SESSION['phone'],
                'degree' => $_SESSION['degree'],
                'field_of_study' => $_SESSION['field_of_study'],
                'institution' => $_SESSION['institution'],
                'graduation_year' => $_SESSION['graduation_year'],
                'job_title' => $_SESSION['job_title'],
                'company_name' => $_SESSION['company_name'],
                'experience_years' => $_SESSION['experience_years'],
                'responsibilities' => $_SESSION['responsibilities'],
            ];

            $applicationsFile = 'applications.json';
            if (file_exists($applicationsFile)) {
                $applications = json_decode(file_get_contents($applicationsFile), true);
            } else {
                $applications = [];
            }
            $applications[] = $application;
            file_put_contents($applicationsFile, json_encode($applications, JSON_PRETTY_PRINT));
        } else if (isset($_POST['step']) && $_POST['step'] == 5) {
            exit;
        }
        $_SESSION['step']++;
    }

    if (isset($_POST['previous'])) {
        $_SESSION['step']--;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div>

        <?php if (isset($_SESSION['username'])): ?>
            <form method="POST" action="logout.php">
                <button type="submit">Logout</button>
            </form>
        <?php endif; ?>

        <?php if (isset($_SESSION['step']) && $_SESSION['step'] == 1) : ?>
            <form method="POST">
                <h2>Step 1: Personal Information</h2>
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" required value=<?php echo $_SESSION['full_name']; ?>><br><br>

                <label for="email">Email:</label>
                <input type="email" name="email" required value=<?php echo $_SESSION['email']; ?>><br><br>

                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" required value=<?php echo $_SESSION['phone']; ?>><br><br>

                <input type="hidden" name="step" value="1">
                <button type="submit" name="next">Next</button>
            </form>

        <?php elseif (isset($_SESSION['step']) && $_SESSION['step'] == 2) : ?>
            <form method="POST">
                <h2>Step 2: Educational Background</h2>
                <label for="degree">Highest Degree Obtained:</label>
                <input type="text" name="degree" required value=<?php echo $_SESSION['degree']; ?>><br><br>

                <label for="field_of_study">Field of Study:</label>
                <input type="text" name="field_of_study" required value=<?php echo $_SESSION['field_of_study']; ?>><br><br>

                <label for="institution">Name of Institution:</label>
                <input type="text" name="institution" required value=<?php echo $_SESSION['institution']; ?>><br><br>

                <label for="graduation_year">Year of Graduation:</label>
                <input type="text" name="graduation_year" required value=<?php echo $_SESSION['graduation_year']; ?>><br><br>

                <input type="hidden" name="step" value="2">
                <button type="submit" name="previous">Previous</button>
                <button type="submit" name="next">Next</button>
            </form>

        <?php elseif (isset($_SESSION['step']) && $_SESSION['step'] == 3) : ?>
            <form method="POST">
                <h2>Step 3: Work Experience</h2>
                <label for="job_title">Previous Job Title:</label>
                <input type="text" name="job_title" required value=<?php echo $_SESSION['job_title']; ?>><br><br>

                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name" required value=<?php echo $_SESSION['company_name']; ?>><br><br>

                <label for="experience_years">Years of Experience:</label>
                <input type="text" name="experience_years" required value=<?php echo $_SESSION['experience_years']; ?>><br><br>

                <label for="responsibilities">Key Responsibilities:</label>
                <input type="text" name="responsibilities" required value=<?php echo $_SESSION['responsibilities']; ?>><br><br>

                <input type="hidden" name="step" value="3">
                <button type="submit" name="previous">Previous</button>
                <button type="submit" name="next">Next</button>
            </form>

        <?php elseif (isset($_SESSION['step']) && $_SESSION['step'] == 4) : ?>
            <form method="POST">
                <h2>Review Your Application</h2>
                <p><strong>Full Name:</strong> <?php echo $_SESSION['full_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $_SESSION['phone']; ?></p>
                <p><strong>Highest Degree:</strong> <?php echo $_SESSION['degree']; ?></p>
                <p><strong>Field of Study:</strong> <?php echo $_SESSION['field_of_study']; ?></p>
                <p><strong>Institution:</strong> <?php echo $_SESSION['institution']; ?></p>
                <p><strong>Graduation Year:</strong> <?php echo $_SESSION['graduation_year']; ?></p>
                <p><strong>Job Title:</strong> <?php echo $_SESSION['job_title']; ?></p>
                <p><strong>Company Name:</strong> <?php echo $_SESSION['company_name']; ?></p>
                <p><strong>Years of Experience:</strong> <?php echo $_SESSION['experience_years']; ?></p>
                <p><strong>Key Responsibilities:</strong> <?php echo $_SESSION['responsibilities']; ?></p>

                <input type="hidden" name="step" value="4">
                <button type="submit" name="previous">Previous</button>
                <button type="submit" name="next">Submit Application</button>
            </form>
        <?php elseif (isset($_SESSION['step']) && $_SESSION['step'] == 5) : ?>
            <h2>Your application has been submitted successfully!</h2>
            <h3>A confirmation email has been sent to your email id</h3>

        <?php endif; ?>
    </div>

</body>

</html>