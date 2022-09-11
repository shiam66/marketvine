@extends('frontEnd.master')

@section('title') About Us @endsection

@section('mainContent')

    <section class="page-header" data-stellar-background-ratio="1.2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3>About Us</h3>

                    <p class="page-breadcrumb">
                        <a href="{{ url('/') }}">Home</a> / About Us
                    </p>
                </div>
            </div> <!-- end .row  -->
        </div> <!-- end .container  -->
    </section>

    <section id="donor_by_district">
        <div class="container">
            <div class="row">
                <h2 style="text-align: center">About Us</h2>
            </div>
        </div>
    </section>

@endsection
