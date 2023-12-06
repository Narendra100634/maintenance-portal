@include('layouts.header')
@include('layouts.sidebar')
<div class="content-wrapper">
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Create New Request</h1></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST" action="{{route('storerequest')}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Priority<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom:20px;">
                                            <label class="radio-inline" style="margin-top: 0px;margin-right: 10px;"><input type="radio" name="priority" value="Low" checked style="margin-left:-36px;"><span class="btn btn-warning">Low</span></label>
                                            <label class="radio-inline" style="margin-right: 10px;"><input type="radio" name="priority" value="Medium" style="margin-left:-40px;"><span class="btn btn-info">Medium</span></label>
                                            <label class="radio-inline" style="margin-right: 10px;"><input type="radio" name="priority" value="High" style="margin-left:-35px;"><span class="btn btn-success">High</span></label>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Request Type<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <select class="form-control" name="request_type" id="request_type" required>
                                                    <option value="" selected disabled>Select Request</option>
                                                    @foreach ($requests as $request )                                                            
                                                        <option value="{{$request->id}}">{{$request->name}}</option>
                                                    @endforeach                                                        
                                                </select>
                                            </span>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2"><label>Subject<span class="required_min">*</span></label></div>
                                        <div class="col-md-6"><span><input type="text" class="form-control" name="subject" placeholder ="Enter Subject"></span></div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Description<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6"><span><textarea type="text" class="form-control" row="5" col="10" name="description" placeholder ="Enter Message Here"></textarea></span></div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Attachment<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6"><span><input type="file" name ="files" /></span></div>
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
                <div class="col-md-3">
                    @if(session('userType') == 'requester')
                        <div class="box">
                            <div class="box-body">
                                <div class="request-body"><span>Request Information</span></div>
                                <h5><b>Name</b> : {{session('name') ? session('name') : '' }}</h5>
                                <h5><b>Location</b> : {{ session('region') ? session('region') : '' }}</h5>
                                <h5><b>Request Date</b> : {{ date('d-m-Y') }}</h5>
                                <hr class="body-line-content">
                                <h5><b>Resolver</b></h5>
                                <h5>{{$resolverData[0]->name ? ucfirst($resolverData[0]->name) : ''}}</h5>
                            </div>
                        </div>
                    @endif                             
                </div>
            </div>
        </div>
    </section>    
</div>
@include('layouts.footer')
