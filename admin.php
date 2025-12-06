<!DOCTYPE html>
<?php require 'config.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="admin.css">
    <title>FastAid</title>
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
         <div class="admin-dashboard">
            <div class="sidebar">
                <ul class="sidebar-list">
                    <li class="dashboard">Dashboard</li>
                    <li class="resDet">Responders Details</li>
                    <li class="vReq">View Requests</li>
                    <li class="stat">Status</li>
                </ul>
            </div>
            <div class="details">
                <div class="responder-details">
                    <h1>Responder Details</h1>
                    <table>
                        <thead>
                          <tr>
                            
                            <th>Responder Name</th>
                            <th>Join Date</th>
                            <th>contact</th>
                            <th>Address</th>
                            <th>Rate</th>
                          </tr>
                        </thead>
<tbody>
<?php
$result = $conn->query("SELECT full_name, phone, location, created_at FROM responders ORDER BY created_at DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td>5</td> <!-- you can later replace with real rating -->
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='5'>No responders registered yet.</td></tr>";
}
?>
</tbody>
                    </table>
                </div>

                <div class="accept-reject">
                    <h1>Accept/Reject Requests</h1>
                    <table>
                        <thead>
                          <tr>
                            <th>Request ID</th>
                            <th>Responder Name</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
<tbody>
<?php
$reqResult = $conn->query("SELECT id, full_name, location, status FROM emergency_requests ORDER BY created_at DESC");
if ($reqResult && $reqResult->num_rows > 0) {
    while ($row = $reqResult->fetch_assoc()) {
        ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td><?= htmlspecialchars(ucfirst($row['status'])) ?></td>
            <td>
                <button class='accept-btn'>Accept</button>
                <button class='reject-btn'>Reject</button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='5'>No requests submitted yet.</td></tr>";
}
?>
</tbody>
                    </table>
                </div>
                <div class="graph">
                    <h1>Statistics</h1>
                    <div class="graph-container">
                        <div class="bar-graph">
                            <h2>Bar Graph</h2>
                            <!-- Bar graph content here -->
                        </div>
                        <div class="pie-chart">
                            <h2>Pie Chart</h2>
                            <!-- Pie chart content here -->
                        </div>
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
            </div>
        </div>
    </div>
    <script>
        function logout() {
      window.location.href = "index.html";
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="admin.js"></script>
</body>
</html>