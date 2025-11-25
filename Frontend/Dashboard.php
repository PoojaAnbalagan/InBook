<?php
// session_start();
include '../Backend/check_session.php';

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: Login/login.html");
//     exit();
// }

// Get user information from session
$username = $_SESSION['username'] ?? 'User';
$email = $_SESSION['email'] ?? '';

// Get initials for avatar (first letter of first and last name)
$nameParts = explode(' ', $username);
$initials = strtoupper(substr($nameParts[0], 0, 1));
if (count($nameParts) > 1) {
    $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
}

// You can also fetch more user data from database if needed
// Example:
// include 'config.php';
// $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
// $stmt->bind_param("i", $_SESSION['user_id']);
// $stmt->execute();
// $result = $stmt->get_result();
// $userData = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InBook - My Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #343A40;
            background: #F8F9FA;
        }

        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1rem 5%;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo h1 {
            background: linear-gradient(to right, #00a89e, #39d473);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #343A40;
            font-weight: 600;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #2E8B57;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
        }

        .user-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            min-width: 180px;
            z-index: 1000;
        }

        .user-menu.active {
            display: block;
        }

        .user-menu a {
            display: block;
            padding: 0.8rem 1.2rem;
            color: #343A40;
            text-decoration: none;
            transition: background 0.3s;
        }

        .user-menu a:hover {
            background: #F8F9FA;
        }

        .user-menu a:first-child {
            border-radius: 8px 8px 0 0;
        }

        .user-menu a:last-child {
            border-radius: 0 0 8px 8px;
            color: #dc3545;
        }

        .notification-btn {
            position: relative;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .notification-btn:hover {
            transform: scale(1.1);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #FF6B35;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .user-profile:hover {
            background: #F8F9FA;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00a89e, #39d473);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #2E8B57, #3D5A80);
            color: white;
            padding: 3rem 5%;
            margin-bottom: 2rem;
        }

        .welcome-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .welcome-text h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .quick-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: white;
            color: #2E8B57;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Stats Cards */
        .stats-grid {
            max-width: 1400px;
            margin: -3rem auto 2rem;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-icon.green { background: #e8f5e9; color: #2E8B57; }
        .stat-icon.blue { background: #e3f2fd; color: #3D5A80; }
        .stat-icon.orange { background: #fff3e0; color: #FF6B35; }
        .stat-icon.purple { background: #f3e5f5; color: #7B68EE; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #343A40;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 5%;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .section-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            color: #343A40;
        }

        .view-all-link {
            color: #2E8B57;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .view-all-link:hover {
            color: #246d43;
        }

        /* Upcoming Bookings */
        .booking-item {
            padding: 1.2rem;
            border: 2px solid #F8F9FA;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .booking-item:hover {
            border-color: #2E8B57;
            background: #f8fffe;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.8rem;
        }

        .booking-title {
            font-weight: 600;
            color: #343A40;
            margin-bottom: 0.3rem;
        }

        .booking-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-confirmed {
            background: #e8f5e9;
            color: #2E8B57;
        }

        .status-pending {
            background: #fff3e0;
            color: #FF6B35;
        }

        .booking-details {
            display: flex;
            gap: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
            flex-wrap: wrap;
        }

        .booking-detail {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .booking-actions {
            display: flex;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .booking-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-view {
            background: #3D5A80;
            color: white;
        }

        .btn-cancel {
            background: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .btn-view:hover {
            background: #2d4560;
        }

        .btn-cancel:hover {
            background: #dc3545;
            color: white;
        }

        /* Recommended Stadiums */
        .stadium-mini-card {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border: 2px solid #F8F9FA;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .stadium-mini-card:hover {
            border-color: #2E8B57;
            background: #f8fffe;
        }

        .stadium-mini-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .stadium-mini-content {
            flex: 1;
        }

        .stadium-mini-title {
            font-weight: 600;
            color: #343A40;
            margin-bottom: 0.3rem;
        }

        .stadium-mini-location {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .stadium-mini-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stadium-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #FF6B35;
            font-size: 0.85rem;
        }

        .stadium-price {
            font-weight: 700;
            color: #2E8B57;
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #F8F9FA;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-icon.green { background: #e8f5e9; }
        .activity-icon.blue { background: #e3f2fd; }
        .activity-icon.orange { background: #fff3e0; }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            color: #343A40;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .activity-time {
            color: #6c757d;
            font-size: 0.8rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-text {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .empty-action {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(to bottom, #00a89e, #39d473);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .empty-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 139, 87, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .user-info {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">
                <h1>InBook</h1>
            </div>

            <ul class="nav-links">
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#my-bookings">My Bookings</a></li>
                <li><a href="#browse">Browse</a></li>
                <li><a href="#favorites">Favorites</a></li>
            </ul>

            <div class="user-section">
                <button class="notification-btn">
                    🔔
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-profile" onclick="toggleUserMenu()">
                    <div class="user-avatar"><?php echo $initials; ?></div>
                    <div class="user-info">
                        <div class="user-name"><?php echo htmlspecialchars($username); ?></div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
                <!-- User Dropdown Menu -->
                <div class="user-menu" id="userMenu">
                    <a href="profile.php">👤 My Profile</a>
                    <a href="settings.php">⚙️ Settings</a>
                    <a href="../Backend/logout.php">🚪 Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="welcome-content">
            <div class="welcome-header">
                <div class="welcome-text">
                    <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $username)[0]); ?>! 👋</h1>
                    <p>Ready for your next game? Let's find the perfect stadium.</p>
                </div>
                <div class="quick-actions">
                    <a href="#new-booking" class="action-btn btn-primary">
                        📅 New Booking
                    </a>
                    <a href="#browse" class="action-btn btn-secondary">
                        🔍 Browse Stadiums
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">📅</div>
            <div class="stat-value">8</div>
            <div class="stat-label">Total Bookings</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">⏰</div>
            <div class="stat-value">2</div>
            <div class="stat-label">Upcoming Games</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">⭐</div>
            <div class="stat-value">5</div>
            <div class="stat-label">Favorite Venues</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">🏆</div>
            <div class="stat-value">150</div>
            <div class="stat-label">Reward Points</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-grid">
            <!-- Left Column -->
            <div>
                <!-- Upcoming Bookings -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Upcoming Bookings</h2>
                        <a href="#all-bookings" class="view-all-link">View All →</a>
                    </div>

                    <div class="booking-item">
                        <div class="booking-header">
                            <div>
                                <div class="booking-title">Elite Badminton Arena</div>
                                <div class="booking-details">
                                    <span class="booking-detail">📍 Downtown, New York</span>
                                    <span class="booking-detail">📅 Nov 12, 2025</span>
                                    <span class="booking-detail">⏰ 6:00 PM - 8:00 PM</span>
                                </div>
                            </div>
                            <span class="booking-status status-confirmed">Confirmed</span>
                        </div>
                        <div class="booking-actions">
                            <button class="booking-btn btn-view">View Details</button>
                            <button class="booking-btn btn-cancel">Cancel</button>
                        </div>
                    </div>

                    <div class="booking-item">
                        <div class="booking-header">
                            <div>
                                <div class="booking-title">Pro Basketball Center</div>
                                <div class="booking-details">
                                    <span class="booking-detail">📍 Midtown, New York</span>
                                    <span class="booking-detail">📅 Nov 15, 2025</span>
                                    <span class="booking-detail">⏰ 4:00 PM - 6:00 PM</span>
                                </div>
                            </div>
                            <span class="booking-status status-pending">Pending</span>
                        </div>
                        <div class="booking-actions">
                            <button class="booking-btn btn-view">View Details</button>
                            <button class="booking-btn btn-cancel">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Recommended Stadiums -->
                <div class="section-card" style="margin-top: 2rem;">
                    <div class="section-header">
                        <h2>Recommended For You</h2>
                        <a href="#browse" class="view-all-link">View All →</a>
                    </div>

                    <div class="stadium-mini-card">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23d4a574' width='100' height='100'/%3E%3C/svg%3E" alt="Stadium" class="stadium-mini-img">
                        <div class="stadium-mini-content">
                            <div class="stadium-mini-title">Premium Tennis Courts</div>
                            <div class="stadium-mini-location">📍 Brooklyn, New York</div>
                            <div class="stadium-mini-footer">
                                <span class="stadium-rating">⭐ 4.7</span>
                                <span class="stadium-price">$60/hr</span>
                            </div>
                        </div>
                    </div>

                    <div class="stadium-mini-card">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23d2b48c' width='100' height='100'/%3E%3C/svg%3E" alt="Stadium" class="stadium-mini-img">
                        <div class="stadium-mini-content">
                            <div class="stadium-mini-title">City Football Arena</div>
                            <div class="stadium-mini-location">📍 Queens, New York</div>
                            <div class="stadium-mini-footer">
                                <span class="stadium-rating">⭐ 4.9</span>
                                <span class="stadium-price">$95/hr</span>
                            </div>
                        </div>
                    </div>

                    <div class="stadium-mini-card">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23d86828' width='100' height='100'/%3E%3C/svg%3E" alt="Stadium" class="stadium-mini-img">
                        <div class="stadium-mini-content">
                            <div class="stadium-mini-title">Ace Volleyball Court</div>
                            <div class="stadium-mini-location">📍 Manhattan, New York</div>
                            <div class="stadium-mini-footer">
                                <span class="stadium-rating">⭐ 4.8</span>
                                <span class="stadium-price">$55/hr</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Recent Activity -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Recent Activity</h2>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon green">✅</div>
                        <div class="activity-content">
                            <div class="activity-text">Booking confirmed at Elite Badminton Arena</div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon blue">⭐</div>
                        <div class="activity-content">
                            <div class="activity-text">You left a review for Pro Basketball Center</div>
                            <div class="activity-time">1 day ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon orange">🎉</div>
                        <div class="activity-content">
                            <div class="activity-text">Earned 50 reward points</div>
                            <div class="activity-time">3 days ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon green">❤️</div>
                        <div class="activity-content">
                            <div class="activity-text">Added Premium Tennis Courts to favorites</div>
                            <div class="activity-time">5 days ago</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="section-card" style="margin-top: 2rem;">
                    <div class="section-header">
                        <h2>This Month</h2>
                    </div>
                    
                    <div style="padding: 1rem 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                            <span style="color: #6c757d;">Hours Played</span>
                            <span style="font-weight: 700; color: #2E8B57;">12 hrs</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                            <span style="color: #6c757d;">Total Spent</span>
                            <span style="font-weight: 700; color: #2E8B57;">$540</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #6c757d;">Points Earned</span>
                            <span style="font-weight: 700; color: #FF6B35;">100 pts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle user menu
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('active');
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const userProfile = document.querySelector('.user-profile');
            const userMenu = document.getElementById('userMenu');
            
            if (!userProfile.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.remove('active');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Button interactions
        document.querySelectorAll('.booking-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.classList.contains('btn-view')) {
                    alert('Viewing booking details...');
                } else if (this.classList.contains('btn-cancel')) {
                    if (confirm('Are you sure you want to cancel this booking?')) {
                        alert('Booking cancelled successfully!');
                    }
                }
            });
        });

        document.querySelectorAll('.stadium-mini-card').forEach(card => {
            card.addEventListener('click', function() {
                alert('Opening stadium details...');
            });
        });
    </script>
</body>
</html>