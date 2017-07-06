
    <form class="form-horizontal" role="form" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
                        
        <div class="form-group{{ $errors->has('financial_institution_code') ? ' has-error' : '' }}">
            <label for="financial_institution_code" class="col-md-4 control-label">銀行代號</label>

            <div class="col-md-6">
                <select id="financial_institution_code" class="form-control" name="financial_institution_code">
                    <option value="" disabled>請選擇銀行代號</option>
                    @foreach ($taiwan_bank_codes as $bank_code)
                        @if (!is_null(old('financial_institution_code')))
                            <option value="{{ $bank_code['code'] }}" {{ old('financial_institution_code') == $bank_code['code'] ? 'selected' : '' }}">{{ $bank_code['code'] }} {{ $bank_code['name'] }}</option>
                        @elseif (isset($financial_account))
                            <option value="{{ $bank_code['code'] }}" {{ $financial_account->financial_institution_code == $bank_code['code'] ? 'selected' : '' }}">{{ $bank_code['code'] }} {{ $bank_code['name'] }}</option>
                        @else
                            <option value="{{ $bank_code['code'] }}">{{ $bank_code['code'] }} {{ $bank_code['name'] }}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('financial_institution_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('financial_institution_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
            <label for="account_number" class="col-md-4 control-label">帳號</label>

            <div class="col-md-6">
                <input id="account_number" class="form-control" name="account_number" value="{{ !is_null(old('account_number')) ? old('account_number') : (isset($financial_account) ? $financial_account->account_number : '') }}">
                @if ($errors->has('account_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('account_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-6">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                    存檔
                </button>
            </div>
        </div>
    </form>