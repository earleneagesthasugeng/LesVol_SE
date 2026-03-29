<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Home</title>
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<nav>
  <a class="nav-brand" href="/home">LesVol</a>
  <div class="nav-links">
    <a href="/home">Home</a>
    <a href="/my-activities">My Activities</a>
    
    <div class="dropdown-wrapper">
      <div class="nav-avatar" onclick="toggleDropdown('nav-dropdown')" id="avatar-trigger">
        <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>

      <div class="dropdown-menu" id="nav-dropdown" style="right: 0; left: auto; background: var(--red); min-width: 180px; padding: 10px 0;">
        
        <div id="state-logged-in">
          <a href="/profile" class="dropdown-item" style="color: white; font-weight: 700; text-align: center; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            View Profile
          </a>
          
          <a href="/be-a-seeker" class="dropdown-item" style="color: white; font-weight: 700; text-align: center; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            Be a Seeker!
          </a>
          
          <a href="/login" class="dropdown-item" style="color: white; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            Log Out 
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
            </svg>
          </a>
          
          <a href="#" class="dropdown-item" style="color: white; font-weight: 700; text-align: center; padding: 15px 20px;">
            Delete Account
          </a>
        </div>

        <div id="state-logged-out" style="display: none;">
          <a href="/login" class="dropdown-item" style="color: white; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 20px;">
            Log In 
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h4M10 17l5-5-5-5M13 12H3"/></svg>
          </a>
          <a href="/register" class="dropdown-item" style="color: white; font-weight: 700; text-align: center; padding: 15px 20px;">Sign Up</a>
        </div>

      </div>
    </div>
  </div>
</nav>

<div class="hero-banner">
  <div class="hero-banner-content">
    <div>
      <div class="hero-banner-title">Nama Aktivitas</div>
      <div class="hero-banner-meta">
        <svg style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1-2.5-2.5A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9A2.5 2.5 0 0 1 12 11.5z"/>
        </svg> Lokasi aktivitas &nbsp; 
        <svg style="width: 1.1em; height: 1.1em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
        </svg> dd/mm/yy</div>
      <a class="btn-see-more" href="/activity" style="margin-top:10px; display:inline-flex; width:auto;">See More ▶</a>
      <div class="hero-dots" style="margin-top:12px;">
        <div class="hero-dot active"></div>
        <div class="hero-dot"></div>
        <div class="hero-dot"></div>
      </div>
    </div>
    <div style="color:rgba(255,255,255,0.85); font-size:12px; line-height:1.7;">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </div>
  </div>
</div>

<div class="search-bar">
  <input class="search-input" type="text" placeholder="Search">
  <button class="search-btn">
    <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
  </button>
</div>

<div style="padding: 24px 32px; flex:1;">
  <div class="activities-grid" id="home-grid"></div>
</div>

<footer>
  <div>
    <h3>Les Know Us More</h3>
    <div class="footer-contact">
      <span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        +6212 6767 6767
      </span>

      <span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
        emailus@mail.com
      </span>
    </div>
  </div>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
</footer>

<script src = "{{asset('js/home.js')}}"></script>
<script src="{{asset('js/dropdown_login.js')}}"></script>
</body>
</html>
