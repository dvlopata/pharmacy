@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.main')

@section('content')
    <section class="oleez-what-we-do ml-5">
        <div class="row no-gutters"> <!-- Added no-gutters to remove extra margin between columns -->
            <div class="col-lg-10 offset-lg-1">
                <h2 class="section-title wow fadeInUp mb-5" style="visibility: visible; animation-name: fadeInUp;">Адреси аптек</h2>
                <div class="row">
                    @foreach($pharmacies as $pharmacy)
                        <div class="col-md-4 mb-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <h5 class="what-we-do-list-title"><b>{{$pharmacy->city}}</b></h5>
                            <ul class="what-we-do-list">
                                <li>{{$pharmacy->region}}</li>
                                <li>{{$pharmacy->address}}</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection


