@extends('frontend.layouts.master')

@section('content')
    <section class="container">
      <div class="blogdetailssection d-flex row">
        <div class="blogdetailssection_left col-md-6">
          <h5 class="card-title blogsingle-title">
            {{ $blogpostcategory->title }}
          </h5>
           <h6 class=""><span class="">{{ $blogpostcategory->created_at->format('F d, Y') }}</span></h6>
           <p>   {!! $blogpostcategory->content !!}</p>
           
       
        </div>
        <div class="blogdetailssection_right col-md-6">
          <img src="{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}" alt="{{ $blogpostcategory->title }}" />
        </div>
      </div>
    </section>
    <style>
    .blogsingle-title{
        font-size:28px;
        font-weight:500;
    }
    .blogdetailssection_left p{
        displya:flex;
        text-align:justify !important;
    }
    .blogdetailssection_right{
        height:40vh;
        width:30vw;
    }
      .blogdetailssection_right img{
        height:100%;
        width:100%;
        object-fit:cover;
    }
     
        
        
    </style>
@endsection
