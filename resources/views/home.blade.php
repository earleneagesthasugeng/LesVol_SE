<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LesVol - Home</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <style>
  .hero-carousel {
    position: relative;
    width: 100%;
  }

  .hero-slide {
    display: none;
  }

  .hero-slide.active {
    display: block;
  }

.hero-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 42px;
  height: 42px;
  border-radius: 50%;
  border: none;
  background: white;
  cursor: pointer;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.hero-arrow:hover {
  background: #fff7f5;
}

.hero-arrow-icon {
  width: 15px;
  height: 15px;
  fill: var(--red-btn);
  display: block;
}

.hero-arrow-right .hero-arrow-icon {
  transform: scaleX(-1);
}

 .hero-arrow-left {
    left: 24px;
}

.hero-banner-content {
    padding-left: 90px;
    padding-right: 90px;
}

  .hero-arrow-right {
    right: 24px;
  }

  .carousel-dots {
    position: absolute;
    left: 50%;
    bottom: 18px;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
  }

  .carousel-dot {
    border: none;
    cursor: pointer;
    padding: 0;
  }

  .home-pagination {
    margin-top: 28px;
    display: flex;
    justify-content: center;
  }

  .home-pagination nav {
    background: transparent;
    box-shadow: none;
    padding: 0;
  }

  .home-pagination .hidden {
    display: none;
  }

  .home-pagination a,
  .home-pagination span {
    margin: 0 6px;
    color: var(--red-btn);
    font-weight: 700;
    text-decoration: none;
  }

  .home-pagination span[aria-current="page"] span {
    color: #111827;
  }
</style>
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

  <div class="hero-carousel" id="heroCarousel">
    @if($heroActivities->count() > 0)
      @foreach($heroActivities as $index => $heroActivity)
        @php
          $heroAlreadyJoined = false;

          if (session('user')) {
            $heroAlreadyJoined = \App\Models\Volunteer::where('user_id', session('user')->id)
              ->where('activity_id', $heroActivity->id)
              ->exists();
          }
        @endphp

        <div class="hero-banner hero-slide {{ $index === 0 ? 'active' : '' }}"
          style="
            background-image: url('{{ asset('storage/' . $heroActivity->image_path) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #cfcfd4;
          ">

          <div class="hero-banner-content">
            <div>
              <div class="hero-banner-title">{{ $heroActivity->activity_name }}</div>

              <div class="hero-banner-meta">
                <svg style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1-2.5-2.5A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9A2.5 2.5 0 0 1 12 11.5z" />
                </svg>
                {{ $heroActivity->location }}

                &nbsp;

                <svg style="width: 1.1em; height: 1.1em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                </svg>
                {{ \Carbon\Carbon::parse($heroActivity->activity_date)->format('d/m/y') }}
              </div>

              <div style="margin-top:10px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <a class="btn-see-more" href="{{ route('see-details', $heroActivity->id) }}" style="display:inline-flex; width:auto;">
                  see more ▶
                </a>

                @if($heroActivity->is_done)
                  <div class="accepted-badge" style="display:inline-flex; width:auto; padding: 10px 24px;">✓ Done</div>
                @elseif($heroActivity->slot > 0 && !$heroAlreadyJoined)
                  <a class="btn-register-card" href="{{ url('/register-activity/' . $heroActivity->id) }}" style="display:inline-flex; width:auto;">
                    Register ▶
                  </a>
                @endif
              </div>
            </div>

            <div style="color:rgba(255,255,255,0.85); font-size:12px; line-height:1.7;">
              {{ $heroActivity->description }}
            </div>
          </div>
        </div>
      @endforeach

      <button class="hero-arrow hero-arrow-left" type="button" onclick="changeHeroSlide(-1)" aria-label="Previous activity">
        <svg class="hero-arrow-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path>
        </svg>
      </button>

      <button class="hero-arrow hero-arrow-right" type="button" onclick="changeHeroSlide(1)" aria-label="Next activity">
        <svg class="hero-arrow-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path>
        </svg>
      </button>

      <div class="hero-dots carousel-dots">
        @foreach($heroActivities as $index => $heroActivity)
          <button type="button"
            class="hero-dot carousel-dot {{ $index === 0 ? 'active' : '' }}"
            onclick="goToHeroSlide({{ $index }})">
          </button>
        @endforeach
      </div>
    @else
      <div class="hero-banner" style="background-color: #cfcfd4; display: flex; align-items: center; justify-content: center;">
        <div style="color: white; font-size: 24px; font-weight: 700; text-align: center;">
          Belum ada activity
        </div>
      </div>
    @endif
  </div>

  <form class="search-bar" method="GET" action="/home">
    <input class="search-input" type="text" name="search" placeholder="Search" value="{{ $search ?? '' }}">
    <button class="search-btn" type="submit">
      <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.35-4.35" />
      </svg>
    </button>
  </form>

  <div style="padding: 24px 32px; flex:1;">
  <div class="activities-grid" id="home-grid">
    @foreach($activities as $activity)
      <div class="activity-card">
        <div class="activity-card-img" style="
          background-image: url('{{ asset('storage/' . $activity->image_path) }}');
          background-size: contain;
          background-position: center;
          background-repeat: no-repeat;
          background-color: #d9d9d9;
          height: 180px;
        ">
          <div class="slots-badge">{{ $activity->slot }} slots left</div>
        </div>

        <div class="activity-card-body">
          <h4>{{ $activity->activity_name }}</h4>

          <div class="activity-meta">
            <svg style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1-2.5-2.5A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9A2.5 2.5 0 0 1 12 11.5z" />
            </svg>
            {{ $activity->location }}
          </div>

          <div class="activity-meta">
            <svg style="width: 1.1em; height: 1.1em; vertical-align: middle; margin-right: 4px;" viewBox="0 0 24 24" fill="currentColor">
              <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
            </svg>
            {{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/y') }}
          </div>

          <div class="activity-card-actions">
          @php
              $alreadyJoined = false;
              $isOwnActivity = $isSeeker && $activity->seeker_id == $isSeeker->id;

              if (session('user')) {
                  $alreadyJoined = \App\Models\Volunteer::where('user_id', session('user')->id)
                      ->where('activity_id', $activity->id)
                      ->exists();
              }
          @endphp

          @if($isOwnActivity)
              <a class="btn-see-more" href="/options/{{ $activity->id }}">
                  Options ▶
              </a>
          @else
              <a class="btn-see-more" href="{{ route('see-details', $activity->id) }}">
                  See More ▶
              </a>

              @if($activity->is_done)
                  <div class="accepted-badge" style="width: 100%; text-align: center; margin-top: 5px;">
                      ✓ Done
                  </div>
              @elseif(!$alreadyJoined && $activity->slot > 0)
                  <a class="btn-register-card" href="/register-activity/{{ $activity->id }}">
                      Register ▶
                  </a>
              @endif
          @endif
      </div>
        </div>
      </div>
    @endforeach
  </div>

    @if($activities->hasPages())
      <div class="home-pagination-wrapper">
          @if ($activities->onFirstPage())
              <button class="home-pagination-btn home-pagination-disabled" disabled>
                  Prev
              </button>
          @else
              <a href="{{ $activities->previousPageUrl() }}" class="home-pagination-btn">
                  Prev
              </a>
          @endif

          <span class="home-pagination-info">
              Page {{ $activities->currentPage() }} of {{ $activities->lastPage() }}
          </span>

          @if ($activities->hasMorePages())
              <a href="{{ $activities->nextPageUrl() }}" class="home-pagination-btn">
                  Next
              </a>
          @else
              <button class="home-pagination-btn home-pagination-disabled" disabled>
                  Next
              </button>
          @endif
      </div>
  @endif
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

  <script src="{{ asset('js/home.js') }}"></script>
  <script src="{{ asset('js/dropdown_login.js') }}"></script>
</body>

</html>