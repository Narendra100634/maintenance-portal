@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Create New Request</h1></div>
            <div class="col-md-6 text-right"><a href="{{route('req.allrequest','all')}}"><button class="btn btn-danger ">Back</button></a></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST" action="{{route('req.store')}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                @csrf
                                   
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Request Type<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <select class="form-control @error('request_type') is-invalid @enderror" name="request_type" id="request_type" required>
                                                    <option value="" selected disabled>Select Request</option>
                                                    @foreach ($requests as $request )                                                            
                                                        <option value="{{$request->id}}">{{ucwords($request->name)}}</option>
                                                    @endforeach                                                        
                                                </select>
                                                @if($errors->has('request_type'))
                                                    <div class="invalid-feedback error-msg">{{$errors->first('request_type')}}</div>
                                                @endif
                                            </span>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2"><label>Subject<span class="required_min">*</span></label></div>
                                        <div class="col-md-6"><span>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder ="Enter Subject" required>
                                            @if($errors->has('subject'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('subject')}}</div>
                                            @endif
                                        </span></div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Description<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6"><span>
                                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" row="5" col="10" name="description" placeholder ="Enter Message Here" required></textarea>
                                            @if($errors->has('description'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('description')}}</div>
                                            @endif
                                    </span></div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Attachment</label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <input type="file" class="form-control @error('files') is-invalid @enderror" name ="files" />
                                                @if($errors->has('files'))
                                                    <div class="invalid-feedback error-msg">{{$errors->first('files')}}</div>
                                                @endif
                                            </span>
                                        </div>
                                    </div> 	
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Priority<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-8" class="form-control @error('priority') is-invalid @enderror">
                                            <label class="radio-inline"><input type="radio" name="priority" value="Low" checked ><span class="btn low" >Low</span></label>
                                            <label class="radio-inline"><input type="radio" name="priority" value="Medium"><span class="btn medium">Medium</span></label>
                                            <label class="radio-inline"><input type="radio" name="priority" value="High"><span class="btn high">High</span></label>
                                            @if($errors->has('request_type'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('priority')}}</div>
                                            @endif
                                        </div>
                                    </div>                                           	                                      	
                                    <div class="row" class="body-submit">
                                        <div class="col-md-2"> 
                                        <button type="submit" id="create_request" class="btn btn-primary btn-body">Submit </button>
                                        </div>
                                    </div>                                     
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if(session('userType') == 'requester')
                        <div class="box">
                         <div class="box-body-right">
                            <div class="request-body">Request Information</div>
                                <div class="body-right-content">
                                <h5><span class="right-label">Name:</span><span>{{session('name') ? session('name') : '' }}</span></h5>
                                <h5><span class="right-label">Location :</span><span>{{ session('region') ? session('region') : '' }}</span></h5>
                                <h5><span class="right-label">Request Date :</span><span> {{ date('d-m-Y') }}</span></h5>
                                    <hr class="body-line-content">
                                    <h5>Resolver</h5>
                                    <h5><span>{{$resolverData[0]->name ? ucfirst($resolverData[0]->name) : ''}}</span></h5>
                                </div>
                           </div>
                        </div>
                    @endif                             
                </div>
            </div>
    </section>    
@endsection
