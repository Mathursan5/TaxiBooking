<?php
require_once('./config.php');
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming client_id is obtained from $_settings->userdata('id')
    $client_id = $_settings->userdata('id');
    
    $feedback_text = $_POST["feedback_text"];
    $rating = $_POST["rating"];

    // Fetch cab_id from booking_list based on client_id and status = 3
    $booking_query = "SELECT cab_id FROM booking_list WHERE client_id = '$client_id' AND status = 3 ORDER BY id DESC LIMIT 1";
    $booking_result = $conn->query($booking_query);

    if ($booking_result->num_rows > 0) {
        // Booking record found, proceed to insert feedback
        $booking_row = $booking_result->fetch_assoc();
        $cab_id_from_booking = $booking_row["cab_id"];

        // Insert feedback into the database
        $sql = "INSERT INTO feedback (client_id, cab_id, feedback_text, rating) VALUES ('$client_id', '$cab_id_from_booking', '$feedback_text', '$rating')";

        if ($conn->query($sql) === TRUE) {
            // Update status to 6 in the booking_list table
            $update_query = "UPDATE booking_list SET status = 5 WHERE client_id = '$client_id' AND status = 3 ORDER BY id DESC LIMIT 1";
            $conn->query($update_query);

            $_SESSION['success_message'] = "Thanks for Rating Us";
            //location.href = './?p=booking_list';
            header("Location: index.php");
            //exit();
        } else {
            echo "Error inserting feedback: " . $conn->error;
        }
    } else {
        echo "Error: Booking record not found for client_id=$client_id and status=3";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
        }

        
        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: orange;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .rating {
        display: flex;
        margin-bottom: 15px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 30px;
        height: 30px;
        margin-right: 5px;
        text-align: center;
        line-height: 30px;
        color: #ccc;
    }

    .rating label i {
        font-size: 20px;
    }

    .rating label.selected {
        color: #ffcc00;
    }
    </style>
</head>
<body>

<div class="content py-5 mt-5 container">
    <h2>Last Trip Feedback</h2>
    <form action="feedback.php" method="post" onsubmit="return validateForm()">

        <label for="feedback_text">Comments:</label>
        <textarea name="feedback_text" rows="4" required></textarea>

        <label for="rating">Rating:</label>
        <div class="rating" onclick="handleRating(event)">
            <?php
            // Display 5 star icons
            for ($i = 1; $i <= 5; $i++) {
                echo '<input type="radio" id="star' . $i . '" name="rating" value="' . $i . '">';
                echo '<label for="star' . $i . '"><i class="fas fa-star"></i></label>';
            }
            ?>
        </div>


        <button type="submit">Submit Feedback</button>
    </form>
</div>
<script>
    function handleRating(event) {
        const stars = document.querySelectorAll('.rating label');
        const clickedStar = event.target.closest('label');

        if (clickedStar) {
            const clickedIndex = Array.from(stars).indexOf(clickedStar);
            for (let i = 0; i <= clickedIndex; i++) {
                stars[i].classList.add('selected');
            }
            for (let i = clickedIndex + 1; i < stars.length; i++) {
                stars[i].classList.remove('selected');
            }
        }
    }
</script>
<script>
    function validateForm() {
        var ratingSelected = false;
        var ratingInputs = document.getElementsByName('rating');

        for (var i = 0; i < ratingInputs.length; i++) {
            if (ratingInputs[i].checked) {
                ratingSelected = true;
                break;
            }
        }

        if (!ratingSelected) {
            alert('Please select a rating.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</body>
</html>
