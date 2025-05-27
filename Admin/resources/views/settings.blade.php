@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <h1>Account Settings</h1>
        <p>Manage your personal information</p>
    </div>

    <form action="/update-settings" method="POST">
        @csrf
        @method('PUT') {{-- Use PUT or PATCH for updates --}}

        <div class="form-container" style="grid-template-columns: 1fr;">
            <!-- Personal Information Card -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Personal Information</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ Auth::user()->name ?? '' }}">
                    </div>

                    {{-- Add fields for phone number, gender, and date of birth --}}
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="{{ Auth::user()->phone_number ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="male" {{ (Auth::user()->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ (Auth::user()->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="submit-container">
            <button type="submit" class="submit-btn">Save Changes</button>
        </div>
    </form>
</div>

{{-- You might want to include the styles either here or in the main layout file --}}
<style>
    :root {
        --primary: #8a6bff;
        --primary-hover: #7559ff;
        --light-bg: #f3efec;
        --border-radius: 12px;
        --shadow: 0 4px 12px rgba(0,0,0,0.1);
        --text-primary: #333;
        --text-secondary: #666;
        --border-color: #e3e3e0;
    }

    .container {
        max-width: 800px; /* Slightly narrower container for settings */
        margin: 0 auto;
        padding: 40px 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
    }

    .header h1 {
        color: var(--text-primary);
        font-size: 32px;
        margin-bottom: 12px;
    }

    .header p {
        color: var(--text-secondary);
        font-size: 16px;
    }

    .form-container {
        display: grid;
        /* Adjusted for a single column */
        gap: 24px;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 100%;
        border: 1px solid var(--border-color);
    }

    .form-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        padding: 16px;
        background-color: var(--light-bg);
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
    }

    .card-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s ease;
        background-color: white;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
    }

    .submit-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .submit-btn {
        background-color: var(--primary);
        color: white;
        padding: 14px 36px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 20px 10px;
        }
        .form-card {
            margin-bottom: 20px; /* Add space between cards on small screens */
        }
    }
</style>
@endsection 