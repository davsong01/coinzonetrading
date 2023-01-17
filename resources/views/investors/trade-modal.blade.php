<div class="modal modal fade" id="trade-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#dd3765">Buy</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col-md-1">
                    <img src="http://127.0.0.1:8000/front-end/images/favicon.png" alt="">
                </div>
                <div class="col-md-3">
                    <span id="price">17721.95</span> <span id="rate">444.68</span> <br> <span id="percent">(2.59%)</span>
                </div>
                <div class="col-md-7">
                    <select class="form-control select2 w-p100" id="instruments">
					  <option value="">Select...</option>
                        @foreach ($instruments as $instrument)
                        <option value="{{ $instrument->id }}">{{ $instrument->name }}</option>
                        @endforeach
					</select>
                   
                </div>
                <hr>
            </div>
            <form action="{{ route('investorpackages.add') }}" onsubmit="return confirm('This action cannot be undone!');" method="post">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label class="form-label">Order number</label>
                    <input style="margin: 0;" class="form-control" name="order_number" type="text" value="{{ old('order_number')}}" required>
                </div>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

