<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaAmir Admin - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<style>
    :root {
        --primary: #6C63FF;
        --secondary: #4D44DB;
        --dark: #2A2A72;
        --light: #F8F9FA;
        --success: #28A745;
        --warning: #FFC107;
        --danger: #DC3545;
        --gray: #6C757D;
        --info: #17A2B8;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #F5F7FB;
        color: #333;
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        background: linear-gradient(180deg, var(--dark), var(--secondary));
        color: white;
        padding: 20px 0;
        transition: all 0.3s;
        height: 100vh;
        position: fixed;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar-header {
        padding: 0 20px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
    }

    .sidebar-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .sidebar-header h3 {
        font-size: 18px;
        font-weight: 600;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .sidebar-menu ul {
        list-style: none;
    }

    .sidebar-menu li {
        margin-bottom: 5px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s;
        font-size: 14px;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-left: 3px solid var(--primary);
    }

    .sidebar-menu i {
        margin-right: 10px;
        font-size: 16px;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .header h1 {
        font-size: 24px;
        color: var(--dark);
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-info h4 {
        font-size: 14px;
        margin-bottom: 2px;
    }

    .user-info p {
        font-size: 12px;
        color: var(--gray);
    }
    /* Responsive */
    @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }
            
            .sidebar-header h3, .sidebar-menu a span {
                display: none;
            }
            
            .sidebar-menu a {
                justify-content: center;
            }
            
            .sidebar-menu i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .main-content {
                margin-left: 80px;
            }
        }
</style>

<body>
        @include('admin.layouts.sidebar')

        <div class="main-content">
            @include('admin.layouts.header')

            @yield('content')
        </div>

    <!-- Scripts JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>