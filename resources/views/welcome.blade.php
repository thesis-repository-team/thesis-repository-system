<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Thesis Repository</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      

        :root {
            --primary: #6538d9;
            --primary-dark: #4f27b5;
            --primary-light: #f1edff;

            --black: #111111;
            --dark: #181818;

            --white: #ffffff;

            --gray-50: #fafafa;
            --gray-100: #f4f4f5;
            --gray-200: #e4e4e7;
            --gray-300: #d4d4d8;
            --gray-500: #71717a;
            --gray-600: #52525b;
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
            line-height: 1.5;
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
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        .navbar {
            height: 76px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--gray-200);

            position: sticky;
            top: 0;
            z-index: 100;

            backdrop-filter: blur(12px);
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

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--black);
            color: var(--white);

            border-radius: 10px;

            font-size: 19px;
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
            margin-top: 2px;

            color: var(--gray-500);

            font-size: 11px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .nav-link {
            color: var(--gray-700);

            font-size: 13px;
            font-weight: 600;

            transition: color .2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }


        .btn {
            min-height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 9px 17px;

            border-radius: 8px;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                transform .15s ease,
                box-shadow .2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: 1px solid var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: var(--white);
            box-shadow: 0 8px 20px rgba(101, 56, 217, .18);
        }

        .btn-outline {
            background: var(--white);
            color: var(--black);
            border: 1px solid var(--gray-200);
        }

        .btn-outline:hover {
            border-color: var(--black);
            color: var(--black);
        }


        /* =========================================================
       HERO
    ========================================================== */

        .hero {
            position: relative;
            overflow: hidden;

            padding: 105px 0 75px;

            background:
                radial-gradient(circle at 50% 0%,
                    rgba(101, 56, 217, .12),
                    transparent 38%),
                linear-gradient(180deg,
                    #ffffff 0%,
                    #fafafa 100%);
        }

        .hero::before {
            content: "";

            position: absolute;

            width: 420px;
            height: 420px;

            top: -240px;
            left: -180px;

            border-radius: 50%;

            border: 1px solid rgba(101, 56, 217, .08);
        }

        .hero::after {
            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            top: -300px;
            right: -220px;

            border-radius: 50%;

            border: 1px solid rgba(101, 56, 217, .06);
        }

        .hero-content {
            position: relative;
            z-index: 2;

            max-width: 900px;
            margin: 0 auto;

            text-align: center;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 7px 13px;

            background: var(--primary-light);
            color: var(--primary);

            border-radius: 30px;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .1em;

            margin-bottom: 22px;
        }

        .hero-label i {
            font-size: 12px;
        }

        .hero-title {
            max-width: 850px;
            margin: 0 auto;

            font-size: clamp(46px, 7vw, 76px);

            line-height: .98;
            letter-spacing: -3px;

            font-weight: 700;
        }

        .hero-title span {
            color: var(--primary);
        }

        .hero-description {
            max-width: 650px;

            margin: 25px auto 0;

            color: var(--gray-500);

            font-size: 16px;
            line-height: 1.75;
        }


        /* =========================================================
       HERO SEARCH
    ========================================================== */

        .hero-search {
            max-width: 780px;

            margin: 36px auto 0;

            padding: 7px;

            display: flex;
            align-items: center;
            gap: 8px;

            background: var(--white);

            border: 1px solid var(--gray-200);
            border-radius: 12px;

            box-shadow:
                0 12px 35px rgba(0, 0, 0, .06);
        }

        .hero-search-icon {
            width: 44px;
            height: 44px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--gray-500);

            font-size: 17px;
        }

        .hero-search input {
            flex: 1;

            min-width: 0;

            height: 44px;

            border: 0;
            outline: 0;

            background: transparent;

            color: var(--black);

            font-size: 14px;
        }

        .hero-search input::placeholder {
            color: #a1a1aa;
        }

        .hero-search button {
            min-height: 44px;

            padding: 10px 22px;

            border: 0;
            border-radius: 8px;

            background: var(--primary);
            color: var(--white);

            cursor: pointer;

            font-size: 13px;
            font-weight: 600;

            transition: .2s ease;
        }

        .hero-search button:hover {
            background: var(--primary-dark);
        }


        /* =========================================================
       HERO HINT
    ========================================================== */

        .search-hint {
            margin-top: 12px;

            color: var(--gray-500);

            font-size: 11px;
        }

        .search-hint i {
            margin-right: 3px;
        }


        /* =========================================================
       STATISTICS
    ========================================================== */

        .hero-stats {
            max-width: 760px;

            margin: 48px auto 0;

            display: grid;
            grid-template-columns: repeat(3, 1fr);

            border-top: 1px solid var(--gray-200);
            border-bottom: 1px solid var(--gray-200);
        }

        .hero-stat {
            position: relative;

            padding: 23px 20px;

            text-align: center;
        }

        .hero-stat:not(:last-child)::after {
            content: "";

            position: absolute;

            right: 0;
            top: 22px;
            bottom: 22px;

            width: 1px;

            background: var(--gray-200);
        }

        .hero-stat-number {
            font-size: 27px;
            font-weight: 700;

            line-height: 1;
        }

        .hero-stat-label {
            margin-top: 7px;

            color: var(--gray-500);

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .08em;
        }


        /* =========================================================
       FEATURED SECTION
    ========================================================== */

        .section {
            padding: 85px 0;
        }

        .section-gray {
            background: var(--gray-50);
        }

        .section-header {
            text-align: center;

            max-width: 650px;

            margin: 0 auto 38px;
        }

        .section-label {
            color: var(--primary);

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .12em;

            margin-bottom: 9px;
        }

        .section-title {
            font-size: 34px;

            line-height: 1.15;
            letter-spacing: -1px;

            font-weight: 700;
        }

        .section-description {
            margin-top: 12px;

            color: var(--gray-500);

            font-size: 14px;
            line-height: 1.7;
        }


        /* =========================================================
       FEATURED CARDS
    ========================================================== */

        .featured-grid {
            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 18px;
        }

        .thesis-card {
            position: relative;

            display: flex;
            flex-direction: column;

            min-height: 285px;

            padding: 24px;

            background: var(--white);

            border: 1px solid var(--gray-200);
            border-radius: 14px;

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .thesis-card:hover {
            transform: translateY(-4px);

            border-color: rgba(101, 56, 217, .4);

            box-shadow:
                0 15px 35px rgba(0, 0, 0, .07);
        }

        .thesis-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;

            margin-bottom: 20px;
        }

        .department-badge {
            display: inline-flex;
            align-items: center;

            max-width: 75%;

            padding: 6px 9px;

            background: var(--primary-light);
            color: var(--primary);

            border-radius: 6px;

            font-size: 9px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .04em;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .thesis-number {
            color: var(--gray-500);

            font-size: 10px;
            font-weight: 600;
        }

        .thesis-card-title {
            font-size: 17px;
            font-weight: 700;

            line-height: 1.45;

            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }

        .thesis-card-meta {
            display: flex;
            flex-direction: column;

            gap: 7px;

            margin-top: 18px;

            color: var(--gray-500);

            font-size: 11px;
        }

        .thesis-card-meta span {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .thesis-card-meta i {
            width: 14px;

            color: var(--gray-600);

            font-size: 11px;
        }

        .thesis-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: auto;
            padding-top: 20px;

            border-top: 1px solid var(--gray-100);
        }

        .thesis-year {
            color: var(--gray-500);

            font-size: 10px;
        }

        .view-thesis {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            color: var(--primary);

            font-size: 11px;
            font-weight: 700;

            transition: gap .2s ease;
        }

        .view-thesis:hover {
            gap: 8px;
        }


        /* =========================================================
       EMPTY FEATURED
    ========================================================== */

        .empty-featured {
            grid-column: 1 / -1;

            padding: 60px 20px;

            background: var(--white);

            border: 1px solid var(--gray-200);
            border-radius: 14px;

            text-align: center;
        }

        .empty-featured i {
            display: block;

            margin-bottom: 12px;

            color: var(--gray-300);

            font-size: 35px;
        }

        .empty-featured-title {
            font-size: 15px;
            font-weight: 700;
        }

        .empty-featured-text {
            margin-top: 6px;

            color: var(--gray-500);

            font-size: 12px;
        }


        /* =========================================================
       EXPLORE SECTION
    ========================================================== */

        .explore-section {
            padding: 85px 0;
        }

        .explore-box {
            position: relative;
            overflow: hidden;

            padding: 55px;

            background: var(--black);
            color: var(--white);

            border-radius: 18px;
        }

        .explore-box::after {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            right: -100px;
            top: -160px;

            border-radius: 50%;

            border: 1px solid rgba(255, 255, 255, .08);
        }

        .explore-content {
            position: relative;
            z-index: 2;
        }

        .explore-label {
            color: #b9a6ff;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .12em;
        }

        .explore-title {
            max-width: 650px;

            margin-top: 10px;

            font-size: 35px;
            line-height: 1.2;

            letter-spacing: -1px;
        }

        .explore-text {
            max-width: 600px;

            margin-top: 13px;

            color: #a1a1aa;

            font-size: 13px;
            line-height: 1.7;
        }

        .department-links {
            display: flex;
            flex-wrap: wrap;

            gap: 9px;

            margin-top: 28px;
        }

        .department-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 10px 14px;

            background: rgba(255, 255, 255, .06);

            border: 1px solid rgba(255, 255, 255, .12);

            border-radius: 8px;

            color: var(--white);

            font-size: 11px;
            font-weight: 600;

            transition: .2s ease;
        }

        .department-link:hover {
            background: var(--primary);
            border-color: var(--primary);

            transform: translateY(-1px);
        }


        /* =========================================================
       PUBLIC THESIS COLLECTION
    ========================================================== */

        .collection-section {
            padding: 85px 0;
        }

        .collection-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 30px;

            margin-bottom: 30px;
        }

        .collection-heading {
            max-width: 600px;
        }

        .collection-heading .section-label {
            margin-bottom: 7px;
        }

        .collection-heading .section-title {
            font-size: 31px;
        }

        .collection-description {
            max-width: 400px;

            color: var(--gray-500);

            font-size: 13px;
            line-height: 1.7;
        }


        /* =========================================================
       TABLE
    ========================================================== */

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

            min-width: 900px;

            border-collapse: collapse;
        }

        .thesis-table th {
            padding: 14px 18px;

            background: var(--gray-50);

            color: var(--gray-500);

            border-bottom: 1px solid var(--gray-200);

            font-size: 9px;
            font-weight: 700;

            text-align: left;
            text-transform: uppercase;

            letter-spacing: .08em;
        }

        .thesis-table td {
            padding: 16px 18px;

            border-bottom: 1px solid var(--gray-100);

            font-size: 12px;

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
            max-width: 400px;

            font-weight: 600;

            line-height: 1.5;
        }

        .author-cell {
            white-space: nowrap;

            color: var(--gray-700);
        }

        .table-department {
            display: inline-flex;

            padding: 5px 9px;

            background: var(--primary-light);
            color: var(--primary);

            border-radius: 6px;

            font-size: 9px;
            font-weight: 600;

            white-space: nowrap;
        }

        .date-cell {
            white-space: nowrap;

            color: var(--gray-500);

            font-size: 11px;
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

            min-height: 31px;

            padding: 6px 9px;

            border-radius: 6px;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;

            transition: .2s ease;
        }

        .public-action-btn:hover {
            transform: translateY(-1px);
        }

        .public-view-btn {
            background: #198754;
            border: 1px solid #198754;
            color: var(--white);
        }

        .public-view-btn:hover {
            background: #157347;
            color: var(--white);
        }

        .public-download-btn {
            background: #0d6efd;
            border: 1px solid #0d6efd;
            color: var(--white);
        }

        .public-download-btn:hover {
            background: #0b5ed7;
            color: var(--white);
        }


        /* =========================================================
       EMPTY TABLE
    ========================================================== */

        .empty-table {
            padding: 55px 20px !important;

            text-align: center !important;

            color: var(--gray-500);
        }

        .empty-table i {
            display: block;

            margin-bottom: 10px;

            color: var(--gray-300);

            font-size: 30px;
        }


        /* =========================================================
       CTA
    ========================================================== */

        .cta {
            padding: 75px 0;

            background: var(--gray-50);

            border-top: 1px solid var(--gray-100);
        }

        .cta-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 40px;
        }

        .cta-title {
            font-size: 31px;

            line-height: 1.2;

            letter-spacing: -1px;
        }

        .cta-text {
            margin-top: 10px;

            color: var(--gray-500);

            font-size: 13px;
        }

        .cta-actions {
            display: flex;
            gap: 9px;

            flex-shrink: 0;
        }


        /* =========================================================
       FOOTER
    ========================================================== */

        .footer {
            padding: 28px 0;

            background: #0b0b0b;

            color: #a1a1aa;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .footer-brand {
            color: var(--white);

            font-size: 13px;
            font-weight: 700;
        }

        .footer-copy {
            margin-top: 3px;

            font-size: 10px;
        }

        .footer-links {
            display: flex;
            align-items: center;

            gap: 20px;

            font-size: 10px;
        }

        .footer-links a:hover {
            color: var(--white);
        }


        /* =========================================================
       RESPONSIVE — 1000PX
    ========================================================== */

        @media (max-width: 1000px) {

            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .collection-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .collection-description {
                max-width: 600px;
            }

            .cta-inner {
                flex-direction: column;
                align-items: flex-start;
            }

        }


        /* =========================================================
       RESPONSIVE — 768PX
    ========================================================== */

        @media (max-width: 768px) {

            .container {
                width: min(100% - 28px, 1180px);
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

            .nav-right {
                gap: 10px;
            }

            .hero {
                padding: 75px 0 60px;
            }

            .hero-title {
                font-size: 48px;
                letter-spacing: -2px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-search {
                flex-wrap: wrap;
            }

            .hero-search-icon {
                width: 40px;
            }

            .hero-search input {
                width: calc(100% - 55px);
                flex: 1;
            }

            .hero-search button {
                width: 100%;
            }

            .hero-stats {
                margin-top: 38px;
            }

            .hero-stat {
                padding: 20px 10px;
            }

            .hero-stat-number {
                font-size: 23px;
            }

            .hero-stat-label {
                font-size: 8px;
            }

            .section,
            .collection-section,
            .explore-section {
                padding: 65px 0;
            }

            .section-title {
                font-size: 29px;
            }

            .featured-grid {
                grid-template-columns: 1fr;
            }

            .explore-box {
                padding: 35px 25px;
            }

            .explore-title {
                font-size: 29px;
            }

            .department-links {
                gap: 7px;
            }

            .collection-heading .section-title {
                font-size: 28px;
            }

            .cta {
                padding: 60px 0;
            }

            .cta-title {
                font-size: 28px;
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


        /* =========================================================
       RESPONSIVE — 480PX
    ========================================================== */

        @media (max-width: 480px) {

            .container {
                width: calc(100% - 24px);
            }

            .brand-logo {
                width: 38px;
                height: 38px;
            }

            .brand-title {
                font-size: 14px;
            }

            .nav-right .btn-outline {
                display: none;
            }

            .hero {
                padding: 60px 0 50px;
            }

            .hero-label {
                font-size: 8px;
            }

            .hero-title {
                font-size: 39px;
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 13px;
            }

            .hero-search {
                margin-top: 28px;
            }

            .hero-search input {
                font-size: 12px;
            }

            .hero-search button {
                font-size: 12px;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            .hero-stat:not(:last-child)::after {
                right: 20%;
                left: 20%;
                top: auto;
                bottom: 0;

                width: auto;
                height: 1px;
            }

            .hero-stat-number {
                font-size: 25px;
            }

            .section-title {
                font-size: 27px;
            }

            .thesis-card {
                padding: 20px;
            }

            .explore-title {
                font-size: 26px;
            }

            .explore-text {
                font-size: 12px;
            }

            .department-link {
                width: 100%;

                justify-content: center;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 12px;
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


                <div class="nav-right">

                    <nav class="nav-links">

                        <a href="#home" class="nav-link">
                            Home
                        </a>

                        <a href="#featured" class="nav-link">
                            Featured
                        </a>

                        <a href="#theses" class="nav-link">
                            Browse
                        </a>

                    </nav>


                    <div>

                        @auth

                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">

                                <i class="bi bi-speedometer2"></i>

                                Dashboard

                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">

                                Login

                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">

                                    Register

                                </a>
                            @endif

                        @endauth

                    </div>

                </div>

            </div>

        </header>



        <main>


            {{-- =========================================================
         HERO
    ========================================================== --}}

            <section class="hero" id="home">

                <div class="container">

                    <div class="hero-content">


                        <div class="hero-label">

                            <i class="bi bi-book-half"></i>

                            UNIVERSITY ACADEMIC RESEARCH

                        </div>


                        <h1 class="hero-title">

                            Your Research
                            <span>Starts Here.</span>

                        </h1>


                        <p class="hero-description">

                            Explore academic theses and research created by
                            students and researchers across the university.
                            Discover ideas, knowledge, and work that inspire
                            future research.

                        </p>


                        {{-- =================================================
                     SEARCH
                ================================================== --}}

                        <form action="{{ url('/') }}" method="GET" class="hero-search">

                            <div class="hero-search-icon">

                                <i class="bi bi-search"></i>

                            </div>


                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search thesis, author, or department..." autocomplete="off">


                            <button type="submit">

                                <i class="bi bi-search"></i>

                                Search

                            </button>

                        </form>


                        <div class="search-hint">

                            <i class="bi bi-info-circle"></i>

                            Search by thesis title, author name, or department

                        </div>


                        {{-- =================================================
                     STATISTICS
                ================================================== --}}

                        <div class="hero-stats">


                            <div class="hero-stat">

                                <div class="hero-stat-number">

                                    {{ $totalTheses ?? $theses->count() }}

                                </div>

                                <div class="hero-stat-label">
                                    Theses
                                </div>

                            </div>


                            <div class="hero-stat">

                                <div class="hero-stat-number">

                                    {{ $totalDepartments ?? $theses->pluck('department_id')->unique()->count() }}

                                </div>

                                <div class="hero-stat-label">
                                    Departments
                                </div>

                            </div>


                            <div class="hero-stat">

                                <div class="hero-stat-number">

                                    {{ $totalAuthors ?? $theses->pluck('author_name')->unique()->count() }}

                                </div>

                                <div class="hero-stat-label">
                                    Researchers
                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </section>



            {{-- =========================================================
         FEATURED RESEARCH
    ========================================================== --}}

            <section class="section section-gray" id="featured">

                <div class="container">


                    <div class="section-header">

                        <div class="section-label">
                            RECENTLY PUBLISHED
                        </div>

                        <h2 class="section-title">
                            Featured Research
                        </h2>

                        <p class="section-description">

                            Discover some of the latest academic research
                            published in the university repository.

                        </p>

                    </div>


                    <div class="featured-grid">


                        @forelse($theses->take(3) as $thesis)
                            <article class="thesis-card">


                                <div class="thesis-card-top">

                                    <span class="department-badge">

                                        {{ $thesis->department?->name ?? 'Research' }}

                                    </span>


                                    <span class="thesis-number">

                                        #{{ $loop->iteration }}

                                    </span>

                                </div>


                                <h3 class="thesis-card-title">

                                    {{ $thesis->title }}

                                </h3>


                                <div class="thesis-card-meta">

                                    <span>

                                        <i class="bi bi-person"></i>

                                        {{ $thesis->author_name }}

                                    </span>


                                    <span>

                                        <i class="bi bi-calendar3"></i>

                                        {{ $thesis->published_at?->format('M d, Y') ?? 'Published research' }}

                                    </span>

                                </div>


                                <div class="thesis-card-footer">

                                    <span class="thesis-year">

                                        {{ $thesis->published_at?->format('Y') ?? '-' }}

                                    </span>


                                    @if ($thesis->files->count())
                                        <a href="{{ route('student.thesis.view-pdf', ['file' => $thesis->files->first()->id]) }}"
                                            target="_blank" class="view-thesis">

                                            View Thesis

                                            <i class="bi bi-arrow-right"></i>

                                        </a>
                                    @else
                                        <span class="thesis-year">
                                            No PDF
                                        </span>
                                    @endif

                                </div>


                            </article>

                        @empty


                            <div class="empty-featured">

                                <i class="bi bi-journal-x"></i>

                                <div class="empty-featured-title">

                                    No public theses available yet.

                                </div>

                                <div class="empty-featured-text">

                                    Published research will appear here.

                                </div>

                            </div>
                        @endforelse


                    </div>

                </div>

            </section>



            {{-- =========================================================
         EXPLORE RESEARCH
    ========================================================== --}}

            <section class="explore-section">

                <div class="container">

                    <div class="explore-box">

                        <div class="explore-content">


                            <div class="explore-label">
                                EXPLORE BY DEPARTMENT
                            </div>


                            <h2 class="explore-title">

                                Find research in your field.

                            </h2>


                            <p class="explore-text">

                                Explore academic research from different
                                departments and discover theses related to
                                your area of study.

                            </p>


                            <div class="department-links">


                                <a href="#theses" class="department-link">

                                    <i class="bi bi-laptop"></i>

                                    Information Technology

                                </a>


                                <a href="#theses" class="department-link">

                                    <i class="bi bi-code-slash"></i>

                                    Software Engineering

                                </a>


                                <a href="#theses" class="department-link">

                                    <i class="bi bi-calculator"></i>

                                    Mathematics

                                </a>


                                <a href="#theses" class="department-link">

                                    <i class="bi bi-atom"></i>

                                    Physics

                                </a>


                                <a href="#theses" class="department-link">

                                    <i class="bi bi-grid"></i>

                                    All Research

                                </a>


                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =========================================================
         PUBLIC THESIS COLLECTION
    ========================================================== --}}

            <section class="collection-section" id="theses">

                <div class="container">


                    <div class="collection-header">


                        <div class="collection-heading">

                            <div class="section-label">
                                RESEARCH COLLECTION
                            </div>

                            <h2 class="section-title">
                                Browse Public Theses
                            </h2>

                        </div>


                        <p class="collection-description">

                            Browse publicly available academic research
                            and access published thesis documents from
                            different departments.

                        </p>


                    </div>


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

                                                <span class="table-department">

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
                                                    <span class="date-cell">

                                                        No PDF

                                                    </span>
                                                @endif


                                            </td>


                                        </tr>


                                    @empty


                                        <tr>

                                            <td colspan="6" class="empty-table">

                                                <i class="bi bi-journal-x"></i>

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



            {{-- =========================================================
         CALL TO ACTION
    ========================================================== --}}

            {{-- <section class="cta">

                <div class="container">

                    <div class="cta-inner">


                        <div>

                            <h2 class="cta-title">

                                Ready to explore research?

                            </h2>


                            <p class="cta-text">

                                Discover academic knowledge and find research
                                that supports your next idea.

                            </p>

                        </div>


                        <div class="cta-actions">


                            <a href="#theses" class="btn btn-primary">

                                <i class="bi bi-search"></i>

                                Browse Theses

                            </a>


                            @guest

                                <a href="{{ route('login') }}" class="btn btn-outline">

                                    <i class="bi bi-box-arrow-in-right"></i>

                                    Sign In

                                </a>

                            @endguest


                        </div>


                    </div>

                </div>

            </section> --}}


        </main>



        {{-- =========================================================
     FOOTER
========================================================== --}}

        {{-- <footer class="footer">

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

            <a href="#featured">
                Featured
            </a>

            <a href="#theses">
                Theses
            </a>

            @guest

                <a href="{{ route('login') }}">
                    Login
                </a>

            @endguest

        </div>


    </div>

</footer> --}}


    </div>

</body>

</html>
