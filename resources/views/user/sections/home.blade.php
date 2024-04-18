@extends('user.layouts.main')
@section('content')
    @if($hostels->isNotEmpty())
        <div class="container">
            <ul class="no-bullets pt-3">
                @foreach($hostels as $hostel)
                    <li class="mb-3">
                        <a>
                            <div class="d-flex gap-3">
                               <div>
                                   <img class="img-20vh" src="{{ asset('assets/img/hostel.jpg') }}" alt="hostel-demo">
                               </div>
                                <div class="align-content-center">
                                   <div class="row mb-3">
                                      <div class="col-6">
                                          <h3>{{ $hostel->name }}</h3>
                                          <h5>{{ $hostel->location }}</h5>
                                      </div>
                                       <div class="col-6">
                                           <h5>Room Count: {{ $hostel->rooms->count() }}</h5>
                                       </div>
                                   </div>
                                    <a class="btn btn-info" href="{{ route('user.hostel.show', [$hostel]) }}">More Info</a>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
