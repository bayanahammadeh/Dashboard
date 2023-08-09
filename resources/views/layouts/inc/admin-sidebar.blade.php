<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ url($role . '/personal') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-female"></i></div>
                    Personal
                </a>
                <a class="nav-link" href="{{ url($role . '/skill') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Skill
                </a>
                <a class="nav-link" href="{{ url($role . '/project') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                    Project
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseEducation" aria-expanded="false" aria-controls="collapseEducation">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
                    Education
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEducation" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url($role . '/education') }}">Main</a>
                        <a class="nav-link" href="{{ url($role . '/ed') }}">Detail</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseExperience" aria-expanded="false" aria-controls="collapseExperience">
                    <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                    Experience
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseExperience" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url($role . '/experience') }}">Main</a>
                        <a class="nav-link" href="{{ url($role . '/ex') }}">Detail</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ url($role . '/lang') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe-americas"></i></div>
                    Lang
                </a>
                <a class="nav-link" href="{{ url($role . '/social') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-sms"></i></div>
                    Social
                </a>
                <a class="nav-link" href="{{ url($role . '/contact') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Contact
                </a>
                @if ($role == 'admin' || $role == 'supper')
                    <a class="nav-link" href="{{ url($role . '/user') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                        User
                    </a>
                @endif
                @if ($role == 'supper')
                    <a class="nav-link" href="{{ url($role . '/role') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-door-open"></i></div>
                        Role
                    </a>
                @endif
            </div>
        </div>
    </nav>
</div>
