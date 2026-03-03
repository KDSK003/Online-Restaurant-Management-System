<?php
session_start();
include("../connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $rating = (int) $_POST['rating'];
    $review = mysqli_real_escape_string($db, $_POST['review']);

    $query = "INSERT INTO reviews (name, rating, review, created_at) VALUES ('$name', '$rating', '$review', NOW())";
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Review submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting review!');</script>";
    }
}

$reviews_query = "SELECT * FROM reviews ORDER BY created_at DESC";
$reviews_result = mysqli_query($db, $reviews_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Reviews</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .review-box { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Leave a Review</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>
        <label>Review:</label><br>
        <textarea name="review" required></textarea><br>
        <button type="submit">Submit Review</button>
    </form>

    <h2>Reviews</h2>
    <?php while ($row = mysqli_fetch_assoc($reviews_result)) { ?>
        <div class="review-box">
            <strong><?php echo htmlspecialchars($row['name']); ?></strong>
            <p>Rating: <?php echo $row['rating']; ?>/5</p>
            <p><?php echo nl2br(htmlspecialchars($row['review'])); ?></p>
            <small>Posted on: <?php echo $row['created_at']; ?></small>
        </div>
    <?php } ?>
</body>
</html>
