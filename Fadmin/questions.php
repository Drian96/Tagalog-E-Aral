<?php 
include('header.php'); 
include("../p/db.php");
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
            <!--
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div> -->
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

                <h2>Questions</h2>
                <div style="overflow-x:auto;">
                    <table id="posts">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:30%">Question Text</th>
                                <th style="width:10%">Choice 1</th>
                                <th style="width:10%">Choice 2</th>
                                <th style="width:10%">Choice 3</th>
                                <th style="width:10%">Correct Choice</th>
                                <th style="width:10%">Stars Value</th>
                                <th style="width:5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT id, questionText, choice1, choice2, choice3, correctChoice, starsValue FROM questions";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>" . htmlspecialchars($row['questionText']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['choice1']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['choice2']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['choice3']) . "</td>";
                                echo "<td>{$row['correctChoice']}</td>";
                                echo "<td>{$row['starsValue']}</td>";
                                echo "<td>
                                    <a href='edit_question.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                                    <a href='delete_question.php?id={$row['id']}' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this question?');\">Delete</a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
</body>
</html>
