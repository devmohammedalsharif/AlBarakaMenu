<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مطعم البركة | القائمة الرقمية</title>
    <meta name="description" content="قائمة مطعم البركة الرقمية — شاورما، مشاوي، وسلطات مع صور وأسعار محدثة.">
    <meta name="theme-color" content="#0c0c0c">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #c59d5f;
            --bg-body: #0c0c0c;
            --bg-surface: #121212;
            --bg-card: #161616;
            --text-main: #ffffff;
            --text-muted: rgba(255,255,255,0.72);
            --text-dim: rgba(255,255,255,0.55);
            --border: rgba(255,255,255,0.10);
            --shadow: 0 18px 50px rgba(0,0,0,0.55);
            --shadow-soft: 0 12px 30px rgba(0,0,0,0.40);
            --radius-lg: 18px;
            --radius-md: 14px;
            --radius-sm: 12px;
            --accent-red: #e74c3c;
            --success: #2ecc71;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        html { scroll-behavior: smooth; }
        body {
            background:
                radial-gradient(1200px 600px at 12% 6%, rgba(197,157,95,0.12), transparent 60%),
                radial-gradient(900px 500px at 90% 10%, rgba(231,76,60,0.08), transparent 55%),
                var(--bg-body);
            color: var(--text-main);
        }

        a { color: inherit; }
        img { display: block; }
        ::selection { background: rgba(197,157,95,0.25); }

        .skip-link {
            position: absolute;
            inset-inline-start: 12px;
            top: 12px;
            padding: 10px 12px;
            background: #000;
            border: 1px solid var(--border);
            border-radius: 10px;
            transform: translateY(-150%);
            transition: 160ms ease;
            z-index: 2000;
            text-decoration: none;
        }
        .skip-link:focus { transform: translateY(0); outline: none; box-shadow: var(--shadow-soft); }

        .hero {
            min-height: 46vh;
            background:
                radial-gradient(900px 300px at 50% 30%, rgba(197,157,95,0.22), transparent 60%),
                linear-gradient(to bottom, rgba(0,0,0,0.25), var(--bg-body)),
                url('https://images.unsplash.com/photo-1598103442097-8b74394b95c6?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 28px 18px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(0,0,0,0.35);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-soft);
        }
        .brand-badge {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(145deg, rgba(197,157,95,0.95), rgba(197,157,95,0.55));
            box-shadow: 0 10px 25px rgba(197,157,95,0.22);
            display: grid;
            place-items: center;
            color: #0b0b0b;
            font-weight: 900;
            letter-spacing: 0.5px;
        }
        .hero h1 {
            font-size: clamp(2.1rem, 3.6vw, 3.6rem);
            color: var(--primary);
            margin: 14px 0 10px;
            text-shadow: 2px 2px 12px rgba(0,0,0,0.8);
        }
        .hero p {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-weight: 700;
            color: rgba(255,255,255,0.9);
        }
        .hero .meta {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(18,18,18,0.68);
            border: 1px solid rgba(255,255,255,0.12);
            color: var(--text-muted);
            backdrop-filter: blur(10px);
        }
        .pill strong { color: var(--text-main); }

        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(12, 12, 12, 0.86);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(14px);
        }
        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 800;
            font-size: 1.05rem;
            padding: 10px 12px;
            border-radius: 999px;
            border: 1px solid transparent;
            transition: 160ms ease;
            white-space: nowrap;
        }
        nav a:hover { color: var(--text-main); border-color: rgba(197,157,95,0.22); background: rgba(197,157,95,0.10); }
        nav a[aria-current="true"] { color: var(--text-main); background: rgba(197,157,95,0.14); border-color: rgba(197,157,95,0.28); }
        .nav-tools { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

        .container { max-width: 1200px; margin: auto; padding: clamp(18px, 2.2vw, 28px) clamp(14px, 2vw, 20px) 56px; }

        .section-header {
            margin: 34px 0 16px;
            padding: 14px 16px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(197,157,95,0.20);
            background:
                radial-gradient(800px 120px at 30% 20%, rgba(197,157,95,0.16), transparent 60%),
                rgba(18,18,18,0.68);
            font-size: clamp(1.3rem, 2.2vw, 2rem);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .section-header .count {
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.10);
            color: var(--text-muted);
            font-size: 0.95rem;
            background: rgba(0,0,0,0.15);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: clamp(12px, 2.2vw, 26px);
        }

        .food-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.03), transparent 50%), var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
            border: 1px solid rgba(255,255,255,0.10);
            box-shadow: 0 10px 30px rgba(0,0,0,0.35);
            position: relative;
        }

        .food-card:hover { transform: translateY(-8px); border-color: rgba(197,157,95,0.40); box-shadow: var(--shadow); }
        .media { position: relative; width: 100%; height: 220px; overflow: hidden; }
        .food-card img { width: 100%; height: 100%; object-fit: cover; transform: scale(1.02); transition: transform 220ms ease; }
        .food-card:hover img { transform: scale(1.06); }
        .media::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.62), rgba(0,0,0,0.00) 55%); }
        .card-content { padding: 14px 14px 16px; text-align: start; }
        .title-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .card-content h3 { margin-bottom: 8px; font-size: 1.18rem; line-height: 1.35; }
        .subtitle { color: var(--text-dim); font-size: 0.98rem; margin-bottom: 12px; }
        .price-box { display: inline-block; background: var(--primary); color: #000; padding: 5px 15px; border-radius: 20px; font-weight: 900; font-size: 1.1rem; }
        .actions { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .mini { color: var(--text-dim); font-size: 0.95rem; font-weight: 700; }
        .chip { display: inline-flex; align-items: center; gap: 8px; padding: 8px 10px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.12); background: rgba(0,0,0,0.15); color: rgba(255,255,255,0.88); cursor: pointer; font-weight: 900; transition: 160ms ease; }
        .chip:hover { border-color: rgba(197,157,95,0.35); background: rgba(197,157,95,0.10); }

        @media (max-width: 768px) {
            .menu-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .media { height: 170px; }
            .card-content h3 { font-size: 1rem; }
        }
        @media (max-width: 520px) {
            .nav-links { flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; gap: 8px; padding: 2px 2px 8px; }
            .menu-grid { grid-template-columns: 1fr; }
            .media { height: 190px; }
        }
        @media (prefers-reduced-motion: reduce) { * { scroll-behavior: auto !important; transition: none !important; } }
    </style>
</head>
<body>

<a class="skip-link" href="#menu">تخطي إلى القائمة</a>

<header class="hero" role="banner">
    <div class="brand" aria-label="هوية مطعم البركة">
        <div class="brand-badge" aria-hidden="true">ب</div>
        <div style="text-align:start">
            <div style="font-weight:900; letter-spacing:0.2px">مطعم البركة</div>
            <div style="color: rgba(255,255,255,0.70); font-weight:700; font-size:0.98rem">قائمة رقمية — صور وأسعار</div>
        </div>
    </div>
    <h1>البركة طعم فيه بركة</h1>
    <p>اختَر صنفك بسرعة — تنقّل بين الأقسام بكل سلاسة</p>
    <div class="meta" aria-label="معلومات سريعة">
        <span class="pill"><strong>جاهز بسرعة</strong> <span style="color:rgba(255,255,255,0.55)">حسب الطلب</span></span>
        <span class="pill"><strong>مكونات طازجة</strong> <span style="color:rgba(255,255,255,0.55)">يوميًا</span></span>
        <span class="pill"><strong>خدمة محلية</strong> <span style="color:rgba(255,255,255,0.55)">داخل المدينة</span></span>
    </div>
</header>

<nav>
    <div class="nav-inner">
        <div class="nav-links" aria-label="أقسام القائمة">
            @foreach($categories as $category)
                <a href="#cat-{{ $category->id }}" data-nav="cat-{{ $category->id }}">{{ $category->name }}</a>
            @endforeach
        </div>
        <div class="nav-tools" aria-label="أدوات إضافية"></div>
    </div>
</nav>

<main id="menu" class="container" role="main">
    @foreach($categories as $category)
        <section aria-labelledby="cat-{{ $category->id }}">
            <h2 class="section-header" id="cat-{{ $category->id }}">
                <span>{{ $category->name }}</span>
                <span class="count">{{ $category->meals->count() }} صنف</span>
            </h2>

            <div class="menu-grid" data-section="cat-{{ $category->id }}">
                @foreach($category->meals as $meal)
                    <article class="food-card" data-name="{{ $meal->name }}" data-category="cat-{{ $category->id }}">
                        <div class="media">
                            <img loading="lazy" decoding="async" src="{{ $meal->image_path }}" alt="{{ $meal->name }}">
                        </div>
                        <div class="card-content">
                            <div class="title-row">
                                <h3>{{ $meal->name }}</h3>
                                <span class="price-box"><span class="tabular-nums">{{ rtrim(rtrim(number_format((float)$meal->price, 2), '0'), '.') }}</span> شيكل</span>
                            </div>
                            @if($meal->description)
                                <div class="subtitle">{{ $meal->description }}</div>
                            @endif
                            <div class="actions">
                                <span class="mini">قسم: {{ $category->name }}</span>
                                <button class="chip" type="button" data-jump="#cat-{{ $category->id }}">عرض القسم</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endforeach
</main>

<footer style="text-align: center; padding: 44px 16px; color: var(--text-muted); border-top: 1px solid rgba(255,255,255,0.10); margin-top: 24px; background: rgba(18,18,18,0.45);">
    <div style="max-width:1200px; margin:0 auto; display:grid; gap:10px;">
        <div style="font-weight:900; color:rgba(255,255,255,0.92)">مطعم البركة</div>
        <div style="color:rgba(255,255,255,0.55); font-size:0.98rem">جميع الحقوق محفوظة © مطعم البركة 2026</div>
    </div>
</footer>

<script>
    (function () {
        // Jump chips
        document.addEventListener('click', (e) => {
            const btn = e.target && e.target.closest && e.target.closest('[data-jump]');
            if (!btn) return;
            const target = btn.getAttribute('data-jump');
            const el = document.querySelector(target);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        // Active nav link on scroll
        const sections = Array.from(document.querySelectorAll('h2.section-header')).map((h) => {
            const id = h.getAttribute('id');
            const link = document.querySelector(`a[data-nav="${id}"]`);
            return link ? { id, link } : null;
        }).filter(Boolean);

        const observer = new IntersectionObserver((entries) => {
            const visible = entries.filter(e => e.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
            if (!visible) return;
            for (const s of sections) s.link.setAttribute('aria-current', 'false');
            const active = sections.find(s => s.id === visible.target.id);
            if (active) active.link.setAttribute('aria-current', 'true');
        }, { root: null, threshold: [0.12, 0.2, 0.35, 0.5, 0.65] });

        for (const s of sections) {
            const el = document.getElementById(s.id);
            if (el) observer.observe(el);
        }
    })();
</script>

</body>
</html>

