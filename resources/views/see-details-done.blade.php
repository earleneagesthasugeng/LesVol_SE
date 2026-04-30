<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Activity Details</title>
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

<div style="flex:1; padding: 24px 32px; max-width:900px; margin:0 auto; width:100%;">
  <a class="back-btn" href="/done-activity" style="margin-bottom:20px; display:inline-flex;">
    <div class="back-icon">◀</div> Back
  </a>

  @if(session('success'))
    <div style="background: #dcfce7; border: 1px solid #22c55e; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px; text-align: center; font-size: 14px;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 16px; text-align: center; font-size: 14px;">
      {{ session('error') }}
    </div>
  @endif

  <div class="activity-detail-card" style="margin-top:16px;">
    <div style="height:220px; background-color:#d9d9d9;
      @if(!empty($activity->image_path))
        background-image: url('{{ asset('storage/' . $activity->image_path) }}');
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
      @endif
    "></div>
    <div class="activity-detail-body">

      <div class="detail-header">
        <div>
          <div class="detail-title">{{ $activity->activity_name }}</div>
          <div class="detail-author">
            <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
              <div class="author-avatar">
                @if($activity->seeker->user->profile_picture_path)
                  <img src="{{ asset('storage/' . $activity->seeker->user->profile_picture_path) }}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                @else
                  <svg width="18" height="18" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                @endif
              </div>
              <div>
                <div style="font-weight:700; font-size:14px;">{{ $activity->seeker->user->name }}</div>
              </div>
            </div>
          </div>
        </div>
        <span class="accepted-badge">Done</span>
      </div>

      <hr class="detail-divider">
      <div style="font-weight:700; margin-bottom:12px;">Details:</div>
      <div class="detail-info-grid" style="margin-bottom:16px;">
        <div class="detail-info-item"><label>Location:</label><span>{{ $activity->location }}</span></div>
        <div class="detail-info-item"><label>Open Registration:</label><span>{{ \Carbon\Carbon::parse($activity->open_reg_date)->format('d/m/Y') }}</span></div>
        <div class="detail-info-item"><label>Status:</label><span>Completed</span></div>
        <div class="detail-info-item"><label>Date:</label><span>{{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/Y') }}</span></div>
        <div class="detail-info-item"><label>Close Registration:</label><span>{{ \Carbon\Carbon::parse($activity->close_reg_date)->format('d/m/Y') }}</span></div>
        <div class="detail-info-item"><label>Quota:</label><span>{{ $activity->slot }} volunteer(s)</span></div>
      </div>
      <hr class="detail-divider">

      <div style="font-weight:700; margin-bottom:10px;">Description:</div>
      <p style="font-size:14px; color:#4b5563; line-height:1.7; margin-bottom:28px;">
        {{ $activity->description }}
      </p>

      {{-- Show proof upload section only for volunteers --}}
      @if($volunteer)
        @if($volunteer->proof_path)
          {{-- Proof already submitted --}}
          <div style="text-align:center; margin-bottom:20px;">
            <div style="font-weight:700; margin-bottom:12px; color:#22c55e;">✓ Proof Submitted</div>
            <img src="{{ asset('storage/' . $volunteer->proof_path) }}" 
              style="max-width:400px; width:100%; border-radius:12px; border: 2px solid #22c55e;">
          </div>
        @else
          {{-- Show upload button --}}
          <div style="text-align:center;">
            <button class="btn-danger" onclick="openModal('modal-upload-proof')">Upload Attendance</button>
          </div>
        @endif
      @endif

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

{{-- Upload Proof Modal --}}
@if($volunteer && !$volunteer->proof_path)
<div class="modal-overlay" id="modal-upload-proof">
  <div class="modal" style="max-width:560px; border-radius: 24px;">
    <button class="modal-close" onclick="closeModal('modal-upload-proof')" style="font-weight: bold; font-size: 24px; top: 20px; right: 25px;">✕</button>
    
    <div class="popup-title" style="font-size: 32px; margin-top: 10px;">Upload Attendance</div>
    <div class="popup-subtitle" style="font-size: 20px; margin-top: 8px;">{{ $activity->activity_name }}</div>
    
    <div class="popup-meta" style="display: flex; justify-content: center; gap: 15px; margin-top: 10px;">
      <span style="display: flex; align-items: center; gap: 5px;">📍 {{ $activity->location }}</span>
      <span style="display: flex; align-items: center; gap: 5px;">🗓 {{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/Y') }}</span>
    </div>

    <hr class="detail-divider" style="margin: 20px 0;">

    <form action="{{ route('activity.submitProof', $activity->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div style="text-align: center; margin-bottom: 20px;">
        <p style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">Upload a picture of yourself at the place of volunteer</p>
        
        <div class="upload-img-box" id="proof-drop-zone" 
          style="background: #f3f4f6; border: 2px dashed #d1d5db; height: 200px; flex-direction: column; gap: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; border-radius: 12px;"
          onclick="document.getElementById('proof-file-input').click()">
          <img id="proof-preview" src="" style="display:none; max-height:180px; border-radius:8px;">
          <div id="proof-placeholder">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <div style="color: #6b7280; font-size: 14px; margin-top: 8px;">Select a file to upload (jpg, jpeg, png, max 10MB)</div>
          </div>
        </div>
        <input type="file" id="proof-file-input" name="proof" accept="image/jpeg,image/jpg,image/png" style="display:none;" required>
      </div>

      @if ($errors->has('proof'))
        <div style="color: #ef4444; text-align: center; font-size: 13px; margin-bottom: 12px;">
          {{ $errors->first('proof') }}
        </div>
      @endif

      <div style="text-align: center; margin-top: 30px;">
        <button type="submit" class="btn-danger" style="padding: 12px 60px; font-size: 16px;">Upload</button>
      </div>
    </form>
  </div>
</div>
@endif

<script>
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});

// Image preview for proof upload
const proofInput = document.getElementById('proof-file-input');
if (proofInput) {
  proofInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        document.getElementById('proof-preview').src = ev.target.result;
        document.getElementById('proof-preview').style.display = 'block';
        document.getElementById('proof-placeholder').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  });
}
</script>
<script src="{{asset('js/dropdown_login.js')}}"></script>
</body>
</html>
