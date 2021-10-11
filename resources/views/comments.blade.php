@extends('home')
@section('comments')
<div class="row d-flex justify-content-center">
            <div class="card mb-3 w-75">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
                <!-- <img src="http://lorempixel.com/400/200/sports/" class="card-img-bottom m-2" alt="..."> -->
                <div class="card-body border-top">
                    <div class="d-flex justify-content-between bd-highlight">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaletoiles"  data-role="star" data-id="2">
                            <span class="badge bg-secondary">3.5</span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span> 
                            {{ __('Votes') }} 
                            <span class="badge bg-secondary">35</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card mb-3 w-75">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
                <!-- <img src="http://lorempixel.com/400/200/sports/" class="card-img-bottom m-2" alt="..."> -->
                <div class="card-body border-top">
                    <div class="d-flex justify-content-between bd-highlight">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaletoiles" data-role="star" data-id="1">
                        <span class="badge bg-secondary">4.5</span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star" style="color:orange"></span>
                            <span class="fa fa-star"></span> {{ __('Votes') }} <span class="badge bg-secondary">56</span> </button>
                    </div>
                </div>
            </div>
        </div>
@endsection