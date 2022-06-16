@extends('admin.layout.master')
@section('content')
<div class="form-group">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" id="test">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add New Salary Head</h5>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            <span style="font-size: medium">{{Session::get('success')}}</span>
                        </div>
                        @endif
                <div class="ibox-content">
                    <form>
                        @csrf
                        <div id="tab-2" class="tab-pane active">
                            {{-- Personal Details --}}
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Head Name</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="HName" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Short Name</label>
                                        <div class="col-md-3">
                                            <input type="text" name="SName" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Salary Type</label>
                                        <div class="col-sm-3">
                                            <select name="Satus" class="form-control">
                                                <option>select</option>
                                                <option value="1">Income</option>
                                                <option value="0">Deduction</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Order</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="Order" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-primary">Add Salary Head</button>
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
