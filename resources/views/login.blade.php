<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Log In</title>
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>


<nav>
  <a class="nav-brand" href="/">LesVol</a>
  <div class="nav-links">
    <a href="/register">Sign Up</a>
   
    <div class="dropdown-wrapper">
      <div class="nav-avatar" onclick="toggleDropdown('nav-dropdown')" id="avatar-trigger">
        <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>


      <div class="dropdown-menu" id="nav-dropdown" style="right: 0; left: auto; background: var(--red); min-width: 180px; padding: 10px 0;">


        <div id="state-logged-out">
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


<div class="auth-container">
  <div class="auth-card" style="max-width:520px;">
    <div class="auth-title">Log in</div>
    <div class="auth-subtitle">back to make a change</div>


    <form method="POST" action="/user-login">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-input" type="email" name="email" placeholder="Type Email Here" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-input" type="password" name="password" placeholder="Type Password Here" id="password" required>
      </div>


      @if(session('error'))
        <div id="error-msg" style="color:#dc2626; font-size:13px; margin-bottom:10px;">{{ session('error') }}</div>
      @endif


      <div style="text-align:center; margin-top:24px;">
        <button type="submit" class="btn btn-primary btn-lg" style="padding:14px 60px;">Log in</button>
      </div>
    </form>
    <div style="text-align:center; margin-top:16px; font-size:13px; color:var(--gray);">
      Don't have an account? <a href="/register" style="color:var(--red-btn); font-weight:600;">Sign Up</a>
    </div>
  </div>
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