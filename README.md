# Sayf - Ride Safety & Driver Review System

## Overview
Sayf is a **ride safety and driver review platform** designed to empower passengers by providing a **transparent and secure** ride-hailing experience. Users can **review drivers, report concerns, and share their experiences**, helping to create a safer environment for ride-hailing services.

## Impact
- **Enhances Passenger Safety** – Allows users to **report unsafe drivers** and incidents.
- **Promotes Accountability** – Drivers with positive reviews gain credibility, while unsafe behavior is flagged.
- **Community-Driven Insights** – Users contribute to a **database of driver ratings and reviews**.
- **Empowers Ride-Hailing Users** – Encourages safer ride choices by providing real feedback from past passengers.

## Features
- **Driver Reviews & Ratings** – Users can rate and review drivers based on ride experience.
- **Safety Reporting** – Passengers can **report safety incidents** for public awareness.
- **Post Management** – Users can add and delete posts regarding their ride experiences.
- **Session Handling** – Ensures secure login/logout features.
- **Real-Time Updates** – Keeps review content updated dynamically.

## Project Structure
```
📦 Sayf
 ┣ 📂 actions                  # PHP scripts for handling actions
 ┃ ┣ 📜 addpost_action.php      # Adds a new review post
 ┃ ┣ 📜 addrhc_action.php       # Report a harmful conduct (safety feature)
 ┃ ┣ 📜 deletepost_action.php   # Deletes a review post
 ┃ ┣ 📜 deletereview_action.php # Deletes a driver review
 ┃ ┣ 📜 driverdetail_action.php # Fetches details about a driver
 ┃ ┣ 📜 driverreviews_action.php # Handles driver reviews
 ┃ ┣ 📜 editreview_action.php   # Edits a review post
 ┣ 📜 index.php                 # Main application interface
```

## Installation & Setup
### 1. Clone the Repository
```sh
git clone <repository-url>
cd sayf-main
```

### 2. Set Up a Local Server
Use **XAMPP**, **MAMP**, or another PHP-compatible local server. Move the project to the server’s directory (e.g., `htdocs` for XAMPP).

### 3. Start the Server
Start Apache and MySQL services.

### 4. Access the Application
Open a browser and navigate to:
```
http://localhost/sayf-main/index.php
```

## Usage
1. **Sign in** to access review features.
2. **Review Drivers** by adding or editing ratings.
3. **Report Safety Issues** via the safety reporting feature.
4. **View Driver Profiles** and read community-submitted reviews.
5. **Manage Posts** – Add, edit, or delete ride experience reports.

## Future Enhancements
- **Mobile App Integration** – A dedicated mobile application for ease of use.
- **Automated Alerts** – Notify users about flagged drivers.
- **User Verification System** – Enhance credibility by linking reviews to verified ride histories.
- **AI Sentiment Analysis** – Analyze review content for automated safety alerts.

## Author
Developed by **Freda-Marie Beecham**

---

