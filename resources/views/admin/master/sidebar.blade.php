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
            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Package</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Packages</a></li>
                    <li><a class="nav-link" href="#">Compose</a></li>
                    <li><a class="nav-link" href="#">Read</a></li>
                </ul>
            </li> --}}
            <li class="menu-header">UI Elements</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Basic Components</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Alert</a></li>
                    <li><a class="nav-link" href="#">Badge</a></li>
                    <li><a class="nav-link" href="#">Breadcrumb</a></li>
                    <li><a class="nav-link" href="#">Buttons</a></li>
                    <li><a class="nav-link" href="#">Collapse</a></li>
                    <li><a class="nav-link" href="#">Dropdown</a></li>
                    <li><a class="nav-link" href="#">Checkbox &amp; Radios</a></li>
                    <li><a class="nav-link" href="#">List Group</a></li>
                    <li><a class="nav-link" href="#">Media Object</a></li>
                    <li><a class="nav-link" href="#">Navbar</a></li>
                    <li><a class="nav-link" href="#">Pagination</a></li>
                    <li><a class="nav-link" href="#">Popover</a></li>
                    <li><a class="nav-link" href="#">Progress</a></li>
                    <li><a class="nav-link" href="#">Tooltip</a></li>
                    <li><a class="nav-link" href="#">Flag</a></li>
                    <li><a class="nav-link" href="#">Typography</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>Advanced</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Avatar</a></li>
                    <li><a class="nav-link" href="#">Card</a></li>
                    <li><a class="nav-link" href="#">Modal</a></li>
                    <li><a class="nav-link" href="#">Sweet Alert</a></li>
                    <li><a class="nav-link" href="#">Toastr</a></li>
                    <li><a class="nav-link" href="#">Empty State</a></li>
                    <li><a class="nav-link" href="#">Multiple Upload</a></li>
                    <li><a class="nav-link" href="#">Pricing</a></li>
                    <li><a class="nav-link" href="#">Tabs</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="#"><i data-feather="file"></i><span>Blank Page</span></a></li>
            <li class="menu-header">Otika</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Basic Form</a></li>
                    <li><a class="nav-link" href="#">Advanced Form</a></li>
                    <li><a class="nav-link" href="#">Editor</a></li>
                    <li><a class="nav-link" href="#">Validation</a></li>
                    <li><a class="nav-link" href="#">Form Wizard</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>Tables</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Basic Tables</a></li>
                    <li><a class="nav-link" href="#">Advanced Table</a></li>
                    <li><a class="nav-link" href="#">Datatable</a></li>
                    <li><a class="nav-link" href="#">Export Table</a></li>
                    <li><a class="nav-link" href="#">Editable Table</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Charts</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">amChart</a></li>
                    <li><a class="nav-link" href="#">apexchart</a></li>
                    <li><a class="nav-link" href="#">eChart</a></li>
                    <li><a class="nav-link" href="#">Chartjs</a></li>
                    <li><a class="nav-link" href="#">Sparkline</a></li>
                    <li><a class="nav-link" href="#">Morris</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="feather"></i><span>Icons</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Font Awesome</a></li>
                    <li><a class="nav-link" href="#">Material Design</a></li>
                    <li><a class="nav-link" href="#">Ion Icons</a></li>
                    <li><a class="nav-link" href="#">Feather Icons</a></li>
                    <li><a class="nav-link" href="#">Weather Icon</a></li>
                </ul>
            </li>
            <li class="menu-header">Media</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>Gallery</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Light Gallery</a></li>
                    <li><a href="#">Gallery 2</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="flag"></i><span>Sliders</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Bootstrap Carousel</a></li>
                    <li><a class="nav-link" href="#">Owl Carousel</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="#"><i data-feather="sliders"></i><span>Timeline</span></a></li>
            <li class="menu-header">Maps</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Google Maps</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Advanced Route</a></li>
                    <li><a href="#">Draggable Marker</a></li>
                    <li><a href="#">Geocoding</a></li>
                    <li><a href="#">Geolocation</a></li>
                    <li><a href="#">Marker</a></li>
                    <li><a href="#">Multiple Marker</a></li>
                    <li><a href="#">Route</a></li>
                    <li><a href="#">Simple</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="#"><i data-feather="map-pin"></i><span>Vector Map</span></a></li>
            <li class="menu-header">Pages</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Forgot Password</a></li>
                    <li><a href="#">Reset Password</a></li>
                    <li><a href="#">Subscribe</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="alert-triangle"></i><span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">503</a></li>
                    <li><a class="nav-link" href="#">403</a></li>
                    <li><a class="nav-link" href="#">404</a></li>
                    <li><a class="nav-link" href="#">500</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="anchor"></i><span>Other Pages</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Create Post</a></li>
                    <li><a class="nav-link" href="#">Posts</a></li>
                    <li><a class="nav-link" href="#">Profile</a></li>
                    <li><a class="nav-link" href="#">Contact</a></li>
                    <li><a class="nav-link" href="#">Invoice</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="chevrons-down"></i><span>Multilevel</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Menu 1</a></li>
                    <li class="dropdown">
                        <a href="#" class="has-dropdown">Menu 2</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Child Menu 1</a></li>
                            <li class="dropdown">
                                <a href="#" class="has-dropdown">Child Menu 2</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Child Menu 1</a></li>
                                    <li><a href="#">Child Menu 2</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Child Menu 3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
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