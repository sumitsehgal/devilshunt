@extends('layouts.front')

@section('content')

<div class="banner-sec">
    <div class="about-banner">
        <h1>Apply US</h1>
    </div>
</div>
<div class="contact-sec apply-sec">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Audition Form</a></li>
      <li><a data-toggle="tab" href="#menu1">Job Form</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <div class="col-md-12"><h3>Introduction</h3></div> 
         {!! Form::open(['url' => 'categories','files'=>true]) !!}
         {{ Form::token() }}
          <div class="form-group col-md-6">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Your Name.']) }}
          </div>
          <div class="form-group col-md-6">
            {{ Form::label('dob', 'Date of Birth:') }}
            {{ Form::date('dob',old('dob'),['class'=>'form-control']) }}
          </div>
          <div class="form-group col-md-6">
            <label for="">Sex</label>
            <input type="" class="form-control" id="" placeholder="Sex">
          </div>
          <div class="form-group col-md-6">
            <label for="">Marital Status</label>
            <input type="" class="form-control" id="" placeholder="Marital Status">
          </div>
          <div class="form-group col-md-6">
            {{ Form::label('language', 'Languages:') }}
            {{Form::text('language',old('language'),['class'=>'form-control','placeholder'=>'Language.']) }}
            <label for=""></label>
            <input type="" class="form-control" id="" placeholder="Languages">
          </div>
          <div class="form-group col-md-6">
            <label for="">Hair</label>
            <input type="" class="form-control" id="" placeholder="Hair:(Long/Short)">
          </div>
          <div class="form-group col-md-6">
            {{ Form::label('height', 'Height:') }}
            {{Form::text('height',old('height'),['class'=>'form-control','placeholder'=>'Height.']) }}
          </div>   
          <div class="form-group col-md-6">
            {{ Form::label('weight', 'Weight:') }}
            {{Form::text('weight',old('weight'),['class'=>'form-control','placeholder'=>'Weight.']) }}
          </div>   
          <div class="form-group col-md-6">
            {{ Form::label('hair_color', 'Hair Color:') }}
            {{Form::text('hair_color',old('hair_color'),['class'=>'form-control','placeholder'=>'Hair Color.']) }}
          </div>
          <div class="form-group col-md-6">
            {{ Form::label('eye_color', 'Eye Color:') }}
            {{Form::text('eye_color',old('eye_color'),['class'=>'form-control','placeholder'=>'Eye Color.']) }}
          </div>   
          <div class="form-group col-md-6">
            {{ Form::label('professional_experience', 'Professional:') }}
            {{Form::text('professional_experience',old('professional_experience'),['class'=>'form-control','placeholder'=>'Professional Experience.']) }}
          </div>   
          <div class="form-group col-md-6">
            {{ Form::label('qualification', 'Qualification:') }}
            {{Form::text('qualification',old('qualification'),['class'=>'form-control','placeholder'=>'Qualification.']) }}
          </div>   
          <div class="form-group col-md-6">
            {{ Form::label('hobbies', 'Hobbies:') }}
            {{Form::text('hobbies',old('hobbies'),['class'=>'form-control','placeholder'=>'Hobbies.']) }}
          </div> 
          <div class="col-md-12"><h3>{{ Form::label('photo_upload', 'Photo Upload:') }}</h3></div> 
          <div class="col-md-12">
             <div class="browse-label">
                <label class="btn browse-btn">
                  Browse {{ Form::file('image',  ['class'=>'form-control']) }}
                </label> No File Selected
            </div>
          </div>
          <div class="col-md-12"><h3>Passport Info</h3></div> 
          <div class="form-group col-md-6">
            {{ Form::label('passport', 'Passport:') }}
            {{Form::text('passport',old('passport'),['class'=>'form-control','placeholder'=>'Passport.']) }}
          </div>   
          <div class="form-group col-md-6">
            
            
            <label for="">Visa</label>
            <input type="" class="form-control" id="" placeholder="Any Visa Rejected(Yes/No)">
          </div>   
          <div class="form-group col-md-6">
            <label for="">Date of Expiry</label>
            <input type="" class="form-control" id="" placeholder="Date of Expiry">
          </div>
          <div class="form-group col-md-6">
            <label for="">Issue</label>
            <input type="" class="form-control" id="" placeholder="Date and Place of Issue">
          </div>  
             
          <div class="col-md-12"><h3>Shoot</h3></div> 
          <div class="form-group col-md-6">
            <label for="">Outdoor Shoot</label>
            <input type="" class="form-control" id="" placeholder="Outdoor Shoot(Yes/No)">
          </div>
          <div class="form-group col-md-6">
            <label for="">Night Shoot</label>
            <input type="" class="form-control" id="" placeholder="Night Shoot(Yes/No)">
          </div>   
            
          <div class="col-md-12"><h3>Family Info</h3></div> 
          <div class="form-group col-md-6">
            <label for="">Family</label>
            <input type="" class="form-control" id="" placeholder="Family Info">
          </div>
          <div class="form-group col-md-6">
            <label for="">Category</label>
            <select class="form-control" id="">
                <option selected>Select</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
          </div>   
          
          <div class="col-md-12"><h3>Contact Info</h3></div> 
          <div class="form-group col-md-12">
            <label for="">Parmanent Address</label>
            <input type="" class="form-control" id="" placeholder="Parmanent Address">
          </div>   
          <div class="form-group col-md-12">
            <label for="">Correspondence Address</label>
            <input type="" class="form-control" id="" placeholder="Correspondence Address">
          </div>   
          <div class="form-group col-md-6">
            <label for="">Email</label>
            <input type="" class="form-control" id="" placeholder="Email">
          </div>   
          <div class="form-group col-md-6">
            <label for="">Mobile</label>
            <input type="" class="form-control" id="" placeholder="Mobile">
          </div>   
          <div class="form-group col-md-6">
            <label for="">Aadhaarcard No</label>
            <input type="" class="form-control" id="" placeholder="Aadhaarcard No">
          </div>   
          <div class="form-group col-md-6">
            <label for="">Driving Licence</label>
            <input type="" class="form-control" id="" placeholder="Driving Licence">
          </div>    
             
          <div class="col-md-12"><h3>Portfolio Info</h3></div> 
          <div class="form-group col-md-12">
            <label for="">Portfolio Address</label>
            <input type="" class="form-control" id="" placeholder="Portfolio Address">
          </div>   
          <div class="form-group col-md-12">
            <label for="">Project Done</label>
            <input type="" class="form-control" id="" placeholder="Project Done">
          </div>   
             
          <div class="col-md-12"><h3>Special Recommendation</h3></div> 
          <div class="form-group col-md-12">
            <label for="">Portfolio Address</label>
            <input type="" class="form-control" id="" placeholder="Portfolio Address">
          </div>   
          <div class="form-group col-md-12">
            <label for="">Project Done</label>
            <input type="" class="form-control" id="" placeholder="Project Done">
          </div>
             
          <div class="col-md-12"><h3>About You</h3></div> 
          <div class="form-group col-md-12">
            <label for="">About Address</label>
            <textarea rows="5" class="form-control" placeholder="Write some words about you..."></textarea>
          </div>
          
          <div class="col-md-12">   
             <button type="submit" class="btn red-btn">Submit</button>
          </div>
        </form> 
      </div>
      <div id="menu1" class="tab-pane fade">
        <form>
          <div class="col-md-12"><h3>Personal Details</h3></div>
          <div class="form-group col-md-6">
            <label for="">Name</label>
            <input type="" class="form-control" id="" placeholder="Your Name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Current Location</label>
            <input type="" class="form-control" id="" placeholder="City/State">
          </div>
          <div class="form-group col-md-6">
            <label for="">Sex</label>
            <input type="" class="form-control" id="" placeholder="Male/Female">
          </div>
            
          <div class="col-md-12"><h3>Work Experience</h3></div>  
          <div class="form-group col-md-6">
            <label for="">Are You</label>
            <input type="" class="form-control" id="" placeholder="Fresher/Experienced">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Total Experience</label>
            <input type="" class="form-control" id="" placeholder="Experience">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Current Annual Salary</label>
            <input type="" class="form-control" id="" placeholder="Salary">
          </div>  
            
          <div class="col-md-12"><h3>Current Job Details</h3></div>  
          <div class="form-group col-md-6">
            <label for="">Job Title</label>
            <input type="" class="form-control" id="" placeholder="Job Title">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Company Name</label>
            <input type="" class="form-control" id="" placeholder="Company Name">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Department</label>
            <input type="" class="form-control" id="" placeholder="Department">
          </div>
            
          <div class="col-md-12"><h3>Education Details</h3></div>  
          <div class="form-group col-md-6">
            <label for="">Qualification Level</label>
            <input type="" class="form-control" id="" placeholder="Highest Degree">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Institute Name</label>
            <input type="" class="form-control" id="" placeholder="Institute Name">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Year Of Passing</label>
            <input type="" class="form-control" id="" placeholder="Year Of Passing">
          </div>
            
          <div class="col-md-12"><h3>Hobbies</h3></div>  
          <div class="form-group col-md-6">
            <label for="">Hobbies</label>
            <input type="" class="form-control" id="" placeholder="Hobbies">
          </div> 
          
          <div class="col-md-12"><h3>Resume</h3></div>
          <div class="col-md-12">
             <div class="browse-label">
                <label class="btn browse-btn">
                  Browse <input name="fileToUpload" id="fileToUpload" type="file">
                </label> No File Selected
            </div>
          </div> 
            
          <div class="col-md-12"><h3>Key Skills</h3></div>  
          <div class="form-group col-md-12">
            <label for="">Key Skills</label>
            <input type="" class="form-control" id="" placeholder="Year Of Passing">
          </div>  
            
          <div class="col-md-12"><h3>Contact Info</h3></div>  
          <div class="form-group col-md-6">
            <label for="">Email</label>
            <input type="" class="form-control" id="" placeholder="Email">
          </div>  
          <div class="form-group col-md-6">
            <label for="">Mobile</label>
            <input type="" class="form-control" id="" placeholder="Mobile">
          </div>
          <div class="col-md-12">   
             <button type="submit" class="btn red-btn">Submit</button>
          </div>
        </form>
      </div>
   </div>
</div>

@endsection