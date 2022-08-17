<div class="modal modal fade" id="modal-top" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#dd3765">Add new package for {{ $investor->user->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('investorpackages.add') }}" onsubmit="return confirm('This action cannot be undone!');" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label">Select Package</label>
                        <select style="margin: 0;" name="package_id" id="package_id" class="form-control" required>
                            <option value="">Select...</option>
                            @foreach($otherpackages as $package)
                            <option  value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>{{ $package->name }} ({{ $settings->currency_sign . number_format($package->amount) .' - ' . number_format($package->max_amount)}})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
						<label class="form-label">Order number</label>
                        <input style="margin: 0;" class="form-control" name="order_number" type="text" value="{{ old('order_number')}}" required>
                    </div>
                    <div class="form-group">
						<label class="form-label">Start date</label>
                        <input style="margin: 0;" class="form-control" name="start_date" type="date" value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
						<label class="form-label">End date</label>
                        <input style="margin: 0;" class="form-control" name="end_date" type="date" value="{{ old('end_date') }}" required>
                    </div>
                    <div class="form-group">
						<label class="form-label">Amount paid in {{ $settings->currency }}</label>
                        <input style="margin: 0;" class="form-control" name="amount" type="numbeer" step="0.01" value="{{ old('amount')}}" required>
                    </div>
                
                    <input type="hidden" name="investor_id" value={{ $investor->user->id }}>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

