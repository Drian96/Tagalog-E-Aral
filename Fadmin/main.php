<?php include('header.php')?>

<body>
    <div class="container">
        <aside id="sidebar">
            <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="toggle-btn">
                <i class="lni lni-grid-alt"></i>
            </label>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                

                <li class="sidebar-item">
                    <a href="upload.php" class="sidebar-link">
                        <i class="lni lni-upload"></i>
                        <span>Upload</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Learn</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-pencil"></i>
                        <span>Challenge</span>
                    </a>
                </li>
                
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
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
                                <!-- Dropdown Menu -->
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
                    <div class="card">
                        <h6 class="title">Total Users</h6>
                        <h6 class="amount">9,999</h6>
                        <div class="badge">
                            <span class="text-success-bg"> +6.85% </span>
                            <span class="badge-text">Since Last Month</span>
                        </div>
                    </div>
                </div>

                <h2>Users</h2>
                <div style="overflow-x:auto;">
                    <table id="posts">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:30%">Username</th>
                                <th style="width:30%">Email</th>
                                <th style="width:30%">Stars</th>
                                <th style="width:5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Raymart</td>
                                <td>raymart@example.com</td>
                                <td>99</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Yuan</td>
                                <td>yuan@example.com</td>
                                <td>89</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Gab</td>
                                <td>gab@example.com</td>
                                <td>97</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Drian</td>
                                <td>drian@example.com</td>
                                <td>79</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
        </div>

    </div>

    <script src="admin.js"></script>
</body>

</html>