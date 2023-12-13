@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Dashboard</h1></div>
            <div class="col-md-6 text-right"></div>
        </div>   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner"><h3>{{isset($total) ? $total : 0}}</h3><p>Total Tickets</p></div>
                    <div class="icon"><i class="ion ion-bag"></i></div>
                    <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner"><h3>{{isset($totalactive) ? $totalactive : 0}}</h3><p>My Active Tickets </p></div>
                    <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow"> 
                    <div class="inner"><h3>{{isset($totalclose) ? $totalclose : 0}} </h3><p>My Closed Tickets</p></div>
                    <div class="icon"><i class="ion ion-person-add"></i></div>
                    <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
        </div>
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
                                    <th>Tentative Target Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data )                                                   
                                    <tr> 
                                        <td style="display:none">{{ $loop->iteration }}</td>
                                        <th scope="row">
                                        <span class="tbl-content">{{$data->priority ? $data->priority : ''}}</span>
                                        {{$data->subject ? $data->subject : ''}}<br>
                                        <a href="#"><b>#</b> {{$data->id ? $data->id : ''}} </a>
                                        <small>{{ session('region') ? session('region') : '' }}</small></th>
                                        <td>{{$data->status ? $data->status : ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>  	 
                                        <td>{{$data->name ? $data->name : ''}}</td>
                                        <td>{{ $data->req_name ?  $data->req_name : ''}}</td>
                                        <td>{{$data->resName ? ucfirst($data->resName) : ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->tentative_date))}}</td>
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
       
