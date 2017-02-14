
@inject('carbon', 'Carbon\Carbon')

@extends('layouts.main')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">舉辦的活動
                    <small></small>
                    <button type="button" class="btn btn-default" aria-label="Left Align" onclick="window.location.href='{{ url('/organise/activity')}}'">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        新增活動
                    </button>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <table class="table table-hover">
                <caption></caption>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>活動名稱</th>
                        <th>活動時間起迄</th>
                        <th>活動地點</th>
                        <th>活動概要</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $key => $activity)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>
                                @if ($carbon->parse($activity->start_time)->toDateString() != $carbon->parse($activity->end_time)->toDateString())
                                    {{ $carbon->parse($activity->start_time)->toDateString() }}
                                     ~ 
                                    {{ $carbon->parse($activity->end_time)->toDateString() }}
                                @else
                                    {{ $carbon->parse($activity->start_time)->toDateString() }}
                                @endif
                            </td>
                            <td>{{ $activity->venue }}</td>
                            <td>{{ $activity->summary }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                目前這裡沒有活動，不如開始辦一個吧 ! 
                                <a href="{{ url('/organise/activity') }}">
                                    立刻新增活動
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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