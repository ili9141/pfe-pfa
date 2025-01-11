<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    {{-- Navbar --}}
    @include('components.nvb')

    {{-- Sidebar --}}
    @include('components.snb')

    {{-- Dynamic Content Based on User Type --}}
    <div class="container-fluid p-0 mt-5">
        <div class="container my-4">
            @php
            $userType = session('user_type', 'guest');
            @endphp

            @if ($userType === 'admin')
            <h2 class="mb-4 text-success">Welcome, Admin</h2>
            <p class="lead">Manage internships, assign professors, and oversee the entire process.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">Add, edit, or delete users in the system.</p>
                            <a href="{{ route('admin.users') }}" class="btn btn-success">Go to Users</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Internships</h5>
                            <p class="card-text">Define internship opportunities for students.</p>
                            <a href="#" class="btn btn-success">Create Internship</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Assign Professors</h5>
                            <p class="card-text">Allocate professors to manage and review internships.</p>
                            <a href="#" class="btn btn-success">Assign Professors</a>
                        </div>
                    </div>
                </div>
            </div>

            @elseif ($userType === 'professor')
            <h2 class="mb-4 text-primary">Welcome, Professor</h2>
            <p class="lead">Manage your assigned students and schedule meetings.</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Students</h5>
                            <p class="card-text">View and manage the students under your supervision.</p>
                            <a href="#" class="btn btn-primary">View Students</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Set Meetings</h5>
                            <p class="card-text">Schedule management sessions with your students.</p>
                            <a href="#" class="btn btn-primary">Manage Calendar</a>
                        </div>
                    </div>
                </div>
            </div>

            @elseif ($userType === 'student')
            <h2 class="mb-4 text-info">Welcome, Student</h2>
            <p class="lead">Keep track of your internship and collaborate with your professor.</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Internship</h5>
                            <p class="card-text">View details of your assigned internship and progress.</p>
                            <a href="#" class="btn btn-info">View Internship</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Professor</h5>
                            <p class="card-text">See the professor assigned to you and schedule meetings.</p>
                            <a href="#" class="btn btn-info">View Professor</a>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <h2 class="mb-4 text-secondary">Welcome</h2>
            <p class="lead">Explore internship opportunities and connect with our team.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Learn More</h5>
                            <p class="card-text">Discover what our platform offers for your career growth.</p>
                            <a href="#" class="btn btn-secondary">About Us</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Contact Us</h5>
                            <p class="card-text">Get in touch with us for further assistance.</p>
                            <a href="{{ route('contact') }}" class="btn btn-secondary">Contact</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Help Center</h5>
                            <p class="card-text">Find answers to common questions in our help center.</p>
                            <a href="{{ route('help') }}" class="btn btn-secondary">Help</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    @include('components.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>