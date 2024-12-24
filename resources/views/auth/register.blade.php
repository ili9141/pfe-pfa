@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                    <h4 class="text-primary">Register</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Role Selector -->
                        <div class="form-group">
                            <label for="role-selector">Select Role</label>
                            <select id="role-selector" name="user_role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="professor">Professor</option>
                                <option value="student">Student</option>
                            </select>
                        </div>

                        <!-- Common Fields -->
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter Last Name" required>
                        </div>

                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter First Name" required>
                        </div>

                        <div class="form-group">
                            <label for="phonenumber">Phone Number</label>
                            <input type="tel" id="phonenumber" name="phone_number" class="form-control" placeholder="Enter Phone Number">
                        </div>

                        <div class="form-group">
                            <label for="dateofbirth">Date of Birth</label>
                            <input type="date" id="dateofbirth" name="date_of_birth" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="cin">CIN</label>
                            <input type="text" id="cin" name="cin" class="form-control" placeholder="Enter CIN">
                        </div>

                        <div class="form-group">
                            <label for="signup-email">Email</label>
                            <input type="email" id="signup-email" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                        </div>

                        <!-- Conditional Fields for Professor -->
                        <div id="professor-fields" class="conditional-fields" style="display: none;">
                            <div class="form-group">
                                <label for="speciality">Speciality</label>
                                <input type="text" id="speciality" name="speciality" class="form-control" placeholder="Enter Speciality">
                            </div>

                            <div class="form-group">
                                <label for="major-professor">Major</label>
                                <select id="major-professor" name="major" class="form-control">
                                    <option value="" disabled selected>Select Major</option>
                                    @foreach($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->majorName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Conditional Fields for Student -->
                        <div id="student-fields" class="conditional-fields" style="display: none;">
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" id="year" name="year" class="form-control" placeholder="Enter Year">
                            </div>

                            <div class="form-group">
                                <label for="major-student">Major</label>
                                <select id="major-student" name="major" class="form-control">
                                    <option value="" disabled selected>Select Major</option>
                                    @foreach($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->majorName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const roleSelector = document.getElementById('role-selector');
    const professorFields = document.getElementById('professor-fields');
    const studentFields = document.getElementById('student-fields');

    roleSelector.addEventListener('change', () => {
        const selectedRole = roleSelector.value;

        // Hide all conditional fields by default
        professorFields.style.display = 'none';
        studentFields.style.display = 'none';

        // Show fields based on selected role
        if (selectedRole === 'professor') {
            professorFields.style.display = 'block';
        } else if (selectedRole === 'student') {
            studentFields.style.display = 'block';
        }
    });

    // Trigger change event on page load to ensure correct fields are displayed
    roleSelector.dispatchEvent(new Event('change'));
</script>
@endsection