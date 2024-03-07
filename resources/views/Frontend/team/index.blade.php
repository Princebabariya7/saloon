@extends('Frontend.layout.master')
@section('title')
Stylist
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2> {{ Lang::get('saloon.barber') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="team">
        <div class="container">
            <div class="section-header text-center">
                <p>{{ Lang::get('saloon.our_barber_team_main') }}</p>
                <h2>{{ Lang::get('saloon.meet_our_expert_barber') }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-1.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.adam_phillips') }}</h2>
                            <p>{{ Lang::get('saloon.master_barber') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-2.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.dylan_adams') }}</h2>
                            <p>{{ Lang::get('saloon.hair_expert') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-3.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.gloria_edwards') }}</h2>
                            <p>{{ Lang::get('saloon.beard_expert') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-4.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.josh_dunn') }}</h2>
                            <p>{{ Lang::get('saloon.color_expert') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
