@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Report</h1></div>
            <div class="col-md-6 text-right"><a href="{{route('req.allrequest','all')}}"><button class="btn btn-danger ">Back</button></a></div>
        </div>   
    </section>
    <section class="content">
       <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form action="{{ route('reports.store')}}" method='POST'>
                            @csrf
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label for="daterange" class="form-label">Daterange</label>                                        
                                        <input type="text" name="daterange" id="daterange" class="form-control">                        
                                        @error('daterange')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                    <label for="Status" class="form-label">Status</label>
                                    <select  name="status[]" class="form-control @error('Status') is-invalid @enderror chosen-select" multiple>
                                        <option value="all" selected>All</option>
                                        <option value="Open">Open</option>
                                        <option value="WIP">WIP</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="Information Awaiting">Information Awaiting</option>
                                        <option value="Feedback Awaiting">Feedback Awaiting</option>
                                        <option value="Closed">Closed</option>
                                      </select>
                                        
                                        @error('Status')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>                                       
                                <div class="col-md-4" {{ (session('userType') != 'admin') ? 'style=display:none' : '' }}>  
                                    <div class="form-group">
                                        <label for="location" class="form-label">Location</label>
                                        <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">   
                                            @if((session('region') == "All"))
                                                <option value="0"  {{ (session('userType') == 'admin') ? 'selected' : '' }} >All</option>
                                            @endif                                              
                                            @if(isset($locations))
                                                @foreach($locations as $user)
                                                    <option value="{{$user->location}}" {{ (session('region') == $user->location) ? 'selected' : '' }} {{ old('location') == $user->location ? 'selected' : '' }}>{{$user->location}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('location')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>     
                                
                            </div> 
                            <div class="row">                                                     
                             
                                <div class="col-md-4" {{ (session('userType') != 'admin') ? 'style=display:none' : '' }}> 
                                    <div class="form-group">
                                        <label for="resolver" class="form-label">Resolver Name</label>
                                        <select name="resolver" id="resolver" class="form-control @error('resolver') is-invalid @enderror">
                                            @if((session('region') == "All") || (session('userType') == "admin"))
                                                <option value="0"  {{ (session('userType') == 'admin') ? 'selected' : '' }} >All</option>
                                            @endif                         
                                            @if(isset($users))
                                                @foreach($users as $res)
                                                    <option value="{{$res->id}}"  {{ (session('region') == $res->id) ? 'selected' : '' }} {{ old('resolver') == $res->id ? 'selected' : '' }}>{{$res->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('resolver')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="row" class="body-submit">
                                <div class="col-md-2"> 
                                    <button type="submit"  class="btn btn-primary btn-body">Download</button>
                                </div>
                            </div> 
                        </form>                
                   </div>
               </div>
            </div>
       </div>
    </section>
@endsection