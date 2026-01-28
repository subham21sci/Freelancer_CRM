<ul class="metismenu" id="menu">

    <li class="">
        <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="parent-icon"><i class="bx bx-home-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-message-square-edit font-30 secondary"></i>
            </div>
            <div class="menu-title">Catalog</div>
        </a>
        <ul>
            <li> <a href="{{ route('admin.categoryList') }}"
                    class="{{ Request::routeIs('admin.categoryList') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Category</a>
            </li>

             <li> <a href="{{ route('admin.technology') }}" class="{{ Request::routeIs('admin.technology') ? 'active' : '' }}"><i class='bx bx-radio-circle'></i>Technologies</a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Tags</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('admin.clients.clientsList') }}"
            class="{{ request()->routeIs(['admin.clients.*']) ? 'active' : '' }}">
            <div class="parent-icon"><i class="bx bx-user font-30 secondary"></i></div>
            <div class="menu-title">Clients</div>
        </a>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-pin font-30 secondary"></i>
            </div>
            <div class="menu-title">Projects</div>
        </a>
        <ul>
            <li> <a href="{{ route('admin.projects.all') }}"
                    class="{{ Request::routeIs('admin.projects.all') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>All Project</a></li>
            <li> <a href="{{ route('admin.projects.completed') }}"
                    class="{{ Request::routeIs('admin.projects.completed') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Completed</a></li>
            <li> <a href="{{ route('admin.projects.incomplete') }}"
                    class="{{ Request::routeIs('admin.projects.incomplete') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>In-Complete</a></li>
            <li> <a href="{{ route('admin.projects.ongoing') }}"
                    class="{{ Request::routeIs('admin.projects.ongoing') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Ongoing</a></li>
            <li> <a href="{{ route('admin.projects.pipeline') }}"
                    class="{{ Request::routeIs('admin.projects.pipeline') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Pipeline</a></li>
            <li> <a href="{{ route('admin.projects.rejected') }}"
                    class="{{ Request::routeIs('admin.projects.rejected') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Rejected</a></li>
            <li> <a href="#"
                    class="#"><i
                        class='bx bx-radio-circle'></i>Maintenance</a></li>
        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-home-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">Proposal & Contract</div>
        </a>
        <ul>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Proposal </a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Quotation </a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>SOP </a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Contract</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-home-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">Financial Tracking</div>
        </a>
        <ul>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Invoice</a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Payments</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('admin.enquiryList') }}"
            class="{{ Request::routeIs('admin.enquiryList') ? 'active' : '' }}">
            <div class="parent-icon"><i class="bx bx-calendar-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">
                Enquiry
            </div>
        </a>
    </li>


    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-home-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">Site Management</div>
        </a>
        <ul>
            <li> <a href="{{ route('admin.galleryList') }}"
                    class="{{ Request::routeIs('admin.galleryList') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Portfolio</a>
            </li>
            <li> <a href="{{ route('admin.blogList') }}"
                    class="{{ Request::routeIs('admin.blogList') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Blogs</a>
            </li>
            <li> <a href="{{ route('admin.faqlist') }}"
                    class="{{ Request::routeIs('admin.faqlist') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Faqs</a>
            </li>
            <li> <a href="{{ route('admin.testimoniallist') }}"
                    class="{{ Request::routeIs('admin.testimoniallist') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Testimonial</a>
            </li>
            <li> <a href="{{ route('admin.contactList') }}"
                    class="{{ Request::routeIs('admin.contactList') ? 'active' : '' }}"><i
                        class='bx bx-radio-circle'></i>Contact</a>
            </li>
        </ul>
    </li>




    {{-- <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-home-alt font-30 secondary"></i>
            </div>
            <div class="menu-title">Catalog</div>
        </a>
        <ul>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Category</a>
            </li>
            <li> <a href="#" class=""><i class='bx bx-radio-circle'></i>Technologies</a>
            </li>
        </ul>
    </li> --}}


</ul>
<!--end navigation-->
</div>


<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>

            <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                data-bs-target="#SearchModal">
                <!-- <input class="form-control px-5" disabled type="search" placeholder="Search">
      <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i class='bx bx-search'></i></span> -->
            </div>


            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    <li class="nav-item dropdown dropdown-app">
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="app-container p-2 my-2">
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0)"></a>
                            <div class="header-notifications-list"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0)"></a>
                            <div class="header-message-list"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ auth()->user()->profile_photo_path
                        ? asset('storage/admin/' . auth()->user()->profile_photo_path)
                        : asset('backassets/images/avatars/avatar-1.png') }}"
                        alt="Profile Image" height="50">
                    <div class="user-info">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}"><i
                                class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.changePassword') }}"><i class="bx bx-cog fs-5"></i><span>Change
                                Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>

                        <form method="POST" action="/logout">
                            {{ csrf_field() }}
                            <button type="submit" class="dropdown-item d-flex align-items-center"><i
                                    class="bx bx-log-out-circle"></i><span>Logout</span></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--end header -->
