@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h3 class="dashboard-heading">Request Details</h3></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-body">
                            <h4>{{ $editData->subject ? $editData->subject : '' }}</h4>
                            <hr class="body-line">
                            <h4>Description</h4>
                            <p>{{$editData->description ? $editData->description : '' }}</p>
                            @if ($editData->attachment !== null)                                
                                <h4>Attachment: <a href="{{ url('file-data/'.$editData->attachment) }}" target="_blank" class="body-attach">{{$editData->attachment ? $editData->attachment : ''  }}</a></h4> 
                            @endif
                            <hr class="body-line">   
                                @foreach ($comments as  $comment)
                                    <div class="box-body-content">
                                        <h4>{{isset($comment->user_name) ? $comment->user_name : '' }}</h4>
                                        <p>{{isset($comment->created_at) ? $comment->created_at->format('d-m-Y H:i:s') : '' }}</p>
                                        <p>{{isset($comment->comment) ? $comment->comment : '' }}</p>
                                        @if ($comment->attachment  != null || $comment->attachment  != "")                                            
                                            <h4>Attachment: <a href="{{ url('file-data/comments/'.$comment->attachment) }}" target="_blank" class="body-attach">{{$comment->attachment ? $comment->attachment : '' }}</a></h4>
                                        @endif
                                    </div> 
                                @endforeach
                                @if ($editData->status == "Closed")                                    
                                    <div class="box-body-content">
                                        <h4>{{$editData->req_name ? $editData->req_name : ''}}</h4>                                        
                                        <p>{{$editData->closer_date ? $editData->closer_date : ''}}</p>                                    
                                        <p>{{$editData->feedback ? $editData->feedback : ''}}</p>
                                        <div class="star-rating">
                                            <span class="fa fa-star-o" data-rating="1"></span>
                                            <span class="fa fa-star-o" data-rating="2"></span>
                                            <span class="fa fa-star-o" data-rating="3"></span>
                                            <span class="fa fa-star-o" data-rating="4"></span>
                                            <span class="fa fa-star-o" data-rating="5"></span>
                                            <input type="hidden" class="rating-value" value="{{$editData->rating ? $editData->rating : 0}}" disabled >
                                        </div>
                                    </div> 
                                @endif

                            @if($editData->status != 'Closed')
                                <h4>Share your feedback</h4>
                                <hr class="body-line">                            
                                <form method="POST" action="{{route('comment',Crypt::encrypt($editData->id))}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                    @csrf
                                    @if (session('userType') == 'resolver' || (session('userType') == 'requester' && $editData->status == 'Feedback Awaiting' ) )
                                    
                                        <div class="row">                                           
                                            <div class="col-md-2">  
                                                <label for="status" >Set Status<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <span>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="" selected disabled>Select Status</option>
                                                        @if (session('userType') == 'resolver' )
                                                            @if(session('userType') == 'resolver' && $editData->status == 'On Hold' || $editData->status == 'Open' || $editData->status == 'Information Awaiting' )
                                                                <option value="WIP">WIP</option>
                                                            @endif 
                                                            @if(session('userType') == 'resolver' && $editData->status != 'On Hold' || $editData->status == 'Open' )
                                                                <option value="On Hold">On Hold</option>
                                                            @endif 
                                                            @if(session('userType') == 'resolver' && $editData->status == 'WIP' || $editData->status == 'Open' )
                                                                <option value="Information Awaiting">Information Awaiting</option>
                                                            @endif 
                                                            @if(session('userType') == 'resolver' && $editData->status == 'WIP' )
                                                            <option value="Feedback Awaiting">Feedback Awaiting</option>     
                                                            @endif      
                                                        @elseif (session('userType') == 'requester')                                                     
                                                            <option value="Closed">Closed</option> 
                                                        @endif                                                
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(session('userType') == 'resolver' && ($editData->status == 'WIP' ||$editData->status == 'Information Awaiting' || $editData->status == 'On Hold' || $editData->status != 'Information Awaiting'))
                                        <div class="row" id="tdod">
                                            <div class="col-md-2">  
                                                <label for="tentative_date" >Tentative Target Date<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <span>
                                                    <input type="text" id="td_date" class="form-control @error('rating') is-invalid @enderror" name="tentative_date">
                                                    @if($errors->has('tentative_date'))
                                                       <div class="invalid-feedback error-msg">{{$errors->first('tentative_date')}}</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(session('userType') == 'resolver')
                                        <div class="row" id="handoverDt" style="display:none">
                                            <div class="col-md-2">  
                                                <label for="handover_date" >Handover Date<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <span>
                                                    <input type="text" id="handover_date" class="form-control @error('handover_date') is-invalid @enderror" name="handover_date">
                                                    @if($errors->has('handover_date'))
                                                       <div class="invalid-feedback error-msg">{{$errors->first('handover_date')}}</div>
                                                   @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row" id="rating-row" style="display:none">
                                        <div class="col-md-2">  
                                            <label for="rating" >Rating<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="star-rating">
                                                <span class="fa fa-star-o" data-rating="1"></span>
                                                <span class="fa fa-star-o" data-rating="2"></span>
                                                <span class="fa fa-star-o" data-rating="3"></span>
                                                <span class="fa fa-star-o" data-rating="4"></span>
                                                <span class="fa fa-star-o" data-rating="5"></span>
                                                <input type="hidden"  name="rating" class="rating-value" value="">
                                                
                                            </div>
                                        </div>
                                    </div>  


                                    @if( (session('userType') == 'requester' && ($editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status == 'Feedback Awaiting' || $editData->status == 'Open')) ||  (session('userType') == 'resolver' && ($editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status == 'Feedback Awaiting' || $editData->status == 'Open')) )
                                        <div class="row" id="comment-row">
                                            <div class="col-md-2">  
                                                <label for="comment_text" >Comment<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <span>
                                                    <textarea type="text" class="form-control @error('comment_text') is-invalid @enderror" row="10" col="80" id="editor" name="comment_text" placeholder ="Enter Message Here"></textarea>
                                                    @if($errors->has('comment_text'))
                                                       <div class="invalid-feedback error-msg">{{$errors->first('comment_text')}}</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row" id="feedback-row" style="display:none">
                                        <div class="col-md-2">  
                                            <label for="feedback_text" >Feedback<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <textarea type="text" cclass="form-control @error('feedback_text') is-invalid @enderror" row="10" col="50"  name="feedback_text" id="feedback_text" placeholder ="Enter Message Here"></textarea>
                                                @if($errors->has('feedback_text'))
                                                  <div class="invalid-feedback error-msg">{{$errors->first('feedback_text')}}</div>
                                               @endif
                                            </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-2">  
                                            <label for= "files" >Attachment<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                        <span>
                                            <input type="file" name ="files" class="form-control @error('files') is-invalid @enderror" />
                                            @if($errors->has('files'))
                                                <div class="invalid-feedback error-msg">{{$errors->first('files')}}</div>
                                            @endif
                                        </span></div>
                                    </div>    
                                    
                                    
                                    <div class="row" class="body-submit">
                                        <div class="col-md-2"> 
                                            <button type="submit" class="btn btn-primary btn-body">Submit </button>
                                        </div>
                                    </div> 
                                </form> 
                            @endif                           
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="request-body"><span>Request Information</span></div>
                                <h5><b>Request ID :</b> : #{{$editData->id ? $editData->id : ''}}</h5>
                                <h5><b>Name</b> : {{$editData->req_name ? $editData->req_name : ''}}</h5>
                                <h5><b>Phone</b> : {{$editData->req_phone ? $editData->req_phone : ''}}</h5>
                                <h5><b>Email ID</b> : {{$editData->req_email ? $editData->req_email : ''}}</h5>
                                <h5><b>Location</b> : {{$editData->req_region ? $editData->req_region : ''}}</h5>
                                <h5><b>Request Type</b> : {{$editData->requestType ? $editData->requestType : '' }}</h5>
                                <h5><b>Priority</b> : {{$editData->priority ? $editData->priority : ''}}</h5>
                                <h5><b>Request Date</b> :{{$editData->created_at ? date('d-m-Y', strtotime($editData->created_at)): ''}}</h5>
                                <h5><b>Tentative Date</b> : {{$editData->tentative_date ? date('d-m-Y', strtotime($editData->tentative_date)): ''}}</h5>
                                <h5><b>Status</b> : {{$editData->status ? $editData->status : ''}}</h5>
                                <h5><b>Handover Date</b> :{{$editData->handover_date ?  date('d-m-Y', strtotime($editData->handover_date)): ''}}</h5>
                                <hr class="body-line-content">
                                <h5><b>Assign To</b> 
                                    @if((session('userType') == 'resolver' ||  session('userType') == 'admin') && $editData->status != 'Closed')
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#changeresolver-model"><i class="fa fa-pencil"></i> Change</button>
                                    @endif
                                </h5>
                                <h5>{{$editData->resvname ? ucfirst($editData->resvname) : ''}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>    


    <!-- Model chenge resolver -->
    <div class="modal fade bd-example-modal-sm" id="changeresolver-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6"><h5 class="modal-title" id="exampleModalLabel">Change Assign</h5></div>
                        <div class="col-md-6 float-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times-circle"  style="color:red" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>                  
                </div>
                <div class="modal-body">
                    @foreach ($resolverDatas as $resolverData ) 
                        <div class="row">
                            <div class="col-sm-6"><label for="resolver-name">{{$resolverData->name}}</label></div>
                            <div class="col-sm-6"><input type="radio" name="resolver-name" id="resolver-name" value="{{$resolverData->id}}"  {{ $resolverData->id == $editData->resv_id ? 'checked' : '' }} ></div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" id="save" class="btn btn-primary" onclick="changeResolver({{$editData->id}})" >Save</button>
                </div>
            </div>
        </div>
    </div>     
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
   
@endsection