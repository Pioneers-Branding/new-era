<?php
/**
 * Anew Era TMS & Psychiatry — Thank You Page
 * Form submission confirmation page.
 */

$PHONE     = '(936) 444-4870';
$PHONE_RAW = '9364444870';

$BASE       = '';   // see index.php
$LOGO       = $BASE . 'assets/logo/new-era-logo.webp';
$LOGO_WHITE = $BASE . 'assets/logo/new-era-logo-white.png';

$INS_DIR = $BASE . 'assets/insurances/';
$insurers = [
    ['Aetna',                               'aetna.webp'],
    ['Anthem Blue Cross',                   'anthem.webp'],
    ['Blue Cross Blue Shield of Tx (BCBS)', null],
    ['Blue Shield of California',            'blue-california.webp'],
    ['Cigna',                               'cigna.webp'],
    ['Healthnet',                           'health-net.png'],
    ['Humana',                               null],
    ['Magellan / MHSA',                     'megallan-health-logo.png'],
    ['MHN',                                 'mhn.webp'],
    ['Optum',                               'optum.webp'],
    ['Oscar',                               null],
    ['Tricare-West',                        'tricare.webp'],
    ['Tricare-East',                        'tricare.webp'],
    ['Triwest CCN',                         'triwest.png'],
    ['United Healthcare',                   'unitedhealthcare.png'],
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

<!-- Event snippet for Submit lead form Psy conversion page.
     Fires on load of this page, which the lead form redirects to after a
     successful submission. Must stay after the global tag above, which is
     where gtag() is defined. -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-18384277784/ySDeCJTMzu0cEJiip75E',
      'value': 1.0,
      'currency': 'USD'
  });
</script>
<title>Thank You — Anew Era TMS &amp; Psychiatry</title>
<link rel="icon" type="image/png" sizes="32x32" href="<?= $BASE ?>favicon.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= $BASE ?>apple-touch-icon.png">
<meta name="description" content="Thank you for requesting a consultation with Anew Era TMS & Psychiatry. We verify your insurance benefits at no cost and will contact you shortly.">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          navy: { DEFAULT: '#0F2440', 800: '#142C4C', 900: '#0B1A2E' },
          med: { 100: '#E6F4FA', 200: '#BAE3F5', 300: '#7ECBEF', 400: '#38AFE7', 500: '#0094D8', 600: '#007BB8', 700: '#005F91' },
          steel: { 50: '#F8FAFC', 100: '#F1F5F9', 200: '#E2E8F0', 300: '#CBD5E1', 400: '#94A3B8', 500: '#64748B', 600: '#475569', 700: '#334155' }
        },
        fontFamily: { sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'] },
        letterSpacing: { tightest: '-.035em' }
      }
    }
  }
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  .eyebrow { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.12em; }
  .rule { width:32px; height:2px; background:#0094D8; }
</style>
</head>

<body class="bg-steel-50 text-navy font-sans min-h-screen flex flex-col justify-between">

<!-- ═══ HEADER ═══ -->
<header class="bg-navy border-b border-white/10 sticky top-0 z-50">
  <div class="mx-auto max-w-[82rem] px-6 h-10 flex items-center justify-between border-b border-white/10 text-[13px] text-steel-300">
    <p class="hidden sm:block">Accepting new patients &amp; most major insurance plans</p>
    <div class="flex items-center gap-6 mx-auto sm:mx-0">
      <span class="hidden md:inline">15 clinics across CA &amp; TX</span>
      <a href="tel:<?= $PHONE_RAW ?>" class="font-semibold text-white hover:text-med-200 transition"><?= $PHONE ?></a>
    </div>
  </div>

  <div class="mx-auto max-w-[82rem] px-6">
    <div class="flex items-center justify-between h-[72px]">
      <a href="index.php" class="relative block h-11 w-[152px] shrink-0" aria-label="Anew Era TMS &amp; Psychiatry — home">
        <img src="<?= $LOGO_WHITE ?>" alt="Anew Era TMS &amp; Psychiatry" width="300" height="87" class="h-full w-auto">
      </a>

      <div class="flex items-center gap-4">
        <a href="tel:<?= $PHONE_RAW ?>" class="hidden sm:flex items-center gap-2.5 rounded-lg border border-white/20 px-4 py-2 text-[14px] font-semibold text-white hover:bg-white/10 transition">
          <svg viewBox="0 0 24 24" class="h-4 w-4 text-med-300" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
          <?= $PHONE ?>
        </a>
        <a href="index.php" class="inline-flex items-center gap-2 rounded-lg bg-med-600 px-4 py-2 text-[14px] font-semibold text-white hover:bg-med-700 transition">
          <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
          Back to Home
        </a>
      </div>
    </div>
  </div>
</header>

<!-- ═══ MAIN THANK YOU CONTENT ═══ -->
<main class="flex-1 py-12 lg:py-20">
  <div class="mx-auto max-w-4xl px-6">
    <div class="rounded-2xl border border-steel-200 bg-white p-8 sm:p-12 shadow-xl shadow-steel-200/50 text-center">
      
      <!-- Success Icon -->
      <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 ring-8 ring-emerald-50">
        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>

      <span class="eyebrow text-med-600">Consultation Request Received</span>
      <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tightest text-navy">
        Thank You for Reaching Out!
      </h1>
      <p class="mt-4 text-base sm:text-lg text-steel-600 max-w-2xl mx-auto leading-relaxed">
        Our clinical intake team has received your information. We review requests promptly and will contact you back shortly to verify your insurance benefits at no cost and answer any questions.
      </p>

      <!-- Immediate Call Action Box -->
      <div class="mt-8 rounded-xl border border-steel-200 bg-navy text-white p-6 sm:p-8 max-w-xl mx-auto text-left">
        <div class="flex items-center gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-med-600 text-white">
            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .4 1.9.7 2.8a2 2 0 01-.5 2.1L8.1 9.9a16 16 0 006 6l1.3-1.2a2 2 0 012.1-.5c.9.3 1.8.6 2.8.7a2 2 0 011.7 2z"/></svg>
          </div>
          <div>
            <h2 class="text-lg font-bold text-white">Need immediate assistance?</h2>
            <p class="text-xs text-steel-300">Speak directly with our clinical coordinator right now.</p>
          </div>
        </div>
        <div class="mt-5 flex flex-col sm:flex-row items-center gap-4">
          <a href="tel:<?= $PHONE_RAW ?>" class="w-full sm:w-auto flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-med-600 px-6 py-3 text.15px font-semibold text-white hover:bg-med-500 transition">
            Call <?= $PHONE ?>
          </a>
          <span class="text-xs text-steel-400">Monday–Friday 8am–6pm</span>
        </div>
      </div>

      <!-- Roadmap / Next Steps -->
      <div class="mt-12 border-t border-steel-200 pt-10 text-left">
        <h3 class="text-lg font-bold text-navy text-center mb-8">What Happens Next?</h3>
        
        <div class="grid sm:grid-cols-3 gap-6">
          <div class="rounded-lg border border-steel-200 bg-steel-50 p-5">
            <div class="flex items-center gap-2 text-med-600 font-bold text-sm mb-2">
              <span class="flex h-6 w-6 items-center justify-center rounded-full bg-med-100 text-xs">1</span>
              Free Coverage Check
            </div>
            <p class="text-xs leading-relaxed text-steel-600">
              We verify your insurance benefits directly with your provider to confirm your exact out-of-pocket cost.
            </p>
          </div>

          <div class="rounded-lg border border-steel-200 bg-steel-50 p-5">
            <div class="flex items-center gap-2 text-med-600 font-bold text-sm mb-2">
              <span class="flex h-6 w-6 items-center justify-center rounded-full bg-med-100 text-xs">2</span>
              Intake Consultation
            </div>
            <p class="text-xs leading-relaxed text-steel-600">
              Our clinical coordinator reviews your health history and routes you to the nearest of our 15 clinics.
            </p>
          </div>

          <div class="rounded-lg border border-steel-200 bg-steel-50 p-5">
            <div class="flex items-center gap-2 text-med-600 font-bold text-sm mb-2">
              <span class="flex h-6 w-6 items-center justify-center rounded-full bg-med-100 text-xs">3</span>
              First Appointment
            </div>
            <p class="text-xs leading-relaxed text-steel-600">
              Your evaluation and initial treatment protocol are scheduled typically within 1 to 5 business days.
            </p>
          </div>
        </div>
      </div>

      <!-- Back to Home CTA -->
      <div class="mt-10 pt-6 border-t border-steel-100 flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="index.php" class="inline-flex items-center gap-2 rounded-lg bg-navy px-8 py-3.5 text-[15px] font-semibold text-white hover:bg-navy-800 transition shadow-md">
          Return to Main Page
        </a>
      </div>

    </div>
  </div>
</main>

<!-- ═══ FOOTER ═══ -->
<footer class="bg-navy-900 border-t border-white/10 text-white py-10">
  <div class="mx-auto max-w-[82rem] px-6 flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-steel-400">
    <div class="flex items-center gap-4">
      <img src="<?= $LOGO_WHITE ?>" alt="Anew Era TMS &amp; Psychiatry" width="150" height="44" class="h-8 w-auto">
      <span>&copy; <?= date('Y') ?> Anew Era TMS &amp; Psychiatry. All rights reserved.</span>
    </div>
    <div class="flex items-center gap-6">
      <a href="tel:<?= $PHONE_RAW ?>" class="text-steel-300 hover:text-white font-medium transition"><?= $PHONE ?></a>
      <a href="index.php" class="text-steel-300 hover:text-white transition">Home</a>
    </div>
  </div>
</footer>

</body>
</html>
