@extends('backend.layouts.master')

@section('content')


<style>
    /* For the cards in the dashboard */
    .ag-courses_box {
        /* display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap; */

        padding: 10px 0;
    }

    .ag-courses_item {
        /* -ms-flex-preferred-size: calc(33.33333% - 30px);
        flex-basis: calc(33.33333% - 150px); */

        margin: 0 5px 10px;

        overflow: hidden;
        width: 100%;
        border-radius: 28px;
    }

    .ag-courses-item_link {
        display: block;
        padding: 30px 20px;
        background-image: linear-gradient(-45deg, rgba(0, 160, 255, 0.86), #0048a2), url(../img/generic/bg-navbar.png);

        overflow: hidden;

        position: relative;
    }

    .ag-courses-item_link:hover,
    .ag-courses-item_link:hover .ag-courses-item_date {
        text-decoration: none;
        color: #FFF;
    }

    .ag-courses-item_link:hover .ag-courses-item_bg {
        -webkit-transform: scale(10);
        -ms-transform: scale(10);
        transform: scale(10);
    }

    .ag-courses-item_title {
        min-height: 87px;
        margin: 0 0 25px;

        overflow: hidden;

        font-weight: bold;
        font-size: 30px;
        color: #FFF;

        z-index: 2;
        position: relative;
    }

    .ag-courses-item_date-box {
        font-size: 18px;
        color: #FFF;

        z-index: 2;
        position: relative;
    }

    .ag-courses-item_date {
        font-weight: bold;
        color: #f9b234;

        -webkit-transition: color .5s ease;
        -o-transition: color .5s ease;
        transition: color .5s ease
    }

    .ag-courses-item_bg {
        height: 128px;
        width: 128px;
        background-color: #f9b234;

        z-index: 1;
        position: absolute;
        top: -75px;
        right: -75px;

        border-radius: 50%;

        -webkit-transition: all .5s ease;
        -o-transition: all .5s ease;
        transition: all .5s ease;
    }

    .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
        background-color: #3ecd5e;
    }

    .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
        background-color: #e44002;
    }

    .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
        background-color: #952aff;
    }

    .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
        background-color: #cd3e94;
    }

    .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
        background-color: #4c49ea;
    }



    @media only screen and (max-width: 979px) {
        .ag-courses_item {
            -ms-flex-preferred-size: calc(50% - 30px);
            flex-basis: calc(50% - 30px);
        }

        .ag-courses-item_title {
            font-size: 24px;
        }
    }

    @media only screen and (max-width: 767px) {
        .ag-format-container {
            width: 96%;
        }

    }

    @media only screen and (max-width: 639px) {
        .ag-courses_item {
            -ms-flex-preferred-size: 100%;
            flex-basis: 100%;
        }

        .ag-courses-item_title {
            min-height: 72px;
            line-height: 1;

            font-size: 24px;
        }

        .ag-courses-item_link {
            padding: 22px 40px;
        }

        .ag-courses-item_date-box {
            font-size: 16px;
        }
    }

    .no_transaction {
        width: 100% !important;
    }
</style>
<div class="container">
    <div class="ag-format-container">
       
            <div class="ag-courses_box row">

            <div class="col-lg-3">
                <div class="ag-courses_item">
                    <a href="#" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Workers
                        </div>

                        <div class="ag-courses-item_date-box">

                            <span class="ag-courses-item_date">
                                {{ $studentCount }}
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ag-courses_item">

                    <a href="#" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Visitors
                        </div>

                        <div class="ag-courses-item_date-box">

                            <span class="ag-courses-item_date">
                                {{ $visitorCount }}
                            </span>
                        </div>

                    </a>

                </div>
            </div>

            <div class="col-lg-3">
                <div class="ag-courses_item">

                    <a href="#" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Blogs
                        </div>

                        <div class="ag-courses-item_date-box">

                            <span class="ag-courses-item_date">
                                {{ $blogPostCount }}
                            </span>
                        </div>

                    </a>

                </div>
            </div>

            <div class="col-lg-3">
                <div class="ag-courses_item">

                    <a href="#" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Contacts
                        </div>

                        <div class="ag-courses-item_date-box">

                            <span class="ag-courses-item_date">
                                {{ $contactRequestCount }}
                            </span>
                        </div>

                    </a>

                </div>
            </div>

            </div>
   
         

    </div>
</div>





    {{-- <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

       
                <div class="info-box-content">
                    <span class="info-box-text">Student Count</span>
                    <span class="info-box-number">{{ $studentCount }}</span>
                </div>
             
            </div>
         
        </div>
        
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Visitors Count</span>
                    <span class="info-box-number">{{ $visitorCount }}</span>
                </div>
            
            </div>
           
        </div>
    
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Blog Post Count</span>
                    <span class="info-box-number">{{ $blogPostCount }}</span>
                </div>
               
            </div>
         
        </div>
      
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Contact</span>
                    <span class="info-box-number">{{ $contactRequestCount }}</span>
                </div>
               
            </div>
          
        </div>
        
    </div> --}}
@endsection
