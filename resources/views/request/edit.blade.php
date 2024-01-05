@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h3 class="dashboard-heading">Request Details</h3></div>
            <div class="col-md-6 text-right"><a href="{{URL::previous() }}"><button class="btn btn-danger ">Back</button></a></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <div class="Description">
                                <h4>{{isset($editData->subject) ? $editData->subject : '' }}</h4>
                            <hr class="body-line">
                            <h4>Description</h4>
                            <p>{{isset($editData->description) ? $editData->description : '' }}</p>
                            @if ($editData->attachment != null || $editData->attachment != "")                                
                                <h5><i class="fa fa-paperclip" aria-hidden="true"></i> Attachment: <a href="{{ url('file-data/'.$editData->attachment) }}" target="_blank" class="body-attach">{{$editData->attachment ? $editData->attachment : ''  }}</a></h5> 
                            @endif
                         </div>
                            <hr class="body-line"> 
                                <div class="ScrollStyle" >  
                                @foreach ($comments as  $comment)
                                    
                                    <div class="box-body-content">                              
                                        <h4>{{isset($comment->user_name) ? $comment->user_name : '' }}</h4>
                                        <p class="date-format">{{isset($comment->created_at) ? $comment->created_at->format('d-m-Y H:i:s') : '' }}</p>
                                        <p>{!! isset($comment->comment) ? $comment->comment : '' !!}</p>
                                        @if ($comment->attachment  != null || $comment->attachment  != "")                                            
                                            <h5><i class="fa fa-paperclip" aria-hidden="true"></i> Attachment: <a href="{{ url('file-data/comments/'.$comment->attachment) }}" target="_blank" class="body-attach">{{$comment->attachment ? $comment->attachment : '' }}</a></h5>
                                        @endif
                                    </div> 
                                @endforeach
                                </div>
                                @if ($editData->status == "Closed")                                    
                                    <div class="box-body-content">
                                        <h4>Feedback by: <span>{{isset($editData->req_name) ? $editData->req_name : ''}}</span></h4>
                                        <div class="star-rating">
                                            <span class="fa fa-star-o" data-rating="1"></span>
                                            <span class="fa fa-star-o" data-rating="2"></span>
                                            <span class="fa fa-star-o" data-rating="3"></span>
                                            <span class="fa fa-star-o" data-rating="4"></span>
                                            <span class="fa fa-star-o" data-rating="5"></span>
                                            <input type="hidden" class="rating-value" value="{{$editData->rating ? $editData->rating : 0}}" readonly = "readonly" >
                                        </div>                                        
                                        <p>{!! isset($editData->feedback) ? $editData->feedback : '' !!}</p>
                                    </div> 
                                @endif
                            @if($editData->status != 'Closed')
                            <div class="share-feedback">
                                @if( (session('userType') == 'resolver' && ($editData->status == 'Open' || $editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status == 'Feedback Awaiting')) ||  
                                (session('userType') == 'requester' && ($editData->status == 'Open' || $editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status != 'Feedback Awaiting'))    )
                                <h4>Share your Comment</h4>
                                @elseif(session('userType') == 'admin' )
                                <h4>Share your Comment</h4>
                                @elseif(session('userType') == 'requester' && $editData->status == 'Feedback Awaiting' )
                                <h4>Share your Feedback</h4>
                                @endif
                                <hr class="body-line">                            
                                    <form method="POST" id="ckeditorForm" action="{{route('comment',Crypt::encrypt($editData->id))}}" class="form-submission watermark min-height form-sbmt" enctype="multipart/form-data">
                                        @csrf
                                        @if (session('userType') == 'resolver' || (session('userType') == 'requester' && $editData->status == 'Feedback Awaiting' ) )                                    
                                            <div class="row">                                           
                                                <div class="col-md-2">  
                                                    <label for="status" >Set Status<span class="required_min">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <span>
                                                        <select class="form-control" name="status" id="status" required>
                                                            <option value="" selected disabled>Select Status</option>
                                                            @if (session('userType') == 'resolver' )
                                                                <option value="Comment">Comment</option>
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
                                                            <option value="Comment">Comment</option>                                                   
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
                                                <div class="col-md-5">
                                                    <span>
                                                    
                                                    <input id="td_date" type="text"  class="form-control @error('tentative_date') is-invalid @enderror" name="tentative_date" autocomplete="off" />
                                                
                                                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                            
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
                                                <div class="col-md-5">
                                                <span>
                                                    <input id="handover_date" type="text"  class="form-control @error('handover_date') is-invalid @enderror" name="handover_date" autocomplete="off"/>
                                                   
                                                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                                   
                                                        @if($errors->has('handover_date'))
                                                        <div class="invalid-feedback error-msg">{{$errors->first('handover_date')}}</div>
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row" id="rating-row" style="display:none">
                                            <div class="col-md-2">  
                                                <label>Rating<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="star-rating">
                                                    <span class="fa fa-star-o" data-rating="1"></span>
                                                    <span class="fa fa-star-o" data-rating="2"></span>
                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                    <input type="hidden"  name="rating" class="rating-value" value="" required>
                                                    
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row" id="closerDt" style="display:none">
                                            <div class="col-md-2">  
                                                <label for="closer_date" >Closer Date<span class="required_min">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                 <span>
                                                    <input id="closer_date" type="text"  class="form-control @error('closer_date') is-invalid @enderror" name="closer_date" autocomplete="off"/>
                                                   
                                                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                               
                                                    @if($errors->has('closer_date'))
                                                        <div class="invalid-feedback error-msg">{{$errors->first('closer_date')}}</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @if( (session('userType') == 'requester' || (session('userType') == 'admin' && ($editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status == 'Feedback Awaiting' || $editData->status == 'Open')) ||  (session('userType') == 'resolver' && ($editData->status == 'WIP' || $editData->status == 'On Hold' || $editData->status == 'Information Awaiting' || $editData->status == 'Feedback Awaiting' || $editData->status == 'Open'))) )
                                            <div class="row" id="comment-row">
                                                <div class="col-md-2">  
                                                    <label>Comment<span class="required_min">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        <textarea rows="10" col="10" class="ck_editor_txt form-control @error('comment_text') is-invalid @enderror" name="comment_text" id="editor" Placeholder="Enter Message Here"></textarea>
                                                        <!-- <textarea type="text" class="form-control @error('comment_text') is-invalid @enderror" row="10" col="10" id="editor" name="comment_text" placeholder ="Enter Message Here" required></textarea> -->
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
                                            <div class="col-md-8">
                                                <span>
                                                    <textarea type="text" class=" ck_editor_txt1 form-control @error('feedback_text') is-invalid @enderror" row="10"  name="feedback_text" id="feedback_text" placeholder ="Enter Message Here" ></textarea>
                                                    @if($errors->has('feedback_text'))
                                                    <div class="invalid-feedback error-msg">{{$errors->first('feedback_text')}}</div>
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">  
                                                <label>Attachment</label>
                                            </div>
                                            <div class="col-md-5">
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
                                </div>
                            @endif                           
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-body-right">
                            <div class="request-body">Request Information</div>
                            <div class="body-right-content">
                                <h5><span class="right-label">Request ID:</span><span> #{{isset($editData->id) ? $editData->id : ''}}</span></h5>
                                <h5><span class="right-label">Name:</span><span> {{isset($editData->req_name) ? $editData->req_name : ''}}</span></h5>
                                <h5><span class="right-label">Phone:</span><span> {{isset($editData->req_phone) ? $editData->req_phone : ''}}</span></h5>
                                <h5><span class="right-label">Email ID:</span><span>{{isset($editData->req_email) ? $editData->req_email : ''}}</span></h5>
                                <h5><span class="right-label">Location: </span><span>{{isset($editData->req_region) ? $editData->req_region : ''}}</span></h5>
                                <h5><span class="right-label">Request Type:</span><span> {{isset($editData->requestType) ? $editData->requestType : '' }}</span></h5>
                                <h5><span class="right-label">Priority:</span>
                                    @if($editData->priority == 'Low')
                                     <span class="Priority low"> {{isset($editData->priority) ? $editData->priority : ''}}</span>
                                    @elseif ($editData->priority == 'Medium')
                                     <span class="Priority medium"> {{isset($editData->priority) ? $editData->priority : ''}}</span>
                                    @else
                                     <span class="Priority"> {{isset($editData->priority) ? $editData->priority : ''}}</span>
                                    @endif
                                </h5>
                                <h5><span class="right-label">Request Date:</span> <span>{{isset($editData->created_at) ? date('d-m-Y', strtotime($editData->created_at)): ''}}</span></h5>
                                @if ($editData->tentative_date  != null || $editData->tentative_date  != "")
                                <h5><span class="right-label">Tentative Date:</span> <span>{{isset($editData->tentative_date) ?  date('d-m-Y', strtotime($editData->tentative_date)): ''}}</span></h5>
                                @endif
                                <h5><span class="right-label">Status :</span>
                                    @if($editData->status == 'Open')
                                     <span class="Status open"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @elseif($editData->status == 'WIP')
                                    <span class="Status wip"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @elseif($editData->status == 'On Hold')
                                    <span class="Status onhold"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @elseif($editData->status == 'Information Awaiting')
                                    <span class="Status information"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @elseif($editData->status == 'Feedback Awaiting')
                                    <span class="Status feedback"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @else
                                    <span class="Status close1"> {{isset($editData->status) ? $editData->status : ''}}</span>
                                    @endif
                                </h5>
                                @if ($editData->handover_date  != null || $editData->handover_date  != "")
                                <h5><span class="right-label">Handover Date:</span> <span>{{isset($editData->handover_date) ?  date('d-m-Y', strtotime($editData->handover_date)): ''}}</span></h5>
                                @endif
                                @if ($editData->closer_date  != null || $editData->closer_date  != "")                                            
                                   <h5><span class="right-label">Closer Date:</span> <span>{{isset($editData->closer_date) ?  date('d-m-Y', strtotime($editData->closer_date)): ''}}</span></h5>
                                @endif
                                <hr class="body-line-content">
                                <h5>Assign To
                                    @if((session('userType') == 'resolver' ||  session('userType') == 'admin') && $editData->status != 'Closed')
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#changeresolver-model"><i class="fa fa-pencil"></i> Change</button>
                                    @endif
                                </h5>
                                <h5><span>{{isset($editData->resvname) ? ucfirst($editData->resvname) : ''}}</span></h5>
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
                        <div class="col-md-10"><h5 class="modal-title" id="exampleModalLabel">Change Assign</h5></div>
                        <div class="col-md-2 float-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>                  
                </div>
                <div class="modal-body">
                    @foreach ($resolverDatas as $resolverData ) 
                        <div class="row">
                            <div class="col-sm-8 float-mobile-left"><label for="resolver-name">{{$resolverData->name}}</label></div>
                            <div class="col-sm-4 radio-btn"><input type="radio" name="resolver-name" id="resolver-name" value="{{$resolverData->id}}"  {{ $resolverData->id == $editData->resv_id ? 'checked' : '' }} ></div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" id="save" class="btn btn-primary" onclick="changeResolver({{$editData->id}})" >Save</button>
                </div>
            </div>
        </div>
    </div>   
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>  -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.0/classic/ckeditor.js"></script> 
   <script>ClassicEditor.create( document.querySelector( '#editor' ) )</script>
    <!--  <script>ClassicEditor.create( document.querySelector( '#feedback_text' ) )</script> --> 
   @endsection