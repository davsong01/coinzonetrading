<div class="modal modal-right fade" id="modal-right{{ $packages->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#dd3765">Update {{ $packages->package->name }} for {{ $investor->user->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('investorpackages.edit') }}" onsubmit="return confirm('This action cannot be undone!');" method="post">
                    @csrf
                    <div class="form-group">
						<label class="form-label">Start date</label>
                        <input style="margin: 0;" class="form-control" name="start_date" type="date" value="{{ empty($packages->start_date ) ? '' : \Illuminate\Support\Carbon::parse($packages->start_date)->format('Y-m-d')  }}" required>
                    </div>
                    <div class="form-group">
						<label class="form-label">End date</label>
                        <input style="margin: 0;" class="form-control" name="end_date" type="date" value="{{ empty($packages->end_date ) ? '' :  \Illuminate\Support\Carbon::parse($packages->end_date)->format('Y-m-d')  }}" required>
                    </div>
                    {{-- <div class="form-group">
						<label class="form-label">Amount</label>
                        <input style="margin: 0;" class="form-control" name="end_date" type="number" step=".01" value="{{ $packages->amount }}" required>
                    </div> --}}
                    
                    {{-- <div class="form-group">
						<label class="form-label">Status</label>
                        <select style="margin: 0;" name="status" class="form-control" id="">
                            <option value="pending" {{ $packages->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ $packages->status == 'active' ? 'selected' : '' }}>Active</option>
                        </select>
                    </div> --}}
                    <input type="hidden" name="id" value="{{ $packages->id }}">
                    <input type="hidden" name="user_id" value={{ $investor->id }}>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
