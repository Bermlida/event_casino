
@inject('carbon', 'Carbon\Carbon')
@inject('request', 'Illuminate\Http\Request')

@extends('layouts.main')

@section('content')

    <!-- Page Content -->
    <div class="container">
    
    <form role="form" method="POST" action="{{ '/' . $request->path() }}">
        {{ method_field($form_method) }}
        {{ csrf_field() }}

        <!-- Page Heading -->
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">
                    活動報名
                    <small>確認報名資料</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="panel-group" id="accordion">

                    <!-- Activity Info -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                活動資訊
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p>活動名稱：{{ $activity->name }}</p>
                            <p>活動時間：
                                @if ($activity->start_time->toDateString() != $activity->end_time->toDateString())
                                    {{ $activity->start_time->toDateString() }}
                                     ~ 
                                    {{ $activity->end_time->toDateString() }}
                                @else
                                    {{ $activity->start_time->toDateString() }}
                                @endif
                            </p>
                            <p>活動地點：{{ $activity->venue }}</p>
                        </div>
                    </div>
                    <!-- /.panel -->
                    
                    <!-- Apply Info -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                報名者資料
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p>姓名：{{ $user_profile->name }}</p>
                            <p>電子郵件：{{ $user_account->email }}</p>
                            <p>手機：{{ $user_profile->mobile_phone }}</p>
                        </div>
                    </div>
                    <!-- /.panel -->

                    @if (!$activity->is_free || $activity->can_sponsored)

                        <!-- Fee Info -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">報名費用或隨喜贊助</h4>
                            </div>
                            <div class="panel-body">
                                @if (!$activity->is_free)
                                    <p>報名費用：{{ $activity->apply_fee }}</p>
                                @endif
                                @if ($activity->can_sponsored)
                                    <p>另外，您可隨喜贊助本活動，<p>
                                    <p>
                                        如欲贊助本活動，請輸入欲贊助的金額：
                                        <input id="sponsorship_amount" type="number" name="sponsorship_amount" value="{{ old('sponsorship_amount') }}">
                                        @if ($errors->has('sponsorship_amount'))
                                            <span class="help-block" style="color:red">
                                                {{ $errors->first('sponsorship_amount') }}
                                            </span>
                                        @endif
                                    <p>
                                @endif
                            </div>
                        </div>
                        <!-- /.panel -->

                    @endif
                </div>
                <!-- /.panel-group -->
            </div>
            <!-- /.col-xs-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6 col-xs-6">
                <a href="javascript:history.back(-1);" class="btn btn-danger">
                    <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                    取消
                </a>
            </div>
            <div class="col-md-6 col-xs-6">
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
                    下一步
                </button>
            </div>
        </div>
        
        </form>

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