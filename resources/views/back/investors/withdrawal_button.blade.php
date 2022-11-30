<?php
$canWithdraw = app('App\Http\Controllers\FunctionsController')->canWithdraw();
?>
<div class="row">
    <div class="col-md-4">
        <div class="small-box bg-{{  $canWithdraw['eligibility'] == true ? 'success' : 'warning' }} pull-up bg-hexagons-white">
            <div class="inner">
            <h3>{{ $settings->currency_sign . auth()->user()->walletBalance()  }}</h3>

            <p>Wallet Balance</p>
            </div>
            <div class="icon">
            <i class="icon-wallet"></i>
            </div>
           
            @if($canWithdraw['eligibility'] == true)
            <a style="cursor: grab;" class="small-box-footer" data-toggle="modal" data-target="#modal-default">Request withdrawal <i class="fa fa-arrow-right"></i></a>
            @else
            <a style="cursor: grab;" class="small-box-footer" data-toggle="modal" data-target="#modal-reason">Not eligible for withdrawal, find out why <i class="fa fa-info-circle"></i></a>
            @endif
        </div>
    </div>
</div>

</td>
<div class="text-xs-right">
    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('withdrawal.store') }}">
                        @csrf
                        <div class="form-group">
                            <h5>Wihdrawal method</h5>
                            <div class="controls">
                                <input type="text" name="withdrawal_method" class="form-control" required=""
                                    value="{{auth()->user()->investor->wallet_type}}" readonly>
                                <div class="help-block"></div>
                            </div>
                        </div>
                         <div class="form-group">
                            <h5>Wallet address <small>(Withdrawal amount will be sent to this address)</small></h5>
                            <div class="controls">
                                <input type="text" name="withdrawal_address" class="form-control" required=""
                                    value="{{auth()->user()->investor->wallet_addrress}}" readonly>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Amount (<span style="color:red">min: {{ $settings->currency_sign.'5'}}</span>, <span style="color:green">max: {{ $settings->currency_sign.$canWithdraw['max'] }}</span>)<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="amount" class="form-control" required=""
                                    min="5"
                                    max="{{ $canWithdraw['max'] }}" step=".01" value={{$canWithdraw['max'] ?? old('amount')}}>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Send request</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<div class="text-xs-right">
    <div class="modal fade" id="modal-reason" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                   @if(app('App\Http\Controllers\FunctionsController')->canWithdraw()['reasons'])
                
                   You cannot make a withdrawal request at the momment due to the following reasons: <br>
                    <ol>
                    @foreach(app('App\Http\Controllers\FunctionsController')->canWithdraw()['reasons'] as $reason)
                  
                    <li>{{ $reason }}</li>
                     
                   @endforeach
                   </ol>
                   @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>


