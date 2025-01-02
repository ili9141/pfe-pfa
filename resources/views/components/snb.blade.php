@php
$userType = session('user_type', 'guest'); // Default to 'guest' if not set
$menuItems = [];

switch ($userType) {
case 'admin':
$menuItems = [
['label' => 'Admin Dashboard', 'link' => route('admin.dashboard')],
['label' => 'Manage Users', 'link' => route('admin.users')],
['label' => 'Add User', 'link' => route('register')],
];
break;
case 'professor':
$menuItems = [
['label' => 'Professor Dashboard', 'link' => route('professor.dashboard')],
['label' => 'Manage Classes', 'link' => route('professor.classes')],
['label' => 'View Reports', 'link' => route('professor.reports')],
];
break;
case 'student':
$menuItems = [
['label' => 'Student Dashboard', 'link' => route('student.dashboard')],
['label' => 'View Assignments', 'link' => route('student.assignments')],
['label' => 'Submit Projects', 'link' => route('student.projects')],
];
break;
default:
$menuItems = [
['label' => 'Home', 'link' => route('index')],
['label' => 'Contact Us', 'link' => route('contact')],
['label' => 'Help', 'link' => route('help')],
];
break;
}
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-success shadow-sm">
    <div class="container-fluid">
        <ul class="navbar-nav d-flex justify-content-center w-100">
            @foreach ($menuItems as $item)
            <li class="nav-item">
                <a class="nav-link text-white px-5 py-2" href="{{ $item['link'] }}">
                    {{ $item['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>