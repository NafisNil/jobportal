{{--@extends('layouts.admin.main')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        @foreach ($listings as $listing)
         {{$listing->title}} . {{$listing->users_count}} <br><br>
            @foreach ($listing->users()->get( ) as $applicant)
            echo "Applicant  Name : $applicant->name <br>
            echo "Applicant  Email : $applicant->email <br>
            @endforeach
        @endforeach
    </div>
</div>
@endsection--}}


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
                            <th>Total Applicants</th>
                            <th>View Job</th>
                            <th>View Applicants</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Create On</th>
                            <th>Total Applicants</th>
                            <th>View Job</th>
                            <th>View Applicants</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($listings as $listing)
                        <tr>
                            
                                <td>{{$listing->title}}</td>
                                <td>{{$listing->created_at->format('Y-m-d')}}</td>
                                <td>{{$listing->users_count}}  </td>
                                <td></td>
                                <td><a href="{{route('applicants.show', $listing->slug)}}">View</a></td>
                        </tr>


                        <!-- Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection