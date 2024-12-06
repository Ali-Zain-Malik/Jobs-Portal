{{-- ======= Sidebar ======  --}}
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        {{-- Dashboard Navigator --}}
        <li class="nav-item">
            <a class="nav-link " href="{{ route("admin.dashboard") }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- Dashboard navigator ends --}}

        {{-- Users Management nav --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#usersManagement-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="usersManagement-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route("users.management") }}">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("userAdd.view") }}">
                        <i class="bi bi-circle"></i><span>Add User</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Users Management nav ends --}}

        {{-- Jobs Management nav --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#jobsManagement-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase"></i><span>Jobs Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="jobsManagement-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Jobs</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Jobs management nav ends --}}

        {{-- Skills management nav --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#skillsManagement-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-lightbulb"></i><span>Skills Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="skillsManagement-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route("skills") }}">
                        <i class="bi bi-circle"></i><span>Skills</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Skills management nav ends --}}

        {{-- Feedbacks nav --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route("user.feedbacks") }}">
                <i class="bi bi-chat-quote"></i>
                <span>Feedbacks</span>
            </a>
        </li>
        {{-- Feedbacks nav ends --}}

        {{-- My profile nav --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
        </li>
        {{-- My profile nav ends --}}
    </ul>
</aside>
{{-- ======= End Sidebar ======  --}}