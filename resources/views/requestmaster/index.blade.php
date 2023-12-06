@include('layouts.header')
@include('layouts.sidebar')
<div class="content-wrapper">
    <section class="content-header">                   
        <div class="row">
            <div class="col-md-6"><h1 class="dashboard-heading">Manage Request Type</h1></div>
            <div class="col-md-6 text-right"><a href="{{route('reqtype.create')}}"><button class="btn btn-danger ">Create New</button></a></div>
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
                                    <th>SN.</th> 
                                    <th>Request Name</strong></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data )                                               
                                <tr>
                                    <th scope="row"> {{$loop->iteration}}</th>
                                    <td>{{ $data->name ? $data->name : '' }}</td>  	 
                                    <td>{{ ($data->status == 1) ? 'Active' : 'Inactive'}}</td>
                                    <td><a href="{{route('reqtype.edit', Crypt::encrypt($data->id) )}}" title="Edit" class="x1"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</div>
@include('layouts.footer')
            
