@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard - <b>{{ __('subscribers.Newsletter subscriptions') }}</b></div>

                <div class="card-body">
                    <subscriber-list></subscriber-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
