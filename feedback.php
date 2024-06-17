<?php
// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to read existing feedbacks from JSON file
function read_feedbacks()
{
    $file = 'feedbacks.json';
    $feedbacks = [];

    // Check if file exists and is readable
    if (file_exists($file) && is_readable($file)) {
        $json_data = file_get_contents($file);
        $feedbacks = json_decode($json_data, true);
    }

    return $feedbacks;
}

// Function to save feedbacks to JSON file
function save_feedbacks($feedbacks)
{
    $file = 'feedbacks.json';
    $json_data = json_encode($feedbacks, JSON_PRETTY_PRINT);
    file_put_contents($file, $json_data);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST["name"]);
    $email = sanitize_input($_POST["email"]);
    $message = sanitize_input($_POST["message"]);

    // Create new feedback array
    $new_feedback = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];

    // Read existing feedbacks
    $feedbacks = read_feedbacks();

    // Add new feedback to array
    $feedbacks[] = $new_feedback;

    // Save updated feedbacks to JSON file
    save_feedbacks($feedbacks);

    // Return new feedback as JSON response
    echo json_encode($new_feedback);
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Feedback Form</h1>
    </header>

    <?php include('nav.php'); ?>

    <main>
        <section>
            <h2>Submit Your Feedback</h2>
            <div id="error" style="display: none;">
                <p>There was an error processing your request. Please try again later.</p>
            </div>
            <div id="success" style="display: none;">
                <p>Feedback submitted successfully!</p>
            </div>
            <form id="feedbackForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <input type="submit" value="Submit">
            </form>
        </section>

        <section>
            <h2>Current Feedbacks</h2>
            <ul class="feedback-list">
                <?php
                $feedbacks = read_feedbacks();

                if (!empty($feedbacks)) {
                    // Reverse the array to show the latest feedback first
                    $feedbacks = array_reverse($feedbacks);

                    foreach ($feedbacks as $feedback) {
                        echo "<li class='feedback-item'>";
                        echo "<p><strong>" . htmlspecialchars($feedback['name']) . "</strong> says:</p>";
                        echo "<p>" . htmlspecialchars($feedback['message']) . "</p>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No feedbacks yet.</li>";
                }
                ?>
            </ul>
        </section>

    </main>

    <footer>
        <p>&copy; 2024 Maldivian Culture Website. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>