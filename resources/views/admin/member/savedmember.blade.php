@extends('admin.layout.master')
@section('content')
<div class="form-group">
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
                  <h5>New Member{{$success}}</h5>
               </div>
                @if(isset($success))
                    <div class="alert alert-success">
                        {{$success}}
                    </div>
                @endif

                @if(isset($error))
                    <div class="alert alert-success">
                        {{$error}}
                    </div>
                @endif
               {{-- @if(Session::has('success'))
                    <div class="alert alert-success"><span style="font-size: medium">{{Session::get('success')}}</span></div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger"><span style="font-size: medium">{{Session::get('error')}}</span></div>
                @endif --}}
               <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="col-lg-6 m-b-md">
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">

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
   </div>
</div>
@endsection
