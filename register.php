<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="register.css" />
    <link rel="stylesheet" href="index.css" />
    <title>FastAid - Register</title>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <ul class="logo">
                <li>LOGO</li>
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

        <!-- Registration Form -->
        <div class="form-container">
            <h2>Responder Registration</h2>
            <form id="registerForm" action="save_responder.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required />
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required />
                </div>
                <div class="form-group">
                    <label for="location">Your City/Location</label>
                    <input type="text" id="location" name="location" placeholder="Click 'Set Up Location' to auto-fill" required />
                    <button type="button" id="getLocationBtn" class="btn-submit" style="margin-top:10px; background-color:#28a745;">📍 Set Up Location</button>
                </div>
                <div class="form-group">
                    <label for="skills">License No</label>
                    <textarea id="skills" name="skills" rows="3"></textarea>
                </div>
                <div>
                    <label for="uploadFile">Certificate and other File:</label><br>
                    <input type="file" name="uploadFile" id="uploadFile" required><br><br>
                </div>
                <div class="form-group">
                    <label for="password">Create Password</label>
                    <input type="password" id="password" name="password" required />
                </div>
                <div class="time-selection">
                    <label for="preferredTime">Preferred Time:</label><br>
                    <select name="preferredTime" id="preferredTime" required>
                      <option value="">-- Select Time Slot --</option>
                      <option value="morning">Morning (6 AM - 12 PM)</option>
                      <option value="afternoon">Afternoon (12 PM - 4 PM)</option>
                      <option value="evening">Evening (4 PM - 8 PM)</option>
                      <option value="night">Night (8 PM - 12 AM)</option>
                      <option value="late-night">Late Night (12 AM - 6 AM)</option>
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn-submit">Register Now</button>
            </form>
            <p id="successMsg" style="color:green; font-weight:bold; display:none; margin-top:10px;">✅ Registration successful!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer1">
                <h3>FastAid</h3><br>
                <p>FastAid connects trained responders with individuals in need of emergency medical assistance.</p>
                <p>© 2025 FastAid. All rights reserved.</p>
            </div>
            <div class="footer1">
                <h3>Links</h3><br>
                <ul class="footer-list">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                </ul>
            </div>
            <div class="footer1">
                <h3>Social Media</h3><br>
                <ul class="footer-list">
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                </ul>
            </div>
            <div class="footer1">
                <h3>Resources</h3><br>
                <ul class="footer-list">
                    <li>Guides</li>
                    <li>Training Resources</li>
                    <li>FAQs</li>
                </ul>
            </div>
            <div class="footer1">
                <h3>Contact Us</h3><br>
                <ul class="footer-list">
                    <li>Phone: +1 234 567 890</li>
                    <li>Email: fastaid@gmail.com</li>
                    <li>Address: 123 Main St, City</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Geolocation functionality
        document.getElementById("getLocationBtn").addEventListener("click", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            const locationInput = document.getElementById("location");
            locationInput.value = `Lat: ${latitude}, Lng: ${longitude}`;
            alert("✅ Location set successfully!");
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("❌ User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("⚠️ Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("⏳ The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("❗ An unknown error occurred.");
                    break;
            }
        }

        // Form submission
        //const form = document.getElementById("registerForm");
        //form.addEventListener("submit", function(e) {
            //e.preventDefault(); // prevent default page reload
           // const successMsg = document.getElementById("successMsg");

            // You can also do validation here if needed

           // successMsg.style.display = "block"; // show success message
           // form.reset(); // clear form fields
       // });
    
    function logout() {
      window.location.href = "index.html";
    }
    </script>
</body>
</html>
