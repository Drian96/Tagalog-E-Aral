<?php
include('header.php');
include('../p/db.php');

// Get the selected difficulty level from URL parameters
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : 'easy';

// Fetch users with the selected difficulty level
$query = "
    SELECT u.Id, u.Username, u.Email, q.score, q.starsEarned, q.createdAt
    FROM quiz_history q
    JOIN users u ON u.Id = q.userId
    WHERE q.difficultyLevel = ?
    ORDER BY q.createdAt DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $difficulty);
$stmt->execute();
$result = $stmt->get_result();
?>

    <header>
        <div class="mini-title">
            <a href="main.php">
                <div class="title-content">
                    <img src="../image/backArrow.png" alt="back-button">
                    <h1>Back</h1>
                </div>
            </a>
        </div>
    </header>

<body>
    <div class="knowdledgeTitle">
        <h2>Knowledge Level: <?php echo ucfirst($difficulty); ?></h2>
    </div>
    <div class="content">
        <table id="posts">
            <thead>
                <tr>
                    <th style="width:5%">User ID</th>
                    <th style="width:10%">Username</th>
                    <th style="width:15%">Email</th>
                    <th style="width:5%">Score</th>
                    <th style="width:5%">Stars Earned</th>
                    <th style="width:5%">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Id']; ?></td>
                        <td><?php echo htmlspecialchars($row['Username']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo $row['score']; ?></td>
                        <td><?php echo $row['starsEarned']; ?></td>
                        <td><?php echo $row['createdAt']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
