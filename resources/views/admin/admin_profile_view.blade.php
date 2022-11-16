@extends('layout.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br>
                        <center>
                            <img class="rounded-circle avatar-xl"
                                src="{{ !empty($adminData->profile_images) ? url('upload/admin_images/' . $adminData->profile_images) : url('upload/no_image.jpg') }}"
                                alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3">Name</label>
                                    <div class="col-sm-9">
                                        {{ ucfirst($adminData->name) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        {{ $adminData->email }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Username</label>
                                    <div class="col-sm-9">
                                        {{ $adminData->username }}
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('edit.profile') }}" class="btn btn-rounded btn-warning float-right"> <i
                                    class="fa fa-edit"></i> Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
