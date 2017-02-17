
@inject('carbon', 'Carbon\Carbon')

@extends('layouts.main')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    活動報名
                    <small>填寫報名資料</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-group" id="accordion">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                活動資訊
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p>活動名稱：{{ $activity->name }}</p>
                            <p>活動時間：
                                @if ($carbon->parse($activity->start_time)->toDateString() != $carbon->parse($activity->end_time)->toDateString())
                                    {{ $carbon->parse($activity->start_time)->toDateString() }}
                                     ~ 
                                    {{ $carbon->parse($activity->end_time)->toDateString() }}
                                @else
                                    {{ $carbon->parse($activity->start_time)->toDateString() }}
                                @endif
                            </p>
                            <p>活動地點：{{ $activity->venue }}</p>
                        </div>
                    </div>
                    
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                報名者資料填寫
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p>電子郵件：{{ $user_account->email }}</p>
                            <p>姓名：{{ $user_profile->name }}</p>
                            <p>手機：{{ $user_profile->mobile_phone }}</p>
                        </div>
                    </div>

                    <!-- /.panel -->
                    @if ($activity->apply_fee > 0 || $activity->can_sponsored)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">報名費用或隨喜贊助</h4>
                            </div>
                            <div class="panel-body">
                                @if ($activity->apply_fee > 0)
                                    <p>報名費用：{{ $activity->apply_fee }}</p>
                                @endif
                                @if ($activity->can_sponsored)
                                    <p>您可隨喜贊助本活動，<p>
                                    <p>
                                        如欲贊助本活動，請輸入欲贊助的金額：
                                        <input id="" type="number" name="" value="">
                                        @if ($errors->has(''))
                                            <span class="help-block" style="color:red">
                                                {{ $errors->first('') }}
                                            </span>
                                        @endif
                                    <p>
                                @endif
                            </div>
                        </div>

                        <!-- /.panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    付款方式
                                </h4>
                            </div>
                            <div class="panel-body">
                                <select name="">
                                    <option value="" disabled selected>請選擇付款方式</option>
                                    <option value="">信用卡</option>
                                    <option value="">網路ATM轉帳</option>
                                    <option value="">ATM轉帳</option>
                                    <option value="">超商代碼</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.panel-group -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

@endsection