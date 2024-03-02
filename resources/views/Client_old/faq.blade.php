@extends('Client.layouts.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">

            <div id="accordion">
            @foreach (FAQ() as $item)
                <div class="card my-2">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button style="text-decoration: none;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}">
                                {{ $item['question_'.lang()] }}
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-{{ $item->id }}" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            {!! $item['answer_'.lang()] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection