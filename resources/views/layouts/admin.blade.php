<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Pondok')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon/logo4_192.png') }}?v=5">

    <!-- Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 4.6.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS (build statis, sebelumnya CDN runtime) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">

    <!-- Custom Modernized Overrides for Bootstrap Components -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }

        /* Modernize Card component */
        .card {
            border: 1px solid #f1f5f9;
            border-radius: 16px !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05) !important;
            background-color: #ffffff;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1.25rem 1.5rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
        }

        .card-header .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .card-footer {
            background-color: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
            padding: 1rem 1.5rem !important;
        }

        /* Modernize Buttons */
        .btn {
            border-radius: 8px !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .btn-primary {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
        }

        .btn-secondary {
            background-color: #64748b !important;
            border-color: #64748b !important;
            color: #ffffff !important;
        }

        .btn-secondary:hover {
            background-color: #475569 !important;
            border-color: #475569 !important;
        }

        .btn-success {
            background-color: #10b981 !important;
            border-color: #10b981 !important;
            color: #ffffff !important;
        }

        .btn-success:hover {
            background-color: #059669 !important;
            border-color: #059669 !important;
        }

        .btn-danger {
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
            color: #ffffff !important;
        }

        .btn-danger:hover {
            background-color: #dc2626 !important;
            border-color: #dc2626 !important;
        }

        .btn-info {
            background-color: #06b6d4 !important;
            border-color: #06b6d4 !important;
            color: #ffffff !important;
        }

        .btn-info:hover {
            background-color: #0891b2 !important;
            border-color: #0891b2 !important;
        }

        .btn-warning {
            background-color: #f59e0b !important;
            border-color: #f59e0b !important;
            color: #ffffff !important;
        }

        .btn-warning:hover {
            background-color: #d97706 !important;
            border-color: #d97706 !important;
        }

        /* Modernize Form Controls */
        .form-control,
        .form-select {
            width: 100% !important;
            border-radius: 10px !important;
            border: 1px solid #cbd5e1 !important;
            padding: 0.625rem 0.9rem !important;
            font-size: 0.875rem !important;
            color: #1e293b !important;
            background-color: #ffffff !important;
            transition: all 0.2s !important;
        }

        /* Ensure consistent height for all single-line inputs and select dropdowns, excluding textarea */
        input[type="text"].form-control,
        input[type="date"].form-control,
        input[type="email"].form-control,
        input[type="password"].form-control,
        input[type="number"].form-control,
        input[type="tel"].form-control,
        select.form-control,
        .form-select {
            height: 42px !important;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }

        /* Specific styles for file inputs to prevent button truncation */
        input[type="file"].form-control {
            height: auto !important;
            padding-top: 0.375rem !important;
            padding-bottom: 0.375rem !important;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12) !important;
        }

        /* Modernize Badges */
        .badge {
            border-radius: 8px !important;
            padding: 0.4em 0.8em !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
            text-transform: capitalize !important;
        }

        .badge-warning {
            background-color: #fef3c7 !important;
            color: #d97706 !important;
        }

        .badge-success {
            background-color: #d1fae5 !important;
            color: #065f46 !important;
        }

        .badge-danger {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
        }

        .badge-info {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
        }

        .badge-secondary {
            background-color: #f1f5f9 !important;
            color: #475569 !important;
        }

        /* Modernize Table */
        .table {
            border-color: #f1f5f9 !important;
            margin-bottom: 0 !important;
        }

        .table th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em !important;
            padding: 1rem !important;
            border-bottom: 2px solid #e2e8f0 !important;
        }

        .table td {
            padding: 1rem !important;
            vertical-align: middle !important;
            color: #334155 !important;
            font-size: 0.875rem !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(248, 250, 252, 0.5) !important;
        }

        /* Modernize Alert */
        .alert {
            border-radius: 12px !important;
            border: none !important;
            padding: 1rem 1.25rem !important;
            font-size: 0.875rem !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .alert-warning {
            background-color: #fffbeb !important;
            color: #92400e !important;
            border-left: 4px solid #f59e0b !important;
        }

        .alert-success {
            background-color: #ecfdf5 !important;
            color: #065f46 !important;
            border-left: 4px solid #10b981 !important;
        }

        .alert-danger {
            background-color: #fff5f5 !important;
            color: #9b1c1c !important;
            border-left: 4px solid #ef4444 !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Overrides for H1 inside top navbar header */
        .top-nav-header h1,
        .top-nav-header h2,
        .top-nav-header h3,
        .top-nav-header h4 {
            font-size: 1.125rem !important;
            font-weight: 600 !important;
            margin: 0 !important;
            display: inline-block !important;
            color: #0f172a !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Remove underline on sidebar hover links */
        aside a,
        aside button {
            text-decoration: none !important;
        }

        aside a:hover,
        aside button:hover {
            text-decoration: none !important;
            text-decoration-line: none !important;
        }

        /* Modernize Pagination */
        .pagination {
            gap: 4px !important;
            margin-bottom: 0 !important;
        }

        .page-item .page-link {
            border-radius: 8px !important;
            padding: 0.5rem 0.85rem !important;
            font-size: 0.825rem !important;
            font-weight: 500 !important;
            color: #475569 !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #ffffff !important;
            transition: all 0.2s !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .page-item .page-link:hover {
            color: #1e293b !important;
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            text-decoration: none !important;
        }

        .page-item.active .page-link {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2) !important;
        }

        .page-item.disabled .page-link {
            color: #94a3b8 !important;
            background-color: #f8fafc !important;
            border-color: #f1f5f9 !important;
            box-shadow: none !important;
        }

        /* Hide scrollbars but keep functionality */
        .no-scrollbar::-webkit-scrollbar {
            display: none !important;
        }

        .no-scrollbar {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        /* Style content header h1 tags to look modern and align button to the right */
        .content-header-container h1 {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            margin: 0 0 1rem 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            flex-wrap: wrap !important;
            gap: 1rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Style the action buttons inside content header */
        .content-header-container h1 a.btn,
        .content-header-container h1 button.btn {
            font-size: 0.875rem !important;
            padding: 0.6rem 1.2rem !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.12), 0 2px 4px -1px rgba(37, 99, 235, 0.08) !important;
        }

        /* Force container-fluid inside main content to be full width (no horizontal padding) */
        main .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Tight row columns padding for filter inputs */
        .row-tight {
            margin-right: -6px !important;
            margin-left: -6px !important;
        }

        .row-tight>[class*="col-"] {
            padding-right: 6px !important;
            padding-left: 6px !important;
        }

        /* -------------------------------------------------------------
           GREEN THEME SYSTEM (SIAK-Style Dashboard)
           ------------------------------------------------------------- */
        :root {
            --primary-green: #276e43;
            --primary-green-hover: #1e5533;
            --primary-green-active: #1b4f30;
            --sidebar-green-bg: #276e43;
            --sidebar-green-header: #1b4f30;
            --sidebar-green-border: #1e5533;
            --sidebar-green-hover: #1e5533;
            --sidebar-green-active: #205634;
            --sidebar-submenu-active: #348a56;
            --body-bg: #f4faf6;
            --card-header-green: #276e43;
            --card-filter-bg: #eaf7ec;
            --card-filter-border: #c8e6c9;
            --top-navbar-bg: #eaf2ee;
            --top-navbar-border: #d3e2d9;
        }

        /* Body background override */
        body {
            background-color: var(--body-bg) !important;
        }

        /* Top Navbar green-grey background similar to SIAK */
        header.h-16 {
            background-color: var(--top-navbar-bg) !important;
            border-bottom: 1px solid var(--top-navbar-border) !important;
        }

        /* Desktop Sidebar Background overrides */
        aside.bg-slate-900 {
            background-color: var(--sidebar-green-bg) !important;
            border-right: 1px solid var(--sidebar-green-border) !important;
        }

        /* Mobile Sidebar Background overrides */
        aside.bg-slate-900.md\:hidden {
            background-color: var(--sidebar-green-bg) !important;
        }

        /* Sidebar Branding and Footer bg */
        aside .bg-slate-950\/50 {
            background-color: var(--sidebar-green-header) !important;
            border-bottom: 1px solid var(--sidebar-green-border) !important;
        }

        aside .bg-slate-950\/20 {
            background-color: var(--sidebar-green-header) !important;
            border-top: 1px solid var(--sidebar-green-border) !important;
        }

        aside .border-slate-800 {
            border-color: var(--sidebar-green-border) !important;
        }

        /* Sidebar Navigation Hover */
        aside nav a.hover\:bg-slate-800\/60:hover,
        aside nav button.hover\:bg-slate-800\/60:hover,
        aside nav a.hover\:bg-slate-800:hover,
        aside nav button.hover\:bg-slate-800:hover {
            background-color: var(--sidebar-green-hover) !important;
            color: #ffffff !important;
        }

        /* Top level active items in sidebar (from bg-blue-600) */
        aside nav a.bg-blue-600,
        aside nav button.bg-blue-600 {
            background-color: var(--sidebar-green-active) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(27, 79, 48, 0.2) !important;
        }

        /* Sub-menu active items in sidebar dropdowns */
        aside nav a.bg-blue-600.shadow-sm {
            background-color: var(--sidebar-submenu-active) !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }

        /* Override Tailwind Blue Utilities globally to match the green theme */
        .bg-blue-600 {
            background-color: var(--primary-green) !important;
        }

        .text-blue-600 {
            color: var(--primary-green) !important;
        }

        .text-blue-500 {
            color: var(--primary-green) !important;
        }

        .text-blue-400 {
            color: #8ce9ad !important;
        }

        .shadow-blue-500\/20 {
            box-shadow: 0 4px 6px -1px rgba(39, 110, 67, 0.2) !important;
        }

        .border-blue-600 {
            border-color: var(--primary-green) !important;
        }

        /* Bootstrap Buttons overrides */
        .btn-primary {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
            color: #ffffff !important;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--primary-green-hover) !important;
            border-color: var(--primary-green-hover) !important;
            color: #ffffff !important;
        }

        /* Card container styling */
        .card {
            border: 1px solid #d3e2d9 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02) !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }

        /* Solid green headers for cards similar to SIAK */
        .card-header {
            background-color: var(--card-header-green) !important;
            color: #ffffff !important;
            border-bottom: 1px solid var(--primary-green-hover) !important;
            padding: 0.75rem 1.25rem !important;
        }

        .card-header-tabs {
            padding: 0 !important;
        }

        .card-header h5,
        .card-header h3,
        .card-header .card-title,
        .card-header b,
        .card-header strong {
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 1rem !important;
            margin: 0 !important;
        }

        /* Card primary outline top border */
        .card.card-primary.card-outline {
            border-top: 4px solid var(--primary-green) !important;
        }

        /* Style the filter cards specifically to have a mint green background with white inputs */
        .card.card-filter {
            background-color: var(--card-filter-bg) !important;
            border: 1px solid var(--card-filter-border) !important;
        }

        /* Ensure labels on card-filter stand out nicely */
        .card.card-filter label {
            color: var(--primary-green-active) !important;
            font-weight: 600 !important;
        }

        /* White background for input fields on mint green background */
        .card.card-filter .form-control,
        .card.card-filter .form-select {
            background-color: #ffffff !important;
            border: 1px solid var(--card-filter-border) !important;
        }

        /* Ensure table background is solid white for all rows */
        .table {
            background-color: #ffffff !important;
        }

        .table tbody tr {
            background-color: #ffffff !important;
        }

        /* Restore hover background highlight color */
        .table-hover tbody tr:hover {
            background-color: #f1f5f9 !important;
        }

        /* Table header green theme with white uppercase text */
        .table thead th {
            background-color: var(--primary-green-hover) !important;
            color: #ffffff !important;
            border-color: var(--primary-green-active) !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em !important;
            vertical-align: middle !important;
        }

        /* Active page item pagination */
        .page-item.active .page-link {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(39, 110, 67, 0.2) !important;
        }

        /* Focus styles for inputs and selects */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-green) !important;
            box-shadow: 0 0 0 4px rgba(39, 110, 67, 0.12) !important;
        }

        /* Active Bootstrap nav-tabs link style */
        .nav-tabs .nav-link.active,
        .nav-pills .nav-link.active {
            color: var(--primary-green) !important;
            border-bottom: 3px solid var(--primary-green) !important;
        }

        /* Style all modal headers to be green with white text */
        .modal-header {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
            border-bottom: 1px solid var(--primary-green-hover) !important;
            border-top-left-radius: calc(0.3rem - 1px) !important;
            border-top-right-radius: calc(0.3rem - 1px) !important;
        }

        .modal-header .modal-title {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        .modal-header .close {
            color: #ffffff !important;
            opacity: 0.8 !important;
            text-shadow: none !important;
            outline: none !important;
        }

        .modal-header .close:hover {
            color: #ffffff !important;
            opacity: 1 !important;
        }

        /* Laporan & Detail Page Tab Menu Styling overrides */
        #laporanTab .nav-link,
        #detailTab .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            border: none !important;
            transition: all 0.2s ease !important;
        }

        #laporanTab .nav-link.active,
        #detailTab .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.15) !important;
            border-bottom: 3px solid #ffffff !important;
        }

        #laporanTab .nav-link:hover,
        #detailTab .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Laporan Page Kecamatan Accordion styling (light green theme) */
        .kec-header-wrapper {
            background-color: #eaf7ec !important;
            border-bottom: 1px solid #c8e6c9 !important;
            padding: 0 !important;
        }

        #accordionWilayah .kec-header h5 {
            color: #1b4f30 !important;
        }

        #accordionWilayah .kec-header i.fa-map-marker-alt {
            color: #276e43 !important;
        }

        #accordionWilayah .kec-header span.badge-primary {
            background-color: #276e43 !important;
            color: #ffffff !important;
        }

        /* Force all sidebar text and icons to be white */
        aside nav a,
        aside nav button,
        aside nav span,
        aside nav i {
            color: #ffffff !important;
        }
    </style>

    @yield('css')
    @stack('css')
</head>

<body class="bg-slate-50 antialiased" x-data="{ sidebarOpen: true, mobileSidebarOpen: false }">

    <!-- Wrapper -->
    <div class="h-screen flex overflow-hidden">

        <!-- Sidebar Desktop -->
        <aside class="bg-slate-900 text-slate-300 w-64 flex-shrink-0 hidden md:flex flex-col border-r border-slate-800 transition-all duration-300"
            :class="sidebarOpen ? 'w-64' : 'w-20'">

            <!-- Branding Header -->
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950/50 justify-between overflow-hidden">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('icon/logo4_192.png') }}" class="w-8 h-8 rounded-lg shadow-sm flex-shrink-0" alt="Logo">
                    <span class="font-title font-bold text-lg text-white tracking-wide transition-all duration-300"
                        x-show="sidebarOpen">PONDOK</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-6 pl-3 pr-4">
                <nav class="space-y-1">



                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800/60 hover:text-white' }}"
                        title="Dashboard">
                        <i class="fas fa-fw fa-tachometer-alt text-lg {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                        <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Dashboard</span>
                    </a>

                    <!-- Transaksi -->
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.transaksi.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800/60 hover:text-white' }}"
                        title="Transaksi">
                        <i class="fas fa-fw fa-tags text-lg {{ request()->routeIs('admin.transaksi.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                        <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Transaksi</span>
                    </a>

                    <!-- Pesan -->
                    <a href="{{ route('admin.pesan.index') }}"
                        class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.pesan.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800/60 hover:text-white' }}"
                        title="Pesan">
                        <div class="flex items-center">
                            <i class="fas fa-fw fa-comments text-lg {{ request()->routeIs('admin.pesan.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                            <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Pesan</span>
                        </div>
                        <span id="unread-pesan-badge-desktop" class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full" style="display: none;" x-show="sidebarOpen"></span>
                    </a>

                    <!-- Aktivasi User -->
                    <a href="{{ route('user_baru.index') }}"
                        class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('user_baru.index') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800/60 hover:text-white' }}"
                        title="Aktivasi User">
                        <i class="fas fa-fw fa-key text-lg {{ request()->routeIs('user_baru.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                        <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Aktivasi User</span>
                    </a>

                    @if(auth()->user()->role_id == 1)


                    <!-- DATA MASTER -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.user.*') || request()->routeIs('admin.formulir.*') || request()->routeIs('admin.persyaratan.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800/60 transition-all duration-200 group text-slate-300 focus:outline-none"
                            title="Tabel Master">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-table text-lg {{ (request()->routeIs('admin.user.*') || request()->routeIs('admin.formulir.*') || request()->routeIs('admin.persyaratan.*')) ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                                <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Tabel Master</span>
                            </div>
                            <i class="fas text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'fa-chevron-down rotate-180' : 'fa-chevron-right'"
                                x-show="sidebarOpen"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1" :class="sidebarOpen ? 'pl-9' : 'pl-2'" x-cloak>
                            <a href="{{ route('admin.user.index') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.user.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-users text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">User</span>
                            </a>
                            <a href="{{ route('admin.formulir.index') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.formulir.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-file text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Formulir</span>
                            </a>
                            <a href="{{ route('admin.persyaratan.index') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.persyaratan.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-file-alt text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Persyaratan</span>
                            </a>
                        </div>
                    </div>



                    <!-- PENGATURAN -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.jadwal.*') || request()->routeIs('admin.slide.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800/60 transition-all duration-200 group text-slate-300 focus:outline-none"
                            title="Pengaturan">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-cog text-lg {{ (request()->routeIs('admin.jadwal.*') || request()->routeIs('admin.slide.*')) ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                                <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Pengaturan</span>
                            </div>
                            <i class="fas text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'fa-chevron-down rotate-180' : 'fa-chevron-right'"
                                x-show="sidebarOpen"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1" :class="sidebarOpen ? 'pl-9' : 'pl-2'" x-cloak>
                            <a href="{{ route('admin.jadwal.index') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.jadwal.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="far fa-calendar text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Jadwal</span>
                            </a>
                            <a href="{{ route('admin.slide.index') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.slide.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="far fa-image text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Gambar Slide</span>
                            </a>
                        </div>
                    </div>

                    <!-- SINKRONISASI -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.sinkronisasi.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800/60 transition-all duration-200 group text-slate-300 focus:outline-none"
                            title="Sinkronisasi">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-sync-alt text-lg {{ (request()->routeIs('admin.sinkronisasi.*')) ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                                <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Sinkronisasi</span>
                            </div>
                            <i class="fas text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'fa-chevron-down rotate-180' : 'fa-chevron-right'"
                                x-show="sidebarOpen"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1" :class="sidebarOpen ? 'pl-9' : 'pl-2'" x-cloak>
                            <a href="{{ route('admin.sinkronisasi.transaksi') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.transaksi') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-exchange-alt text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Cek Transaksi</span>
                            </a>
                            <a href="{{ route('admin.sinkronisasi.wilayah') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.wilayah') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-map-marker-alt text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Cek Wilayah</span>
                            </a>
                            <a href="{{ route('admin.sinkronisasi.riwayat') }}"
                                class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.riwayat') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-trash-alt text-xs mr-3 w-4 text-center"></i>
                                <span x-show="sidebarOpen">Riwayat Hapus</span>
                            </a>
                        </div>
                    </div>
                    @endif



                    <!-- Laporan Link -->
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800/60 hover:text-white' }}"
                        title="Laporan">
                        <i class="fas fa-fw fa-chart-line text-lg {{ request()->routeIs('admin.laporan.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} w-6"></i>
                        <span class="ml-3 transition-opacity duration-300" x-show="sidebarOpen">Laporan</span>
                    </a>



                </nav>
            </div>

            <!-- User Footer in Sidebar -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/20 flex items-center gap-3 overflow-hidden">
                <img src="{{ auth()->user()->avatar_url }}" class="w-9 h-9 rounded-full object-cover border border-slate-700 flex-shrink-0" alt="Avatar">
                <div class="transition-all duration-300 min-w-0" x-show="sidebarOpen">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->level_name }}</p>
                </div>
            </div>

        </aside>

        <!-- Sidebar Mobile Backdrop -->
        <div class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden transition-opacity duration-300"
            x-show="mobileSidebarOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileSidebarOpen = false"></div>

        <!-- Sidebar Mobile Menu -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 md:hidden flex flex-col transition-transform duration-300"
            x-show="mobileSidebarOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">

            <!-- Branding Header -->
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950/50 justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('icon/logo4_192.png') }}" class="w-8 h-8 rounded-lg shadow-sm" alt="Logo">
                    <span class="font-title font-bold text-lg text-white tracking-wide">PONDOK</span>
                </div>
                <button class="text-slate-400 hover:text-white" @click="mobileSidebarOpen = false">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation Links Mobile -->
            <div class="flex-1 overflow-y-auto py-6 pl-3 pr-4">
                <nav class="space-y-1">


                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                        <i class="fas fa-fw fa-tachometer-alt text-lg mr-3 w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <!-- Transaksi -->
                    <a href="{{ route('admin.transaksi.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.transaksi.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                        <i class="fas fa-fw fa-tags text-lg mr-3 w-6"></i>
                        <span>Transaksi</span>
                    </a>
                    <!-- Pesan -->
                    <a href="{{ route('admin.pesan.index') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.pesan.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                        <div class="flex items-center">
                            <i class="fas fa-fw fa-comments text-lg mr-3 w-6"></i>
                            <span>Pesan</span>
                        </div>
                        <span id="unread-pesan-badge-mobile" class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full" style="display: none;"></span>
                    </a>
                    <!-- Aktivasi User -->
                    <a href="{{ route('user_baru.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('user_baru.index') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800' }}">
                        <i class="fas fa-fw fa-key text-lg mr-3 w-6"></i>
                        <span>Aktivasi User</span>
                    </a>

                    @if(auth()->user()->role_id == 1)

                    <!-- DATA MASTER MOBILE -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.user.*') || request()->routeIs('admin.formulir.*') || request()->routeIs('admin.persyaratan.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800 transition-all duration-200 group text-slate-300 focus:outline-none">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-table text-lg mr-3 w-6"></i>
                                <span>Tabel Master</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1 pl-9" x-cloak>
                            <a href="{{ route('admin.user.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.user.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-users text-xs mr-3 w-4 text-center"></i>
                                <span>User</span>
                            </a>
                            <a href="{{ route('admin.formulir.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.formulir.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-file text-xs mr-3 w-4 text-center"></i>
                                <span>Formulir</span>
                            </a>
                            <a href="{{ route('admin.persyaratan.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.persyaratan.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-file-alt text-xs mr-3 w-4 text-center"></i>
                                <span>Persyaratan</span>
                            </a>
                        </div>
                    </div>


                    <!-- PENGATURAN MOBILE -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.jadwal.*') || request()->routeIs('admin.slide.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800 transition-all duration-200 group text-slate-300 focus:outline-none">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-cog text-lg mr-3 w-6"></i>
                                <span>Pengaturan</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1 pl-9" x-cloak>
                            <a href="{{ route('admin.jadwal.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.jadwal.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="far fa-calendar text-xs mr-3 w-4 text-center"></i>
                                <span>Jadwal</span>
                            </a>
                            <a href="{{ route('admin.slide.index') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.slide.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="far fa-image text-xs mr-3 w-4 text-center"></i>
                                <span>Gambar Slide</span>
                            </a>
                        </div>
                    </div>

                    <!-- SINKRONISASI MOBILE -->
                    <div x-data="{ open: {{ (request()->routeIs('admin.sinkronisasi.*')) ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-xl hover:bg-slate-800 transition-all duration-200 group text-slate-300 focus:outline-none">
                            <div class="flex items-center">
                                <i class="fas fa-fw fa-sync-alt text-lg mr-3 w-6"></i>
                                <span>Sinkronisasi</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-500"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-collapse class="mt-1 space-y-1 pl-9" x-cloak>
                            <a href="{{ route('admin.sinkronisasi.transaksi') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.transaksi') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-exchange-alt text-xs mr-3 w-4 text-center"></i>
                                <span>Cek Transaksi</span>
                            </a>
                            <a href="{{ route('admin.sinkronisasi.wilayah') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.wilayah') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-map-marker-alt text-xs mr-3 w-4 text-center"></i>
                                <span>Cek Wilayah</span>
                            </a>
                            <a href="{{ route('admin.sinkronisasi.riwayat') }}" class="flex items-center px-3 py-1.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.sinkronisasi.riwayat') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                                <i class="fas fa-trash-alt text-xs mr-3 w-4 text-center"></i>
                                <span>Riwayat Hapus</span>
                            </a>
                        </div>
                    </div>
                    @endif


                    <!-- Laporan Link -->
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'hover:bg-slate-800' }}">
                        <i class="fas fa-fw fa-chart-line text-lg mr-3 w-6"></i>
                        <span>Laporan</span>
                    </a>


                </nav>
            </div>

            <!-- User Footer in Mobile Sidebar -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/20 flex items-center gap-3">
                <img src="{{ auth()->user()->avatar_url }}" class="w-9 h-9 rounded-full object-cover border border-slate-700" alt="Avatar">
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->level_name }}</p>
                </div>
            </div>

        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-100 flex items-center justify-between px-6 sticky top-0 z-30">

                <!-- Navbar Left: Toggles -->
                <div class="flex items-center gap-4">
                    <!-- Hamburger Desktop -->
                    <button class="text-slate-500 hover:text-slate-800 focus:outline-none hidden md:block"
                        @click="sidebarOpen = !sidebarOpen">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <!-- Hamburger Mobile -->
                    <button class="text-slate-500 hover:text-slate-800 focus:outline-none md:hidden"
                        @click="mobileSidebarOpen = true">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Page Header / Breadcrumb -->
                    <div class="top-nav-header font-title font-semibold text-lg text-slate-800 hidden sm:block">
                        @php
                        $titleText = '';
                        if (View::hasSection('title')) {
                        $titleText = View::yieldContent('title');
                        // Clean up title: strip common suffixes and prefixes
                        $titleText = str_ireplace(['admin - ', 'kelola ', ' - pondok', ' admin', 'detail ', 'data '], '', $titleText);
                        }
                        if (empty($titleText) || str_contains(strtolower($titleText), 'pondok')) {
                        $titleText = 'Dashboard';
                        }
                        @endphp
                        {!! trim($titleText) !!}
                    </div>
                </div>

                <!-- Navbar Right: Profile & Action Links -->
                <div class="flex items-center gap-4">

                    <!-- App Link -->
                    <a href="{{ route('home') }}" target="_blank" class="text-slate-500 hover:text-slate-800 flex items-center gap-1.5 text-sm font-medium px-2.5 py-1.5 rounded-lg hover:bg-slate-50 transition-colors" title="Lihat Website">
                        <i class="fas fa-external-link-alt text-base"></i>
                        <span class="hidden md:inline">Lihat Website</span>
                    </a>

                    <div class="h-6 w-[1px] bg-slate-200"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                        <button class="flex items-center gap-2 focus:outline-none" @click="dropdownOpen = !dropdownOpen">
                            <img src="{{ auth()->user()->avatar_url }}" class="w-8 h-8 rounded-full object-cover border border-slate-100 shadow-sm" alt="Avatar">
                            <span class="text-sm font-medium text-slate-700 hover:text-slate-900 hidden sm:inline">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-lg py-1 z-50 origin-top-right transform transition-all duration-100"
                            x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">

                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->level_name }}</p>
                            </div>

                            <a href="{{ route('admin.profile.show') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 gap-2.5">
                                <i class="fas fa-user text-slate-400 w-4 text-center"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('admin.profile.password') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 gap-2.5">
                                <i class="fas fa-unlock text-slate-400 w-4 text-center"></i>
                                <span>Ubah Sandi</span>
                            </a>

                            <div class="border-t border-slate-100 my-1"></div>

                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 gap-2.5 font-medium">
                                <i class="fas fa-sign-out-alt text-red-400 w-4 text-center"></i>
                                <span>Keluar</span>
                            </a>
                        </div>
                    </div>

                </div>

            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 md:p-8">
                <!-- Content Header (Original Page Title & Action Buttons) -->
                @if(View::hasSection('content_header'))
                @php
                $headerContent = trim(View::yieldContent('content_header'));
                $cleanHeader = trim(strip_tags($headerContent));
                @endphp
                @if(!empty($cleanHeader))
                <div class="content-header-container mb-4">
                    {!! $headerContent !!}
                </div>
                @endif
                @endif



                <!-- Page Content -->
                @yield('content')
            </main>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>

    </div>

    <!-- Scripts: JQuery, Bootstrap Bundle, Alpine.js, SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{!! addslashes(session('success')) !!}",
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{!! addslashes(session('error')) !!}",
                confirmButtonText: 'OK'
            });
            @endif
        });

        // Pemicu muat jumlah pesan belum dibaca di sidebar (chat internal,
        // diperbarui lewat polling berkala karena tidak memakai realtime)
        (function() {
            async function refreshUnreadBadges() {
                try {
                    // Hemat request: lewati saat tab tidak aktif
                    if (document.hidden) return;
                    const response = await fetch('/chat-proxy/admin-conversations');
                    if (!response.ok) return;
                    const conversations = await response.json();

                    let totalUnread = 0;
                    conversations.forEach(conv => {
                        totalUnread += conv.unreadCount || 0;
                    });

                    const badgeDesktop = document.getElementById('unread-pesan-badge-desktop');
                    const badgeMobile = document.getElementById('unread-pesan-badge-mobile');

                    [badgeDesktop, badgeMobile].forEach(badge => {
                        if (!badge) return;
                        if (totalUnread > 0) {
                            badge.textContent = totalUnread;
                            badge.style.display = 'inline-block';
                        } else {
                            badge.style.display = 'none';
                        }
                    });
                } catch (err) {
                    console.error('Gagal memuat jumlah pesan belum dibaca:', err);
                }
            }

            refreshUnreadBadges();
            setInterval(refreshUnreadBadges, 30000);
        })();
    </script>

    @yield('js')
    @stack('js')
</body>

</html>