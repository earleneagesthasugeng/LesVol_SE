<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register – LesVol</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
</head>
<body>

  <!-- MAIN -->
  <main>
    <div class="card">
      <h1 class="card-title">Become a Volunteer!</h1>
      <p class="card-sub">One step a way to make real change.</p>

      <div class="field full">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name"/>
      </div>

      <div class="field-row">
        <div class="field">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Email Address"/>
        </div>
        <div class="field">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Phone Number"/>
        </div>
      </div>

      <div class="field-row three">
        <div class="field">
          <label for="dob">Date of Birth</label>
          <input type="text" id="dob" name="dob" placeholder="Date of Birth"/>
        </div>
        <div class="field">
          <label for="occupation">Occupation</label>
          <input type="text" id="occupation" name="occupation" placeholder="Occupation"/>
        </div>
        <div class="field">
          <label for="city">City</label>
          <input type="text" id="city" name="city" placeholder="City"/>
        </div>
      </div>

      <div class="field full">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Type Password Here"/>
      </div>

      <div class="field full">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Type Password Here"/>
      </div>

      <button class="btn-register">Create Account</button>

      <p class="login-text">Already have an account? <a href="{{ route('login') }}" class="login-link">log in here</a></p>
    </div>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-left">
      <h2>Les Know Us More</h2>
      <div class="footer-contact">
        <div class="footer-contact-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
          </svg>
          +6212 6767 6767
        </div>
        <div class="footer-contact-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="2"/>
            <path d="M2 7l10 7 10-7"/>
          </svg>
          emailus@mail.com
        </div>
      </div>
    </div>
    <div class="footer-right">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    </div>
  </footer>

  <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>