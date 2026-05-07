<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Upload Activity</title>
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


<div style="flex:1; padding: 5px 32px; margin-top: 20px;">
  <div class="page-title-row">
    <div class="dropdown-wrapper">
      <div style="display:flex; align-items:center; gap:8px; cursor:pointer;" onclick="toggleDropdown('my-dropdown')">
        <span class="page-title">Upload Activity</span>
        <span style="color:var(--red); font-size:20px;">▼</span>
      </div>
      <div class="dropdown-menu" id="my-dropdown">
        <a class="dropdown-item" href="/my-activities">Joined Activities</a>
        @if ($isSeeker)
           <a class="dropdown-item" href="/proposed-activities">Proposed Activities</a>
        @endif
        <a class="dropdown-item" href="/done-activity">Done Activities</a>
        <span class="dropdown-item active">Upload Activity</span>
      </div>
    </div>
  </div>


  <div class="activities-grid" id="proposed-grid"></div>
</div>


<form action="{{ route('activity.upload') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @if ($errors->any())
    <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px; margin: 20px 32px;">
      <ul style="margin: 0; padding-left: 20px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div style="padding:0px 32px; margin-bottom: 30px">
    <div class="upload-form">
      <div class="upload-layout">
        <div>
          <input type="file" id="img-input" name="image" accept="image/*" style="display:none;" onchange="previewImage(event)">
          <div class="upload-img-box" onclick="document.getElementById('img-input').click()">
            <span>Upload Images Here</span>
          </div>
        </div>
        <div>
          <div class="form-group">
            <label>Activity Name</label>
            <input class="form-input" type="text" name="activity_name" placeholder="Type Activity Name Here" required>
          </div>
          <div class="form-group">
            <label>Location</label>
            <input class="form-input" type="text" name="location" placeholder="Select Location" required>
          </div>
          <div style="display: flex; gap: 20px;">
            <div class="form-group" style="flex: 1;">
              <label>Activity Date</label>
              <input class="form-input" type="date" name="activity_date" required>
            </div>
            <div class="form-group" style="flex: 1;">
              <label>Activity Time</label>
              <input class="form-input" type="time" name="activity_time" required>
            </div>
          </div>
          <div class="form-group">
            <label>Slot</label>
            <input class="form-input" type="number" name="slot" placeholder="Number of volunteers needed" required>
          </div>
          <div style="display: flex; gap: 20px;">
            <div class="form-group" style="flex: 1;">
              <label>Open Registration Date</label>
              <input class="form-input" type="date" name="open_reg_date" required>
            </div>
            <div class="form-group" style="flex: 1;">
              <label>Close Registration Date</label>
              <input class="form-input" type="date" name="close_reg_date" required>
            </div>
          </div>
          <div class="form-group">
            <label>Requirements</label>
            <textarea class="form-input" name="requirements" style="min-height:80px;" placeholder="What are the requirements?"></textarea>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-input" name="description" style="min-height:120px;" placeholder="Describe your activity"></textarea>
          </div>


          <div class="upload-actions">
            <button type="submit" class="btn btn-dark" style="border-radius:8px; padding:12px 24px;">Submit Activity</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal-overlay" id="modal-upload-proposal">
    <div class="modal" style="text-align:center; max-width:440px;">
      <button type="button" class="modal-close" onclick="closeModal('modal-upload-proposal')">✕</button>
      <h3 style="font-family:'DM Serif Display',serif; font-size:20px; margin-bottom:20px;">Upload Proposal</h3>
      <div style="font-size:64px; color:#ccc; margin-bottom:12px; line-height:1;">⬆</div>
      <p style="font-size:13px; color:var(--gray); margin-bottom:24px;">Select a file to upload (PDF, max 10MB)</p>
      <input type="file" id="proposal-input" name="proposal" accept=".pdf" style="display:none;" onchange="handleProposal(event)">
      <button type="button" class="btn btn-dark" style="border-radius:12px; padding:12px 40px;" onclick="document.getElementById('proposal-input').click()">Upload</button>
    </div>
  </div>
</form>

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


<script src="{{asset('js/upload_activity.js')}}">
</script>
<script src="{{asset('js/dropdown_login.js')}}"></script>
</body>
</html>





