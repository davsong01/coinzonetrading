@extends('back.investors.trade.index')

@section('body')
<div class="tab-content tabcontent-border">
  <div class="tab-pane {{ isset($active) && $active == 'crypto' ? 'active' : '' }}" role="tabpanel" id="crypto">
      <div class="row">
          <div class="col-md-12">
            <div class="box-body">
              <div class="form-group row">
                @if(isset($instrument) && !empty($instrument))
                <div class="col-md-6">
                  <script src="https://widgets.coingecko.com/coingecko-coin-market-ticker-list-widget.js"></script>
                  <coingecko-coin-market-ticker-list-widget  coin-id="{{ $instrument }}" currency="usd" locale="en"></coingecko-coin-market-ticker-list-widget>
                  
                </div>
                <div class="col-md-6">
                    <form action="{{ route('investor.trade') }}" method="post">
                        @csrf
                        <label for="">Amount ($)</label>
                        <input type="hidden" name="instrument" value="{{ $instrument }}" class="form-control" required>

                        <input class="form-control" type="number" name="amount" value="{{ old('amount') }}" max="{{ auth()->user()->walletBalance() }}" min="5" step=".01" required>
                        <div class="col-md-12 mt-15" style="color:#dd3765">
                          Cash available in Wallet : ${{ number_format(auth()->user()->walletBalance(), 2) }}
                        </div>
                        <div class="col-md-12 md-2 mt-10">
                          <button class="btn btn bg-blue btn-lg" type="submit">Invest</button>
                        </div>
                    </form>

                  </div>
                @else
                <label class="col-md-2 col-form-label">Select Instrument</label>
                <div class="col-md-8">
                  <form action="{{ route('select.instrument') }}">
                  
                  <select name="instrument" id="instrument" class="form-control" required>
                    <option value="">Select</option>
                    @if(isset($instruments))
                    @foreach($instruments as $instrument)
                    <option value="{{ $instrument->real_id }}">{{ $instrument->name }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="md-2">
                  <button class="btn btn bg-blue btn-lg" type="submit">Select</button>
                </div>
                </form>
                @endif
              </div>
            </div>
          </div>
          
      </div>	
  </div>
  <div class="tab-pane {{ isset($active) && $active == 'history' ? 'active' : '' }}" role="tabpanel" id="crypto">
      <div class="row">
          <div class="col-md-12">
            <div class="box-body">
            @if(isset($historys) && $historys->count() > 0)
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                
                <table id="example" class="table table-bordered responsive table-hover display nowrap margin-top-10 w-p100 dataTable" role="grid" aria-describedby="example_info">
                  <thead>
                    <tr>
                      <th>{{ __('S/N') }}</th>
                      <th>{{ __('Trade Id') }}</th>
                      <th>{{ __('Instrument') }}</th>
                      <th>{{ __('Amount') }}</th>
                      <th>{{ __('Status') }}</th>
                      <th>{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($historys as $history)
                    <tr>
                      <td>{{ $count ++ }}</td>
                      <td>{{ $history->trade_id }}</td>
                      <td>{{ $history->instrument }}
                      <small> <br>
                          <strong style="color: #dd3765;">Created on: </strong>{{ $history->created_at }} <br>
                      </small>
                      </td>
                      <td>${{ $history->amount }}</td>
                      <td>{{ $history->status }}</td>
                      <td>@if($history->status == 'Initiated') <a onclick="return confirm('You are about to close an initiated transaction');"  class="btn btn-danger" href="{{ route('trade.close',$history->id) }}">Close Trade</a> @endif</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @else
            <h4>No trade history yet!</h4> 
            @endif
            </div>
          </div>
          
      </div>	
  </div>
</div>
@endsection