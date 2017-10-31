@extends('layouts.front')

@section('content')

<div class="banner-sec">
    <div class="about-banner">
        <h1>Contact US</h1>
    </div>
</div>
<div class="contact-sec">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 ">
            <h2>Contact Info</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <div class="addr">
                <div class="phn-icon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <div class="phn-name">Phone</div>
                    <div class="phn-text">(310)873 8874</div>
                </div>
                <div class="phn-icon">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <div class="phn-name">Email</div>
                    <div class="phn-text">info@organic.com</div>
                </div>
            </div>
            <div class="location">
                <div class="addr-icon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <div class="phn-name">address</div>
                    <div class="phn-text">Globaltech Corporation, 28441 Highridge Road, Unit 420 Rolling Hills Business Park,</div>
                </div>
            </div>
          <div class="social">
                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
         </div>    
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h2>Send A Message</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
             <form>
               <div class="form-group">
                 <input class="form-control" id="fname" placeholder="*First Name" type="text">
               </div>
               <div class="form-group">
                  <input class="form-control" id="lname" placeholder="*Last Name" type="text">
               </div>
                 
               <div class="form-group">
                  <input class="form-control" id="phn-num" placeholder="*Phone Number" type="text">
               </div>

               <div class="form-group">
                  <input class="form-control" id="email-addr" placeholder="*Email Address" type="email">
               </div>
                 <div class="form-group">
                    <textarea class="form-control" rows="5" id="comment" placeholder="*Comment"></textarea>
                 </div>
               <button type="submit" class="btn red-btn">Send Message</button>
             </form>
        </div>
     </div>
</div>

@endsection