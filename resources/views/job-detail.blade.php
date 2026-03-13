@extends('layouts.app')

@section('head_metas')

@endsection


@section('head_extras')

<style>
  
    :root {
      --bg:         #f2f2ef;
      --surface:    #ffffff;
      --border:     #e8e8e4;
      --text:       #111111;
      --muted:      #888884;
      --accent:     #1a1a1a;
      --accent-inv: #ffffff;
      --tag-bg:     #eeeeeb;
      --tag-color:  #555552;
      --card-hover: #fafaf8;
      --radius-lg:  16px;
      --radius-md:  12px;
      --radius-sm:  8px;
      --shadow:     0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.05);
      --shadow-card:0 1px 2px rgba(0,0,0,0.04), 0 2px 8px rgba(0,0,0,0.04);
      --font-head:  'Syne', sans-serif;
      --font-body:  'DM Sans', sans-serif;
    }

 /* ── LEFT PANEL ── */
    .job-panel {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    /* Header band */
    .job-header {
      padding: 28px 28px 24px;
      border-bottom: 1px solid var(--border);
    }

    .company-logo {
      width: 58px; height: 58px;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
      background: #fff;
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-head);
      font-size: 18px;
      font-weight: 800;
      color: var(--text);
      flex-shrink: 0;
      overflow: hidden;
      box-shadow: var(--shadow-card);
    }
    .company-logo img {
      width: 100%; height: 100%;
      object-fit: contain;
      padding: 8px;
    }

    .job-title {
      font-family: var(--font-head);
      font-size: 22px;
      font-weight: 700;
      color: var(--text);
      line-height: 1.25;
      margin-bottom: 4px;
    }

    .company-name {
      font-size: 13.5px;
      color: var(--muted);
      font-weight: 400;
    }
    .company-name a {
      color: var(--text);
      font-weight: 500;
      text-decoration: none;
    }
    .company-name a:hover { text-decoration: underline; }

    /* Meta row */
    .meta-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0;
      padding: 0 28px;
      border-bottom: 1px solid var(--border);
    }

    .meta-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 18px 0;
    }
    .meta-item:nth-child(odd) {
      padding-right: 24px;
      border-right: 1px solid var(--border);
    }
    .meta-item:nth-child(even) {
      padding-left: 24px;
    }
    .meta-item:nth-child(1),
    .meta-item:nth-child(2) {
      border-bottom: 1px solid var(--border);
    }

    .meta-icon {
      width: 34px; height: 34px;
      background: var(--tag-bg);
      border-radius: var(--radius-sm);
      display: grid; place-items: center;
      flex-shrink: 0;
      font-size: 13px;
      color: var(--theme-color);
      margin-top: 1px;
    }

    .meta-label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 3px;
    }
    .meta-value {
      font-size: 13.5px;
      font-weight: 500;
      color: var(--text);
      line-height: 1.3;
    }

    /* Tags row */
    .tags-row {
      padding: 16px 28px;
      border-bottom: 1px solid var(--border);
      display: flex; flex-wrap: wrap; gap: 7px;
      align-items: center;
    }
    .tag {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 11px;
      background: var(--tag-bg);
      color: var(--tag-color);
      font-size: 12px;
      font-weight: 500;
      border-radius: 20px;
      border: 1px solid transparent;
      transition: border-color .15s, color .15s;
    }
    .tag:hover { border-color: var(--border); color: var(--text); }
    .tag i { font-size: 11px; }

    /* Description body */
    .job-body {
      padding: 28px;
    }

    .section-heading {
      font-family: var(--font-head);
      font-size: 15px;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 14px;
      margin-top: 28px;
    }
    .section-heading:first-child { margin-top: 0; }

    .job-desc p {
      font-size: 14px;
      line-height: 1.75;
      color: #444;
      margin-bottom: 14px;
    }

    .job-desc ul {
      list-style: none;
      padding: 0;
      margin: 0 0 16px;
    }
    .job-desc ul li {
      font-size: 14px;
      line-height: 1.7;
      color: #444;
      padding-left: 20px;
      position: relative;
      margin-bottom: 6px;
    }
    .job-desc ul li::before {
      content: '';
      position: absolute;
      left: 0; top: 10px;
      width: 5px; height: 5px;
      border-radius: 50%;
      background: var(--muted);
    }

    /* Apply bar */
    .apply-bar {
      padding: 20px 28px;
      border-top: 1px solid var(--border);
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .apply-note {
      font-size: 12.5px;
      color: var(--muted);
      line-height: 1.5;
    }
    .apply-note strong { color: var(--text); font-weight: 600; }

    /* ── RIGHT PANEL ── */
    .right-col { position: sticky; top: 24px; }

    .related-heading {
      font-family: var(--font-head);
      font-size: 14px;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 12px;
      letter-spacing: -0.1px;
    }

    /* Related job card */
    .job-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-md);
      padding: 16px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: box-shadow .18s, border-color .18s, background .18s;
      text-decoration: none;
      display: block;
      box-shadow: var(--shadow-card);
    }
    .job-card:hover {
      box-shadow: var(--shadow);
      border-color: #d0d0cc;
      background: var(--card-hover);
    }
    .job-card.featured {
      border-color: var(--text);
    }

    .card-logo {
      width: 36px; height: 36px;
      border-radius: 8px;
      border: 1px solid var(--border);
      background: var(--tag-bg);
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-head);
      font-size: 12px;
      font-weight: 800;
      color: var(--text);
      flex-shrink: 0;
      overflow: hidden;
    }
    .card-logo img { width: 100%; height: 100%; object-fit: contain; padding: 5px; }

    .card-title {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text);
      line-height: 1.3;
      margin-bottom: 2px;
    }
    .card-company {
      font-size: 12px;
      color: var(--muted);
    }

    .card-meta {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 10px;
    }
    .card-pill {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: 11px;
      color: black;
      background: var(--tag-bg);
      padding: 3px 8px;
      border-radius: 20px;
      font-weight: 400;
    }
    .card-pill i { font-size: 10px; }

    .card-pill.type {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--tag-color);
    }

    /* New badge */
    .badge-new {
      font-size: 10px;
      font-weight: 600;
      background: var(--text);
      color: #fff;
      padding: 2px 7px;
      border-radius: 4px;
      letter-spacing: 0.3px;
    }

    /* Alert banner for open roles count */
    .alert-roles {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-md);
      padding: 14px 16px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .alert-roles-icon {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: var(--tag-bg);
      display: grid; place-items: center;
      font-size: 14px; color: var(--muted);
      flex-shrink: 0;
    }
    .alert-roles-text { font-size: 12.5px; color: var(--muted); line-height: 1.45; }
    .alert-roles-text strong { color: var(--text); font-weight: 600; }

    /* ── RESPONSIVE ── */
    @media (max-width: 991.98px) {
      .right-col { position: static; margin-top: 28px; }
      body { padding: 20px 0 48px; }
    }

    @media (max-width: 767.98px) {
      .meta-grid { grid-template-columns: 1fr; }
      .meta-item:nth-child(odd)  { border-right: none; padding-right: 0; }
      .meta-item:nth-child(even) { padding-left: 0; border-top: 1px solid var(--border); }
      .meta-item:nth-child(1),
      .meta-item:nth-child(2)    { border-bottom: 1px solid var(--border); }
      .meta-item:nth-child(2)    { border-top: none; }
      .meta-item:last-child      { border-bottom: none; }
      .job-header, .job-body, .tags-row { padding: 20px; }
      .meta-grid { padding: 0 20px; }
      .apply-bar { padding: 16px 20px; }
      .job-title { font-size: 19px; }
      .apply-bar { flex-direction: column; align-items: stretch; }
      .apply-bar .d-flex { width: 100%; }
    }




    /* Locked */

    /* ── OUTER WRAPPER ── */
    .wrapper {
      width: 100%;
      animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── LOCK GATE (top) ── */
    .gate {
      background: #d1d1d1;
      border-radius: 10px;
      padding: 28px 36px 32px;
      display: flex;
      align-items: center;
      gap: 24px;
      position: relative;
      overflow: hidden;
    }

    /* subtle diagonal texture */
    .gate::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: repeating-linear-gradient(
        -45deg,
        transparent,
        transparent 18px,
        rgba(255,255,255,0.018) 18px,
        rgba(255,255,255,0.018) 19px
      );
      pointer-events: none;
    }

    .gate-icon {
      flex-shrink: 0;
      width: 52px;
      height: 52px;
      border: 1.5px solid rgba(176,125,46,0.6);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--theme-color);
      background: rgba(176,125,46,0.08);
      animation: glow 3s ease-in-out infinite;
    }

    @keyframes glow {
      0%,100% { box-shadow: 0 0 0 0 rgba(176,125,46,0.25); }
      50%      { box-shadow: 0 0 0 10px rgba(176,125,46,0); }
    }

    .gate-text { flex: 1; }

    .gate-eyebrow {
      font-size: 10px;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: var(--theme-color);
      margin-bottom: 6px;
    }

    .gate-title {
      font-size: 20px;
      font-weight: 500;
      color: black;
      margin-bottom: 5px;
      line-height: 1.35;
    }

    .gate-sub {
      font-size: 13px;
      color: #8a8070;
      line-height: 1.5;
    }

    .gate-actions {
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      gap: 8px;
      min-width: 160px;
    }

    .btn {
      padding: 11px 18px;
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
      transition: all 0.2s ease;
      text-align: center;
    }

    .btn:active { transform: scale(0.97); }

    .btn-primary {
      background: var(--gold);
      color: #fff;
    }
    .btn-primary:hover { background: #c98f38; }

    .btn-ghost {
      background: transparent;
      color: #c2b8a8;
      border: 1px solid #3a3630;
    }
    .btn-ghost:hover {
      border-color: #6a6050;
      color: #f5f1eb;
    }

    /* connector arrow */
    .connector {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 0;
      position: relative;
      z-index: 2;
    }

    .connector-line {
      position: absolute;
      width: 1px;
      height: 28px;
      background: linear-gradient(to bottom, #1e1b16, var(--rule));
      top: 0;
    }

    .connector-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--theme-color);
      border: 2px solid var(--theme-color);
      position: absolute;
      top: 20px;
      z-index: 3;
    }

    /* ── PREVIEW CARD (below) ── */
    .preview-card {
      background: var(--card);
      border: 1px solid var(--rule);
      border-top: none;
      border-radius: 0 0 4px 4px;
      position: relative;
      overflow: hidden;
    }

    .preview-inner {
      padding: 36px 36px 32px;
      filter: blur(5px);
      opacity: 0.5;
      user-select: none;
      pointer-events: none;
    }

    /* fade out bottom */
    .preview-card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 55%;
      background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.97));
      pointer-events: none;
    }

    .preview-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }

    .preview-tags {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .tag {
      font-size: 10px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--mid);
      background: var(--bg);
      border: 1px solid var(--rule);
      padding: 4px 10px;
      border-radius: 2px;
    }

    .preview-salary {
      font-family: 'Lora', serif;
      font-size: 16px;
      color: var(--ink);
      white-space: nowrap;
    }

    .preview-title {
      font-family: 'Lora', serif;
      font-size: 26px;
      color: var(--ink);
      margin-bottom: 6px;
      font-weight: 400;
    }

    .preview-company {
      font-size: 14px;
      color: var(--mid);
      margin-bottom: 22px;
    }

    .bar { height: 11px; background: var(--rule); border-radius: 2px; margin-bottom: 9px; }

    .preview-meta-row {
      display: flex;
      gap: 24px;
      margin-bottom: 22px;
    }

    .meta-chip {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      color: var(--mid);
    }

    .meta-chip svg { color: var(--light); }

    .preview-divider {
      height: 1px;
      background: var(--rule);
      margin-bottom: 20px;
    }

    .preview-actions-row {
      display: flex;
      gap: 12px;
    }

    .fake-btn {
      height: 42px;
      border-radius: 3px;
      background: var(--rule);
    }

    /* ── HINT BAR ── */
    .hint-bar {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px;
      background: var(--gold-pale);
      border-top: 1px solid #e8d8b8;
      font-size: 12px;
      color: #8a6020;
      letter-spacing: 0.04em;
    }

    /* responsive */
    @media (max-width: 520px) {
      .gate { flex-direction: column; padding: 24px 22px 26px; }
      .gate-actions { width: 100%; flex-direction: row; }
      .btn { flex: 1; }
      .preview-inner { padding: 24px 22px; }
      .preview-header { flex-direction: column; gap: 10px; }
    }


    /* ── APPLY NOW ── */
    .btn-apply {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 0 30px;
      height: 50px;
      background: var(--theme-color);
      color: #fff;
      font-family: 'Sora', sans-serif;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      overflow: hidden;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 16px rgba(24,22,18,0.22), inset 0 1px 0 rgba(255,255,255,0.07);
    }

    .btn-apply::after {
      content: '';
      position: absolute;
      top: 0; left: -80%;
      width: 50%;
      height: 100%;
      background: linear-gradient(to right, transparent, rgba(255,255,255,0.09), transparent);
      transform: skewX(-18deg);
      transition: left 0.55s ease;
    }

    .btn-apply:hover::after { left: 160%; }

    .btn-apply:hover {
      background: var(--theme-color2);
      box-shadow: 0 7px 22px rgba(24,22,18,0.26);
    }

    .btn-apply:active { transform: scale(0.97) translateY(0); }

    .btn-apply .fa-arrow-right {
      transition: all 0.2s ease;
      font-size: 12px;
    }
    .btn-apply:hover .fa-arrow-right {  }


    /* ── APPLIED ── */
    .btn-applied {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 0 30px;
      height: 50px;
      background: #eaf4ef;
      color: #1a6b4a;
      font-family: 'Sora', sans-serif;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      border: 1.5px solid rgba(26,107,74,0.22);
      border-radius: 4px;
      cursor: default;
      animation: popIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both;
    }

    @keyframes popIn {
      from { opacity: 0; transform: scale(0.9); }
      to   { opacity: 1; transform: scale(1); }
    }

    .check-ring {
      width: 22px;
      height: 22px;
      background: #1a6b4a;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      animation: checkPop 0.35s 0.08s cubic-bezier(0.34,1.56,0.64,1) both;
    }

    @keyframes checkPop {
      from { transform: scale(0) rotate(-30deg); }
      to   { transform: scale(1) rotate(0deg); }
    }

    .check-ring i {
      font-size: 10px;
      color: #fff;
    }

    .btn-apply i.fa-paper-plane {
      font-size: 13px;
    }




    .contact-wrapper {
      width: 100%;
      max-width: 960px;
    }
 
    .contact-card {
      background:white;
      border-radius: 16px;
      padding: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      border: 1px solid #e4e7ec;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      position: relative;
      overflow: hidden;
    }
 
    .contact-icon-wrap {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #f0f2f5;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.25rem;
      border: 2px solid #e4e7ec;
      transition: background 0.25s ease, border-color 0.25s ease;
    }
 
    .contact-card:hover .contact-icon-wrap {
      background: #1a1a2e;
      border-color: #1a1a2e;
    }
 
    .contact-icon-wrap i {
      font-size: 10px;
      color: #1a1a2e;
      transition: color 0.25s ease;
    }
 
    .contact-card:hover .contact-icon-wrap i {
      color: #ffffff;
    }
 
    .contact-label {
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: #9ca3af;
      margin-bottom: 0.4rem;
    }
 
    .contact-value {
      font-size: 1rem;
      color: #1a1a2e;
      font-weight: 500;
      word-break: break-word;
    }
 
    .divider {
      width: 1px;
      background: #e4e7ec;
      align-self: stretch;
    }
 
    @media (max-width: 767px) {
      .divider { display: none; }
      .contact-card { margin-bottom: 1rem; }
    }


</style>



@endsection


@section('content')


<div class="container-lg my-5 py-5 px-3 px-md-4">

  <!-- Breadcrumb -->


  
  <div class="row g-4">


     <div class="col-lg-12 text-center">
        <h2>{{ $job->designation->name }} vacancy at {{ $job->company->name }}</h2>
     </div>

    <!-- ══════════════ LEFT — JOB DETAIL ══════════════ -->
    <div class="col-lg-8">
      <div class="job-panel">

        <!-- Header -->
        <div class="job-header">
          <div class="d-flex align-items-start gap-3">
            <div class="company-logo">
              
            <img src="{{ $job->company->logo 
                        ? asset('storage/'.$job->company->logo) 
                        : asset('assets/img/job/default.jpg') }}" 
                     alt="{{ $job->company->name }}" 
                     width="100%">

            </div>
            <div>
              <div class="job-title">{{ $job->title }}</div>
              <div class="company-name">
                at <a href="#">{{ $job->company->name }}</a> &nbsp;·&nbsp; Posted {{ $job->created_at->diffForHumans() }}
              </div>
            </div>
            <div class="ms-auto d-none d-sm-flex align-items-center gap-2">
              <span class="badge-new">New</span>
            </div>
          </div>
        </div>

        <!-- Meta grid -->
        <div class="meta-grid">
          <div class="meta-item">
            <div class="meta-icon"><i class="fa-solid fa-location-dot"></i></div>
            <div>
              <div class="meta-label">Locations</div>
              
            <div class="meta-value"> @if($job->districts->count() > 0)
                    {{ $job->districts->pluck('name')->implode(', ') }}
                     @endif
             </div>

            </div>
          </div>
          <div class="meta-item">
            <div class="meta-icon"><i class="fa-solid fa-calendar-days"></i></div>
            <div>

    <div class="meta-label">Date Posted</div>

    <div class="meta-value">
        {{ $job->created_at->format('d M Y') }}
       
        </div>
      </div>


          </div>



          @if($job->qualification)
          <div class="meta-item">

              <div class="meta-icon">
                  <i class="fa-solid fa-briefcase"></i>
              </div>

              <div>
                  <div class="meta-label">Min. Qualification</div>
                  <div class="meta-value">
                      {{ $job->qualification }}
                  </div>
              </div>

          </div>
          @endif



          @if($job->min_experience)
          <div class="meta-item">
              <div class="meta-icon">
                  <i class="fa-solid fa-briefcase"></i>
              </div>

              <div>
                  <div class="meta-label">Min. Experience</div>

                  <div class="meta-value">
                      {{ $job->min_experience }}
                  </div>
              </div>
          </div>
          @endif


          @if($job->max_age)
          <div class="meta-item">
              <div class="meta-icon">
                  <i class="fa-solid fa-user"></i>
              </div>

              <div>
                  <div class="meta-label">Max. Age</div>

                  <div class="meta-value">
                      {{ $job->max_age }} Y
                  </div>
              </div>
          </div>
          @endif

         
        </div>

        <!-- Tags -->
        @php /*
        <div class="tags-row">
          <span class="tag"><i class="fa-solid fa-clock"></i> Full-time</span>
          <span class="tag"><i class="fa-solid fa-laptop"></i> Remote</span>
          <span class="tag">React</span>
          <span class="tag">TypeScript</span>
          <span class="tag">Next.js</span>
          <span class="tag">GraphQL</span>
        </div>
        */ @endphp

        <!-- Description -->
        <div class="job-body job-desc">

        <div class="section-heading">About the Role</div>


        @php
          $employeeLocations = auth('employee')->check()
              ? auth('employee')->user()->employee->locations->pluck('id')->toArray()
              : [];

          $jobLocations = $job->districts->pluck('id')->toArray();

          $locationAllowed = count(array_intersect($employeeLocations, $jobLocations)) > 0;
      @endphp


        @if(auth('employee')->check() && $locationAllowed)

        {!! $job->description !!}

        @elseif(auth('employee')->check() && !($locationAllowed))


         <div class="wrapper">

      <!-- ① LOCK GATE -->
      <div class="gate">
        <div class="gate-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>

        <div class="gate-text">
          <p class="gate-eyebrow">Location unavilable</p>
          <h2 class="gate-title">This location is restricted for your profile</h2>
          <p class="gate-sub">You can only view jobs in your selected locations</p>
        </div>

        <div class="gate-actions">

         
        </div>
      </div>


      <!-- ② BLURRED PREVIEW -->
      <div class="preview-card">
        <div class="preview-inner">

          <h3 class="preview-title">Lorem Ipsum Dolor</h3>
          <p class="preview-company">Lorem Ipsum · Banglore, Karnataka</p>


          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum euismod faucibus commodo. Fusce pellentesque nulla arcu, in sodales nulla varius eget. Sed ut facilisis enim. Phasellus lacus dui, egestas vel massa in, molestie egestas nibh. Sed facilisis euismod elit, id sagittis dolor porta in. Maecenas nisi lorem, finibus sed euismod nec, auctor sit amet nisi. Curabitur dignissim semper blandit.</p>

          <div class="preview-divider"></div>

          <div class="bar" style="width:92%"></div>
          <div class="bar" style="width:78%"></div>
          <div class="bar" style="width:85%"></div>
          <div class="bar" style="width:60%"></div>

          <div class="preview-actions-row" style="margin-top:20px">
            <div class="fake-btn" style="width:150px"></div>
            <div class="fake-btn" style="width:100px; background:#f5f1eb;"></div>
          </div>

        </div>

      
       </div>

       </div>


      @elseif(auth('employee')->guest() && auth('employer')->guest())


      <div class="wrapper">

      <!-- ① LOCK GATE -->
      <div class="gate">
        <div class="gate-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>

        <div class="gate-text">
          <p class="gate-eyebrow">Members only</p>
          <h2 class="gate-title">Unlock full details &amp; apply</h2>
          <p class="gate-sub">Log in and subscribe to view requirements &amp; apply.</p>
        </div>

        <div class="gate-actions">


          <a href="{{route('login')}}" class="book-n-btn">
          <i class="fa fa-user" aria-hidden="true"></i> Login 
          </a>
         
        </div>
      </div>

      <!-- connector dot -->
      <div class="connector">
        <div class="connector-line"></div>
        <div class="connector-dot"></div>
      </div>

      <!-- ② BLURRED PREVIEW -->
      <div class="preview-card">
        <div class="preview-inner">

          <h3 class="preview-title">Lorem Ipsum Dolor</h3>
          <p class="preview-company">Lorem Ipsum · Banglore, Karnataka</p>


          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum euismod faucibus commodo. Fusce pellentesque nulla arcu, in sodales nulla varius eget. Sed ut facilisis enim. Phasellus lacus dui, egestas vel massa in, molestie egestas nibh. Sed facilisis euismod elit, id sagittis dolor porta in. Maecenas nisi lorem, finibus sed euismod nec, auctor sit amet nisi. Curabitur dignissim semper blandit.</p>

          <div class="preview-divider"></div>

          <div class="bar" style="width:92%"></div>
          <div class="bar" style="width:78%"></div>
          <div class="bar" style="width:85%"></div>
          <div class="bar" style="width:60%"></div>

          <div class="preview-actions-row" style="margin-top:20px">
            <div class="fake-btn" style="width:150px"></div>
            <div class="fake-btn" style="width:100px; background:#f5f1eb;"></div>
          </div>

        </div>

      
       </div>

       </div>

        @endif



        </div>



         @if(auth('employee')->check())

        <!-- Apply bar -->
        <div class="apply-bar">
          <div class="d-flex gap-2 w-100">


            @php
            $applied = $job->applications()
                    ->where('profile_id',auth('employee')->id())
                    ->exists();
            @endphp

          @if($applied)


          @php
          $creator = $job->createdBy;
          @endphp


          @if($creator && $creator->designation == 'hr')

          <div class="btn-applied">
          <div class="check-ring">
          <i class="fa-solid fa-check"></i>
          </div>
            Applied
          </div>

          @else
              

          @if(auth('employee')->check() && $locationAllowed)

           <div class="contact-wrapper">
                <div class="row g-3 align-items-stretch">
            
                  <!-- Name -->
                  <div class="col-12 col-md-4">
                    <div class="contact-card h-100">
                      <div class="contact-icon-wrap">
                        <i class="fa-solid fa-user"></i>
                      </div>
                      <div class="contact-label">Contact Name</div>
                      <div class="contact-value">{{$job->contact_name}}</div>
                    </div>
                  </div>
            
                  <!-- Phone -->
                  <div class="col-12 col-md-4">
                    <div class="contact-card h-100">
                      <div class="contact-icon-wrap">
                        <i class="fa-solid fa-phone"></i>
                      </div>
                      <div class="contact-label">Phone Number</div>
                      <div class="contact-value">{{$job->contact_phone}}</div>
                    </div>
                  </div>
            
                  <!-- Email -->
                  <div class="col-12 col-md-4">
                    <div class="contact-card h-100">
                      <div class="contact-icon-wrap">
                        <i class="fa-solid fa-envelope"></i>
                      </div>
                      <div class="contact-label">Email Address</div>
                      <div class="contact-value">{{$job->contact_email}}</div>
                    </div>
                  </div>
            
                </div>
              </div>

              @endif

          @endif



          @else




          @auth('employee')

          @if(auth('employee')->check() && $locationAllowed)

          @php
          $employee = auth('employee')->user();
          @endphp
            
          @if(!$employee->employee->cv)

          <button class="btn-apply" style="background:red;">

              <i class="fa-regular fa-lock me-2"></i>
               Upload Resume to Apply
              <i class="fa-solid fa-arrow-right"></i>
            </button>
            @else

            
            @php
            $creator = $job->createdBy;
            @endphp

            @if($creator && $creator->designation == 'hr')

            <form action="{{ route('employee.job.apply',$job->id) }}" method="POST">
            @csrf

            <button class="btn-apply">
              <i class="fa-regular fa-paper-plane"></i>
              Apply Now
              <i class="fa-solid fa-arrow-right"></i>
            </button>

          </form>

            @else

            <form action="{{ route('employee.job.apply',$job->id) }}" method="POST">
            @csrf

            <button class="btn-apply">
              <i class="fa-regular fa-eye"></i>
              Show Contact Details
              <i class="fa-solid fa-arrow-right"></i>
            </button>

            </form>

            @endif




            @endif


            @endif

            @endauth

            @endif

            
          </div>
        </div>

        @endif

        

      </div>
    </div><!-- /col-lg-8 -->


    <!-- ══════════════ RIGHT — RELATED JOBS ══════════════ -->
    <div class="col-lg-4">
      <div class="right-col">


        <div class="related-heading">Related Jobs</div>

        @foreach($related as $job)
        <!-- Card 1 -->
        <a href="#" class="job-card featured">
          <div class="d-flex align-items-center gap-2 mb-2">

                    <div class="card-logo"><img src="{{ $job->company->logo 
                        ? asset('storage/'.$job->company->logo) 
                        : asset('assets/img/job/default.jpg') }}" 
                     alt="{{ $job->company->name }}" 
                     width="100%">
                    </div>

            <div>
              <div class="card-title">{{ $job->designation->name }}</div>
              <div class="card-company">{{ $job->company->name }}</div>
            </div>
            <span class="badge-new ms-auto">New</span>
          </div>
          <div class="card-meta">

            <span class="card-pill"><i class="fa-solid fa-location-dot"></i> 
            @if($job->districts->count() > 0)
                    {{ $job->districts->pluck('name')->implode(', ') }}
            @endif
            </span>

          </div>
        </a>
        @endforeach


      </div>
    </div><!-- /col-lg-4 -->

  </div><!-- /row -->
</div><!-- /container -->
       

@endsection