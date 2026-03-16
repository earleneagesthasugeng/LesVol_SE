<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Activity Detail</title>
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<nav>
  <a class="nav-brand" href="/">LesVol</a>
  <div class="nav-links">
    <a href="/">Home</a>
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

<div style="flex:1; padding: 32px; max-width:900px; margin:0 auto; width:100%;">
  <a class="back-btn" href="/" style="margin-bottom:20px; display:inline-flex;">
    <div class="back-icon">◀</div> Back
  </a>

  <div class="activity-detail-card">
    <div class="activity-detail-img"></div>
    <div class="activity-detail-body">

      <div class="detail-header">
        <div>
          <div class="detail-title">Nama Aktivitas</div>
          <div class="detail-author">
            <div class="author-avatar">
              <svg width="18" height="18" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
            <div>
              <div style="font-weight:700; font-size:14px;">Nama Pembuat</div>
              <div class="stars">★★★★☆ <span style="color:#666; font-size:12px;">4.5 (9,6 rb)</span></div>
            </div>
          </div>
        </div>
        <a class="btn btn-primary" href="#" onclick="openModal('modal-activity-details'); return false;">
          Details ▶</a>
      </div>

      <div class="participants-count">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
          67/100
      </div>
      <hr class="detail-divider">

      <div style="font-weight:700; margin-bottom:12px;">Details:</div>
      <div class="detail-info-grid" style="margin-bottom:16px;">
        <div class="detail-info-item"><label>Location:</label><span>lokasi aktivitas</span></div>
        <div class="detail-info-item"><label>Open Registration:</label><span>dd/mm/yy</span></div>
        <div class="detail-info-item"><label>Status:</label><span>Not Registered</span></div>
        <div class="detail-info-item"><label>Date:</label><span>dd/mm/yy</span></div>
        <div class="detail-info-item"><label>Close Registration:</label><span>dd/mm/yy</span></div>
        <div class="detail-info-item"><label>Quota:</label><span>100 volunteer(s)</span></div>
      </div>
      <hr class="detail-divider">

      <div style="font-weight:700; margin-bottom:10px;">Description:</div>
      <p style="font-size:14px; color:#4b5563; line-height:1.7; margin-bottom:28px;">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      </p>

      <div style="text-align:center;">
        <a class="btn-danger" href="/register-activity">Register</a>
      </div>

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

<div class="modal-overlay" id="modal-activity-details">
  <div class="modal" style="max-width:560px; max-height:80vh; overflow-y:auto;">
    <button class="modal-close" onclick="closeModal('modal-activity-details')">✕</button>
    <div class="popup-title">Activity Details</div>
    <div class="popup-subtitle">nama aktivitas</div>
    <div class="popup-meta" style="display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 16px;">
      <span style="display: flex; align-items: center; gap: 6px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
          <circle cx="12" cy="10" r="3"></circle>
        </svg>
        lokasi aktivitas
      </span>
      <span style="display: flex; align-items: center; gap: 6px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        dd/mm/yy
      </span>
    </div>
    <div class="popup-reminder">
      berisikan requirements tambahan/deskripsi di activity card untuk remind volunteers.<br>
      berisi pengingat mengenai apa yang harus dibawa, transportasi (jika ada), dan informasi lainnya
    </div>
    <p style="font-size:13px; color:#4b5563; line-height:1.7; margin-bottom:12px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    <p style="font-size:13px; color:#4b5563; line-height:1.7; margin-bottom:12px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <p style="font-size:13px; color:#4b5563; line-height:1.7;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
  </div>
</div>

</body>
<script>
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});
</script>
<script src="{{ asset('js/dropdown_login.js')}}"></script>
</html>
