@include('layouts.header')
@include('layouts.sidebar')           
<div class="content-wrapper">
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 style="color:#566b75;">Request Details</h1></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form method="POST" action="{{route('reqtype.update',Crypt::encrypt($editData->id) )}}" class="form-submission watermark min-height" style="margin-top:10px;">
                            @csrf
                            <div class="row">
                                <!-- <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{$editData->name}}" class="form-control @if($errors->has('name')) is-invalid @endif" />
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                    @endif
                                </div> -->
                                <div class="col-md-2">  
                                    <label>Request Name<span class="required_min">*</span></label>
                                </div>
                                <span>
                                    <div class="col-md-5">
                                        <input type="text" id="name" name="name" value="{{$editData->name}}" class="form-control @if($errors->has('name')) is-invalid @endif" />
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                        @endif
                                    </div>                                               
                                </span>
                            </div>   
                            <div class="row">
                                <!-- <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control  @if($errors->has('status')) is-invalid @endif" name="status" id="status" required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="1" {{ ($editData->status == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($editData->status == 0) ? 'selected' : '' }}>InActive</option> 
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
                                            <option value="1" {{ ($editData->status == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ($editData->status == 0) ? 'selected' : '' }}>InActive</option> 
                                        </select>
                                        @if($errors->has('status'))
                                            <div class="invalid-feedback">{{$errors->first('status')}}</div>
                                        @endif
                                    </span>
                                </div> 
                                <!-- <div class="col-md-2">  
                                <label>Status<span class="required_min">*</span></label>
                                </div>
                                <div class="col-md-5">
                                    <span>
                                        <select class="form-control  @if($errors->has('status')) is-invalid @endif" name="status" id="status" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="1" {{ ($editData->status == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ($editData->status == 0) ? 'selected' : '' }}>InActive</option> 
                                        </select>
                                        @if($errors->has('status'))
                                            <div class="invalid-feedback">{{$errors->first('status')}}</div>
                                        @endif
                                    </span>
                                </div>  -->
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