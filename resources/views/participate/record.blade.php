
@inject('carbon', 'Carbon\Carbon')

@extends('layouts.main')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">活動報名</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Participate Record Info -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel-group">
                    @include('partials.apply-info-panel')
                    
                    @if (!is_null($transaction))
                        @include('partials.apply-fee-info-panel')

                        @if (!is_null($transaction->payment_result))
                            @include('partials.payment-result-panel')
                        @elseif (!is_null($transaction->payment_info))
                            @include('partials.payment-info-panel')
                        @endif
                    @endif
                </div>
                <!-- /.panel-group -->
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                @include('partials.copyright-notice')
            </div>
        </footer>

    </div>
    <!-- /.container -->

@endsection
