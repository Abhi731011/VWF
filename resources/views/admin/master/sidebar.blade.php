<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"> 
<img alt="image" src="{{ asset('assets/img/Logowithname.png') }}" 
     class="header-logo" 
     style="height:100px; width:auto;" />
                {{-- <span class="logo-name">VWF</span> --}}
            </a>
        </div>
        
        <!-- User Info Section -->
        @if(auth()->check())
        {{-- <div class="sidebar-user-info" style="padding: 15px; border-bottom: 1px solid #e3e6f0;">
            <div class="d-flex align-items-center">
                @if(auth()->user()->profile_img)
                    <img src="{{ asset('admin_profile/' . auth()->user()->profile_img) }}" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                @else
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ddd; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-user" style="color: #666;"></i>
                    </div>
                @endif
                <div>
                    <div style="font-weight: bold; color: #333; font-size: 14px;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 12px; color: #666;">
                        @if(auth()->user()->isMainAdmin())
                            <span style="color: #dc3545; font-weight: bold;">Main Admin</span>
                        @else
                            <span style="color: #007bff;">Admin User</span>
                        @endif
                    </div>
                </div>
            </div>
        </div> --}}
        @endif
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Contact Us</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.contact.index') }}">Listings</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Projects</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('projects.index') }}">Add Project</a></li>
                    {{-- <li><a class="nav-link" href="#">Portfolio</a></li>
                    <li><a class="nav-link" href="#">Blog</a></li>
                    <li><a class="nav-link" href="#">Calendar</a></li> --}}
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="calendar"></i><span>Events</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('events.index') }}">Manage Events</a></li>
                    <li><a class="nav-link" href="{{ route('events.create') }}">Add Event</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="package"></i><span>Packages</span></a>
                <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{ route('packages.create') }}">Add Package</a></li>

                    <li><a class="nav-link" href="{{ route('packages.index') }}">Manage Packages</a></li>
                </ul>
            </li>
            @if(auth()->check() && auth()->user()->isMainAdmin())
            <li class="dropdown" style="border-left: 3px solid #dc3545;">
                <a href="#" class="menu-toggle nav-link has-dropdown" style="color: #dc3545; font-weight: bold;"><i data-feather="users"></i><span>Admin Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admins.index') }}">Manage Admins</a></li>
                    <li><a class="nav-link" href="{{ route('admins.create') }}">Add Admin</a></li>
                </ul>
            </li>
            @endif 
        </ul>
    </aside>
</div>
<div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i></a>
    <div class="settingSidebar-body ps-container ps-theme-default">
        <div class="fade show active">
            <div class="setting-panel-header">Setting Panel</div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                        <span class="selectgroup-button">Light</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                        <span class="selectgroup-button">Dark</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                    <ul class="choose-theme list-unstyled mb-0">
                        <li title="white" class="active">
                            <div class="white"></div>
                        </li>
                        <li title="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li title="black">
                            <div class="black"></div>
                        </li>
                        <li title="purple">
                            <div class="purple"></div>
                        </li>
                        <li title="orange">
                            <div class="orange"></div>
                        </li>
                        <li title="green">
                            <div class="green"></div>
                        </li>
                        <li title="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Mini Sidebar</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Sticky Header</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                    <i class="fas fa-undo"></i> Restore Default
                </a>
            </div>
        </div>
    </div>
</div>