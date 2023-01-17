@extends('back.investors.trade.index')

@section('body')
<div class="tab-content tabcontent-border">
    <div class="tab-pane active" id="overview" role="tabpanel">
      {!! $settings->coin_price_list_widget !!}
    </div>
</div>
@endsection