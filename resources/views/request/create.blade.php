@extends('layouts.app')
@section('content')
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
                            <form method="POST" action="{{route('req.store')}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Priority<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom:20px;" class="form-control @error('priority') is-invalid @enderror">
                                            <label class="radio-inline" style="margin-top: 0px;margin-right: 10px;"><input type="radio" name="priority" value="Low" checked style="margin-left:-36px;"><span class="btn btn-warning">Low</span></label>
                                            <label class="radio-inline" style="margin-right: 10px;"><input type="radio" name="priority" value="Medium" style="margin-left:-40px;"><span class="btn btn-info">Medium</span></label>
                                            <label class="radio-inline" style="margin-right: 10px;"><input type="radio" name="priority" value="High" style="margin-left:-35px;"><span class="btn btn-success">High</span></label>
                                            @if($errors->has('request_type'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('priority')}}</div>
                                            @endif
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Request Type<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <select class="form-control @error('request_type') is-invalid @enderror" name="request_type" id="request_type">
                                                    <option value="" selected disabled>Select Request</option>
                                                    @foreach ($requests as $request )                                                            
                                                        <option value="{{$request->id}}">{{$request->name}}</option>
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
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder ="Enter Subject">
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
                                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" row="5" col="10" name="description" placeholder ="Enter Message Here"></textarea>
                                            @if($errors->has('description'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('description')}}</div>
                                            @endif
                                    </span></div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label>Attachment<span class="required_min">*</span></label>
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
@endsection
