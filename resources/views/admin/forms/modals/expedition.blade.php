<div class="modal fade dd-modal" id="create-expedition-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new Expedition</h4>
            </div>
            <form action="/admin/expeditions" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name: </label>
                        @if($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description: </label>
                        @if($errors->has('description'))
                            <span class="error-message">{{ $errors->first('description') }}</span>
                        @endif
                        <textarea name="description"
                                  placeholder="A brief description for SEO reasons. You can edit this later."
                                  class="form-control"
                        >{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dd-btn btn-light dd-modal-cancel-btn" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn dd-btn dd-modal-confirm-btn">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->