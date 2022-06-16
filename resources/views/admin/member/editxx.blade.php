@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Members Profile </h5>
                    </div>
                    <form class="form-group" method="get" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="wrapper wrapper-content">
                            <div class="row animated fadeInRight">
                                <div class="col-md-3">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Profile Photo</h5>
                                        </div>
                                        <div>
                                            <div class="ibox-content no-padding border-left-right">
                                                <img alt="image" class="img-responsive" src="{{asset('dist/images/profile_big.jpg')}}">
                                                <label>Upload Photo [Optional] </label>
                                                <input type="file" name="memberphoto" id="memberphoto" class="border-left-right">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-9">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Bio Data</h5>
                                            <div class="ibox-content">

                                                <div>
                                                    <div class="feed-activity-list">
                                                        <div class="feed-element ">
                                                                <div class="row">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Name</strong><input type="text" value="{{$editprofile->MemberName}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                            <strong>Type</strong><input type="text" value="{{$editprofile->MemberType}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                            <strong>Gender</strong><input type="text" value="{{$editprofile->Gender}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-3">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Caste</strong><input type="text" value="{{\App\Helpers\Helper::getcaste($editprofile->Caste)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Religion</strong><input type="text" value="{{\App\Helpers\Helper::getreligion($editprofile->Rlgn)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Qualification</strong>
                                                                        <input type="text" value="{{\App\Helpers\Helper::getqualification($editprofile->QualificationId)}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-3">
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Marital Status</strong><input type="text" value="{{\App\Helpers\Helper::getcaste($editprofile->Caste)}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Spouse</strong><input type="text" value="{{$editprofile->Spouce}}" class="form-control"/>
                                                                    </div>
                                                                    <div class="media-body col-md-2">
                                                                        <strong>Qualification</strong>
                                                                        <input type="text" value="{{\App\Helpers\Helper::getqualification($editprofile->Qualification)}}" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-3">
                                                                    <button type="submit" class="btn btn-primary"> Update </button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
