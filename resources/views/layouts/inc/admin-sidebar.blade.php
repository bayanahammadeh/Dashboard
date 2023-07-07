    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ url('admin/personal') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Personal
                    </a>
                    <a class="nav-link" href="{{ url('admin/skill') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Skill
                    </a>
                    <a class="nav-link" href="{{ url('admin/project') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Project
                    </a>
                    <a class="nav-link" href="{{ url('admin/education') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Education
                    </a>
                    <a class="nav-link" href="{{ url('admin/experience') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Experience
                    </a>
                    <a class="nav-link" href="{{ url('admin/lang') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Lang
                    </a>
                    <a class="nav-link" href="{{ url('admin/social') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Social
                    </a>
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
