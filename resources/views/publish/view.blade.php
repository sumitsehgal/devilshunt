@extends('layouts.front')
@section('content')
<?php //dd($media); ?>
<div class="news">
    <div class="video-sec">
        <div class="video-img">
            <img src="{{ asset('images/video-1.jpg') }}" class="img-responsive">
        </div>
        <div class="video-actions">
            <a href="javascript:void(0);" class="btn">Flag</a>
            <a href="javascript:void(0);" class="btn like-btn point-fire @if($likeStatus['like']) active @endif " data-mediaid="{{$media->id}}">Like</a>
            <a href="javascript:void(0);" class="btn dislike-btn point-fire @if($likeStatus['dislike']) active @endif " data-mediaid="{{$media->id}}">Dislike</a>
            <a href="" class="btn">(<span id="point-score">{{$points}}</span>) Points</a>
            <a href="" class="btn">Downloads</a>
            <a href="" class="btn">({{$views}}) Views</a>
        </div>
        <div class="video-des">
            <div class="video-left">
                <div class="des">
                    <h3>{!! $media->description !!}</h3>
                
                    <div class="author">
                        Author: {{$media->user->name}}
                    </div>
                </div>
                <div class="comment-sec">
                    <h3>Comments</h3>
                    <div class="reg-form">
                        <form>
                           <div class="form-group">
                             <input class="form-control" id="" placeholder="*User Name" type="text">
                           </div>

                           <div class="form-group">
                              <input class="form-control" id="" placeholder="*Email" type="pwd">
                           </div>
                            
                           <div class="form-group">
                              <textarea rows="5" placeholder="Message" class="form-control"></textarea>
                           </div>
                           <button type="submit" class="btn red-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="video-right">
                <div class="latest-post">
                    <h3>Recent</h3>
                    <div class="latest-div">
                        <div class="latest-img">
                            <img src="{{ asset('images/video-11.jpg') }}" class="img-responsive">
                        </div>
                        <div class="video-des">
                            Fusce pulvinar enim nulla, ac sodales nisl dignissim vitae.
                        </div>
                    </div>
                    
                    <div class="latest-div">
                        <div class="latest-img">
                            <img src="{{ asset('images/video-11.jpg') }}" class="img-responsive">
                        </div>
                        <div class="video-des">
                            Fusce pulvinar enim nulla, ac sodales nisl dignissim vitae.
                        </div>
                    </div>
                    
                    <div class="latest-div">
                        <div class="latest-img">
                            <img src="{{ asset('images/video-11.jpg') }}" class="img-responsive">
                        </div>
                        <div class="video-des">
                            Fusce pulvinar enim nulla, ac sodales nisl dignissim vitae.
                        </div>
                    </div>
                    
                    <div class="latest-div">
                        <div class="latest-img">
                            <img src="{{ asset('images/video-11.jpg') }}" class="img-responsive">
                        </div>
                        <div class="video-des">
                            Fusce pulvinar enim nulla, ac sodales nisl dignissim vitae.
                        </div>
                    </div>
                </div>
                
                <div class="author-detail">
                    <div class="author-div">Author: <span>Name of the author</span></div>
                    <div class="author-div">Date: <span>03/12/2017</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection