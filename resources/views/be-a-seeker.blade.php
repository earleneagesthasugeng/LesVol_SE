<!DOCTYPE html>
<html lang="id">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LesVol - Be a Seeker!</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
          </svg>
        </div>


        <div class="dropdown-menu" id="nav-dropdown"
          style="right: 0; left: auto; background: var(--red); min-width: 180px; padding: 10px 0;">


          <div id="state-logged-in">
            <a href="/profile" class="dropdown-item"
              style="color: white; font-weight: 700; text-align: center; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
              View Profile
            </a>


            @if (!$isSeeker)
            <a href="/be-a-seeker" class="dropdown-item"
              style="color: white; font-weight: 700; text-align: center; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
              Be a Seeker!
            </a>
            @endif


            <a href="/login" class="dropdown-item"
              style="color: white; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
              Log Out
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
              </svg>
            </a>


            <a href="#" class="dropdown-item"
              style="color: white; font-weight: 700; text-align: center; padding: 15px 20px;">
              Delete Account
            </a>
          </div>


          <div id="state-logged-out" style="display: none;">
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


  <div class="main-content" style="max-width: 800px;">


    <div style="text-align: left; margin-bottom: 20px;">
      <a href="/profile" class="back-btn">
        <div class="back-icon">◀</div> Back
      </a>
    </div>


    <div style="text-align: center; margin-bottom: 40px;">
      <h1 class="page-title" style="font-size: 36px; margin-bottom: 8px; color: var(--text);">Be a Seeker!</h1>
      <p style="color: var(--text); font-size: 14px; font-weight: 500;">Be the one to seek volunteers and help the
        community to be a better place!</p>
    </div>


    <div class="auth-card"
      style="max-width: 700px; margin: 0 auto; padding: 40px; position: relative; border-radius: 30px;">


      <form action="{{ url('/register-seeker') }}" method="POST" enctype="multipart/form-data" style="text-align: center;">
        @csrf
        <p style="font-size: 15px; font-weight: 500; margin-bottom: 30px; color: #374151;">
          For Verification purposes, please upload your identity card
        </p>


        <input type="file" id="file-input" name="identity_card" accept="image/*" style="display: none;">


        <div class="upload-img-box" id="dropzone"
          style="background: #f3f4f6; border: 2px dashed #d1d5db; height: 260px; flex-direction: column; gap: 20px; border-radius: 20px; margin-bottom: 30px; overflow: hidden; position: relative;">


          <div id="upload-placeholder" style="display: flex; flex-direction: column; align-items: center; gap: 20px;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span style="color: #6b7280; font-size: 14px; font-weight: 500;">
              Upload your identity card (png, jpg, jpeg, max 10MB)
            </span>
          </div>


          <img id="image-preview" src="#" alt="Preview"
            style="display: none; width: 100%; height: 100%; object-fit: contain; padding: 10px;">
        </div>


        <button type="submit" class="btn-danger" id="upload-trigger"
          style="padding: 12px 50px; font-size: 16px;">Upload</button>
      </form>
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
          lesvol@mail.com
        </span>
      </div>
    </div>
    <p>LesVol is a volunteer discovery platform that connects passionate individuals with meaningful social activities and community programs. Our mission is to make volunteering easier, more accessible, and more impactful by helping users find activities that match their interests, availability, and location. Through LesVol, seekers can organize volunteer events while volunteers can participate, collaborate, and contribute to positive change within their communities.</p>
  </footer>


  @if(session('success'))
  <div class="modal-overlay open" id="modal-register-success">
    <div class="modal" style="text-align:center; max-width:420px; padding:40px 32px;">
      <div
        style="width:80px; height:80px; border-radius:50%; border:5px solid #22c55e; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; margin-top: 15px color:#22c55e; font-size:36px;">
        ✓</div>
      <p style="color:#4b5563; font-size:15px;">{{ session('success') }}</p>
      <a href="/upload-activity"
        style="display:inline-block; margin-top:20px; color:var(--red-btn); font-weight:600; font-size:14px;">You have
        successfully become a Seeker! Lets Upload an Activity→</a>
    </div>
  </div>
  @endif

<script src="{{ asset('js/dropdown_login.js')}}">
</script>
<script src="{{ asset('js/be-a-seeker.js')}}"></script>
<script>
  function openModal(id) { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }
</script>
</body>
</html>



