<!DOCTYPE html>
<html lang="id">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LesVol - Register</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>


<body>


  <nav>
    <a class="nav-brand" href="/">LesVol</a>
    <div class="nav-links">
      <a href="/login">Login</a>


      <div class="dropdown-wrapper">
        <div class="nav-avatar" onclick="toggleDropdown('nav-dropdown')" id="avatar-trigger">
          <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
          </svg>
        </div>


        <div class="dropdown-menu" id="nav-dropdown"
          style="right: 0; left: auto; background: var(--red); min-width: 180px; padding: 10px 0;">
          <div id="state-logged-out">
            <a href="/login" class="dropdown-item"
              style="color: white; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 20px;">
              Log In
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h4M10 17l5-5-5-5M13 12H3" />
              </svg>
            </a>
            <a href="/register" class="dropdown-item"
              style="color: white; font-weight: 700; text-align: center; padding: 15px 20px;">Sign Up</a>
          </div>


        </div>
      </div>
    </div>
  </nav>


  <div class="auth-container" style="padding: 32px 24px; align-items:flex-start;">
    <div class="auth-card" style="max-width: 680px; padding: 40px;">
      <div class="auth-title">Become a Volunteer!</div>
      <div class="auth-subtitle">One step a way to make real change.</div>


      <form method="POST" action="/user-register">
        @csrf


        <div class="form-group">
          <label for="volunteer_type">Volunteer Type</label>
          <input id="volunteer_type" name="volunteer_type"
            class="form-input @error('volunteer_type') is-invalid @enderror" type="text" placeholder="Type"
            value="{{ old('volunteer_type') }}">
          @error('volunteer_type')
          <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
          @enderror
        </div>


        <div class="form-row">
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" class="form-input @error('name') is-invalid @enderror" type="text"
              placeholder="Name" value="{{ old('name') }}">
            @error('name')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="nickname">Nickname</label>
            <input id="nickname" name="nickname" class="form-input @error('nickname') is-invalid @enderror" type="text"
              placeholder="Nickname" value="{{ old('nickname') }}">
            @error('nickname')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
        </div>


        <div class="form-row">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" name="email" class="form-input @error('email') is-invalid @enderror" type="email"
              placeholder="Email Address" value="{{ old('email') }}">
            @error('email')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" class="form-input @error('phone') is-invalid @enderror" type="tel"
              placeholder="Phone Number" value="{{ old('phone') }}">
            @error('phone')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
        </div>


        <div class="form-row-3">
          <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input id="dob" name="dob" class="form-input @error('dob') is-invalid @enderror" type="text"
              placeholder="Date of Birth" value="{{ old('dob') }}">
            @error('dob')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="occupation">Occupation</label>
            <input id="occupation" name="occupation" class="form-input @error('occupation') is-invalid @enderror"
              type="text" placeholder="Occupation" value="{{ old('occupation') }}">
            @error('occupation')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="pob">Place of Birth</label>
            <input id="pob" name="pob" class="form-input @error('pob') is-invalid @enderror" type="text"
              placeholder="Place of Birth" value="{{ old('pob') }}">
            @error('pob')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
        </div>


        <div class="form-group">
          <label for="reason">Why do you want to volunteer?</label>
          <textarea id="reason" name="reason" class="form-input @error('reason') is-invalid @enderror"
            placeholder="State your reason">{{ old('reason') }}</textarea>
          @error('reason')
          <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="experience">Have you participated in volunteer activities?</label>
          <textarea id="experience" name="experience" class="form-input @error('experience') is-invalid @enderror"
            placeholder="If yes, please describe your experience!">{{ old('experience') }}</textarea>
          @error('experience')
          <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
          @enderror
        </div>


        <div class="form-row">
          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" class="form-input @error('password') is-invalid @enderror"
              type="password" placeholder="Type Password Here">
            @error('password')
            <span class="error-message" style="color: var(--red-btn); font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" class="form-input" type="password"
              placeholder="Type Password Here">
          </div>
        </div>


        <div class="checkbox-row">
          <input type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
          <label for="terms">I agree to LesVol's <a href="#">Terms of Service</a> and <a href="#">Privacy
              Policy</a></label>
        </div>
        @error('terms')
        <span class="error-message"
          style="color: var(--red-btn); font-size: 12px; display: block; margin-top: -8px; margin-bottom: 8px;">{{
          $message }}</span>
        @enderror


        <button type="submit" class="btn btn-primary btn-full" style="margin-top:8px;">Create Account</button>
      </form>


      <div style="text-align:center; margin-top:16px; font-size:13px; color:var(--gray);">
        Already have an account? <a href="/login" style="color:var(--red-btn); font-weight:600;">Log in</a>
      </div>
    </div>
  </div>


  <footer>
    <div>
      <h3>Les Know Us More</h3>
      <div class="footer-contact">
        <span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
          +6212 6767 6767
        </span>


        <span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
            <polyline points="22,6 12,13 2,6" />
          </svg>
          emailus@mail.com
        </span>
      </div>
    </div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore
      magna aliqua.</p>
  </footer>


</body>
<script src="{{asset('js/dropdown_login.js')}}"></script>


</html>

