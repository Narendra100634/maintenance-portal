@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Request Details</h1></div>
            <div class="col-md-6 text-right"><a href="{{route('reqtype.index')}}"><button class="btn btn-danger ">Back</button></a></div>
        </div>   
    </section>
    <section class="content">
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-body">
                          <form method="POST" action="{{route('reqtype.store')}}" class="form-submission watermark min-height form-sbmt">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Request Name<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{old('name')}}" placeholder ="Request Name" required/>
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('name')}}</div>
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
                                                <option value="1" selected>Active</option>
                                                <option value="0">InActive</option> 
                                            </select>
                                            @if($errors->has('status'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('status')}}</div>
                                            @endif
                                        </span>
                                    </div> 
                                </div> 	 
                                <div class="row" class="body-submit">
                                    <div class="col-md-2"> 
                                        <button type="submit" class="btn btn-primary btn-body">Submit </button>
                                    </div>
                                </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
       </section>    
       @endsection