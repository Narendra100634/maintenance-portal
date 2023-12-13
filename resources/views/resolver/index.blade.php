@extends('layouts.app')
@section('content')
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Manange Resolver</h1></div>
            <div class="col-md-6 text-right"><a href="{{route('res.create')}}"><button class="btn btn-danger">Create New</button></a></div>
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
                                    <th>Name</th> 
                                    <th>Location</strong></th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data )                                                   
                                    <tr>
                                        <td style="display:none">{{ $loop->iteration }}</td>
                                        <th scope="row">{{$data->name ? $data->name : ''}}</th>
                                        <td>{{$data->location ? $data->location : ''}}</td>
                                        <td>{{$data->mobile ? $data->mobile : ''}}</td>  	 
                                        <td>{{$data->email ? $data->email : ''}}</td>
                                        <td><input data-id="{{$data->id}}"  id="toggle_class" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"  data-off="InActive" {{ $data->status ? 'checked' : '' }}></td>
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
            