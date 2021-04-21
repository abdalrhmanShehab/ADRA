@extends('layouts.front_layout.master')
@section('title')
    ADRA SYRIA - Contact Us
@endsection
@section('content')
    <div class="container contact-form">
        <div class="contact-image">
            <img src="{{asset('images/adra-vertical-logo.png')}}" alt="adra_logo"/>
        </div>
        <form method="post" action="{{route("receive.email")}}">
            @csrf
                <h3>Drop Us a Message</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone_number" class="form-control" placeholder="Your Phone Number *" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject *" value="" />
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
