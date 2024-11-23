@extends('admin.layouts.masterLayout')
@section("title")
    Users Management
@endsection
@section('main')
<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div class="div">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Users Management</li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div>
        <div class="add-user-div py-3">
            <a href="{{ route("userAdd.view")}}"><button type="button" class="btn btn-info text-light fw-bold">Add User</button></a>
        </div>
    </div>

    @if(Session("success"))
        <div class="alert alert-success w-100">{{Session::get("success")}}</div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Email</th>
                                    <th>Sign up Date</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->signup_date }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href='#' class='d-block link-dark text-decoration-none dropdown-toggle action' data-bs-toggle='dropdown' aria-expanded='false'>
                                                <img src='{{ asset("img/card-list.svg") }}'>
                                            </a>
                                            <ul class='dropdown-menu text-small'>
                                                <li role="button"> <a href="{{ route("user.profile") }}" class='dropdown-item view'>View</a> </li>
                                                <li role="button"> <span class='dropdown-item delete'>Delete</span> </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>