<?php
/**
 * Anew Era TMS & Psychiatry — Landing Page
 * Clinical / professional build. Tailwind CSS (Play CDN). Content from aneweratms.com
 */

$PHONE     = '(855) 562-0794';
$PHONE_RAW = '8555620794';

/* Photography is stored locally in assets/photos/ as "<id>-<w>x<h>.jpg".
   Nothing is fetched from a third-party CDN at render time. The $q argument is
   retained so existing call sites keep working; quality is baked into the file. */
function img(string $id, int $w = 900, int $h = 700, int $q = 80): string {
    return "assets/photos/{$id}-{$w}x{$h}.jpg";
}
$IMG = [
    'hero'    => '1758691461957-474a7686e388', // physician consulting with patient
    'hope'    => '1634498754740-b6c5df206842', // patient in profile, reflective
    'tms'     => '1758691461990-03b49d969495', // clinician reviewing chart with patient
    'therapy' => '1739285388427-d6f85d12a8fc', // therapy / counseling session
    'calm'    => '1638136630741-ea30b45d4516', // patient, hopeful, natural light
    'family'  => '1770775776141-6b3ac7ef9dd3', // clinic corridor
    'consult' => '1739285452629-2672b13fa42d', // clinician in conversation
    'clinic'  => '1781513144825-aa1e284c5950', // clinical treatment room
    'quote'   => '1652226825940-46ad2a55d132', // patient portrait (testimonial)
    'med'     => '1758691461935-202e2ef6b69f', // physician at desk
    'window'  => '1776886099265-6366478b341b', // waiting area
    'light'   => '1779281887548-f676406dea2f', // clinic interior
    'people'  => '1653512488909-e204afcc8495', // patient, smiling
    'ketamine'=> '1763310225009-50214e3c99d9', // IV infusion line, clinical setting
];

/* ---------- Hero background ----------------------------------------------
 * Use a wide, landscape shot (min 1920×1080). The copy sits on the left under
 * a near-opaque navy scrim and the consultation form covers the right column
 * on desktop, so the middle of the frame is the part that actually reads.
 * assets/bg-image/neurons-hero.jpg is the previous abstract background.
 * ------------------------------------------------------------------------ */
$HERO_BG = 'assets/bg-image/hero-option-a-three-adults.jpg';

/* Brand logo. The supplied .webp is 300×87 with an opaque white background, so a
   white-knockout PNG with a real alpha channel was generated from it for use on
   dark surfaces (see assets/logo/new-era-logo-white.png). */
$LOGO       = 'assets/logo/new-era-logo.webp';        // full colour — for light surfaces
$LOGO_WHITE = 'assets/logo/new-era-logo-white.png';   // white knockout — for dark surfaces

/* Real clinic interior photo */
$LOCATION_IMG = 'assets/location/new-era-tms-location.webp';

/* ---------- TMS treatment photography ----------
 * Real photographs from the clinic, on the Magstim Horizon platform. The
 * product cutout (H3 SG PRO image website 13024.png) is still in
 * assets/tms-device/ but is no longer rendered anywhere.
 * ------------------------------------------------------------------ */
$TMS_CARD_IMG   = 'assets/tms-device/tms-newera.webp';     // clinician positioning the coil
$TMS_DEVICE_IMG = 'assets/tms-device/tms-new-era-2.jpg';   // patient mid-treatment, coil in place

/* ---------- Lead capture (stub) ---------- */
$formSent = false; $formErr = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lead_form'])) {
    $name  = trim($_POST['name']  ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $zip   = trim($_POST['zip']   ?? '');
    if ($name === '' || $phone === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErr = 'Please enter your name, a valid email address, and a phone number.';
    } elseif (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
        $formErr = 'Please enter a valid 5-digit ZIP code so we can route you to the nearest clinic.';
    } else {
        // TODO: wire to CRM / mail() / webhook
        $formSent = true;
    }
}

/* [title, description, image id] */
$conditions = [
    ['Depression','More than a bad or sad mood — a real disorder with physical and mental symptoms.','1486002113024-43b2ce358eb0'],
    ['Anxiety','Intense fear and worry that becomes exhausting to live with, day after day.','1610354878912-08f1ab8ae913'],
    ['PTSD','Trauma of many forms can lead to post-traumatic stress disorder.','1510260775793-169be61ebe50'],
    ['OCD','Obsessive-compulsive disorder built on repetitive, intrusive thoughts.','1501556466850-7c9fa1fccb4c'],
    ['Postpartum Depression','A form of depression that often affects new mothers after childbirth.','1542385151-efd9000785a0'],
    ['Migraines','Severe headaches driven by a complex underlying neurological condition.','1507875650466-196f39058c13'],
    ['Tinnitus','A chronic hearing condition producing constant buzzing or ringing.','1596088728260-08a654466a00'],
    ['Treatment-Resistant Cases','When multiple medications have failed, a different mechanism of action may be indicated.','1563213126-a4273aed2016'],
];

/* [number, timing tag, title, body] */
$steps = [
    ['01','Same day','Free consultation','Speak with our team the day you call. We review your history, answer your questions and verify your insurance benefits at no cost.'],
    ['02','Within 1–5 days','Psychiatric evaluation','A full evaluation with a board-certified psychiatrist or psychiatric nurse practitioner establishes your diagnosis and treatment plan.'],
    ['03','First session','Brain mapping','Using StimGuide PRO neuronavigation, we locate the brain\'s mood center precisely and calibrate the magnetic pulse to your individual anatomy.'],
    ['04','Weeks 1–6','Treatment course','Forty-minute sessions, five days per week, for three to six weeks. No anesthesia, no sedation and no recovery time between sessions.'],
];

/* How TMS works — mechanism, in three stages */
$mechanism = [
    ['01','Focused magnetic pulses','A coil positioned against the scalp delivers precisely targeted magnetic fields. There is no incision, no sedation and no medication involved.','M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8'],
    ['02','Nerve cells are stimulated','Those fields induce a gentle electrical current that activates nerve cells in the prefrontal cortex — the region of the brain that governs mood.','M4 12h3l2-5 3 10 2.5-7 1.5 4h4'],
    ['03','Mood circuitry re-engages','Areas that slowed under depression become active again, rebalancing the circuits underlying mood, concentration, energy and sleep.','M12 3a9 9 0 109 9M12 3v9l6.4 3.2'],
];

/* [title, description, bullets, image src, object-fit, object-position (optional)]
   The cards crop the image to a wide band, so portraits whose subject sits high
   in the frame need 'object-top' or the head is cut off. */
$services = [
    ['TMS Therapy','FDA-cleared magnetic stimulation targeting the brain\'s mood center. Non-invasive, drug-free and covered by most insurance plans.',['Magstim Horizon® with StimGuide PRO','Standard and Theta Burst protocols','Covered by most major plans'],
     $TMS_CARD_IMG, 'cover'],
    ['Medication Management','Board-certified psychiatrists and psychiatric nurse practitioners managing your diagnosis, prescribing and ongoing adjustment over time.',['Comprehensive psychiatric evaluation','Ongoing review and adjustment','Same-week availability'],
     img($IMG['med'], 900, 560), 'cover', 'object-top'],
    ['Ketamine Therapy','Rapid-acting treatment for treatment-resistant depression, administered and monitored in a clinical setting.',['Esketamine (SPRAVATO®)','Clinically supervised administration','For treatment-resistant depression'],
     img($IMG['ketamine'], 900, 560), 'cover'],
    ['Psychotherapy','Licensed therapists providing in-person and online sessions, coordinated with your medical care under one roof.',['In-person or virtual sessions','Licensed clinicians','Integrated with your treatment plan'],
     $LOCATION_IMG, 'cover', 'object-center'],
];

$stats = [
    ['1M+','TMS treatments delivered in the United States'],
    ['15','Clinics across California and Texas'],
    ['10','Days or less to your first appointment'],
    ['0','Days of recovery time after a session'],
];

$faqs = [
    ['How quickly can I be seen?','For TMS we can often schedule a consultation the same day. A full psychiatric evaluation and the start of treatment typically occur within one to five business days.'],
    ['Is TMS covered by insurance?','Yes. We are in-network with most major insurers, including Aetna, Anthem, Blue Cross, Blue Shield, Cigna and Evernorth, GEHA, Health Net, Humana, Medicare, MHNet Behavioral Health, Optum, Oscar Health, Scott &amp; White Health Plan (Texas only), TRICARE, TriWest and UnitedHealthcare (UHC / UBH). We do not accept Medicaid. Competitive cash-pay options are available.'],
    ['Does TMS hurt, and are there side effects?','TMS is non-invasive and requires no anesthesia or sedation. Most patients describe a light tapping sensation on the scalp. Because no medication enters the bloodstream, TMS avoids the systemic side effects commonly associated with antidepressants.'],
    ['How long is the full course of treatment?','Most patients complete treatment within three to six weeks, attending forty-minute sessions five times per week. Patients may drive themselves and return to work or school immediately afterward.'],
    ['What conditions do you treat?','Depression, anxiety, PTSD, OCD, postpartum depression, migraines and tinnitus, along with other conditions identified during the psychiatric evaluation.'],
    ['What TMS equipment do you use?','Our clinics treat on the Magstim Horizon® TMS platform with StimGuide PRO neuronavigation. StimGuide PRO tracks the position of the treatment coil in real time against the brain map created during your session, so treatment is delivered to the same cortical target at consistent intensity throughout your course of care.'],
    ['What if I have already tried medication?','TMS is specifically indicated for patients who have not responded adequately to antidepressant medication. It targets the brain directly and represents a different mechanism of treatment.'],
];

/* Accepted insurance. [display name, logo file in assets/insurances/ or null, note]
   Entries without artwork fall back to a text cell so the list stays complete. */
$INS_DIR = 'assets/insurances/';
/* Patient reviews — verbatim excerpts from Google reviews of the Austin clinic.
   "…" marks omitted text. [name, meta, when, excerpt] */
$reviews = [
    ['Mark Kobdish','2 reviews','a month ago',
     'Greg was a wonderful technician who provided the majority of my treatments. He was consistently pleasant and made sure I was comfortable, and very professional throughout.'],
    ['Tommy Miserendino','Local Guide · 76 reviews','4 months ago',
     'It was easy to schedule the appointments and they took my insurance… each person made sure I understood what TMS was, possible side-effects, and what to expect for treatment… No issues, straight-forward explanations about treatment, overall great experience.'],
    ['Wendy Douglas','Local Guide · 24 reviews','4 months ago',
     'So easy to take great care of your mental health, scheduling is totally stress free, online appts make is stress free as well… The providers take excellent care of me, I feel comfortable talking to them, Rx refills are immediate. Very happy patient here!!!'],
    ['Madeline Rowe','Local Guide · 19 reviews','9 months ago',
     'Laura Beaufford has been such a blessing in my mental health journey… She listens deeply, remembers details, and tailors care with genuine thoughtfulness… I always leave our sessions feeling lighter, understood, and hopeful.'],
    ['Brianna Shaffer','5 reviews','a year ago',
     'From the moment I first reached out, the team was incredibly welcoming and supportive… The progress I\'ve made is noticeable, and I genuinely feel more empowered and equipped to handle life\'s ups and downs.'],
    ['Misha Burgardt','1 review','2 years ago',
     'TMS has been completely life-changing in terms of my depression and anxiety. I highly recommend it to anyone who needs relief they haven\'t been able to find anywhere else.'],
];

$insurers = [
    ['Aetna',                       'aetna.webp',           ''],
    ['Anthem',                      'anthem.webp',          ''],
    ['Blue Cross',                   null,                  ''],
    ['Blue Shield',                 'blue-california.webp', ''],
    ['Cigna',                       'cigna.webp',           ''],
    ['Evernorth',                   'evernorth-logo.png',   ''],
    ['GEHA',                         null,                  'Government Employees Health Association'],
    ['Health Net',                  'health-net.png',       ''],
    ['Humana',                       null,                  ''],
    ['Medicare',                    'medicare.webp',        ''],
    ['MHNet Behavioral Health',     'mhn.webp',             ''],
    ['Optum',                       'optum.webp',           ''],
    ['Oscar Health',                 null,                  ''],
    ['Scott &amp; White Health Plan', null,                 'Texas only'],
    ['TRICARE',                     'tricare.webp',         ''],
    ['TriWest',                     'triwest.png',          ''],
    ['UnitedHealthcare',            'unitedhealthcare.png', 'UHC / UBH'],
];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Anew Era TMS &amp; Psychiatry — TMS Therapy for Depression, Anxiety &amp; PTSD</title>
<meta name="description" content="FDA-cleared TMS therapy, psychiatry and talk therapy for depression, anxiety, PTSD and OCD. Accepting new patients and most major insurance. Appointments within 10 days.">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        navy:  { DEFAULT:'#0F2440', 900:'#0A1A30', 800:'#132C4E', 700:'#1B3A63', 600:'#27507F' },
        steel: { 50:'#F4F6F9', 100:'#E9EDF3', 200:'#D8DFE9', 300:'#B9C4D3', 400:'#8494AB', 500:'#5B6B82', 600:'#475569' },
        /* med-600 is the logo's ocean blue; the rest of the scale is built around it. */
        med:   { 50:'#EFF7FB', 100:'#D7EBF5', 200:'#AFD5E9', 300:'#7BB8D6', 400:'#3F93BF', 500:'#1573A6', 600:'#0F639B', 700:'#0B4E7B' },
        /* The logo's orange. 2.4:1 on white, so it is never used for text on a light
           surface — only on navy, or as a non-text rule. */
        brand: { orange:'#E8922F', green:'#86BE52' },
        sky:   { 400:'#38BDF8', 500:'#0EA5E9', 600:'#0284C7' },
      },
      fontFamily: { sans:['"IBM Plex Sans"','system-ui','sans-serif'] },
      letterSpacing: { tightest:'-.03em' },
      boxShadow: {
        card: '0 1px 2px rgba(15,36,64,.05)',
        pop:  '0 8px 24px -12px rgba(15,36,64,.20)',
      },
      keyframes: { marquee:{'0%':{transform:'translateX(0)'},'100%':{transform:'translateX(-50%)'}} },
      animation: { marquee:'marquee 38s linear infinite' },
    }
  }
}
</script>

<style>
  body{ -webkit-font-smoothing:antialiased; }
  .reveal{ opacity:0; transform:translateY(18px); transition:opacity .7s ease, transform .7s ease; }
  .reveal.in{ opacity:1; transform:none; }
  .eyebrow{ font-size:11.5px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; }
  details[open] .chev{ transform:rotate(180deg); }
  ::selection{ background:#AFD5E9; color:#0F2440; }
  .no-bar::-webkit-scrollbar{ display:none; }

  /* ── Mobile card sliders ───────────────────────────────────────────────
     Below md the card grids scroll horizontally with snap points instead of
     stacking, so the phone page does not run to a dozen screens. At md and
     up the original grid takes over untouched. The class is doubled to
     out-specify the Tailwind display/gap utilities on the same element,
     which the Play CDN injects after this stylesheet. */
  @media (max-width: 767.98px){
    .cards-slider.cards-slider{
      display:flex;
      gap:1rem;
      overflow-x:auto;
      overscroll-behavior-x:contain;
      scroll-snap-type:x mandatory;
      scroll-padding-inline:1.5rem;
      /* full-bleed track, first card still aligned to the page gutter */
      margin-inline:-1.5rem;
      padding-inline:1.5rem;
      padding-bottom:.5rem;
      scrollbar-width:none;
    }
    .cards-slider.cards-slider::-webkit-scrollbar{ display:none; }
    /* 84% leaves the next card peeking, which is the swipe affordance */
    .cards-slider.cards-slider > *{
      scroll-snap-align:start;
      flex:0 0 84%;
      max-width:84%;
    }
  }
  .rule{ border-top:3px solid #E8922F; width:44px; }

  /* ── Header: transparent over the hero → white once scrolled ───────────── */
  #topbar{ max-height:2.5rem; opacity:1; transition:max-height .3s ease, opacity .25s ease; overflow:hidden; }
  #nav{ transition:background-color .3s ease, box-shadow .3s ease; }
  #nav.scrolled{
    background:#ffffff;
    box-shadow:0 1px 0 #E2E8F0, 0 12px 30px -20px rgba(15,36,64,.35);
  }
  #nav.scrolled #topbar{ max-height:0; opacity:0; border-color:transparent; }

  /* Logo crossfades: white knockout over the hero, full colour on the white bar */
  .logo-white,.logo-color{ transition:opacity .3s ease; }
  #nav.scrolled .logo-white{ opacity:0; }
  #nav.scrolled .logo-color{ opacity:1; }

  /* White-bar state: recolour everything that was tuned for the dark bar */
  #nav.scrolled .nav-link{ color:#475569; }
  #nav.scrolled .nav-link:hover{ color:#0F639B; }
  #nav.scrolled .nav-underline{ background:#0F639B; }
  #nav.scrolled .nav-phone{ border-color:#D8DFE9; color:#0F2440; }
  #nav.scrolled .nav-phone:hover{ background:#F4F6F9; border-color:#B9C4D3; }
  #nav.scrolled .nav-burger{ border-color:#D8DFE9; color:#0F2440; }
  #nav.scrolled #mobileNav{ background:#ffffff; border-color:#E2E8F0; }
  #nav.scrolled .nav-mlink{ color:#475569; border-color:#E2E8F0; }
  #nav.scrolled .nav-mphone{ border-color:#D8DFE9; color:#0F2440; }
</style>
</head>

<body class="bg-white text-navy font-sans">

<!-- ═══ HEADER (transparent over hero, solid on scroll) ═══ -->
<header id="nav" class="fixed inset-x-0 top-0 z-50 transition-colors duration-300">

  <!-- utility bar -->
  <div id="topbar" class="border-b border-white/10 text-[13px] text-steel-300">
    <div class="mx-auto max-w-[82rem] px-6 h-10 flex items-center justify-between">
      <p class="hidden sm:block">Accepting new patients &amp; most major insurance plans</p>
      <div class="flex items-center gap-6 mx-auto sm:mx-0">
        <span class="hidden md:inline">15 clinics across CA &amp; TX</span>
        <a href="tel:<?= $PHONE_RAW ?>" class="font-semibold text-white hover:text-med-200 transition"><?= $PHONE ?></a>
      </div>
    </div>
  </div>

  <!-- main bar -->
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="flex items-center justify-between h-[76px]">

      <a href="#" class="relative block h-11 w-[152px] shrink-0" aria-label="Anew Era TMS &amp; Psychiatry — home">
        <img src="<?= $LOGO_WHITE ?>" alt="Anew Era TMS &amp; Psychiatry" width="300" height="87"
             class="logo-white absolute inset-0 h-full w-auto">
        <img src="<?= $LOGO ?>" alt="" aria-hidden="true" width="300" height="87"
             class="logo-color absolute inset-0 h-full w-auto opacity-0">
      </a>

      <nav class="hidden lg:flex items-center gap-8 text-[14.5px] font-medium text-white/75">
        <?php foreach ([['TMS Therapy','#tms'],['Conditions','#conditions'],['How It Works','#process'],['Services','#services'],['Reviews','#reviews'],['FAQ','#faq']] as $l): ?>
        <a href="<?= $l[1] ?>" class="nav-link group relative py-2 hover:text-white transition-colors">
          <?= $l[0] ?>
          <span class="nav-underline absolute inset-x-0 bottom-0 h-[2px] origin-left scale-x-0 rounded-full bg-med-400 transition-transform duration-300 group-hover:scale-x-100"></span>
        </a>
        <?php endforeach; ?>
      </nav>

      <div class="flex items-center gap-3">
        <a href="tel:<?= $PHONE_RAW ?>" class="nav-phone hidden xl:flex items-center gap-2.5 rounded-lg border border-white/20 px-4 py-2.5 text-[14.5px] font-semibold text-white hover:bg-white/10 hover:border-white/35 transition">
          <svg viewBox="0 0 24 24" class="h-4 w-4 text-med-300" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
          <?= $PHONE ?>
        </a>
        <a href="#book" class="hidden sm:inline-flex items-center gap-2 rounded-lg bg-med-500 px-5 py-2.5 text-[14.5px] font-semibold text-white hover:bg-med-400 transition">
          Book Appointment
        </a>
        <button id="burger" class="nav-burger lg:hidden grid place-items-center h-11 w-11 rounded-lg border border-white/20 text-white" aria-label="Menu" aria-expanded="false">
          <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- mobile panel -->
  <div id="mobileNav" class="hidden lg:hidden bg-navy-900/98 backdrop-blur-xl border-t border-white/10">
    <div class="mx-auto max-w-[82rem] px-6 py-5 grid">
      <?php foreach ([['TMS Therapy','#tms'],['Conditions Treated','#conditions'],['How It Works','#process'],['Services','#services'],['Reviews','#reviews'],['FAQ','#faq']] as $l): ?>
      <a href="<?= $l[1] ?>" class="nav-mlink py-3 text-[16px] font-medium text-white/80 border-b border-white/10"><?= $l[0] ?></a>
      <?php endforeach; ?>
      <div class="mt-5 grid gap-3">
        <a href="tel:<?= $PHONE_RAW ?>" class="nav-mphone rounded-lg border border-white/25 py-3.5 text-center text-[15px] font-semibold text-white"><?= $PHONE ?></a>
        <a href="#book" class="rounded-lg bg-med-500 py-3.5 text-center text-[15px] font-semibold text-white">Book Appointment</a>
      </div>
    </div>
  </div>
</header>


<!-- ═══ HERO (copy + consultation form) ═══ -->
<section class="relative isolate overflow-hidden bg-navy">

  <img src="<?= htmlspecialchars($HERO_BG) ?>" alt=""
       class="absolute inset-0 -z-10 h-full w-full object-cover object-center">
  <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy-900/85 via-navy-900/65 to-navy-900/30"></div>
  <div class="absolute inset-0 -z-10 bg-gradient-to-t from-navy-900/75 via-transparent to-navy-900/45"></div>

  <div class="mx-auto max-w-[82rem] px-6 pt-[8.5rem] pb-0 lg:pt-[10rem]">
    <div class="grid lg:grid-cols-[1.02fr_.98fr] gap-10 lg:gap-14 items-start">

      <!-- copy -->
      <div class="reveal lg:pt-4">
        <div class="inline-flex items-center gap-2.5 rounded border border-white/25 bg-white/10 px-3 py-1.5 text-[12.5px] font-medium text-white backdrop-blur-sm">
          <svg viewBox="0 0 24 24" class="h-4 w-4 text-med-200" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l8 4v6c0 5-3.5 7.5-8 8-4.5-.5-8-3-8-8V7z"/><path d="M9 12l2 2 4-4"/></svg>
          FDA-cleared · Over 1 million treatments delivered in the U.S.
        </div>

        <h1 class="mt-6 text-[2.5rem] sm:text-[3.1rem] lg:text-[3.5rem] font-bold leading-[1.06] tracking-tightest text-white">
          Clinically proven relief from depression, anxiety and PTSD.
        </h1>

        <p class="mt-5 text-[17px] leading-[1.7] text-steel-200 max-w-xl">
          When medication has not worked, Transcranial Magnetic Stimulation offers a different path —
          non-invasive, drug-free, no recovery time.
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-3">
          <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-white/35 bg-white/5 px-6 py-3.5 text-[15px] font-semibold text-white backdrop-blur-sm hover:bg-white/15 transition">
            <svg viewBox="0 0 24 24" class="h-4 w-4 text-med-300" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
            Call <?= $PHONE ?>
          </a>
          <a href="#tms" class="inline-flex items-center gap-2 text-[15px] font-semibold text-white/80 hover:text-white transition">
            How TMS works
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>

      </div>

      <!-- consultation form -->
      <div id="book" class="reveal scroll-mt-[92px]">
        <div class="rounded-xl border border-white/25 bg-white/10 backdrop-blur-2xl p-6 sm:p-7 shadow-2xl shadow-navy-900/60">
          <?php if ($formSent): ?>
            <div class="py-14 text-center">
              <div class="mx-auto grid place-items-center h-14 w-14 rounded-full bg-white/15 border border-white/30 text-white">
                <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              </div>
              <p class="mt-5 text-[1.4rem] font-bold tracking-tightest text-white">Request received</p>
              <p class="mt-3 text-[15px] leading-relaxed text-steel-200 max-w-sm mx-auto">
                A care coordinator will contact you shortly. To speak with someone now, call
                <a href="tel:<?= $PHONE_RAW ?>" class="font-semibold text-white underline underline-offset-4"><?= $PHONE ?></a>.
              </p>
            </div>
          <?php else: ?>
            <div class="flex items-start justify-between gap-4 pb-5 border-b border-white/20">
              <div>
                <h2 class="text-[1.3rem] font-bold tracking-tightest text-white">Request a free consultation</h2>
                <p class="mt-1.5 text-[13.5px] text-steel-200">We verify your insurance benefits at no cost.</p>
              </div>
              <span class="shrink-0 rounded border border-white/30 bg-white/15 px-2.5 py-1 text-[11px] font-semibold text-white tracking-wide">NO COST</span>
            </div>

            <form method="post" class="mt-5 grid gap-4">
              <input type="hidden" name="lead_form" value="1">
              <?php if ($formErr): ?>
                <p class="rounded border border-red-300/40 bg-red-500/20 px-4 py-3 text-[13.5px] text-red-100"><?= htmlspecialchars($formErr) ?></p>
              <?php endif; ?>

              <div class="grid sm:grid-cols-2 gap-4">
                <label class="block">
                  <span class="text-[12.5px] font-semibold text-white">Full name <span class="text-red-300">*</span></span>
                  <input name="name" required placeholder="Jane Doe" class="mt-1.5 w-full rounded-md border border-white/25 bg-white/10 px-3.5 py-2.5 text-[15px] text-white placeholder-white/60 outline-none focus:border-white/60 focus:bg-white/15 focus:ring-2 focus:ring-white/20 transition">
                </label>
                <label class="block">
                  <span class="text-[12.5px] font-semibold text-white">Phone <span class="text-red-300">*</span></span>
                  <input name="phone" type="tel" required placeholder="(555) 123-4567" class="mt-1.5 w-full rounded-md border border-white/25 bg-white/10 px-3.5 py-2.5 text-[15px] text-white placeholder-white/60 outline-none focus:border-white/60 focus:bg-white/15 focus:ring-2 focus:ring-white/20 transition">
                </label>
              </div>

              <div class="grid sm:grid-cols-[1.6fr_1fr] gap-4">
                <label class="block">
                  <span class="text-[12.5px] font-semibold text-white">Email <span class="text-red-300">*</span></span>
                  <input name="email" type="email" required placeholder="you@email.com" class="mt-1.5 w-full rounded-md border border-white/25 bg-white/10 px-3.5 py-2.5 text-[15px] text-white placeholder-white/60 outline-none focus:border-white/60 focus:bg-white/15 focus:ring-2 focus:ring-white/20 transition">
                </label>
                <label class="block">
                  <span class="text-[12.5px] font-semibold text-white">ZIP code <span class="text-red-300">*</span></span>
                  <input name="zip" required inputmode="numeric" pattern="[0-9]{5}(-[0-9]{4})?" maxlength="10" placeholder="90210"
                         title="Enter a 5-digit ZIP code"
                         class="mt-1.5 w-full rounded-md border border-white/25 bg-white/10 px-3.5 py-2.5 text-[15px] text-white placeholder-white/60 outline-none focus:border-white/60 focus:bg-white/15 focus:ring-2 focus:ring-white/20 transition">
                </label>
              </div>

              <label class="block">
                <span class="text-[12.5px] font-semibold text-white">Service of interest</span>
                <select name="interest" style="color-scheme:dark" class="mt-1.5 w-full rounded-md border border-white/25 bg-white/10 px-3.5 py-2.5 text-[15px] text-white outline-none focus:border-white/60 focus:bg-white/15 focus:ring-2 focus:ring-white/20 transition">
                  <?php foreach (['TMS Therapy','Medication Management','Ketamine Therapy','Psychotherapy','Not sure yet'] as $i): ?><option class="bg-navy-800 text-white"><?= $i ?></option><?php endforeach; ?>
                </select>
              </label>

              <button class="mt-1 w-full inline-flex items-center justify-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15.5px] font-semibold text-white hover:bg-med-700 transition">
                Request my free consultation
                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </button>

              <p class="text-[12px] leading-relaxed text-white/65">
                We use your ZIP code to route you to the nearest of our 15 clinics. Your information is
                kept confidential and is never sold or shared.
              </p>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- metric bar -->
    <dl class="reveal mt-12 lg:mt-14 grid grid-cols-2 sm:grid-cols-4 gap-px bg-white/15 border-t border-x border-white/15">
      <?php foreach ([['10 days','To first appointment'],['15','Clinics in CA & TX'],['3–6 wks','Typical course'],['Most','Insurance accepted']] as $h): ?>
      <div class="bg-navy/60 backdrop-blur-md px-5 py-4">
        <dt class="text-[20px] font-bold leading-none text-white"><?= $h[0] ?></dt>
        <dd class="mt-2 text-[12.5px] leading-snug text-steel-300"><?= $h[1] ?></dd>
      </div>
      <?php endforeach; ?>
    </dl>
  </div>
</section>


<!-- ═══ INSURANCE STRIP ═══ -->
<section class="bg-white border-b border-steel-200">
  <div class="mx-auto max-w-[82rem] px-6 py-6 flex items-center gap-8">
    <span class="hidden md:block shrink-0 eyebrow text-steel-400">In-network with</span>
    <div class="relative flex-1 overflow-hidden no-bar" style="mask-image:linear-gradient(90deg,transparent,#000 6%,#000 94%,transparent)">
      <div class="flex w-max animate-marquee items-center gap-14">
        <?php for($k=0;$k<2;$k++): foreach ($insurers as $ins): ?>
          <?php if ($ins[1]): ?>
            <img src="<?= $INS_DIR . $ins[1] ?>" alt="<?= $k ? '' : strip_tags($ins[0]) ?>" <?= $k ? 'aria-hidden="true"' : '' ?>
                 loading="lazy" class="h-9 w-auto max-w-[132px] shrink-0 object-contain opacity-60 grayscale hover:opacity-100 hover:grayscale-0 transition duration-300">
          <?php else: ?>
            <span class="shrink-0 whitespace-nowrap text-[15px] font-semibold text-steel-400"><?= $ins[0] ?></span>
          <?php endif; ?>
        <?php endforeach; endfor; ?>
      </div>
    </div>
  </div>
</section>

<!-- ═══ THE PROBLEM ═══ -->
<section class="bg-white py-14 lg:py-20">
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

      <div class="reveal">
        <img src="<?= img($IMG['hope'], 1000, 780) ?>" alt="" class="w-full aspect-[4/3] object-cover rounded-lg border border-steel-200">
      </div>

      <div class="reveal">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Treatment-resistant depression</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          When medication has not delivered results
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          The National Institute of Mental Health estimates that one in five American adults
          experiences some form of mental disorder. For a significant portion of those patients,
          antidepressant medication produces side effects without producing relief.
        </p>
        <p class="mt-4 text-[16.5px] leading-[1.75] text-steel-600">
          TMS operates through a different mechanism. Rather than acting systemically through the
          bloodstream, it stimulates the region of the brain responsible for mood regulation.
        </p>

        <div class="mt-8 grid sm:grid-cols-2 gap-px bg-steel-200 border border-steel-200 rounded overflow-hidden">
          <?php foreach ([
            ['Medication has not worked','Multiple prescriptions with limited improvement.'],
            ['Side effects are intolerable','Fatigue, weight gain and emotional blunting.'],
            ['Time away is not an option','Treatment must fit around work and family.'],
            ['Waitlists are too long','Care delayed at the point it is most needed.'],
          ] as $p): ?>
          <div class="bg-white p-5">
            <h3 class="text-[15px] font-semibold text-navy"><?= $p[0] ?></h3>
            <p class="mt-1.5 text-[13.5px] leading-relaxed text-steel-500"><?= $p[1] ?></p>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="mt-9 flex flex-wrap items-center gap-3">
          <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
            See if TMS is right for you
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-steel-300 px-6 py-3.5 text-[15px] font-semibold text-navy hover:border-med-500 hover:text-med-600 transition">
            Call <?= $PHONE ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ WHAT IS TMS ═══ -->
<section id="tms" class="bg-steel-50 border-y border-steel-200 py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">

    <!-- header -->
    <div class="reveal grid lg:grid-cols-2 gap-8 lg:gap-16 items-end pb-12 border-b border-steel-200">
      <div>
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">The treatment</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          What is Transcranial Magnetic Stimulation?
        </h2>
      </div>
      <p class="text-[16.5px] leading-[1.75] text-steel-600">
        TMS is a safe, non-invasive treatment that directly targets the brain's mood center. Over a
        course of four to six weeks it can help rebalance brain chemistry, with patients reporting
        measurable improvement in mood, concentration, energy and sleep quality.
      </p>
    </div>

    <!-- mechanism -->
    <ol class="mt-12 grid md:grid-cols-3 gap-px bg-steel-200 border border-steel-200">
      <?php foreach ($mechanism as $m): ?>
      <li class="reveal bg-white p-8">
        <div class="flex items-center justify-between">
          <span class="grid place-items-center h-11 w-11 rounded bg-med-50 border border-med-100 text-med-600">
            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $m[3] ?>"/></svg>
          </span>
          <span class="text-[13px] font-bold tracking-[.1em] text-steel-300"><?= $m[0] ?></span>
        </div>
        <h3 class="mt-6 text-[18.5px] font-semibold text-navy"><?= $m[1] ?></h3>
        <p class="mt-2.5 text-[14.5px] leading-[1.7] text-steel-600"><?= $m[2] ?></p>
      </li>
      <?php endforeach; ?>
    </ol>

    <!-- technology panel -->
    <div class="reveal mt-8 grid lg:grid-cols-2 rounded-lg border border-steel-200 bg-white overflow-hidden">

      <div class="relative min-h-[340px] bg-steel-100 border-b lg:border-b-0 lg:border-r border-steel-200">
        <span class="absolute top-6 left-6 z-10 rounded bg-navy px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[.12em] text-white">Our equipment</span>
        <img src="<?= $TMS_DEVICE_IMG ?>" alt="Patient receiving TMS treatment, the Magstim Horizon coil positioned against the scalp"
             class="absolute inset-0 h-full w-full object-cover">
      </div>

      <div class="p-8 lg:p-12">
        <h3 class="text-[1.5rem] font-bold tracking-tightest text-navy">Magstim Horizon® with StimGuide PRO</h3>
        <p class="mt-4 text-[15.5px] leading-[1.75] text-steel-600">
          StimGuide PRO neuronavigation tracks the position of the treatment coil in real time
          against the map created for your brain — so every pulse lands on the same cortical
          target, at the same intensity, at every session in your course.
        </p>

        <div class="mt-8 grid sm:grid-cols-2 gap-x-8 gap-y-5 pt-8 border-t border-steel-200">
          <?php foreach ([
            ['Navigated targeting','Real-time coil tracking against your brain map'],
            ['No anesthesia or sedation','Awake and alert throughout the session'],
            ['No systemic side effects','No medication enters the bloodstream'],
            ['No recovery time','Drive yourself and resume normal activity'],
          ] as $f): ?>
          <div class="flex gap-3">
            <svg viewBox="0 0 24 24" class="h-5 w-5 mt-0.5 shrink-0 text-med-600" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            <div>
              <p class="text-[15px] font-semibold text-navy"><?= $f[0] ?></p>
              <p class="mt-0.5 text-[13.5px] leading-relaxed text-steel-500"><?= $f[1] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="mt-8 grid grid-cols-3 gap-px bg-steel-200 border border-steel-200">
          <?php foreach ([['40','minutes per session'],['5×','sessions per week'],['3–6','weeks of treatment']] as $m): ?>
          <div class="bg-steel-50 px-4 py-4">
            <p class="text-[1.7rem] font-bold leading-none text-navy"><?= $m[0] ?></p>
            <p class="mt-1.5 text-[12.5px] leading-snug text-steel-500"><?= $m[1] ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="reveal mt-9 flex flex-wrap items-center gap-3">
      <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
        Request a free consultation
        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-steel-300 px-6 py-3.5 text-[15px] font-semibold text-navy hover:border-med-500 hover:text-med-600 transition">
        Call <?= $PHONE ?>
      </a>
    </div>
  </div>
</section>

<!-- ═══ STATS ═══ -->
<section class="relative isolate bg-navy text-white">
  <img src="<?= img($IMG['window'], 1800, 700, 72) ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-[.22]">
  <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy via-navy/90 to-navy/70"></div>
  <div class="mx-auto max-w-[82rem] px-6 py-12">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-8">
      <?php foreach ($stats as $i => $s): ?>
      <div class="reveal <?= $i < 3 ? 'lg:border-r border-white/20' : '' ?> lg:pr-8">
        <p class="text-[2.8rem] font-bold leading-none tracking-tightest text-brand-orange"><?= $s[0] ?></p>
        <p class="mt-3 text-[14px] leading-snug text-steel-300 max-w-[14rem]"><?= $s[1] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ CONDITIONS ═══ -->
<section id="conditions" class="bg-white py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="reveal grid lg:grid-cols-[1fr_auto] gap-8 items-end pb-10 border-b border-steel-200">
      <div class="max-w-2xl">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Conditions treated</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          Care determined by clinical evaluation
        </h2>
      </div>
      <p class="max-w-sm text-[15.5px] leading-[1.7] text-steel-600">
        Every treatment plan begins with a comprehensive psychiatric evaluation, because the
        appropriate course of care depends on an accurate diagnosis.
      </p>
    </div>

    <div class="cards-slider mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($conditions as $c): ?>
      <article class="reveal group flex flex-col overflow-hidden rounded-lg border border-steel-200 bg-white hover:shadow-pop transition-shadow">
        <div class="relative overflow-hidden bg-steel-100">
          <img src="<?= img($c[2], 640, 420) ?>" alt="" loading="lazy"
               class="h-44 w-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-navy/45 to-transparent"></div>
          <h3 class="absolute bottom-4 left-5 right-5 text-[17px] font-semibold text-white drop-shadow-sm"><?= $c[0] ?></h3>
        </div>
        <div class="flex flex-col flex-1 p-6">
          <p class="text-[14px] leading-relaxed text-steel-600"><?= $c[1] ?></p>
          <a href="#book" class="mt-5 pt-4 border-t border-steel-200 inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-med-600 mt-auto">
            Discuss options
            <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-10 flex flex-col sm:flex-row sm:items-center gap-4 rounded-lg border border-steel-200 bg-steel-50 p-6">
      <p class="text-[15.5px] leading-relaxed text-steel-600 flex-1">
        Not sure which applies to you? A free consultation and full psychiatric evaluation will
        establish the right diagnosis and treatment plan.
      </p>
      <div class="flex flex-wrap gap-3 shrink-0">
        <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
          Request a free consultation
          <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-steel-300 bg-white px-6 py-3.5 text-[15px] font-semibold text-navy hover:border-med-500 hover:text-med-600 transition">
          Call <?= $PHONE ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══ BREAK BAND ═══ -->
<section class="relative isolate bg-navy-900 text-white">
  <img src="<?= img($IMG['people'], 1800, 620, 72) ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-center opacity-30">
  <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy-900 via-navy-900/85 to-navy-900/55"></div>
  <div class="mx-auto max-w-[82rem] px-6 py-12 lg:py-16">
    <div class="reveal flex flex-col lg:flex-row lg:items-center justify-between gap-8">
      <div class="max-w-2xl">
        <p class="text-[1.5rem] sm:text-[1.9rem] font-bold leading-[1.25] tracking-tightest">
          Most patients complete treatment within three to six weeks — without medication,
          anesthesia or time away from work.
        </p>
      </div>
      <a href="#book" class="shrink-0 inline-flex items-center gap-2.5 rounded-md bg-white px-7 py-4 text-[15px] font-semibold text-navy hover:bg-steel-100 transition">
        Check your eligibility
        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ═══ PROCESS ═══ -->
<section id="process" class="bg-white py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">

    <!-- header -->
    <div class="reveal grid lg:grid-cols-[1fr_auto] gap-8 items-end pb-12 border-b border-steel-200">
      <div class="max-w-2xl">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">How it works</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          From first call to first session
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          Four steps, and most of them happen inside the first week. Consultations are frequently
          available the same day you call.
        </p>
      </div>
      <a href="#book" class="shrink-0 inline-flex items-center gap-2.5 rounded-md bg-med-600 px-7 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
        Begin with step one
        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>

    <!-- timeline -->
    <ol class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-14">
      <?php foreach ($steps as $i => $s): ?>
      <li class="reveal relative">
        <?php if ($i < count($steps) - 1): ?>
          <span aria-hidden="true" class="hidden lg:block absolute top-7 left-16 -right-10 h-px bg-steel-200"></span>
        <?php endif; ?>
        <span class="relative z-10 grid h-14 w-14 place-items-center rounded-full border border-steel-300 bg-white text-[15px] font-bold text-med-600"><?= $s[0] ?></span>
        <p class="mt-6 inline-block rounded bg-med-50 border border-med-100 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[.12em] text-med-700"><?= $s[1] ?></p>
        <h3 class="mt-3.5 text-[18.5px] font-semibold text-navy"><?= $s[2] ?></h3>
        <p class="mt-2.5 text-[14.5px] leading-[1.7] text-steel-600"><?= $s[3] ?></p>
      </li>
      <?php endforeach; ?>
    </ol>

    <!-- closing banner -->
    <div class="reveal relative isolate mt-16 overflow-hidden rounded-lg">
      <img src="<?= img($IMG['consult'], 1800, 620, 76) ?>" alt="Consultation with a clinician at an Anew Era clinic"
           class="absolute inset-0 -z-10 h-full w-full object-cover object-[center_30%]">
      <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy via-navy/90 to-navy/45"></div>
      <div class="grid lg:grid-cols-[1fr_auto] gap-8 items-center p-8 sm:p-12">
        <div class="max-w-xl">
          <p class="text-[1.35rem] sm:text-[1.6rem] font-bold leading-[1.3] tracking-tightest text-white">
            You do not need a referral, and the consultation costs nothing.
          </p>
          <p class="mt-3 text-[15px] leading-[1.7] text-steel-300">
            We verify your insurance benefits and confirm your exact out-of-pocket cost before
            treatment begins.
          </p>
        </div>
        <div class="flex flex-wrap gap-3">
          <a href="#book" class="inline-flex items-center rounded-md bg-white px-6 py-3.5 text-[15px] font-semibold text-navy hover:bg-steel-100 transition">Request a consultation</a>
          <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center rounded-md border border-white/35 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-white/10 transition"><?= $PHONE ?></a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══ SERVICES ═══ -->
<section id="services" class="bg-white py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="reveal max-w-3xl">
      <div class="rule"></div>
      <span class="mt-5 block eyebrow text-med-600">Our services</span>
      <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
        Comprehensive psychiatric care, coordinated under one roof
      </h2>
      <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
        Psychiatrists, psychologists, psychiatric nurse practitioners and licensed therapists
        working from a single, integrated treatment plan.
      </p>
    </div>

    <div class="cards-slider mt-12 grid md:grid-cols-2 gap-6">
      <?php foreach ($services as $i => $sv): ?>
      <article class="reveal group flex flex-col overflow-hidden rounded-lg border border-steel-200 bg-white hover:shadow-pop transition-shadow">
        <div class="relative h-64 lg:h-72 overflow-hidden <?= $sv[4] === 'contain' ? 'bg-white border-b border-steel-200 p-5' : 'bg-steel-100' ?>">
          <img src="<?= $sv[3] ?>" alt="<?= htmlspecialchars($sv[0]) ?>" loading="lazy"
               class="h-full w-full <?= $sv[4] === 'contain' ? 'object-contain' : 'object-cover group-hover:scale-[1.03]' ?> <?= $sv[5] ?? 'object-center' ?> transition-transform duration-500">
          <span class="absolute top-4 left-4 rounded bg-navy/90 px-2.5 py-1 text-[12px] font-semibold text-white tracking-wide">0<?= $i+1 ?></span>
        </div>
        <div class="flex flex-col flex-1 p-7">
          <h3 class="text-[20px] font-bold tracking-tightest text-navy"><?= $sv[0] ?></h3>
          <p class="mt-3 text-[15px] leading-[1.7] text-steel-600"><?= $sv[1] ?></p>
          <ul class="mt-5 pt-5 border-t border-steel-200 space-y-2.5">
            <?php foreach ($sv[2] as $li): ?>
            <li class="flex items-start gap-2.5 text-[14.5px] text-steel-600">
              <svg viewBox="0 0 24 24" class="h-4 w-4 mt-1 shrink-0 text-med-600" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              <?= $li ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-9 flex flex-wrap items-center gap-3">
      <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
        Book an appointment
        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-steel-300 px-6 py-3.5 text-[15px] font-semibold text-navy hover:border-med-500 hover:text-med-600 transition">
        Call <?= $PHONE ?>
      </a>
    </div>
  </div>
</section>

<!-- ═══ REVIEWS ═══ -->
<section id="reviews" class="bg-steel-50 border-y border-steel-200 py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">

    <div class="reveal grid lg:grid-cols-[1fr_auto] gap-8 items-end pb-10 border-b border-steel-200">
      <div class="max-w-2xl">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Patient reviews</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          What our patients say
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          Reviews left by patients treated at our Austin clinic.
        </p>
      </div>
      <a href="#book" class="shrink-0 inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
        Request a free consultation
        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>

    <!-- featured review -->
    <figure class="reveal relative isolate mt-10 overflow-hidden rounded-lg bg-navy text-white">
      <img src="<?= img($IMG['light'], 1600, 600, 72) ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-[.16]">
      <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy via-navy/94 to-navy/70"></div>
      <div class="grid lg:grid-cols-[auto_1fr] gap-8 lg:gap-12 items-center p-8 sm:p-12">
        <img src="<?= img($IMG['quote'], 460, 560) ?>" alt="" class="hidden lg:block w-[13.5rem] aspect-[5/6] object-cover rounded-lg">
        <div>
          <svg viewBox="0 0 24 24" class="h-8 w-8 text-white/30" fill="currentColor"><path d="M9.5 6C6.5 6 4 8.5 4 11.5S6.5 17 9.5 17c.5 0 1-.1 1.4-.2-.6 1.6-2 2.8-3.9 3.2v1c4.4-.6 8-4.3 8-9.5C15 8.5 12.5 6 9.5 6zM20.5 6C17.5 6 15 8.5 15 11.5S17.5 17 20.5 17c.2 0 .4 0 .5-.1V20c-.1.1-.2.1-.3.2v.8c1.5-.5 2.8-1.6 3.3-3z"/></svg>
          <blockquote class="mt-5 text-[1.35rem] sm:text-[1.7rem] font-medium leading-[1.45] tracking-tightest">
            “TMS really really helped me a lot… I feel more free calm and peaceful the last few weeks
            going through daily TMS. I'm so so grateful I was able to find this place and get
            treatment. <span class="text-med-200">This place saved my life for sure.</span>”
          </blockquote>
          <figcaption class="mt-7 pt-6 border-t border-white/15 text-[14.5px]">
            <span class="font-semibold">Annabeth Parrish</span>
            <span class="text-steel-300"> — 10 reviews · a year ago</span>
          </figcaption>
        </div>
      </div>
    </figure>

    <!-- review grid -->
    <div class="cards-slider mt-5 grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php foreach ($reviews as $r): ?>
      <?php
        $parts = preg_split('/\s+/', $r[0]);
        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
      ?>
      <figure class="reveal flex flex-col rounded-lg border border-steel-200 bg-white p-6">
        <svg viewBox="0 0 24 24" class="h-6 w-6 shrink-0 text-steel-200" fill="currentColor"><path d="M9.5 6C6.5 6 4 8.5 4 11.5S6.5 17 9.5 17c.5 0 1-.1 1.4-.2-.6 1.6-2 2.8-3.9 3.2v1c4.4-.6 8-4.3 8-9.5C15 8.5 12.5 6 9.5 6zM20.5 6C17.5 6 15 8.5 15 11.5S17.5 17 20.5 17c.2 0 .4 0 .5-.1V20c-.1.1-.2.1-.3.2v.8c1.5-.5 2.8-1.6 3.3-3z"/></svg>
        <blockquote class="mt-4 flex-1 text-[15px] leading-[1.7] text-steel-600"><?= $r[3] ?></blockquote>
        <figcaption class="mt-5 pt-4 border-t border-steel-200 flex items-center gap-3">
          <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-50 border border-med-100 text-[12.5px] font-bold text-med-700"><?= $initials ?></span>
          <div class="min-w-0">
            <p class="text-[14.5px] font-semibold text-navy truncate"><?= $r[0] ?></p>
            <p class="text-[12.5px] text-steel-400 truncate"><?= $r[1] ?> · <?= $r[2] ?></p>
          </div>
        </figcaption>
      </figure>
      <?php endforeach; ?>
    </div>

    <p class="reveal mt-5 text-[13px] text-steel-400">
      Excerpts from patient reviews; “…” marks omitted text. Individual results vary.
    </p>
  </div>
</section>


<!-- ═══ INSURANCE ═══ -->
<section class="bg-white py-14 lg:py-18">
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="reveal grid lg:grid-cols-[1fr_auto] gap-12 items-start">
      <div class="max-w-2xl">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Insurance &amp; cost</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          TMS is covered by most major insurance plans
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          We are in-network with the plans below, including Aetna, Anthem, Blue Cross, Blue Shield,
          Cigna and Evernorth, Health Net, Humana, Medicare, Optum, TRICARE and UnitedHealthcare.
          Your exact benefits are verified at no charge before treatment begins, and competitive
          cash-pay options are available.
        </p>
        <p class="mt-4 text-[14px] text-steel-400">Please note: Medicaid is not accepted.</p>
      </div>

      <div class="lg:w-80 rounded-lg border border-steel-200 bg-steel-50 p-7">
        <p class="eyebrow text-steel-400">Benefits verification</p>
        <p class="mt-3 text-[2.6rem] font-bold leading-none tracking-tightest text-navy">Free</p>
        <p class="mt-3 text-[14.5px] leading-relaxed text-steel-600">
          We handle the paperwork with your insurer and confirm your exact out-of-pocket cost
          before your first session.
        </p>
        <a href="#book" class="mt-6 block rounded-md bg-med-600 py-3.5 text-center text-[15px] font-semibold text-white hover:bg-med-700 transition">Check my coverage</a>
      </div>
    </div>

    <!-- carrier wall, full container width -->
    <div class="reveal mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">
      <?php foreach ($insurers as $ins): ?>
      <div class="h-[100px] rounded-lg border border-steel-200 bg-white flex flex-col items-center justify-center gap-1.5 px-4 py-3 text-center hover:border-steel-300 transition-colors">
        <?php if ($ins[1]): ?>
          <img src="<?= $INS_DIR . $ins[1] ?>" alt="<?= strip_tags($ins[0]) ?>" loading="lazy"
               class="max-h-11 w-auto max-w-full object-contain">
        <?php else: ?>
          <span class="text-[15px] font-semibold leading-snug text-navy"><?= $ins[0] ?></span>
        <?php endif; ?>
        <?php if ($ins[2]): ?>
          <span class="text-[11.5px] leading-tight text-steel-400"><?= $ins[2] ?></span>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="reveal mt-5 text-[13px] text-steel-400">
      Plan availability varies by clinic and state. We confirm your specific coverage before treatment begins.
    </p>
  </div>
</section>

<!-- ═══ FAQ ═══ -->
<section id="faq" class="bg-white py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">
    <div class="grid lg:grid-cols-[.75fr_1.25fr] gap-12 lg:gap-16">
      <div class="reveal lg:sticky lg:top-[90px] self-start">
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Frequently asked</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.5rem] font-bold leading-[1.14] tracking-tightest text-navy">
          Common questions
        </h2>
        <p class="mt-6 text-[15.5px] leading-[1.7] text-steel-600">
          If your question is not answered here, our team can help.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
            Request a free consultation
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-steel-300 px-6 py-3.5 text-[15px] font-semibold text-navy hover:border-med-500 hover:text-med-600 transition">
            Call <?= $PHONE ?>
          </a>
        </div>
        <figure class="mt-8 hidden lg:block overflow-hidden rounded-lg border border-steel-200 bg-white">
          <img src="<?= $LOCATION_IMG ?>" alt="Inside an Anew Era TMS &amp; Psychiatry clinic" loading="lazy"
               class="w-full aspect-[4/3] object-cover">
          <figcaption class="flex items-center gap-2.5 px-5 py-3.5 border-t border-steel-200">
            <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0 text-med-600" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 21s-7-5.3-7-10a7 7 0 1114 0c0 4.7-7 10-7 10z"/><circle cx="12" cy="11" r="2.5"/></svg>
            <p class="text-[13.5px] text-steel-600">Inside an Anew Era clinic</p>
          </figcaption>
        </figure>
      </div>

      <div class="reveal divide-y divide-steel-200 border-t border-b border-steel-200">
        <?php foreach ($faqs as $i => $f): ?>
        <details class="group" <?= $i === 0 ? 'open' : '' ?>>
          <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-5 text-[16.5px] font-semibold text-navy marker:hidden hover:text-med-600 transition-colors">
            <?= $f[0] ?>
            <svg viewBox="0 0 24 24" class="chev h-5 w-5 shrink-0 text-steel-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
          </summary>
          <p class="pb-6 pr-10 text-[15.5px] leading-[1.75] text-steel-600"><?= $f[1] ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FINAL CTA ═══ -->
<section class="relative bg-navy text-white">
  <img src="<?= img($IMG['calm'], 1600, 800, 70) ?>" alt="" class="absolute inset-0 h-full w-full object-cover opacity-[.18]">
  <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/95 to-navy/75"></div>
  <div class="relative mx-auto max-w-[82rem] px-6 py-14 lg:py-18">
    <div class="grid lg:grid-cols-[1fr_auto] gap-10 items-center">
      <div class="max-w-2xl reveal">
        <span class="eyebrow text-med-200">Accepting new patients</span>
        <h2 class="mt-4 text-[2.2rem] sm:text-[3rem] font-bold leading-[1.1] tracking-tightest">
          Discover a new era for the treatment of depression
        </h2>
        <p class="mt-5 text-[17px] leading-[1.7] text-steel-300 max-w-xl">
          Schedule your free consultation today and be seen within ten days.
        </p>
      </div>
      <div class="flex flex-wrap gap-3 reveal">
        <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-500 px-7 py-4 text-[15px] font-semibold text-white hover:bg-med-600 transition">
          Request a Consultation
          <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center rounded-md border border-white/30 px-7 py-4 text-[15px] font-semibold text-white hover:bg-white/10 transition">
          <?= $PHONE ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer class="bg-navy-900 text-steel-300 border-t border-white/10">
  <div class="mx-auto max-w-[82rem] px-6 py-12">
    <div class="grid gap-12 lg:grid-cols-[1.6fr_1fr_1fr_1fr]">
      <div>
        <a href="#" class="inline-flex" aria-label="Anew Era TMS &amp; Psychiatry — home">
          <img src="<?= $LOGO_WHITE ?>" alt="Anew Era TMS &amp; Psychiatry" width="300" height="87"
               class="block h-12 w-auto">
        </a>
        <p class="mt-6 text-[14.5px] leading-relaxed max-w-sm">
          Customized, comprehensive mental health care from psychiatrists, psychologists,
          psychiatric nurse practitioners and licensed therapists.
        </p>
        <a href="tel:<?= $PHONE_RAW ?>" class="mt-6 inline-block text-[1.4rem] font-bold tracking-tightest text-white hover:text-med-200 transition"><?= $PHONE ?></a>
      </div>

      <div>
        <h4 class="text-white font-semibold text-[14px]">Treatment</h4>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach (['TMS Therapy','Medication Management','Ketamine Therapy','Psychotherapy'] as $l): ?>
          <li><a href="#services" class="hover:text-white transition"><?= $l ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-semibold text-[14px]">Conditions</h4>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach (array_slice($conditions,0,6) as $c): ?>
          <li><a href="#conditions" class="hover:text-white transition"><?= $c[0] ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-semibold text-[14px]">Company</h4>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach ([['How it works','#process'],['FAQ','#faq'],['Book appointment','#book'],['Careers','#'],['Blog','#'],['Patient portal','#']] as $l): ?>
          <li><a href="<?= $l[1] ?>" class="hover:text-white transition"><?= $l[0] ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="mt-14 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-[13px] text-steel-400">
      <p>&copy; 2018–<?= date('Y') ?> Anew Era TMS &amp; Psychiatry. All rights reserved.</p>
      <div class="flex gap-6">
        <a href="#" class="hover:text-white transition">Privacy Policy</a>
        <a href="#" class="hover:text-white transition">Terms of Use</a>
        <a href="#" class="hover:text-white transition">Accessibility</a>
      </div>
    </div>

    <p class="mt-8 text-[11.5px] leading-relaxed text-steel-500 max-w-4xl">
      This page is provided for general information and does not constitute medical advice, diagnosis
      or treatment. Individual results vary. Always consult a qualified healthcare provider regarding
      a medical condition. If you are experiencing a mental health emergency, call or text 988
      (Suicide &amp; Crisis Lifeline) or dial 911.
    </p>
  </div>
</footer>

<!-- ═══ MOBILE STICKY CTA ═══ -->
<div class="lg:hidden fixed bottom-0 inset-x-0 z-50 border-t border-steel-200 bg-white px-4 py-3 flex gap-3">
  <a href="tel:<?= $PHONE_RAW ?>" class="flex-1 inline-flex items-center justify-center rounded-md border border-steel-300 py-3.5 text-[14.5px] font-semibold text-navy">Call</a>
  <a href="#book" class="flex-[1.5] inline-flex items-center justify-center rounded-md bg-med-600 py-3.5 text-[14.5px] font-semibold text-white">Request Consultation</a>
</div>
<div class="lg:hidden h-[74px]"></div>

<script>
const io = new IntersectionObserver((es) => {
  es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
}, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));

const burger = document.getElementById('burger');
const mobileNav = document.getElementById('mobileNav');
burger.addEventListener('click', () => {
  const open = mobileNav.classList.toggle('hidden') === false;
  burger.setAttribute('aria-expanded', String(open));
});
mobileNav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  mobileNav.classList.add('hidden');
  burger.setAttribute('aria-expanded', 'false');
}));

// header turns solid once the hero starts scrolling past
const nav = document.getElementById('nav');
const onScroll = () => nav.classList.toggle('scrolled', scrollY > 40);
addEventListener('scroll', onScroll, { passive: true });
onScroll();

const items = document.querySelectorAll('#faq details');
items.forEach(d => d.addEventListener('toggle', () => {
  if (d.open) items.forEach(o => { if (o !== d) o.open = false; });
}));
</script>
</body>
</html>
