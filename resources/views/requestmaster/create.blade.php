@include('layouts.header')
@include('layouts.sidebar')           
<div class="content-wrapper">
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Request Details</h1></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-body">
                          <form method="POST" action="{{route('reqtype.store')}}" class="form-submission watermark min-height" style="margin-top:10px;">
                                @csrf
                                <div class="row">
                                    <!-- <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control @if($errors->has('name')) is-invalid @endif" />
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                        @endif
                                    </div> -->
                                    <div class="col-md-2">  
                                        <label>Request Name<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" id="name" class="form-control @if($errors->has('name')) is-invalid @endif"" name="name" value="{{old('name')}}" placeholder ="Request Name"/>
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                            @endif
                                        </span>
                                    </div>
                                </div>   
                                <div class="row">
                                    <!-- <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control  @if($errors->has('status')) is-invalid @endif" name="status" id="status" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option> 
                                        </select>
                                        @if($errors->has('status'))
                                            <div class="invalid-feedback">{{$errors->first('status')}}</div>
                                        @endif
                                    </div> -->
                                        <div class="col-md-2">  
                                            <label>Status<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-5">
                                            <span>
                                                <select class="form-control @if($errors->has('status')) is-invalid @endif" name="status" id="status" required>
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">InActive</option> 
                                                </select>
                                                @if($errors->has('status'))
                                                    <div class="invalid-feedback">{{$errors->first('status')}}</div>
                                                @endif
                                            </span>
                                        </div> 
                                </div> 	 
                                <div class="row" style="margin-top:20px; margin-bottom:10px;">
                                    <div class="col-md-2"> 
                                        <button type="submit" class="btn btn-primary" style="color: #ffffff;font-weight: 600;font-size: 18px;background: #f0303d!important;padding: 10px 30px;border: none;">Submit </button>
                                    </div>
                                </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
       </section>    
</div>
@include('layouts.footer')