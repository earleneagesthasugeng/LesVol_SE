<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LesVol - Participants</title>
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
  <a class="back-btn" href="/options/{{ $activity->id }}" style="margin-bottom:16px; display:inline-flex;">
    <div class="back-icon">◀</div> Back
  </a>

  <h2>
  {{ $activity->activity_name }}
  <span style="display: flex; align-items: center; font-family: 'DM Sans', sans-serif; font-size: 16px; color: var(--gray); font-weight: 500; margin-top: 10px; margin-bottom: 10px;">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
      <circle cx="9" cy="7" r="4"></circle>
      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
    </svg>
    {{ $volunteersCount }}/{{ $activity->slot + $volunteersCount }}
  </span>
</h2>

  @if(session('success'))
    <div style="background: #dcfce7; border: 1px solid #22c55e; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px; text-align: center; font-size: 14px;">
      {{ session('success') }}
    </div>
  @endif

  <div class="search-bar" style="border-radius:30px; margin-bottom:20px;">
    <input class="search-input" type="text" placeholder="Search" id="search-input" oninput="filterParticipants()">
    <button class="search-btn">
      <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    </button>
  </div>

  <div id="participants-list">
    @forelse ($volunteers as $volunteer)
      <div class="participant-item" data-name="{{ strtolower($volunteer->user->name) }}" style="display:flex; align-items:center; padding:14px 16px; border-bottom:1px solid #eee; {{ $volunteer->is_banned ? 'opacity: 0.5;' : '' }}">
        <div class="participant-avatar" style="width:36px; height:36px; border-radius:50%; background:#ddd; margin-right:12px; overflow:hidden;">
          @if($volunteer->user->profile_picture_path)
            <img src="{{ asset('storage/' . $volunteer->user->profile_picture_path) }}" style="width:100%; height:100%; object-fit:cover;">
          @endif
        </div>
        <span class="participant-name" style="flex:1; font-weight:600; font-size:14px;">
          {{ $volunteer->user->name }}
          @if($volunteer->is_banned)
            <span style="color: #ef4444; font-size: 12px; font-weight: 700; margin-left: 8px;">BANNED</span>
          @endif
        </span>
        <form action="{{ route('volunteer.toggleBan', $volunteer->id) }}" method="POST" style="margin:0;">
          @csrf
          <button type="submit"
            style="padding: 6px 16px; border-radius: 999px; border: none; font-size: 12px; font-weight: 700; cursor: pointer;
            {{ $volunteer->is_banned 
              ? 'background: #22c55e; color: white;' 
              : 'background: #ef4444; color: white;' }}">
            {{ $volunteer->is_banned ? 'Unban' : 'Ban' }}
          </button>
        </form>
      </div>
    @empty
      <div style="text-align:center; padding:40px; color:#666;">
        <p>No participants yet.</p>
      </div>
    @endforelse
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

<script>
  function filterParticipants() {
    const query = document.getElementById('search-input').value.toLowerCase();
    document.querySelectorAll('.participant-item').forEach(item => {
      const name = item.getAttribute('data-name');
      item.style.display = name.includes(query) ? 'flex' : 'none';
    });
  }
</script>
<script src="{{asset('js/dropdown_login.js')}}"></script>
</body>
</html>
