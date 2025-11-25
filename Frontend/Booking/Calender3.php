<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InBook – Premium Booking Calendar (Light)</title>

    <!-- Google Fonts – Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ──────────────────────────────────────
           CSS VARIABLES – LIGHT MODE ONLY
        ────────────────────────────────────── */
        :root {
            --clr-primary   : #2E8B57;
            --clr-primary-d : #246d43;
            --clr-accent    : #FF6B35;
            --clr-bg        : #f9fafb;
            --clr-card      : rgba(255,255,255,0.85);
            --clr-glass     : rgba(255,255,255,0.75);
            --clr-text      : #1f2937;
            --clr-muted     : #6b7280;
            --radius        : 1rem;
            --shadow-sm     : 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg     : 0 12px 30px rgba(0,0,0,0.1);
            --transition    : all 0.3s cubic-bezier(0.4,0,0.2,1);
        }

        /* ──────────────────────────────────────
           GLOBAL RESET & TYPOGRAPHY
        ────────────────────────────────────── */
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        html { scroll-behavior:smooth; }
        body {
            font-family:'Inter',sans-serif;
            background:var(--clr-bg);
            color:var(--clr-text);
            line-height:1.6;
            overflow-x:hidden;
        }
        a { text-decoration:none; color:inherit; }
        button { font-family:inherit; cursor:pointer; }

        /* ──────────────────────────────────────
           UTILITIES
        ────────────────────────────────────── */
        .container { width:min(100%, 1400px); margin:auto; padding:0 1rem; }
        .glass {
            background:var(--clr-glass);
            backdrop-filter:blur(14px);
            -webkit-backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,0.4);
            border-radius:var(--radius);
        }
        .shadow-sm { box-shadow:var(--shadow-sm); }
        .shadow-lg { box-shadow:var(--shadow-lg); }
        .transition { transition:var(--transition); }

        /* ──────────────────────────────────────
           HEADER
        ────────────────────────────────────── */
        header {
            position:sticky;
            top:0;
            z-index:1000;
            background:var(--clr-bg);
            backdrop-filter:blur(8px);
            border-bottom:1px solid rgba(0,0,0,0.06);
        }
        nav {
            display:flex;
            align-items:center;
            justify-content:space-between;
            height:4.5rem;
        }
        .logo {
            display:flex;
            align-items:center;
            gap:.5rem;
            font-weight:800;
            font-size:1.35rem;
            color:var(--clr-primary);
        }
        .logo img { height:36px; width:auto; }
        .nav-links {
            display:flex;
            gap:2rem;
            list-style:none;
        }
        .nav-links a {
            font-weight:600;
            color:var(--clr-muted);
            transition:var(--transition);
        }
        .nav-links a:hover { color:var(--clr-primary); }
        .auth-buttons {
            display:flex;
            gap:.75rem;
        }
        .btn {
            padding:.65rem 1.4rem;
            border-radius:.5rem;
            font-weight:600;
            transition:var(--transition);
        }
        .btn-login {
            background:transparent;
            color:var(--clr-text);
            border:1px solid rgba(0,0,0,0.15);
        }
        .btn-register {
            background:var(--clr-primary);
            color:#fff;
        }
        .btn-register:hover {
            background:var(--clr-primary-d);
            transform:translateY(-2px);
            box-shadow:0 6px 16px rgba(46,139,87,.3);
        }

        /* ──────────────────────────────────────
           HERO BANNER (rotating images)
        ────────────────────────────────────── */
        .hero {
            position:relative;
            height:70vh;
            min-height:460px;
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            color:#fff;
        }
        .hero::before {
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(135deg, rgba(0,0,0,.7), rgba(0,0,0,.4));
            z-index:1;
        }
        .hero-slides {
            position:absolute;
            inset:0;
            display:flex;
            animation:slide 24s infinite;
        }
        .hero-slide {
            flex:0 0 100%;
            background-size:cover;
            background-position:center;
        }
        .hero-content {
            position:relative;
            z-index:2;
            max-width:800px;
            animation:fadeInUp .9s ease-out;
        }
        .hero h1 {
            font-size:3.2rem;
            margin-bottom:.5rem;
            font-weight:800;
        }
        .hero p {
            font-size:1.2rem;
            opacity:.95;
        }
        @keyframes slide {
            0%, 20%   { transform:translateX(0%); }
            25%, 45%  { transform:translateX(-100%); }
            50%, 70%  { transform:translateX(-200%); }
            75%, 95%  { transform:translateX(-300%); }
            100%      { transform:translateX(0%); }
        }
        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(30px); }
            to   { opacity:1; transform:none; }
        }

        /* ──────────────────────────────────────
           CALENDAR SECTION
        ────────────────────────────────────── */
        .section { padding:4rem 0; }
        .section-title {
            font-size:1.8rem;
            font-weight:700;
            margin-bottom:1.5rem;
            text-align:center;
            color:var(--clr-text);
        }
        .calendar-wrapper {
            display:grid;
            gap:2rem;
            grid-template-columns:1fr 1fr;
        }
        @media (max-width:960px) { .calendar-wrapper { grid-template-columns:1fr; } }

        .calendar-card {
            padding:1.5rem;
            border-radius:var(--radius);
            background:var(--clr-card);
            backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,.5);
            box-shadow:var(--shadow-lg);
            transition:var(--transition);
        }
        .calendar-card:hover { transform:translateY(-4px); }

        .calendar-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:1rem;
        }
        .calendar-header h2 {
            font-size:1.4rem;
            font-weight:600;
            color:var(--clr-primary);
        }
        .calendar-nav button {
            background:transparent;
            border:none;
            font-size:1.2rem;
            color:var(--clr-muted);
            padding:.4rem .6rem;
            border-radius:.4rem;
            transition:var(--transition);
        }
        .calendar-nav button:hover { background:rgba(0,0,0,.08); color:var(--clr-primary); }

        .calendar-grid {
            display:grid;
            grid-template-columns:repeat(7,1fr);
            gap:1px;
            background:rgba(0,0,0,.06);
            border-radius:.5rem;
            overflow:hidden;
        }
        .calendar-day-header {
            background:var(--clr-primary);
            color:#fff;
            text-align:center;
            padding:.8rem 0;
            font-weight:600;
            font-size:.9rem;
        }
        .calendar-day {
            background:#fff;
            min-height:100px;
            padding:.6rem;
            display:flex;
            flex-direction:column;
            cursor:pointer;
            transition:var(--transition);
        }
        .calendar-day.empty { background:#f8f9fa; cursor:default; }
        .calendar-day:hover { background:#f1f3f5; }
        .calendar-day.today { background:#e7f4ed; border:2px solid var(--clr-primary); }
        .calendar-day.booked { background:#ffe6e6; border-left:4px solid var(--clr-accent); }
        .calendar-day-number { font-weight:600; margin-bottom:.3rem; }
        .booking-slot {
            background:var(--clr-accent);
            color:#fff;
            padding:.15rem .4rem;
            border-radius:.3rem;
            font-size:.75rem;
            text-align:center;
        }

        /* ──────────────────────────────────────
           TIME SLOTS
        ────────────────────────────────────── */
        .time-slots-card {
            padding:1.5rem;
            border-radius:var(--radius);
            background:var(--clr-card);
            backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,.5);
            box-shadow:var(--shadow-lg);
        }
        .time-slots-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:1rem;
        }
        .time-slots-header h2 { font-size:1.4rem; font-weight:600; color:var(--clr-primary); }
        .selected-date { font-weight:600; color:var(--clr-primary); }

        .time-slots-grid {
            display:grid;
            gap:1rem;
            grid-template-columns:repeat(auto-fill, minmax(140px,1fr));
        }
        .time-slot {
            padding:1rem;
            text-align:center;
            border-radius:.75rem;
            background:var(--clr-card);
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,.4);
            transition:var(--transition);
        }
        .time-slot.available {
            background:rgba(46,139,87,.15);
            color:var(--clr-primary);
        }
        .time-slot.available:hover {
            background:var(--clr-primary);
            color:#fff;
            transform:translateY(-4px);
            box-shadow:0 8px 20px rgba(46,139,87,.25);
        }
        .time-slot.booked {
            background:rgba(255,107,53,.15);
            color:var(--clr-muted);
            cursor:not-allowed;
        }
        .time-slot-time { font-weight:600; font-size:1.1rem; }
        .time-slot-status { font-size:.85rem; margin-top:.3rem; }

        /* ──────────────────────────────────────
           LEGEND
        ────────────────────────────────────── */
        .legend {
            display:flex;
            justify-content:center;
            gap:2rem;
            flex-wrap:wrap;
            margin-top:2rem;
        }
        .legend-item {
            display:flex;
            align-items:center;
            gap:.5rem;
            font-size:.9rem;
            color:var(--clr-muted);
        }
        .legend-color {
            width:18px;
            height:18px;
            border-radius:.4rem;
        }
        .legend-color.today   { background:#e7f4ed; border:2px solid var(--clr-primary); }
        .legend-color.available { background:rgba(46,139,87,.15); }
        .legend-color.booked  { background:rgba(255,107,53,.15); border-left:3px solid var(--clr-accent); }

        /* ──────────────────────────────────────
           FOOTER
        ────────────────────────────────────── */
        footer {
            background:#f1f5f9;
            color:#4b5563;
            padding:4rem 0 2rem;
            margin-top:4rem;
            border-top:1px solid #e2e8f0;
        }
        .footer-content {
            display:grid;
            gap:2rem;
            grid-template-columns:repeat(auto-fit, minmax(200px,1fr));
        }
        .footer-section h3 {
            color:#1f2937;
            margin-bottom:1rem;
            font-weight:700;
        }
        .footer-section a {
            display:block;
            margin-bottom:.4rem;
            color:#6b7280;
            transition:var(--transition);
        }
        .footer-section a:hover { color:var(--clr-primary); }
        .footer-bottom {
            text-align:center;
            margin-top:2rem;
            padding-top:1.5rem;
            border-top:1px solid #e2e8f0;
            font-size:.85rem;
            color:#9ca3af;
        }

        /* ──────────────────────────────────────
           RESPONSIVE
        ────────────────────────────────────── */
        @media (max-width:768px) {
            .hero h1 { font-size:2.4rem; }
            /* .nav-links { display:none; } */
            .calendar-day { min-height:80px; padding:.4rem; }
        }
    </style>
</head>
<body>
    
<!-- ==================== HEADER ==================== -->
<!-- ==================== HERO BANNER ==================== -->
<section class="hero">
    <div class="hero-slides">
        <div class="hero-slide" style="background-image:url('https://media.istockphoto.com/id/1186323725/photo/strategy-to-win-in-ice-hockey.jpg?s=612x612&w=0&k=20&c=YuAxDdRJuIAua9gQ-BAAMS1lY-jd94laIlKZn2gKYmE=');"></div>
        <div class="hero-slide" style="background-image:url('https://media.istockphoto.com/id/2151849682/photo/black-defense-player-trying-to-block-his-opponent-during-basketball-match.jpg?s=612x612&w=0&k=20&c=ln49Uh-6gH8E_Xm85FKWtJeZOwZsxwl7KSw8k21k5HM=');"></div>
        <div class="hero-slide" style="background-image:url('https://media.istockphoto.com/id/1652222153/photo/female-volleyball-players-playing-volleyball.jpg?s=612x612&w=0&k=20&c=jVMHJ0lC9X0eK65SkajJT9fIc_MPk_xo_MQvn6U2nb4=');"></div>
        <div class="hero-slide" style="background-image:url('https://media.istockphoto.com/id/929498422/photo/slam-dunk-on-a-basketball-court.jpg?s=612x612&w=0&k=20&c=LaP7s3xJ9cnIK0uKWfs9oVies2RZRTeyZrXPX38L7Gc=');"></div>
    </div>
    <div class="hero-content container">
        <h1>Book Your Perfect Indoor Stadium</h1>
        <p>Premium courts, transparent availability, instant reservations.</p>
    </div>
</section>

<!-- ==================== CALENDAR SECTION ==================== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Booking Calendar</h2>

        <div class="calendar-wrapper">
            <!-- Calendar -->
            <div class="calendar-card glass shadow-lg">
                <div class="calendar-header">
                    <h2 id="current-month">June 2025</h2>
                    <div class="calendar-nav">
                        <button id="prev-month">Prev</button>
                        <button id="today-btn">Today</button>
                        <button id="next-month">Next</button>
                    </div>
                </div>
                <div class="calendar-grid" id="calendar-grid">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                </div>
            </div>

            <!-- Time Slots -->
            <div class="time-slots-card glass shadow-lg">
                <div class="time-slots-header">
                    <h2>Time Slots</h2>
                    <div class="selected-date" id="selected-date">Select a date to view slots</div>
                </div>
                <div class="time-slots-grid" id="time-slots-grid"></div>
            </div>
        </div>

        <!-- Legend -->
        <div class="legend">
            <div class="legend-item"><div class="legend-color today"></div><span>Today</span></div>
            <div class="legend-item"><div class="legend-color available"></div><span>Available</span></div>
            <div class="legend-item"><div class="legend-color booked"></div><span>Booked</span></div>
        </div>
    </div>
</section>

<!-- ==================== FOOTER ==================== -->
<!-- <footer>
    <div class="container footer-content">
        <div class="footer-section">
            <h3>InBook</h3>
            <p>Your one-stop platform for booking premium indoor stadiums.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#browse">Browse</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Sports</h3>
            <ul>
                <li><a href="#">Badminton</a></li>
                <li><a href="#">Basketball</a></li>
                <li><a href="#">Tennis</a></li>
                <li><a href="#">Football</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <ul>
                <li><a href="mailto:info@sportshub.com">info@sportshub.com</a></li>
                <li><a href="tel:+1234567890">+1 (234) 567-890</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom container">
        <p>© 2025 InBook. All rights reserved.</p>
    </div>
</footer> -->

<?php include 'footer.php'; ?>
<script>
/* ──────────────────────────────────────
   Calendar Logic (unchanged core)
────────────────────────────────────── */
const bookedDates = {
    '2025-06-15': ['09:00 AM','02:00 PM','06:00 PM'],
    '2025-06-18': ['10:00 AM','04:00 PM'],
    '2025-06-22': ['11:00 AM','03:00 PM','07:00 PM'],
    '2025-06-25': ['01:00 PM','05:00 PM'],
    '2025-06-28': ['08:00 AM','12:00 PM','04:00 PM','08:00 PM']
};
const timeSlots = [
    '08:00 AM','09:00 AM','10:00 AM','11:00 AM',
    '12:00 PM','01:00 PM','02:00 PM','03:00 PM',
    '04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM'
];

let currentDate = new Date();
let selectedDate = null;

function formatDate(d) {
    const y = d.getFullYear();
    const m = String(d.getMonth()+1).padStart(2,'0');
    const day = String(d.getDate()).padStart(2,'0');
    return `${y}-${m}-${day}`;
}

function renderCalendar(date) {
    const grid = document.getElementById('calendar-grid');
    const monthEl = document.getElementById('current-month');
    while (grid.children.length > 7) grid.removeChild(grid.lastChild);

    monthEl.textContent = date.toLocaleDateString('en-US',{month:'long',year:'numeric'});

    const first = new Date(date.getFullYear(), date.getMonth(), 1);
    const last  = new Date(date.getFullYear(), date.getMonth()+1, 0);
    const startDay = first.getDay();

    for (let i=0;i<startDay;i++) {
        grid.appendChild(document.createElement('div')).className='calendar-day empty';
    }

    const today = new Date(); today.setHours(0,0,0,0);
    for (let d=1; d<=last.getDate(); d++) {
        const dayEl = document.createElement('div');
        const cur = new Date(date.getFullYear(), date.getMonth(), d);
        const key = formatDate(cur);

        dayEl.className = 'calendar-day';
        dayEl.dataset.date = key;
        if (cur.getTime()===today.getTime()) dayEl.classList.add('today');
        if (bookedDates[key]) dayEl.classList.add('booked');

        const num = document.createElement('div');
        num.className='calendar-day-number';
        num.textContent = d;
        dayEl.appendChild(num);

        if (bookedDates[key]) {
            const cont = document.createElement('div');
            cont.className='calendar-bookings';
            bookedDates[key].slice(0,3).forEach(t=>{
                const s = document.createElement('div');
                s.className='booking-slot';
                s.textContent=t;
                cont.appendChild(s);
            });
            if (bookedDates[key].length>3) {
                const more = document.createElement('div');
                more.className='booking-slot';
                more.textContent=`+${bookedDates[key].length-3} more`;
                cont.appendChild(more);
            }
            dayEl.appendChild(cont);
        }

        dayEl.addEventListener('click',()=>selectDate(cur));
        grid.appendChild(dayEl);
    }
}

function selectDate(date) {
    selectedDate = date;
    document.getElementById('selected-date').textContent = date.toLocaleDateString('en-US',{
        weekday:'long', year:'numeric', month:'long', day:'numeric'
    });
    renderTimeSlots(formatDate(date));

    document.querySelectorAll('.calendar-day').forEach(d=>d.classList.remove('selected'));
    document.querySelector(`[data-date="${formatDate(date)}"]`)?.classList.add('selected');
}

function renderTimeSlots(dateKey) {
    const grid = document.getElementById('time-slots-grid');
    grid.innerHTML='';
    const booked = bookedDates[dateKey]||[];

    timeSlots.forEach(t=>{
        const el = document.createElement('div');
        el.className = 'time-slot';
        el.classList.add(booked.includes(t)?'booked':'available');

        const time = document.createElement('div');
        time.className='time-slot-time';
        time.textContent=t;
        el.appendChild(time);

        const status = document.createElement('div');
        status.className='time-slot-status';
        status.textContent = booked.includes(t)?'Booked':'Available';
        el.appendChild(status);

        if (!booked.includes(t)) {
            el.addEventListener('click',()=>alert(`Booking ${t} on ${dateKey}`));
        }
        grid.appendChild(el);
    });
}

document.getElementById('prev-month').onclick = ()=>{ currentDate.setMonth(currentDate.getMonth()-1); renderCalendar(currentDate); };
document.getElementById('next-month').onclick = ()=>{ currentDate.setMonth(currentDate.getMonth()+1); renderCalendar(currentDate); };
document.getElementById('today-btn').onclick = ()=>{ currentDate=new Date(); renderCalendar(currentDate); selectDate(currentDate); };

document.addEventListener('DOMContentLoaded',()=>{
    renderCalendar(currentDate);
    selectDate(new Date());
});
</script>
</body>
</html>