<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LesVol - Edit Profile</title>
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
          
          @if (!$isSeeker)
          <a href="/be-a-seeker" class="dropdown-item" style="color: white; font-weight: 700; text-align: center; padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            Be a Seeker!
          </a>
          @endif
          
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

    <main class="main-content">
        <div style="margin-bottom: 24px; margin-left: 65px">
            <a href="/profile" class="back-btn">
                <span class="back-icon">◀</span>
                Back
            </a>
        </div>

        <div class="card" style="padding: 48px; max-width: 900px; margin: 0 auto;">
            <h2 class="auth-title" style="margin-bottom: 40px;">Edit Profile</h2>

            <form>
                <div class="profile-edit-grid">
                    <div class="photo-upload-section">
                        <div class="photo-placeholder" id="preview-container">
                            <img id="image-preview" src="" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                            <svg id="placeholder-icon" width="100" height="100" viewBox="0 0 24 24" fill="#9ca3af">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <input type="file" id="image-input" accept="image/*" style="display: none;">
                        <button type="button" id="select-image-btn" class="btn btn-dark" style="padding: 10px 30px;">Select Image</button>
                        <p class="upload-info">File size: max 1 MB<br>Extension: .JPEG, .PNG</p>
                    </div>

                    <div>
                        <div class="form-group">
                            <label>Volunteer Type</label>
                            <input type="text" class="form-input" placeholder="Type">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-input" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-input" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label>Email Adresss</label>
                            <input type="email" class="form-input" placeholder="Email Adresss">
                        </div>
                    </div>
                </div>

                <div class="form-row-3" style="margin-top: 20px;">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-input" placeholder="Date of Birth">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-input" placeholder="Occupation">
                    </div>
                    <div class="form-group">
                        <label>Domicile</label>
                        <input type="text" class="form-input" placeholder="Domicile">
                    </div>
                </div>

                <div class="form-group">
                    <label>Bio</label>
                    <textarea class="form-input" placeholder="Bio"></textarea>
                </div>

                <form action="/update-profile" method="POST" enctype="multipart/form-data">
                    @csrf <div class="profile-edit-grid">
                        <input type="file" name="profile_picture" id="image-input" accept="image/*" style="display: none;">
                        </div>

                    <div class="save-container">
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 400px;">Save Changes</button>
                    </div>
                </form>
            </form>
        </div>
    </main>

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

    <div id="success-modal" class="modal-overlay">
    <div class="modal">
        <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        
        <div style="text-align: center;">
            <h2 class="popup-title">Success!</h2>
            <div style="width:80px; height:80px; border-radius:50%; border:5px solid #22c55e; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;margin-top: 20px; color:#22c55e; font-size:36px;">✓</div>
            <p class="popup-subtitle">Your profile has been updated.</p>
            <div style="margin-top: 24px;">
                <button type="button" class="btn btn-primary btn-lg" onclick="closeModal()" style="width: 100%;">
                    Great!
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/dropdown_login.js')}}"></script>
<script src="{{ asset('js/edit-profile.js')}}"></script>
</html>