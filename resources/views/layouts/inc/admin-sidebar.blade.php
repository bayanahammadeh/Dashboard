<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ url($role.'/personal') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Personal
                </a>
                <a class="nav-link" href="{{ url($role.'/skill') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Skill
                </a>
                <a class="nav-link" href="{{ url($role.'/project') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Project
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseEducation" aria-expanded="false" aria-controls="collapseEducation">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Education
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEducation" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url($role.'/education') }}">Main</a>
                        <a class="nav-link" href="{{ url($role.'/ed') }}">Detail</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseExperience" aria-expanded="false" aria-controls="collapseExperience">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Experience
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseExperience" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url($role.'/experience') }}">Main</a>
                        <a class="nav-link" href="{{ url($role.'/ex') }}">Detail</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ url($role.'/lang') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Lang
                </a>
                <a class="nav-link" href="{{ url($role.'/social') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Social
                </a>
                @if (( $role  == "admin")||( $role  == "supper"))
                <a class="nav-link" href="{{ url($role.'/contact') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Contact
                </a>
                <a class="nav-link" href="{{ url($role.'/user') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User
                </a>
                @endif
                @if ($role == "supper")
                <a class="nav-link" href="{{ url($role.'/role') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Role
                </a>
                @endif
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                            aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>
    </nav>
</div>
