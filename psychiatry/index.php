<?php
/**
 * Anew Era TMS & Psychiatry — Psychiatry landing page
 * Sister page to ../tms/. Same brand system and components; the content arrays
 * below and the "how care works" section carry everything that differs.
 */

$PHONE     = '(936) 444-4870';
$PHONE_RAW = '9364444870';

/* ---------- Clinic (The Woodlands, TX) ---------- */
$ADDR_LINES = ['1733 Woodstead Ct #102', 'The Woodlands, TX 77380'];
$ADDR       = implode(', ', $ADDR_LINES);
$MAP_EMBED  = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3449.9061639471643!2d-95.4633427!3d30.154098700000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864737409cd2fe5d%3A0x7925b9e472b8cfcf!2sAnew%20Era%20TMS%20%26%20Psychiatry%20-%20The%20Woodlands!5e0!3m2!1sen!2sin!4v1788434231069!5m2!1sen!2sin';
$MAP_LINK   = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('Anew Era TMS & Psychiatry - The Woodlands, ' . $ADDR);

/* ---------- Asset base ----------------------------------------------------
 * Empty on purpose: every asset path below stays relative to the page.
 *
 * This page is deployed under https://aneweratms.com/inquire/psychiatry/ and
 * served locally from the repo root as /psychiatry/, so no single absolute
 * prefix is correct in both places — an absolute "/psychiatry/..." 301s to the
 * homepage in production. Relative paths work at any depth.
 *
 * The one thing relative paths cannot survive is a URL missing its trailing
 * slash, which PHP's built-in server does not redirect. ../router.php restores
 * that redirect for local development.
 *
 * Set this only if the page is ever served from a fixed, known prefix.
 * ------------------------------------------------------------------------ */
$BASE = '';

/* Photography is stored locally in assets/photos/ as "<id>-<w>x<h>.jpg".
   Nothing is fetched from a third-party CDN at render time. The $q argument is
   retained so existing call sites keep working; quality is baked into the file. */
function img(string $id, int $w = 900, int $h = 700, int $q = 80): string {
    return $GLOBALS['BASE'] . "assets/photos/{$id}-{$w}x{$h}.jpg";
}
$IMG = [
    'hope'    => '1491438590914-bc09fcaaf77a', // three friends laughing, warm light
    'calm'    => '1638136630741-ea30b45d4516', // patient, hopeful, natural light
    'consult' => '1739285452629-2672b13fa42d', // clinician in conversation
    'med'     => '1758691461935-202e2ef6b69f', // physician at desk
    'window'  => '1776886099265-6366478b341b', // waiting area
    'people'  => '1653512488909-e204afcc8495', // patient, smiling
];

/* ---------- Hero background ----------------------------------------------
 * Use a wide, landscape shot (min 1920×1080). The copy sits on the left under
 * a near-opaque navy scrim and the consultation form covers the right column
 * on desktop, so the middle of the frame is the part that actually reads.
 * ------------------------------------------------------------------------ */
$HERO_BG = $BASE . 'assets/bg-image/hero-option-a-three-adults.jpg';

/* Brand logo. The supplied .webp is 300×87 with an opaque white background, so a
   white-knockout PNG with a real alpha channel was generated from it for use on
   dark surfaces (see assets/logo/new-era-logo-white.png). */
$LOGO       = $BASE . 'assets/logo/new-era-logo.webp';        // full colour — for light surfaces
$LOGO_WHITE = $BASE . 'assets/logo/new-era-logo-white.png';   // white knockout — for dark surfaces

/* Real clinic interior photo */
$LOCATION_IMG = $BASE . 'assets/location/new-era-tms-location.webp';

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
    ['Depression','More than a bad or sad mood — a real disorder with physical and mental symptoms.','1531854253260-44f0d06e3d26'],
    ['Anxiety','Intense fear and worry that becomes exhausting to live with, day after day.','1757744705465-ea08b0ddc38a'],
    ['ADHD','Difficulty with attention, focus and follow-through, in adults as well as children.','1573497019940-1c28c88b4f3e'],
    ['Bipolar Disorder','Shifts in mood and energy that need careful diagnosis and steady management.','1623717217554-72ca676de535'],
    ['PTSD','Trauma of many forms can lead to post-traumatic stress disorder.','1564564244660-5d73c057f2d2'],
    ['OCD','Obsessive-compulsive disorder built on repetitive, intrusive thoughts.','1592234789031-94bf65f630ed'],
    ['Postpartum Depression','A form of depression that often affects new mothers after childbirth.','1542385151-efd9000785a0'],
    ['Insomnia &amp; Sleep','Sleep that will not come or will not hold, often tangled with mood and anxiety.','1520206183501-b80df61043c2'],
];

/* [number, timing tag, title, body] */
$steps = [
    ['01','Same day','Free consultation','Speak with our team the day you call. We answer your questions, explain how we work and verify your insurance benefits at no cost.'],
    ['02','Within 1–5 days','Psychiatric evaluation','A full evaluation with a board-certified psychiatrist or psychiatric nurse practitioner: your history, your symptoms, what has already been tried and what has not.'],
    ['03','Same visit','Diagnosis and plan','You leave with a diagnosis explained in plain language and a written plan — medication, therapy, or both, with the reasoning behind each choice.'],
    ['04','Ongoing','Review and adjust','Follow-up appointments track what is working. Doses are adjusted, prescriptions refilled and the plan revised as your life changes.'],
];

/* What sets the care apart — three points, in place of the TMS mechanism */
$mechanism = [
    ['01','An evaluation that takes its time','Diagnosis drives everything that follows, so the first appointment is unhurried. We go through your history, your symptoms and every treatment you have already tried.','M12 3a9 9 0 109 9M12 3v9l6.4 3.2'],
    ['02','A plan, not a prescription','Medication is one tool. Your plan may combine it with therapy, and it always comes with the reasoning explained — what we expect, how long it takes and what we do if it does not work.','M20 6L9 17l-5-5'],
    ['03','Care that keeps adjusting','Psychiatry is not one appointment. We follow up, watch what changes, and adjust — including moving to a different approach when the current one has gone as far as it can.','M4 12h3l2-5 3 10 2.5-7 1.5 4h4'],
];

/* [title, description, bullets, image src, object-fit, object-position (optional),
    availability note (optional) — rendered as a pill beside the card title]
   The cards crop the image to a wide band, so portraits whose subject sits high
   in the frame need 'object-top' or the head is cut off. */
$services = [
    ['Psychiatric Evaluation','A full diagnostic evaluation with a board-certified psychiatrist or psychiatric nurse practitioner, in person or by video.',['Sixty-minute first appointment','Diagnosis explained in plain language','In person or telehealth'],
     img($IMG['consult'], 900, 560), 'cover', 'object-center'],
    ['Medication Management','Prescribing and ongoing adjustment over time, with follow-up appointments that track what is actually working.',['Ongoing review and adjustment','Prompt prescription refills','Same-week availability'],
     img($IMG['med'], 900, 560), 'cover', 'object-top'],
    ['Psychotherapy','Licensed therapists providing in-person and online sessions, coordinated with your medical care under one roof.',['In-person or virtual sessions','Licensed clinicians','Integrated with your treatment plan'],
     $LOCATION_IMG, 'cover', 'object-center'],
    ['SPRAVATO&reg; (esketamine)','Esketamine nasal spray for treatment-resistant depression, self-administered in our clinic under the supervision of our medical team.',['Self-administered under supervision','Two hours of monitoring after each dose','For treatment-resistant depression'],
     img('1779281887548-f676406dea2f', 900, 560), 'cover', 'object-center', 'Texas clinics only'],
];

$stats = [
    ['15','Clinics across California and Texas'],
    ['5','Days or less to your first evaluation'],
    ['60','Minutes for your first appointment'],
    ['0','Cost to verify your insurance benefits'],
];

$faqs = [
    ['How quickly can I be seen?','We can usually schedule a free consultation the same day you call, with a full psychiatric evaluation within one to five business days.'],
    ['Do you see adults, children or both?','We treat adults and adolescents. The evaluation establishes whether our care is the right fit, and we refer on where someone would be better served elsewhere.'],
    ['Is psychiatric care covered by insurance?','Yes. We accept most major commercial insurance companies as well as Tricare and Triwest. We do not accept Medicaid.<br><br><strong>California:</strong> Anthem Blue Cross, Blue Shield of California, Magellan / MHSA, Cigna, Aetna, Optum, United Healthcare, Oscar, Tricare-West, Triwest CCN, Healthnet, and MHN.<br><br><strong>Texas:</strong> Blue Cross Blue Shield of Tx (BCBS), Humana, Magellan / MHSA, Cigna, Aetna, Optum, United Healthcare, Oscar, Tricare-East, Triwest CCN, Healthnet, and MHN.<br><br>Free benefits verification and competitive cash-pay options are available.'],
    ['Can I be seen by video instead of in person?','Yes. Evaluations, medication follow-ups and therapy can all be done by video, and you can move between in-person and virtual appointments as suits you.'],
    ['How long is the first appointment?','About sixty minutes. That is the appointment the diagnosis rests on, so it is not rushed. Follow-up appointments are shorter.'],
    ['Will I have to take medication?','Not necessarily. Medication is one option among several, and the plan may be therapy alone. Where medication is recommended, you get the reasoning, the expected timeline and the alternatives.'],
    ['What if medication has not worked for me before?','That is a common reason people come to us. Where several medications have not produced relief, options with a different mechanism become relevant — SPRAVATO&reg; at our Texas clinics, or TMS therapy, which is drug-free and covered by most plans.'],
    ['Do you prescribe controlled substances?','Where clinically appropriate and after a full evaluation. We follow state and federal prescribing rules, which for some medications means an in-person appointment.'],
];

/* Accepted insurance. [display name, logo file in assets/insurances/ or null, note, state (both|ca|tx)]
   Entries without artwork fall back to a text cell so the list stays complete. */
$INS_DIR = $BASE . 'assets/insurances/';
/* Carrier artwork is off for now: both the marquee and the carrier wall fall back
   to the text cell they already had for carriers with no logo. Flip to true to
   bring the images back — the filenames in $insurers are untouched. */
$INS_LOGOS = false;
/* Patient reviews — published verbatim from Google reviews of our clinics,
   newest first. Paragraph breaks are <br><br>. [name, meta, when, review] */
$reviews = [
    ['Shannon Collins','Local Guide · 107 reviews','3 weeks ago',
     'I feel that I am heard and understood in my treatment. I\'ve tried a variety of medications and finally found a plan that works for me and my health. Laura Beaufford takes her time to carefully assess my case and diagnoses to create a specific treatment plan for me that is working. Finding a doctor that cares about what they are doing is important. Thankful to be treated as a person and not just another patient.'],
    ['Wendy Douglas','Local Guide · 24 reviews','5 months ago',
     'So easy to take great care of your mental health, scheduling is totally stress free, online appts make is stress free as well. I thought I was going to lose my mind when my last psychiatrist dropped me because I kept missing appts. I found ANEW the next day and this was truly a blessing. The providers take excellent care of me, I feel comfortable talking to them, Rx refills are immediate. Very happy patient here!!!'],
    ['Madeline Rowe','Local Guide · 19 reviews','10 months ago',
     'Laura Beaufford has been such a blessing in my mental health journey. She brings an incredible balance of professionalism and heart &mdash; she truly cares. Laura\'s compassion shines through in every session, and her ability to make you feel safe and supported while also being proactive and knowledgeable is remarkable. She listens deeply, remembers details, and tailors care with genuine thoughtfulness. It\'s clear she\'s passionate about helping her patients heal and thrive. I always leave our sessions feeling lighter, understood, and hopeful. Anew Era TMS is exceptional because of clinicians like her.'],
    ['Gloria Lopez','2 reviews','a year ago',
     'I have the best psychiatrist! Amanda is fantastic!! She was out on leave and I had to visit with someone else and it was not the same!! She knows my patterns even better than I do. She\'s straight forward, caring, and attentive! Love her!!!'],
];


$insurers = [
    ['Aetna',                               'aetna.webp',               '',           'both'],
    ['Anthem Blue Cross',                   'anthem.webp',              'California', 'ca'],
    ['Baylor Scott & White',                'baylor-scott-white.png',   'Texas',      'tx'],
    ['Blue Cross Blue Shield of Tx (BCBS)', null,                      'Texas',      'tx'],
    ['Blue Shield of California',            'blue-california.webp',     'California', 'ca'],
    ['Cigna',                               'cigna.webp',               '',           'both'],
    ['Healthnet',                           'health-net.png',           '',           'both'],
    ['Humana',                               null,                      'Texas',      'tx'],
    ['Magellan / MHSA',                     'megallan-health-logo.png', '',           'both'],
    ['MHN',                                 'mhn.webp',                 '',           'both'],
    ['Optum',                               'optum.webp',               '',           'both'],
    ['Oscar',                               'oscar.png',                      '',           'both'],
    ['Tricare-West',                        'tricare.webp',             'California', 'ca'],
    ['Tricare-East',                        'tricare.webp',             'Texas',      'tx'],
    ['Triwest CCN',                         'triwest.png',              '',           'both'],
    ['United Healthcare',                   'unitedhealthcare.png',     '',           'both'],
];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google tag (gtag.js) — Google Ads AW-18384277784 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-18384277784"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-18384277784');
</script>
<title>Anew Era TMS &amp; Psychiatry — Psychiatrists in The Woodlands, TX</title>
<link rel="icon" type="image/png" sizes="32x32" href="<?= $BASE ?>favicon.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= $BASE ?>apple-touch-icon.png">
<meta name="description" content="Psychiatric evaluation, medication management and therapy for depression, anxiety, ADHD, bipolar disorder and PTSD in The Woodlands, TX. New patients seen within five days. Most major insurance accepted.">

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

  /* ── Reviews carousel ──────────────────────────────────────────────────
     Unlike the card grids this one stays a carousel at every width: one row,
     roughly three cards visible on desktop. Reviews run from 21 to 151 words,
     so the body is clamped and a Read more button expands it in place. */
  .rv-track{
    display:flex;
    gap:1.25rem;
    overflow-x:auto;
    overscroll-behavior-x:contain;
    scroll-snap-type:x mandatory;
    scroll-padding-inline:1.5rem;
    margin-inline:-1.5rem;
    padding-inline:1.5rem;
    padding-bottom:.5rem;
    scrollbar-width:none;
  }
  .rv-track::-webkit-scrollbar{ display:none; }
  .rv-track > *{ scroll-snap-align:start; flex:0 0 84%; }
  @media (min-width:640px){ .rv-track > *{ flex-basis:47%; } }
  @media (min-width:1024px){
    .rv-track{ margin-inline:0; padding-inline:0; scroll-padding-inline:0; }
    .rv-track > *{ flex-basis:31.6%; }
  }
  .rv-text{
    display:-webkit-box;
    -webkit-box-orient:vertical;
    -webkit-line-clamp:7;
    overflow:hidden;
  }
  .rv-text.open{ -webkit-line-clamp:unset; overflow:visible; }

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
        <?php foreach ([['Our Approach','#approach'],['Conditions','#conditions'],['How It Works','#process'],['Services','#services'],['Reviews','#reviews'],['FAQ','#faq']] as $l): ?>
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
      <?php foreach ([['Our Approach','#approach'],['Conditions Treated','#conditions'],['How It Works','#process'],['Services','#services'],['Reviews','#reviews'],['FAQ','#faq']] as $l): ?>
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
          Board-certified psychiatrists · Accepting new patients
        </div>

        <h1 class="mt-6 text-[2.5rem] sm:text-[3.1rem] lg:text-[3.5rem] font-bold leading-[1.06] tracking-tightest text-white">
          Psychiatric care that starts with actually understanding you.
        </h1>

        <p class="mt-5 text-[17px] leading-[1.7] text-steel-200 max-w-xl">
          Evaluation, diagnosis and a treatment plan from board-certified psychiatrists in
          The Woodlands — in person or by video, usually within five days.
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-3">
          <a href="tel:<?= $PHONE_RAW ?>" class="inline-flex items-center gap-2.5 rounded-md border border-white/35 bg-white/5 px-6 py-3.5 text-[15px] font-semibold text-white backdrop-blur-sm hover:bg-white/15 transition">
            <svg viewBox="0 0 24 24" class="h-4 w-4 text-med-300" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
            Call <?= $PHONE ?>
          </a>
          <a href="#approach" class="inline-flex items-center gap-2 text-[15px] font-semibold text-white/80 hover:text-white transition">
            How our care works
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

            <form accept-charset="UTF-8" action="https://app.formester.com/forms/H9XhrLPFP/submissions" method="POST" class="mt-5 grid gap-4">
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
                  <?php foreach (['Psychiatric evaluation','Medication management','Psychotherapy','SPRAVATO&reg; (Texas only)','Not sure yet'] as $i): ?><option class="bg-navy-800 text-white"><?= $i ?></option><?php endforeach; ?>
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
      <?php foreach ([['5 days','To your evaluation'],['60 min','First appointment'],['Video','Or in person'],['Most','Insurance accepted']] as $h): ?>
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
          <?php if ($INS_LOGOS && $ins[1]): ?>
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
        <span class="mt-5 block eyebrow text-med-600">Why people come to us</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          When care has felt rushed or out of reach
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          The National Institute of Mental Health estimates that one in five American adults
          experiences some form of mental disorder. Most of them wait months for an appointment,
          then get fifteen minutes and a prescription.
        </p>
        <p class="mt-4 text-[16.5px] leading-[1.75] text-steel-600">
          We work differently. A full evaluation establishes the diagnosis, the plan is explained to
          you, and follow-up appointments exist to change it when the evidence says to.
        </p>

        <div class="mt-8 grid sm:grid-cols-2 gap-px bg-steel-200 border border-steel-200 rounded overflow-hidden">
          <?php foreach ([
            ['Nobody explained the diagnosis','A label, with no reasoning behind it.'],
            ['Appointments feel rushed','Fifteen minutes is not an evaluation.'],
            ['Refills are a chase','Running out before anyone calls back.'],
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
            Book a psychiatric evaluation
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

<!-- ═══ OUR APPROACH ═══ -->
<section id="approach" class="bg-steel-50 border-y border-steel-200 py-14 lg:py-20 scroll-mt-[92px]">
  <div class="mx-auto max-w-[82rem] px-6">

    <!-- header -->
    <div class="reveal grid lg:grid-cols-2 gap-8 lg:gap-16 items-end pb-12 border-b border-steel-200">
      <div>
        <div class="rule"></div>
        <span class="mt-5 block eyebrow text-med-600">Our approach</span>
        <h2 class="mt-4 text-[2.1rem] sm:text-[2.6rem] font-bold leading-[1.14] tracking-tightest text-navy">
          How psychiatric care works here
        </h2>
      </div>
      <p class="text-[16.5px] leading-[1.75] text-steel-600">
        Good psychiatry rests on an accurate diagnosis, and an accurate diagnosis takes time. What
        follows is a plan you understand and a clinician who keeps adjusting it — not a prescription
        handed over at the end of a fifteen-minute appointment.
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
        <span class="absolute top-6 left-6 z-10 rounded bg-navy px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[.12em] text-white">Our practice</span>
        <img src="<?= $LOCATION_IMG ?>" alt="Inside the Anew Era TMS &amp; Psychiatry clinic in The Woodlands"
             class="absolute inset-0 h-full w-full object-cover">
      </div>

      <div class="p-8 lg:p-12">
        <h3 class="text-[1.5rem] font-bold tracking-tightest text-navy">Everything under one roof</h3>
        <p class="mt-4 text-[15.5px] leading-[1.75] text-steel-600">
          Psychiatrists, psychiatric nurse practitioners and licensed therapists work from the same
          treatment plan in the same practice. Your prescriber and your therapist are not strangers
          to one another, and nothing gets lost between them.
        </p>

        <div class="mt-8 grid sm:grid-cols-2 gap-x-8 gap-y-5 pt-8 border-t border-steel-200">
          <?php foreach ([
            ['Board-certified clinicians','Psychiatrists and psychiatric nurse practitioners'],
            ['Medication and therapy together','One plan, one practice, no hand-offs'],
            ['In person or by video','Move between the two as it suits you'],
            ['Prompt refills','Prescriptions handled without the chase'],
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
          <?php foreach ([['60','minute first visit'],['1–5','days to be seen'],['0','cost to check benefits']] as $m): ?>
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
          A full psychiatric evaluation within five days — in person in The Woodlands, or by
          video from wherever you are.
        </p>
      </div>
      <a href="#book" class="shrink-0 inline-flex items-center gap-2.5 rounded-md bg-white px-7 py-4 text-[15px] font-semibold text-navy hover:bg-steel-100 transition">
        Book an evaluation
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
          From first call to a plan you understand
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

    <div class="cards-slider mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($services as $i => $sv): ?>
      <article class="reveal group flex flex-col overflow-hidden rounded-lg border border-steel-200 bg-white hover:shadow-pop transition-shadow">
        <div class="relative h-64 lg:h-72 overflow-hidden <?= $sv[4] === 'contain' ? 'bg-white border-b border-steel-200 p-5' : 'bg-steel-100' ?>">
          <img src="<?= $sv[3] ?>" alt="<?= htmlspecialchars($sv[0]) ?>" loading="lazy"
               class="h-full w-full <?= $sv[4] === 'contain' ? 'object-contain' : 'object-cover group-hover:scale-[1.03]' ?> <?= $sv[5] ?? 'object-center' ?> transition-transform duration-500">
          <span class="absolute top-4 left-4 rounded bg-navy/90 px-2.5 py-1 text-[12px] font-semibold text-white tracking-wide">0<?= $i+1 ?></span>
        </div>
        <div class="flex flex-col flex-1 p-7">
          <div class="flex flex-wrap items-center gap-2.5">
            <h3 class="text-[20px] font-bold tracking-tightest text-navy"><?= $sv[0] ?></h3>
            <?php if (!empty($sv[6])): ?>
              <span class="rounded border border-med-100 bg-med-50 px-2 py-0.5 text-[11px] font-bold uppercase tracking-wider text-med-700"><?= $sv[6] ?></span>
            <?php endif; ?>
          </div>
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
          Reviews left by patients under the care of our psychiatric team.
        </p>
      </div>
      <div class="shrink-0 flex items-center gap-3">
        <div class="hidden sm:flex items-center gap-2">
          <button type="button" onclick="rvScroll(-1)" aria-label="Previous reviews"
                  class="grid place-items-center h-11 w-11 rounded-md border border-steel-300 text-navy hover:border-med-500 hover:text-med-600 transition">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
          </button>
          <button type="button" onclick="rvScroll(1)" aria-label="More reviews"
                  class="grid place-items-center h-11 w-11 rounded-md border border-steel-300 text-navy hover:border-med-500 hover:text-med-600 transition">
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </button>
        </div>
        <a href="#book" class="inline-flex items-center gap-2.5 rounded-md bg-med-600 px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-med-700 transition">
          Request a free consultation
          <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
    </div>

    <!-- review grid -->
    <div class="rv-track mt-5" id="rv-track">
      <?php foreach ($reviews as $r): ?>
      <?php
        $parts = preg_split('/\s+/', $r[0]);
        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
      ?>
      <figure class="reveal flex flex-col rounded-lg border border-steel-200 bg-white p-6">
        <svg viewBox="0 0 24 24" class="h-6 w-6 shrink-0 text-steel-200" fill="currentColor"><path d="M9.5 6C6.5 6 4 8.5 4 11.5S6.5 17 9.5 17c.5 0 1-.1 1.4-.2-.6 1.6-2 2.8-3.9 3.2v1c4.4-.6 8-4.3 8-9.5C15 8.5 12.5 6 9.5 6zM20.5 6C17.5 6 15 8.5 15 11.5S17.5 17 20.5 17c.2 0 .4 0 .5-.1V20c-.1.1-.2.1-.3.2v.8c1.5-.5 2.8-1.6 3.3-3z"/></svg>
        <blockquote class="rv-text mt-4 text-[15px] leading-[1.7] text-steel-600"><?= $r[3] ?></blockquote>
        <button type="button" class="rv-more mt-3 self-start text-[13.5px] font-semibold text-med-600 hover:text-med-700 transition">Read more</button>
        <div class="flex-1"></div>
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
      Published reviews from our clinics on Google. Individual results vary.
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
          Psychiatric care is covered by most major insurance plans
        </h2>
        <p class="mt-6 text-[16.5px] leading-[1.75] text-steel-600">
          We accept most major commercial insurance companies as well as Tricare and Triwest across California and Texas.
          Your exact benefits are verified at no charge before treatment begins, and competitive cash-pay options are available.
        </p>
        <p class="mt-4 text-[14px] font-medium text-steel-700 bg-amber-50 inline-block px-3 py-1.5 rounded-md border border-amber-200/60">
          <strong>Note:</strong> We do not accept Medicaid.
        </p>
      </div>

      <div class="lg:w-80 rounded-lg border border-steel-200 bg-steel-50 p-7">
        <p class="eyebrow text-steel-400">Benefits verification</p>
        <p class="mt-3 text-[2.6rem] font-bold leading-none tracking-tightest text-navy">Free</p>
        <p class="mt-3 text-[14.5px] leading-relaxed text-steel-600">
         We handle the paperwork with your insurer and provide an estimate of your expected out-of-pocket cost.
        </p>
        <a href="#book" class="mt-6 block rounded-md bg-med-600 py-3.5 text-center text-[15px] font-semibold text-white hover:bg-med-700 transition">Check my coverage</a>
      </div>
    </div>

    <!-- State filter tabs -->
    <div class="reveal mt-8 flex flex-wrap items-center gap-2">
      <span class="text-xs font-semibold uppercase tracking-wider text-steel-400 mr-2">Filter by State:</span>
      <button type="button" onclick="filterInsurances('all')" id="ins-tab-all"
              class="ins-tab px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-md bg-navy text-white transition-colors duration-200 shadow-sm">
        All Accepted Plans
      </button>
      <button type="button" onclick="filterInsurances('ca')" id="ins-tab-ca"
              class="ins-tab px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-md bg-steel-100 text-steel-600 hover:bg-steel-200 transition-colors duration-200">
        California (CA)
      </button>
      <button type="button" onclick="filterInsurances('tx')" id="ins-tab-tx"
              class="ins-tab px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-md bg-steel-100 text-steel-600 hover:bg-steel-200 transition-colors duration-200">
        Texas (TX)
      </button>
    </div>

    <!-- carrier wall, full container width -->
    <div class="reveal mt-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4" id="insurance-grid">
      <?php foreach ($insurers as $ins): ?>
      <div data-state="<?= $ins[3] ?>"
           class="ins-card h-[110px] rounded-lg border border-steel-200 bg-white flex flex-col items-center justify-center gap-1.5 px-4 py-3 text-center hover:border-steel-300 transition-all">
        <?php if ($INS_LOGOS && $ins[1]): ?>
          <img src="<?= $INS_DIR . $ins[1] ?>" alt="<?= strip_tags($ins[0]) ?>" loading="lazy"
               class="max-h-11 w-auto max-w-full object-contain">
        <?php else: ?>
          <span class="text-[15px] font-semibold leading-snug text-navy"><?= $ins[0] ?></span>
        <?php endif; ?>
        <div class="flex items-center gap-1.5 flex-wrap justify-center">
          <?php if ($ins[2]): ?>
            <span class="text-[11px] leading-tight text-steel-400"><?= $ins[2] ?></span>
          <?php endif; ?>
          <span class="inline-block px-1.5 py-0.5 text-[10px] font-bold rounded bg-steel-100 text-steel-600">
            <?= $ins[3] === 'both' ? 'CA & TX' : strtoupper($ins[3]) ?>
          </span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="reveal mt-5 text-[13px] text-steel-400">
      Plan availability varies by clinic location. We confirm your specific coverage before treatment begins.
    </p>
  </div>
</section>

<script>
function filterInsurances(state) {
  const tabs = document.querySelectorAll('.ins-tab');
  tabs.forEach(t => {
    t.classList.remove('bg-navy', 'text-white', 'shadow-sm');
    t.classList.add('bg-steel-100', 'text-steel-600');
  });
  const activeTab = document.getElementById('ins-tab-' + state);
  if (activeTab) {
    activeTab.classList.remove('bg-steel-100', 'text-steel-600');
    activeTab.classList.add('bg-navy', 'text-white', 'shadow-sm');
  }

  const cards = document.querySelectorAll('.ins-card');
  cards.forEach(card => {
    const cardState = card.getAttribute('data-state');
    if (state === 'all' || cardState === 'both' || cardState === state) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}
</script>

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
          Psychiatric care that treats you as a person
        </h2>
        <p class="mt-5 text-[17px] leading-[1.7] text-steel-300 max-w-xl">
          Schedule your free consultation today and be evaluated within five days.
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

        <address class="mt-5 flex items-start gap-2.5 not-italic text-[14.5px] leading-relaxed">
          <svg viewBox="0 0 24 24" class="h-4 w-4 mt-1 shrink-0 text-med-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1116 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <span>
            <?php foreach ($ADDR_LINES as $line): ?><span class="block"><?= $line ?></span><?php endforeach; ?>
            <a href="<?= htmlspecialchars($MAP_LINK) ?>" target="_blank" rel="noopener"
               class="mt-1.5 inline-block font-semibold text-med-200 underline underline-offset-4 hover:text-white transition">Get directions</a>
          </span>
        </address>
      </div>

      <div>
        <h4 class="text-white font-semibold text-[14px]">Treatment</h4>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach (['Psychiatric Evaluation','Medication Management','Psychotherapy','SPRAVATO&reg;'] as $l): ?>
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

    <div class="mt-12 overflow-hidden rounded-lg border border-white/15">
      <iframe src="<?= htmlspecialchars($MAP_EMBED) ?>"
              title="Map to Anew Era TMS &amp; Psychiatry, <?= htmlspecialchars($ADDR) ?>"
              class="block h-[260px] sm:h-[320px] w-full" style="border:0"
              allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>

    <div class="mt-14 pt-8 border-t border-white/10 text-[13px] text-steel-400">
      <p>&copy; 2018–<?= date('Y') ?> Anew Era TMS &amp; Psychiatry. All rights reserved.</p>
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

/* ── Reviews carousel ─────────────────────────────────────────────────── */
function rvScroll(dir) {
  const t = document.getElementById('rv-track');
  t.scrollBy({ left: dir * t.clientWidth * 0.9, behavior: 'smooth' });
}

/* Read more only appears on reviews long enough to be clipped, so the short
   ones do not carry a button that expands nothing. Measured after load so the
   web font is in place. */
window.addEventListener('load', () => {
  document.querySelectorAll('.rv-more').forEach(btn => {
    const text = btn.previousElementSibling;
    if (text.scrollHeight <= text.clientHeight + 1) { btn.hidden = true; return; }
    btn.addEventListener('click', () => {
      const open = text.classList.toggle('open');
      btn.textContent = open ? 'Show less' : 'Read more';
    });
  });
});

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
