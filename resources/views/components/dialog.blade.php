<div class="modal fade" id="modalNew">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $action }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ url()->previous() }}'">×</button>
                </div>
                <div class="modal-body">
                    <label>Student Number</label><br>
                    <input name="no" value="{{ $no }}" class="form-control" disabled>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" name="surname" value="{{ $surname }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" name="department" value="{{ $department }}" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-primary mr-auto">Clear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="location.href='{{ url()->previous() }}'">Cancel</button>
                    <button type="submit" class="btn btn-success">{{ $button }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>$("#modalNew").modal("toggle");</script>