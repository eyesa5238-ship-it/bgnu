<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>BNGU Header</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons Library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- Top Utility Bar -->
  <div class="merge-header">
    <div class="top-bar py-2">
      <div class="container-fluid">
        <ul class="nav justify-content-center justify-content-lg-end small align-items-center">
          @auth
            <li class="nav-item"><span class="nav-link py-0">{{ auth()->user()->name }}</span></li>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent small py-0" style="cursor:pointer;">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
          @endauth
          <li class="nav-item"><a class="nav-link" href="#">Apply</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Alumni</a></li>
          <li class="nav-item"><a class="nav-link" href="#">QEC & Accreditation</a></li>
          <li class="nav-item"><a class="nav-link" href="#">ORIC</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Disclaimer</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Events</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Newsletters</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Annual Report</a></li>
          <li class="nav-item"><a class="nav-link" href="#">IT</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Campus Health</a></li>
          <li class="nav-item"><a class="nav-link" href="#">News&Update</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Careers</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg main-navbar">
      <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center">
          <img src="{{ url('images/logo.jpeg') }}" alt="Website Logo" class="logo">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

            <li class="nav-item active-home">
              <a class="nav-link" href="#">HOME</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">VISION & MISSION</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                ABOUT BNGU
              </a>
              <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                <li><a class="dropdown-item" href="#">Overview</a></li>
                <li><a class="dropdown-item" href="#">Board of Governors</a></li>
                <li><a class="dropdown-item" href="#">Core Values</a></li>
                <li><a class="dropdown-item" href="#">Mission</a></li>
                <li><a class="dropdown-item" href="#">Vision</a></li>
              </ul>
            </li>

            <!-- Clone this to craete more with parent menu  -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                ADMISSIONS
              </a>
              <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                 <li><a class="dropdown-item" href="#">Apply Online</a></li>
                <li><a class="dropdown-item" href="#">Fee Structure</a></li>
                <li><a class="dropdown-item" href="#">How to Apply</a></li>
                <li><a class="dropdown-item" href="#">Eligibility Criteria</a></li>
                <li><a class="dropdown-item" href="#">Hope Certificate</a></li>
              </ul>
              
            <li class="nav-item"><a class="nav-link" href="#">BNGU STUDENTS</a></li>
          </ul>

          @auth
          <div class="d-flex align-items-center gap-2 navbar-nav">
            @if(auth()->user()->canAccessAdminPanel())
              <a href="{{ route('faculty.index') }}" class="nav-link text-nowrap py-0 mb-0"><i class="fa-solid fa-cog me-1"></i>Admin</a>
            @endif
            <span class="nav-link text-nowrap py-0 mb-0"><i class="fa-solid fa-user me-1"></i>{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
          </div>
          @endauth

          <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </nav>
  </div>



  <section class="hero-slider">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <!-- Indicators -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
      </div>

      <!-- Slides -->
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <img src="{{ asset('images/bnn1.jpg') }}" alt="BNGU Banner" class="img-fluid">
          <div class="diagonal-shape"></div>
        </div>
      </div>

      <!-- Slide 2 -->
      
      <div class="carousel-item">
      <img src="{{ asset('images/bbnn2.jpg') }}" alt="BNGU Banner" class="img-fluid">
        <div class="diagonal-shape"></div>
      </div>
       

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="{{ asset('images/banners.jpg') }}" alt="BNGUBanner" class="img-fluid">
        <div class="diagonal-shape"></div>
      </div>
    </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

    </div>
  </section>


  <!-- New Container  -->
  <div class="container my-3">
    <div class="news-ticker-container w-100">

      <div class="ticker-label text-white">
        What's New
      </div>

      <div class="ticker-content flex-grow-1 ps-2">
        Chief Minister's IT Internship Program (CMITIP)
      </div>

      <!-- <div class="ticker-controls pe-3">
        &lt;&nbsp;&gt;
      </div> -->

    </div>
  </div>


  <!-- Pinciple section  -->
  <section class="principal-section py-5">
    <div class="container">
      <div class="row align-items-center">

        <!-- Left Image -->
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
          <div class="principal-image">
            <img src="{{ asset('images/voicec.jpg') }}" alt="Principal" class="img-fluid">
          </div>
        </div>

        <!-- Right Content -->
        <div class="col-lg-8 col-md-12">
          <div class="principal-content">
            <h2 class="principal-title">
              MESSAGE FROM THE VICE- CHANCELLOR
            </h2>

            <p class="principal-text">
              I am pleased to welcome the new entrants to our Fall 2025 admissions. Your admission in this great place
              of learning will, Insha'Allah, open up new horizons for your future professional success in the
              disciplines of your choice. With its efficient staff and qualified faculty, Baba Guru Nanak University
              (BGNU) offers modern teaching and research facilities to its students. We seek to equip our graduates with
              advanced knowledge, critical thinking and professional skills suitable for a highly competitive national
              and global job market. Our mode of teaching at this university is not merely confined to imparting
              knowledge, but we also seek to inculcate among our students the rich cultural and religious values we have
              learned from our parents and elders. The aim is to produce not merely skillful professionals but also
              responsible citizens. We remain committed to providing quality education to the students by consistently
              improving our teaching standards and research facilities.
              I wish all of our new students an exciting time ahead. I have no doubt that you will all contribute to the
              rich heritage of quality education at this great institution
            </p>
            <b> Prof. Dr. Shahid Imran </b>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- offer programs  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <section class="programs-section">
    <div class="overlay"></div>

    <div class="container content-wrapper">
      <div class="row mb-5">
        <div class="col-12 text-center">
          <h2 class="section-title text-white">WE OFFER PROGRAMS IN</h2>
        </div>
      </div>

      <div class="row g-4">

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-warning">
              <i class="fa-solid fa-bolt"></i>
            </div>
            <h5>Electrical Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-primary">
              <i class="fa-solid fa-laptop"></i>
            </div>
            <h5>Computer Sciences and Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-success">
              <i class="fa-solid fa-flask"></i>
            </div>
            <h5>Engineering Sciences</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-secondary">
              <i class="fa-solid fa-gear"></i>
            </div>
            <h5>Mechanical Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-muted">
              <i class="fa-solid fa-microscope"></i>
            </div>
            <h5>Materials Science and Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-danger">
              <i class="fa-solid fa-atom"></i>
            </div>
            <h5>Chemical Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-danger">
              <i class="fa-solid fa-industry"></i>
            </div>
            <h5>Department of Civil Engineering</h5>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="program-card">
            <div class="icon-box text-info">
              <i class="fa-solid fa-chart-column"></i>
            </div>
            <h5>School of Management Sciences</h5>
          </div>
        </div>

      </div>
    </div>
  </section>



  <section class="facilities-section py-5">
    <div class="container">

      <div class="row mb-5">
        <div class="col-12 text-center">
          <h2 class="section-title">Facilities</h2>
        </div>
      </div>

      <div class="row g-4 justify-content-center">

        <div class="col-lg-3 col-md-6 col-12">
          <div class="facility-card text-center">
            <div class="icon-wrapper">
              <i class="fa-solid fa-book-open"></i>
            </div>
            <h5 class="facility-title">Library</h5>
            <p class="facility-desc">
              Extensive IT resources, study zones and rich collection of books help you to excel in your studies.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="facility-card text-center">
            <div class="icon-wrapper">
              <i class="fa-solid fa-square-parking"></i>
            </div>
            <h5 class="facility-title">Parking</h5>
            <p class="facility-desc">
              Our parking area is dedicated to deliver easy, convenient and secure access to the university campus.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="facility-card text-center">
            <div class="icon-wrapper">
              <i class="fa-solid fa-store"></i>
            </div>
            <h5 class="facility-title">Shops</h5>
            <p class="facility-desc">
              Explore the shopping and retail area for your printing, photocopying, and daily related services.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="facility-card text-center">
            <div class="icon-wrapper">
              <i class="fa-solid fa-wifi"></i>
            </div>
            <h5 class="facility-title">Wifi</h5>
            <p class="facility-desc">
              The entire campus is Wifi enabled with free high speed internet access for all students.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- Why chose us section  -->
  <section class="why-choose-us" id="statsSection">
    <div class="container content-wrapper">

      <div class="row text-center mb-5">
        <div class="col-12">
          <p class="section-subtitle">THE NUMBERS SAY IT ALL</p>
          <h2 class="section-title">WHY CHOOSE US</h2>
        </div>
      </div>

      <div class="row text-center g-4">

        <div class="col-md-3 col-6">
          <div class="stat-item">
            <h2 class="stat-number"><span class="counter" data-count="85">0</span>%</h2>
            <div class="blue-divider"></div>
            <p class="stat-label">STUDENT SATISFACTION</p>
          </div>
        </div>

        <div class="col-md-3 col-6">
          <div class="stat-item">
            <h2 class="stat-number"><span class="counter" data-count="67.7">0</span>%</h2>
            <div class="blue-divider"></div>
            <p class="stat-label">EMPLOYMENT RATE IN SIX MONTHS</p>
          </div>
        </div>

        <div class="col-md-3 col-6">
          <div class="stat-item">
            <h2 class="stat-number"><span class="counter" data-count="180">0</span>+</h2>
            <div class="blue-divider"></div>
            <p class="stat-label">PROGRAMS</p>
          </div>
        </div>

        <div class="col-md-3 col-6">
          <div class="stat-item">
            <h2 class="stat-number"><span class="counter" data-count="25">0</span>:1</h2>
            <div class="blue-divider"></div>
            <p class="stat-label">STUDENT-FACULTY RATIO</p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <footer class="modern-footer">
    <div class="container">
      <div class="row justify-content-between">

        <div class="col-lg-4 col-md-12 mb-4 d-flex align-items-center">
          <a href="#" class="footer-logo">
            <img src="{{ url('images/BGNU_whiteLogo.png') }}" alt="BGNU Logo" class="img-fluid">
          </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="footer-heading">Quick Links</h5>
          <ul class="footer-links list-unstyled">
            <li><a href="#">Vice Chancellor</a></li>
            <li><a href="#">Core Values</a></li>
            <li><a href="#">Vision</a></li>
            <li><a href="#">Mission</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="footer-heading">Quick Links</h5>
          <ul class="footer-links list-unstyled">
            <li><a href="#">About BGNU</a></li>
            <li><a href="#">Life at BGNU</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <span class="follow-us-text me-3">Follow Us</span>
            <div class="social-icons d-inline-block">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
              <a href="#"><i class="fa-brands fa-twitter"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-youtube"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>

          <div class="col-md-6 text-center text-md-end">
            <p class="copyright-text mb-0">
              &copy; BGNU is Proudly Owned by <span class="brand-highlight">BGNU</span>
            </p>
          </div>

        </div>
      </div>
    </div>

    <a href="#" class="back-to-top" id="backToTop">
      <i class="fa-solid fa-chevron-up"></i>
    </a>
  </footer>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="script.js"></script>



</body>

</html>