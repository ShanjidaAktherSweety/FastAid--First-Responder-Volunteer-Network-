# FastAid--First-Responder-Volunteer-Network-


This repository contains the full source code for FastAid, a community-powered emergency response platform designed to connect patients in urgent need with trained volunteer responders. The project is built with PHP, MySQL, HTML, CSS, and JavaScript, and is fully structured for use inside a XAMPP (Apache + MySQL) environment.

The folder includes:

Frontend Pages
All user-facing interfaces such as the Home page, Responder Registration, Patient Dashboard, Emergency Request form, Admin panel, and the Volunteer Dashboard.

Backend PHP Logic
PHP files responsible for handling form submissions, storing data in the database, updating emergency request statuses, and dynamically loading responder/patient information.

Database Configuration
config.php provides the database connection to MySQL.
The system uses two primary tables:

emergency_requests — stores all patient help requests

responders — stores registered volunteer responder information

Stylesheets & JavaScript
Clean UI design using multiple CSS files, and interactive components handled by custom JS, including status toggles, form validation, and admin analytics (Chart.js).

Assets
Images and icons used across the interface.

This folder contains everything needed to run the FastAid platform locally or deploy it to a server with PHP and MySQL support. It is organized, modular, and ready for future extension such as real-time tracking, SMS notifications, or user authentication.
