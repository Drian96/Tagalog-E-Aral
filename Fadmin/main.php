<?php
include('header.php');
include("../p/db.php");

// Fetching data for widgets
$totalUsersQuery = "SELECT COUNT(*) AS totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['totalUsers'];

$topStarsQuery = "
    SELECT 
        u.Id, 
        u.Username, 
        u.Email, 
        u.totalStars, 
        COALESCE(
            (SELECT COUNT(*) 
             FROM user_badges ub 
             WHERE ub.userId = u.Id AND ub.isUnlocked = 0
            ), 0
        ) AS badges
    FROM users u
    ORDER BY u.totalStars DESC
    LIMIT 5";

$topStarsResult = $conn->query($topStarsQuery);

// Fetching knowledge levels percentages
$knowledgeQuery = "
    SELECT
        (SUM(CASE WHEN score BETWEEN 0 AND 3 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS easyPercentage,
        (SUM(CASE WHEN score BETWEEN 4 AND 7 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS averagePercentage,
        (SUM(CASE WHEN score BETWEEN 8 AND 10 THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS hardPercentage
    FROM quiz_history";
$knowledgeResult = $conn->query($knowledgeQuery)->fetch_assoc();
$easyPercentage = round($knowledgeResult['easyPercentage'], 2);
$averagePercentage = round($knowledgeResult['averagePercentage'], 2);
$hardPercentage = round($knowledgeResult['hardPercentage'], 2);
?>
<body>
    <div class="container">
        <aside id="sidebar">
            <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="toggle-btn">
                <i class="lni lni-grid-alt"></i>
            </label>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="main.php" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="users.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="upload.php" class="sidebar-link">
                        <i class="lni lni-upload"></i>
                        <span>Upload</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="learn.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Learn</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="questions.php" class="sidebar-link">
                        <i class="lni lni-pencil"></i>
                        <span>Questions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="badges.php" class="sidebar-link">
                        <i class="lni lni-crown"></i>
                        <span>Badges</span>
                    </a>
                </li>
            </ul>

        </aside>
        <div class="main">
            <div class="dashboard-navbar">
                <form action="#">
                    <div class="nav-search">
                        <input type="text" class="search-query" placeholder="Search...">
                        <button class="btn" type="button">Search</button>
                    </div>
                </form>
                <div class="navbar-content">
                    <ul class="main-nav">
                        <li class="user-link">
                            <a href="#">
                                <div class="menu">
                                    <img class="avatar" src="../image/account.png" alt="menu-icon" onclick="toggleMenu()"/>
                                    <div class="dropdown-menu" id="profileMenu">
                                        <a href="../login/edit.php">Edit Profile</a>
                                        <a href="../p/logout.php">Logout</a>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <h2>Statistics</h2>
                <div class="dashboard-card">
                    <div class="card" onclick="location.href='users.php'">
                        <h6 class="title">Total Users</h6>
                        <h6 class="amount"><?php echo $totalUsers; ?></h6>
                        <div class="badge">
                            <span class="text-success-bg"> +60.85% </span>
                            <span class="badge-text">Since Last Month</span>
                        </div>
                    </div>

                    <div class="card">
                        <h6 class="title">Users Knowledge</h6>
                        <canvas id="knowledgeChart"></canvas>
                    </div>
                </div>


                <h2>Top Stars Earned</h2>
                <div class="dashTable">
                    <table id="posts">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:30%">Username</th>
                                <th style="width:30%">Email</th>
                                <th style="width:30%">Stars</th>
                                <th style="width:5%">Badges</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $topStarsResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['Id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['Username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                    <td><?php echo $row['totalStars']; ?></td>
                                    <td><?php echo $row['badges']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="admin.js"></script>
    
    <script>
        const ctx = document.getElementById('knowledgeChart').getContext('2d');
        const knowledgeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Easy', 'Average', 'Hard'],
                datasets: [{
                    label: 'Knowledge Levels',
                    data: [<?php echo $easyPercentage; ?>, <?php echo $averagePercentage; ?>, <?php echo $hardPercentage; ?>],
                    backgroundColor: ['#4caf50', '#ff9800', '#f44336'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                onClick: (e, elements) => {
                    if (elements.length > 0) {
                        const index = elements[0].index; // Index of clicked bar
                        const difficulty = ['easy', 'average', 'hard'][index]; // Map index to difficulty level
                        window.location.href = `detailed_report.php?difficulty=${difficulty}`; // Redirect with difficulty level
                    }
                }
            }
        });

    </script>
</body>
</html>