@extends('layouts.app')
@section('content')
    <section class="content-header">                   
            <div class="row">
                <div class="col-md-6"><h1 class="dashboard-heading">Edit Resolver</h1></div>
                <div class="col-md-6 text-right"><a href="{{route('res.index')}}"><button class="btn btn-danger ">Back</button></a></div>
            </div>   
    </section>
    <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST" action="{{route('res.update',Crypt::encrypt($editData->id) )}}" class="form-submission watermark min-height form-sbmt">
                                @csrf    
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Email<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" id="email" value="{{$editData->email}}"  class="form-control @if($errors->has('email')) is-invalid @endif" name="email" placeholder ="Email Id" readonly/>
                                            @if($errors->has('email'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('email')}}</div>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="col-md-5">
                                        <span id="check-user" class="error-msg">
                                            
                                        </span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Name<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" name="name" id="resName" value="{{$editData->name}}" class="form-control @if($errors->has('name')) is-invalid @endif" readonly>
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('name')}}</div>
                                            @endif
                                        </span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Location<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" name="location" id="resLocation" value="{{$editData->location}}" class="form-control @if($errors->has('location')) is-invalid @endif" readonly>
                                            @if($errors->has('location'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('location')}}</div>
                                            @endif
                                        </span>
                                    </div>
                                </div>   
                                   
                                <div class="row">
                                    <div class="col-md-2">  
                                            <label>Mobile<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" class="form-control @if($errors->has('mobile')) is-invalid @endif" name="mobile" id="resMobile" value="{{$editData->mobile}}" placeholder ="Mobile No." readonly/>
                                            @if($errors->has('mobile'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('mobile')}}</div>
                                            @endif
                                        </span>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Status<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                        <select class="form-control @if($errors->has('status')) is-invalid @endif" name="status" id="status" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" {{ ($editData->status == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ($editData->status == 0) ? 'selected' : '' }}>InActive</option> 
                                        </select>
                                        @if($errors->has('status'))
                                            <div class="invalid-feedback error-msg">{{$errors->first('status')}}</div>
                                        @endif
                                        </span>
                                    </div>
                                </div> 				
                                <div class="row" class="body-submit">
                                    <div class="col-md-2"> 
                                    <button type="submit" id="submit" class="btn btn-primary btn-body">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>    
    @endsection