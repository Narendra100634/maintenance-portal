@include('layouts.header')
@include('layouts.sidebar')         
<div class="content-wrapper">
    <section class="content-header">                   
            <div class="row">
                <div class="col-md-6"><h1 class="dashboard-heading">Create Resolver</h1></div>
                <div class="col-md-6 text-right"></div>
            </div>   
    </section>
    <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST" action="{{route('res.store')}}" class="form-submission watermark min-height form-sbmt">
                                @csrf    
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Email<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span><input type="text" id="email" class="form-control" name="email" placeholder ="Email Id"/></span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Name<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" name="name" id="resName" value="" class="form-control" readonly>
                                        </span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Location<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <input type="text" name="location" id="resLocation" value="" class="form-control" readonly>
                                        </span>
                                    </div>
                                </div>   
                                   
                                <div class="row">
                                    <div class="col-md-2">  
                                            <label>Mobile<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span><input type="text" class="form-control" name="mobile" id="resMobile" placeholder ="Mobile No." readonly/></span>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Status<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-5">
                                        <span>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option> 
                                            </select>
                                        </span>
                                    </div>
                                </div> 				
                                <div class="row" class="body-submit">
                                    <div class="col-md-2"> 
                                    <button type="submit" class="btn btn-primary btn-body">Submit</button>
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
