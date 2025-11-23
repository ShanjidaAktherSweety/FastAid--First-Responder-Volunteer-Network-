<?php
// Connect to database
require 'config.php';

// Fetch ACTIVE emergencies (pending or accepted)
$activeSql = "
    SELECT id, request_type, full_name, location, description, status, created_at
    FROM emergency_requests
    WHERE status IN ('pending', 'accepted')
    ORDER BY created_at DESC
";
$activeResult = $conn->query($activeSql);
$activeCount  = $activeResult ? $activeResult->num_rows : 0;

// Fetch PAST emergencies (completed or rejected)
$pastSql = "
    SELECT id, request_type, full_name, location, description, status, created_at
    FROM emergency_requests
    WHERE status IN ('completed', 'rejected')
    ORDER BY created_at DESC
";
$pastResult = $conn->query($pastSql);
$pastCount  = $pastResult ? $pastResult->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="index.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <ul class="logo">
                <li>Logo</li>
                <li>FastAid</li>
            </ul>
            <ul class="menu-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="register.php">Register As Responder</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="requestHelp.php">Request Help</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="patient.php">Patient</a></li>
                <li><a href="#" class="logout-btn" onclick="logout()">Logout</a></li>
            </ul>
        </div>
        <!-- header end -->

        <!-- display content -->
        <div class="responder-status">
            Status: <span id="status-text" class="status-indicator">Offline</span>
        </div>
        
        <div class="status-buttons">
            <button class="status-btn active-btn">Go Active</button>
            <button class="status-btn offline-btn">Go Offline</button>
        </div>
        
        
        <div class="main-div">
            <div class="details">
                <div class="settings">
                    <div class="profile">
                        <img src="image.png" alt="Profile Photo" class="profile-pic">
                        <p>Volunteer Responder</p>
                    </div>
                    <div class="respons-satas">
                        <h3>Response Stats</h3>
                        <p>Total Requests: <?php echo $activeCount + $pastCount; ?></p>
                        <p>Active Emergencies: <?php echo $activeCount; ?></p>
                        <p>Completed / Past: <?php echo $pastCount; ?></p>
                        <p>Email: johndoe@gmail.com</p>
                    </div>
                    <div class="profile-icon">
                        Profile
                    </div>
                    <div class="notification">
                        Notification
                    </div>
                    <div class="settings-icon">
                        Settings
                    </div>
                    <div class="logout-icon" onclick="logout()">
                        Logout
                    </div>
                </div>
                <div class="record">
                    <div class="record-typ">
                        <h4 class="active-res">Active Emergencies</h4>
                        <h4 class="past-res">Past Respons</h4>
                    </div>
                    <div class="emer-num">
                        <h5>Emergency Near You</h5>
                        <p><?php echo $activeCount; ?> emergencies within your response radius</p>
                    </div>

                    <!-- ACTIVE CASES (from DB) -->
                    <div class="active-case-detail">
                        <?php if ($activeCount > 0): ?>
                            <?php while ($row = $activeResult->fetch_assoc()): ?>
                                <div class="case">
                                    <h4>Request #<?php echo htmlspecialchars($row['id']); ?></h4>
                                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['full_name']); ?></p>
                                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                                    <p><strong>Type:</strong> <?php echo htmlspecialchars(ucfirst($row['request_type'])); ?></p>
                                    <p><strong>Status:</strong> <?php echo htmlspecialchars(ucfirst($row['status'])); ?></p>
                                    <p><strong>Time:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                                    <?php if (!empty($row['description'])): ?>
                                        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                                    <?php endif; ?>
                                    <button class="btn-case">Accept</button>
                                    <button class="btn-case">Reject</button>
                                    <button class="btn-case">Details</button>
                                    <button class="btn-case">Completed</button>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <!-- keep one .case for JS but with message -->
                            <div class="case">
                                <h4>No Active Emergencies</h4>
                                <p>There are currently no active help requests. 🎉</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- PAST CASES (from DB) -->
                    <div class="past-case-detail">
                        <?php if ($pastCount > 0): ?>
                            <?php while ($row = $pastResult->fetch_assoc()): ?>
                                <div class="past-case">
                                    <h4>Request #<?php echo htmlspecialchars($row['id']); ?></h4>
                                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['full_name']); ?></p>
                                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                                    <p><strong>Status:</strong> <?php echo htmlspecialchars(ucfirst($row['status'])); ?></p>
                                    <p><strong>Date / Time:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                                    <?php if (!empty($row['description'])): ?>
                                        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                                    <?php endif; ?>
                                    <button class="btn-case">Details</button>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <!-- keep one .past-case for JS but with message -->
                            <div class="past-case">
                                <h4>No Past Responses</h4>
                                <p>You haven’t handled any requests yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- footer -->
        <div class="footer">
            <div class="footer1">
                <h3>FastAid</h3>
                <br>
                <p>FastAid is a platform that connects trained responders with individuals in need of emergency medical assistance.</p>
                <br>
                <p>©copyright 2025 FastAid. All rights reserved</p>
            </div>
            <div class="footer1">
                <h3>Link  </h3>
                <br>
                    <ul class="footer-list">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="register.php">Register As Responder</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                    </ul>
            </div>
            <div class="footer1">
                <h3>Social Media</h3>
                <br>
                <ul class="footer-list">
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                </ul>
            </div>
            <div class="footer1">
                <h3>Resources</h3>
                <br>
                <ul>
                    <li>Fast Aid Guieds</li>
                    <li>Training Resources</li>
                    <li>FAQs</li>
                </ul>
            </div>
            <div class="footer1">
                <h3>Contact Us</h3>
                <br>
                <ul class="footer-list">
                    <li>Phone: +1 234 567 890</li>
                    <li>Email:fastaid@gmail.com</li>
                    <li>Address: 123 Main St, City, Country</li>
                </ul>
            </div>
        </div>

    </div>
    <script>
        function logout() {
            window.location.href = "index.html";
        }
    </script>
    <!-- main container end -->
    <script src="dashboard.js"></script>

</body>
</html>
