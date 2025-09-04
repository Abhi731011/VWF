<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>VWF- Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/favicon.ico') }}" />
    
    <!-- Auto-hide alerts CSS -->
    <style>
        /* Auto-hide alerts functionality */
        .alert {
            transition: opacity 0.5s ease-out, height 0.5s ease-out, margin 0.5s ease-out, padding 0.5s ease-out;
        }
        .alert.auto-hiding {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        /* To disable auto-hide for specific alerts, add class 'no-auto-hide' */
        .alert.no-auto-hide {
            /* This alert will not auto-hide */
        }
    </style>
    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <!--icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
    @yield('style')
</head>
<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.master.header')
            @include('admin.master.sidebar')
            
            <!-- Global Error/Success Messages -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px; z-index: 9999;">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px; z-index: 9999;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
            
            @include('admin.master.footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraries -->
    <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
        
        // Auto-hide alerts after 4 seconds
        document.addEventListener('DOMContentLoaded', function() {
            // Find all alert elements (including Bootstrap alerts)
            const alerts = document.querySelectorAll('.alert, .alert-success, .alert-danger, .alert-warning, .alert-info');
            
            alerts.forEach(function(alert) {
                // Skip if alert is already hidden or has auto-hide disabled
                if (alert.style.display === 'none' || alert.classList.contains('no-auto-hide')) {
                    return;
                }
                
                // Hide alert after 4 seconds
                setTimeout(function() {
                    // Add fade out effect using CSS class
                    alert.classList.add('auto-hiding');
                    
                    // Remove from DOM after fade out
                    setTimeout(function() {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 500);
                }, 4000);
            });
        });
        
        // Also handle dynamically added alerts (for AJAX responses)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1 && (node.classList.contains('alert') || node.querySelector('.alert'))) {
                        const newAlerts = node.classList.contains('alert') ? [node] : node.querySelectorAll('.alert');
                        newAlerts.forEach(function(alert) {
                            if (!alert.classList.contains('no-auto-hide')) {
                                setTimeout(function() {
                                    // Add fade out effect using CSS class
                                    alert.classList.add('auto-hiding');
                                    
                                    setTimeout(function() {
                                        if (alert.parentNode) {
                                            alert.parentNode.removeChild(alert);
                                        }
                                    }, 500);
                                }, 4000);
                            }
                        });
                    }
                });
            });
        });
        
        // Start observing the document body for dynamically added alerts
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    </script>
    @yield('script')
    
    <!-- Auto-hide alerts script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert:not(.no-auto-hide)');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.add('auto-hiding');
                    setTimeout(function() {
                        alert.remove();
                    }, 500); // Remove after transition
                }, 5000); // Hide after 5 seconds
            });
        });
    </script>
</body>
</html>