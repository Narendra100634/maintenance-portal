@include('layouts.header')
@include('layouts.sidebar')          
<div class="content-wrapper">
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h3 class="dashboard-heading">Request Details</h3></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
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
                                        <p>{{isset($comment->created_at) ? $comment->created_at : '' }}</p>
                                        <p>{{isset($comment->comment) ? $comment->comment : '' }}</p>
                                        @if ($comment->attachment  != null || $comment->attachment  != "")                                            
                                            <h4>Attachment: <a href="{{ url('file-data/comments/'.$comment->attachment) }}" target="_blank" class="body-attach">{{$comment->attachment ? $comment->attachment : '' }}</a></h4>
                                        @endif
                                    </div> 
                                @endforeach
                            
                            <h4>Share your feedback</h4>
                            <hr class="body-line">
                            
                            <form method="POST" action="{{route('comment',Crypt::encrypt($editData->id))}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                @csrf
                                @if (session('userType') == 'resolver' || (session('userType') == 'requester' && $editData->status == 'Feedback Awaiting' ) )
                                   
                                    <div class="row">                                           
                                        <div class="col-md-2">  
                                            <label>Set Status<span class="required_min">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span>
                                                <select class="form-control" name="status" id="status" required>
                                                    @if (session('userType') == 'resolver' )
                                                        <option value="" selected disabled>Select Status</option>
                                                        <option value="WIP">WIP</option>
                                                        <option value="On Hold">On Hold</option>
                                                        <option value="Information Awaiting">Information Awaiting</option>
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
                                @if(session('userType') == 'resolver' && $editData->status == 'WIP' || $editData->status == 'On Hold')
                                
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Tentative Target Date<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-6"><span><input type="date" id="shootdate" class="form-control" name="tentative_date"></span></div>
                                </div>
                                @elseif(session('userType') == 'resolver' && $editData->status == 'Information Awaiting')
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Comment<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-6"><span><textarea type="text" class="form-control" row="5" col="10" name="comment_text" placeholder ="Enter Message Here"></textarea></span></div>
                                </div>
                                @elseif(session('userType') == 'requester' && $editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting')
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Comment<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-6"><span><textarea type="text" class="form-control" row="5" col="10" name="comment_text" placeholder ="Enter Message Here"></textarea></span></div>
                                </div>
                                @endif
                                <!-- @if(session('userType') == 'requester' && $editData->status == 'Information Awaiting' || $editData->status == 'On Hold')
                                <div class="row">
                                    <div class="col-md-2">  
                                        <label>Comment<span class="required_min">*</span></label>
                                    </div>
                                    <div class="col-md-6"><span><textarea type="text" class="form-control" row="5" col="10" name="comment_text" placeholder ="Enter Message Here"></textarea></span></div>
                                </div>
                                @endif -->
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
                                <h5><b>Request Date</b> :{{date('d-m-Y', strtotime($editData->created_at));}}</h5>
                                <h5><b>Tentative Date</b> : {{date('d-m-Y', strtotime($editData->tentative_date));}}</h5>
                                <h5><b>Status</b> : {{$editData->status ? $editData->status : ''}}</h5>
                                <h5><b>Handover Date</b> :</h5>
                                <hr class="body-line-content">
                                <h5><b>Assign To</b></h5>
                                <h5>{{$editData->resvname ? ucfirst($editData->resvname) : ''}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>    
</div>
@include('layouts.footer')
   