{{-- @extends('frontend.layouts.master')

@section('content')
<section class="container">
    <div class="whycardsection d-flex flex-column py-2">
        @foreach($whyus as $item)
        <div class="row featurette d-flex justify-content-center align-items-center whyuscustomcard  odd">
            <div class="col-md-6 order-md-{{ $loop->odd ? '1' : '2' }} order-2">
                <h3 class="featurette-heading fw-normal lh-5 py-1">
                    {{ $item->title }}
                </h3>
                <p class="lead">
                    {{ $item->content }}
                </p>
                <div class="highlight-words">
                    @foreach(explode(',', $item->highlights) as $highlight)
                    <span class="highlight">{{ $highlight }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5 col-xs-12 order-md-{{ $loop->odd ? '2' : '1' }} order-1 whyusimage">
                <img src="{{ asset('uploads/whyus/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid" />
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
--}}
