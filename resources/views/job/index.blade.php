@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <h1>All Jobs</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
               Your Jobs
               @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
           @endif
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Create On</th>
                            <th>Edit</th>
                            <th>Delete</th>
                     
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Create On</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($jobs as $item)
                        <tr>
                            
                                <td>{{$item->title}}</td>
                                <td>{{$item->created_at->format('d M, Y')}}</td>
                                <td><a href="{{route('job.edit',[$item->id])}}">Edit</a> </td>
                                <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">Delete</a></td>
                           
                        </tr>


                        <!-- Modal -->
                       
                        <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{route('job.delete', [$item->id])}}" method="POST" >
                                @csrf
                           @method('DELETE')
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to Delete it?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                ...
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete ?</button>
                                </div>
                            </div>
                            </div>
                        </form>
                        </div>

                 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection