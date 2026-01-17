@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">{{ (Request::segment(3) == 'close') ? 'Closed' : ucfirst(Request::segment(3))   }} Requests</h1></div>
            @if (session('userType') == 'requester' && (Request::segment(3) == 'all') )
                <div class="col-md-6 text-right"><a href="{{route('req.create')}}"><button class="btn btn-danger">Create Request</button></a></div>
            @endif
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1"  class="table table-striped table-bordered display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none">sl No.</th> 
                                    <th>Title</th> 
                                    <th>Status</th>
                                    <th>Request Date</th>
                                    <th>Request Type</th>
                                    <th>Requester</th>
                                    <th>Assign To</th>
                                    <th>Tentative Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data )                                                   
                                    <tr>
                                        <td style="display:none">{{ $loop->iteration }}</td>
                                        <td>
                                        <span>
                                            @if ($data->priority === 'Low')
                                             <small class="badge badge-warning low">{{$data->priority ? $data->priority : ''}}</small>
                                            @elseif ($data->priority === 'Medium')
                                             <small class="badge badge-warning medium">{{$data->priority ? $data->priority : ''}}</small>
                                            @else
                                             <small class="badge badge-warning high">{{$data->priority ? $data->priority : ''}}</small>
                                            @endif
                                            <span>#{{$data->id ? $data->id : ''}}</span> 
                                            <span> <small>{{ session('region') ? session('region') : ''}}</small></span>
                                        </span><br>
                                            <span>{{$data->subject ? $data->subject : ''}}</span> <br>
                                        </td>
                                        <td>{{$data->status ? $data->status : ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>  	 
                                        <td>{{$data->name ? $data->name : ''}}</td>
                                        <td>{{ $data->req_name ?  $data->req_name : ''}}</td>
                                        <td>{{$data->resName ? ucfirst($data->resName) : ''}}</td>
                                        <td>{{$data->tentative_date ? date('d-m-Y', strtotime($data->tentative_date)) :'-'}}</td>
                                        <td><a href="{{route('req.edit', Crypt::encrypt($data->id) )}}" title="Edit" class="x1"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   </section>    
   @endsection
            