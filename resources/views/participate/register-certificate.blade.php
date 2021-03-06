
@inject('carbon', 'Carbon\Carbon')

@extends('layouts.main')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">報到憑證</h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="panel-group">

                    <!-- Register Certificate -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">報到憑證</h4>
                        </div>
                        <div class="panel-body text-center">
                            @if ($order->register_status != 1)
                                <img src="{{ $qr_code }}">
                            @else
                                報到已完成
                            @endif
                        </div>
                    </div>
                    <!-- /.panel -->

                    @include('partials.apply-info-panel')
                    
                    @if (!is_null($transaction))
                        @include('partials.apply-fee-info-panel')
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
