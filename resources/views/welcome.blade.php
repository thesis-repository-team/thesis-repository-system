<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Thesis Repository</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>
        :root {
            --primary: #6538d9;
            --primary-dark: #4f27b5;
            --black: #111111;
            --dark: #181818;
            --white: #ffffff;
            --gray-50: #fafafa;
            --gray-100: #f4f4f5;
            --gray-200: #e4e4e7;
            --gray-500: #71717a;
            --gray-700: #3f3f46;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: var(--white);
            color: var(--black);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
            font-family: inherit;
        }

        .welcome-page {
            min-height: 100vh;
            background: var(--white);
        }

        .container {
            width: min(1200px, calc(100% - 40px));
            margin: 0 auto;
        }

        .navbar {
            height: 76px;
            border-bottom: 1px solid var(--gray-200);
            background: rgba(255, 255, 255, 0.96);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .navbar-inner {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--black);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 20px;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            transition: color .2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 9px 17px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-outline {
            border: 1px solid var(--gray-200);
            color: var(--black);
            background: var(--white);
        }

        .btn-outline:hover {
            border-color: var(--black);
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: 1px solid var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 85% 20%,
                    rgba(101, 56, 217, .13),
                    transparent 30%
                ),
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #fafafa 100%
                );
            padding: 95px 0 85px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            align-items: center;
            gap: 70px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 30px;
            background: #f0ebff;
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            margin-bottom: 22px;
        }

        .hero-label i {
            font-size: 13px;
        }

        .hero-title {
            font-size: clamp(40px, 5vw, 68px);
            line-height: 1.02;
            letter-spacing: -2.5px;
            font-weight: 700;
            max-width: 700px;
        }

        .hero-title span {
            color: var(--primary);
        }

        .hero-description {
            max-width: 620px;
            margin-top: 24px;
            color: var(--gray-500);
            font-size: 17px;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 32px;
        }

        .hero-btn {
            min-height: 48px;
            padding: 12px 21px;
            border-radius: 9px;
            font-size: 14px;
        }

        .hero-visual {
            position: relative;
        }

        .repository-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .08);
        }

        .repository-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .repository-card-title {
            font-size: 14px;
            font-weight: 700;
        }

        .repository-card-badge {
            padding: 5px 9px;
            border-radius: 20px;
            background: #f0ebff;
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
        }

        .thesis-mini-card {
            padding: 17px;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            margin-bottom: 10px;
            transition: border-color .2s ease, transform .2s ease;
        }

        .thesis-mini-card:hover {
            border-color: var(--primary);
            transform: translateX(3px);
        }

        .thesis-mini-title {
            font-size: 13px;
            line-height: 1.5;
            font-weight: 600;
        }

        .thesis-mini-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 9px;
            color: var(--gray-500);
            font-size: 10px;
        }

        .thesis-mini-meta i {
            margin-right: 3px;
        }

        .section {
            padding: 90px 0;
        }

        .section-gray {
            background: var(--gray-50);
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 35px;
        }

        .section-label {
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 34px;
            letter-spacing: -1px;
            font-weight: 700;
        }

        .section-description {
            max-width: 520px;
            color: var(--gray-500);
            font-size: 14px;
            line-height: 1.7;
        }

        .search-box {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 7px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .search-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
        }

        .search-box input {
            flex: 1;
            border: 0;
            outline: 0;
            background: transparent;
            font-size: 14px;
            color: var(--black);
            min-width: 0;
        }

        .search-box input::placeholder {
            color: #a1a1aa;
        }

        .search-btn {
            border: 0;
            cursor: pointer;
        }

        .thesis-table-wrapper {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            overflow: hidden;
        }

        .thesis-table-scroll {
            overflow-x: auto;
        }

        .thesis-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .thesis-table th {
            background: #fafafa;
            color: var(--gray-500);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .thesis-table td {
            padding: 17px 18px;
            font-size: 13px;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .thesis-table tr:last-child td {
            border-bottom: 0;
        }

        .thesis-table tbody tr {
            transition: background .2s ease;
        }

        .thesis-table tbody tr:hover {
            background: #fcfcff;
        }

        .title-cell {
            min-width: 280px;
            max-width: 380px;
            font-weight: 600;
            line-height: 1.5;
        }

        .author-cell {
            white-space: nowrap;
            color: var(--gray-700);
        }

        .department-badge {
            display: inline-flex;
            padding: 5px 9px;
            border-radius: 6px;
            background: #f4f1ff;
            color: var(--primary);
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .date-cell {
            white-space: nowrap;
            color: var(--gray-500);
            font-size: 12px;
        }

        .public-action-cell {
            min-width: 220px;
            width: 220px;
            white-space: nowrap;
        }

        .public-action-buttons {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: nowrap;
            width: max-content;
        }

        .public-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 32px;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            border: 1px solid transparent;
            transition: .2s ease;
        }

        .public-action-btn:hover {
            transform: translateY(-1px);
        }

        .public-view-btn {
            background: #198754;
            border-color: #198754;
            color: #fff;
        }

        .public-view-btn:hover {
            background: #157347;
            color: #fff;
        }

        .public-download-btn {
            background: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .public-download-btn:hover {
            background: #0b5ed7;
            color: #fff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 13px;
            padding: 24px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #f0ebff;
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 18px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            margin-top: 8px;
            color: var(--gray-500);
            font-size: 12px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            padding: 28px;
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            background: var(--white);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--black);
            color: var(--white);
            font-size: 20px;
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .feature-text {
            color: var(--gray-500);
            font-size: 13px;
            line-height: 1.7;
        }

        .cta {
            background: var(--black);
            color: var(--white);
            padding: 70px 0;
        }

        .cta-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .cta-title {
            font-size: 36px;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .cta-text {
            margin-top: 12px;
            color: #a1a1aa;
            font-size: 14px;
        }

        .cta-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .cta .btn-outline {
            background: transparent;
            border-color: #3f3f46;
            color: var(--white);
        }

        .cta .btn-outline:hover {
            border-color: var(--white);
        }

        .footer {
            background: #0b0b0b;
            color: #a1a1aa;
            padding: 30px 0;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-brand {
            color: var(--white);
            font-weight: 700;
            font-size: 13px;
        }

        .footer-copy {
            font-size: 11px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            font-size: 11px;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        @media (max-width: 1000px) {

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 45px;
            }

            .hero-visual {
                max-width: 600px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .cta-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 768px) {

            .container {
                width: min(100% - 28px, 1200px);
            }

            .navbar {
                height: 68px;
            }

            .nav-links {
                display: none;
            }

            .brand-subtitle {
                display: none;
            }

            .hero {
                padding: 65px 0;
            }

            .hero-title {
                font-size: 42px;
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 15px;
            }

            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-btn {
                width: 100%;
            }

            .section {
                padding: 65px 0;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 18px;
            }

            .stat-number {
                font-size: 25px;
            }

            .cta-title {
                font-size: 30px;
            }

            .cta-actions {
                width: 100%;
                flex-direction: column;
            }

            .cta-actions .btn {
                width: 100%;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {

            .nav-actions .btn-outline {
                display: none;
            }

            .brand-title {
                font-size: 14px;
            }

            .hero-title {
                font-size: 36px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="welcome-page">

        <header class="navbar">

            <div class="container navbar-inner">

                <a href="{{ url('/') }}" class="brand">

                    <div class="brand-logo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <div class="brand-text">
                        <span class="brand-title">
                            Thesis Repository
                        </span>

                        <span class="brand-subtitle">
                            Academic Research Platform
                        </span>
                    </div>

                </a>

                <nav class="nav-links">

                    <a href="#home" class="nav-link">
                        Home
                    </a>

                    <a href="#theses" class="nav-link">
                        Public Theses
                    </a>

                    <a href="#features" class="nav-link">
                        Features
                    </a>

                </nav>

                <div class="nav-actions">

                    @auth

                        <a href="{{ url('/dashboard') }}"
                            class="btn btn-primary">

                            <i class="bi bi-speedometer2"></i>

                            Dashboard

                        </a>

                    @else

                        <a href="{{ route('login') }}"
                            class="btn btn-outline">

                            Login

                        </a>

                        @if (Route::has('register'))

                            <a href="{{ route('register') }}"
                                class="btn btn-primary">

                                Register

                            </a>

                        @endif

                    @endauth

                </div>

            </div>

        </header>


        <main>

            <section class="hero" id="home">

                <div class="container hero-grid">

                    <div class="hero-content">

                        <div class="hero-label">

                            <i class="bi bi-book-half"></i>

                            ACADEMIC THESIS REPOSITORY

                        </div>

                        <h1 class="hero-title">

                            Discover.
                            <span>Research.</span>
                            Inspire.

                        </h1>

                        <p class="hero-description">

                            Explore a collection of academic theses and
                            research projects created by students and
                            researchers. Discover knowledge, ideas, and
                            research from across the university.

                        </p>

                        <div class="hero-actions">

                            <a href="#theses"
                                class="btn btn-primary hero-btn">

                                <i class="bi bi-search"></i>

                                Browse Public Theses

                            </a>

                            @guest

                                <a href="{{ route('login') }}"
                                    class="btn btn-outline hero-btn">

                                    <i class="bi bi-box-arrow-in-right"></i>

                                    Sign In

                                </a>

                            @endguest

                        </div>

                    </div>


                    <div class="hero-visual">

                        <div class="repository-card">

                            <div class="repository-card-header">

                                <span class="repository-card-title">
                                    Recent Research
                                </span>

                                <span class="repository-card-badge">
                                    PUBLIC
                                </span>

                            </div>

                            @forelse($theses->take(3) as $thesis)

                                <div class="thesis-mini-card">

                                    <div class="thesis-mini-title">
                                        {{ $thesis->title }}
                                    </div>

                                    <div class="thesis-mini-meta">

                                        <span>
                                            <i class="bi bi-person"></i>
                                            {{ $thesis->author_name }}
                                        </span>

                                        <span>
                                            <i class="bi bi-calendar3"></i>
                                            {{ $thesis->published_at?->format('Y') }}
                                        </span>

                                    </div>

                                </div>

                            @empty

                                <div class="thesis-mini-card">

                                    <div class="thesis-mini-title">
                                        No public theses available yet.
                                    </div>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </section>


            <section class="section section-gray">

                <div class="container">

                    <div class="stats-grid">

                        <div class="stat-card">

                            <div class="stat-icon">
                                <i class="bi bi-journal-text"></i>
                            </div>

                            <div class="stat-number">
                                {{ $totalTheses ?? $theses->count() }}
                            </div>

                            <div class="stat-label">
                                Public Theses
                            </div>

                        </div>


                        <div class="stat-card">

                            <div class="stat-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="stat-number">
                                {{ $totalDepartments ?? $theses->pluck('department_id')->unique()->count() }}
                            </div>

                            <div class="stat-label">
                                Departments
                            </div>

                        </div>


                        <div class="stat-card">

                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="stat-number">
                                {{ $totalAuthors ?? $theses->pluck('author_name')->unique()->count() }}
                            </div>

                            <div class="stat-label">
                                Researchers
                            </div>

                        </div>


                        <div class="stat-card">

                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>

                            <div class="stat-number">
                                {{ $totalFiles ?? $theses->sum(fn ($thesis) => $thesis->files->count()) }}
                            </div>

                            <div class="stat-label">
                                Research Files
                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <section class="section" id="theses">

                <div class="container">

                    <div class="section-header">

                        <div>

                            <div class="section-label">
                                RESEARCH COLLECTION
                            </div>

                            <h2 class="section-title">
                                Public Theses
                            </h2>

                        </div>

                        <p class="section-description">

                            Browse publicly available academic research
                            and discover theses from different departments.

                        </p>

                    </div>


                    <form action="{{ url('/') }}"
                        method="GET"
                        class="search-box">

                        <div class="search-icon">

                            <i class="bi bi-search"></i>

                        </div>

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search thesis title, author, or department...">

                        <button type="submit"
                            class="btn btn-primary search-btn">

                            Search

                        </button>

                    </form>


                    <div class="thesis-table-wrapper">

                        <div class="thesis-table-scroll">

                            <table class="thesis-table">

                                <thead>

                                    <tr>

                                        <th>
                                            #
                                        </th>

                                        <th>
                                            Thesis
                                        </th>

                                        <th>
                                            Author
                                        </th>

                                        <th>
                                            Department
                                        </th>

                                        <th>
                                            Published
                                        </th>

                                        <th>
                                            Action
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($theses as $thesis)

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="title-cell">
                                                {{ $thesis->title }}
                                            </td>

                                            <td class="author-cell">
                                                {{ $thesis->author_name }}
                                            </td>

                                            <td>

                                                <span class="department-badge">

                                                    {{ $thesis->department?->name ?? '-' }}

                                                </span>

                                            </td>

                                            <td class="date-cell">

                                                {{ $thesis->published_at?->format('M d, Y') ?? '-' }}

                                            </td>

                                            <td class="public-action-cell">

                                                @if ($thesis->files->count())

                                                    <div class="public-action-buttons">

                                                        @foreach ($thesis->files as $file)

                                                            <a href="{{ route('student.thesis.view-pdf', ['file' => $file->id]) }}"
                                                                target="_blank"
                                                                class="public-action-btn public-view-btn">

                                                                <i class="bi bi-eye"></i>

                                                                View

                                                            </a>


                                                            <a href="{{ route('student.thesis.download', $file) }}"
                                                                class="public-action-btn public-download-btn">

                                                                <i class="bi bi-download"></i>

                                                                Download

                                                            </a>

                                                        @endforeach

                                                    </div>

                                                @else

                                                    <span style="color:#71717a;font-size:12px;">
                                                        No PDF
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="6"
                                                style="text-align:center;padding:45px;color:#71717a;">

                                                <i class="bi bi-journal-x"
                                                    style="font-size:28px;display:block;margin-bottom:10px;">
                                                </i>

                                                No public theses found.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </section>


            <section class="section section-gray" id="features">

                <div class="container">

                    <div class="section-header">

                        <div>

                            <div class="section-label">
                                PLATFORM
                            </div>

                            <h2 class="section-title">
                                Everything in One Place
                            </h2>

                        </div>

                        <p class="section-description">

                            A centralized platform for managing,
                            discovering, and accessing academic research.

                        </p>

                    </div>


                    <div class="feature-grid">

                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <h3 class="feature-title">
                                Discover Research
                            </h3>

                            <p class="feature-text">

                                Search and explore published theses
                                across different departments and
                                academic fields.

                            </p>

                        </div>


                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>

                            <h3 class="feature-title">
                                Read & Download
                            </h3>

                            <p class="feature-text">

                                View available thesis documents online
                                or download published research for
                                academic reference.

                            </p>

                        </div>


                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="bi bi-bookmark"></i>
                            </div>

                            <h3 class="feature-title">
                                Save Your Research
                            </h3>

                            <p class="feature-text">

                                Sign in to save interesting theses and
                                quickly access them again from your
                                personal collection.

                            </p>

                        </div>

                    </div>

                </div>

            </section>


            <section class="cta">

                <div class="container cta-inner">

                    <div>

                        <h2 class="cta-title">
                            Start exploring academic research.
                        </h2>

                        <p class="cta-text">
                            Find knowledge. Discover ideas. Support research.
                        </p>

                    </div>

                    <div class="cta-actions">

                        <a href="#theses"
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Browse Theses

                        </a>

                        @guest

                            <a href="{{ route('login') }}"
                                class="btn btn-outline">

                                Sign In

                            </a>

                        @endguest

                    </div>

                </div>

            </section>

        </main>


        <footer class="footer">

            <div class="container footer-inner">

                <div>

                    <div class="footer-brand">
                        Thesis Repository
                    </div>

                    <div class="footer-copy">
                        Academic Research Repository
                    </div>

                </div>

                <div class="footer-links">

                    <a href="#home">
                        Home
                    </a>

                    <a href="#theses">
                        Theses
                    </a>

                    <a href="#features">
                        Features
                    </a>

                    @guest

                        <a href="{{ route('login') }}">
                            Login
                        </a>

                    @endguest

                </div>

            </div>

        </footer>

    </div>

</body>

</html>