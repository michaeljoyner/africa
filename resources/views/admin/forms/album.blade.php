<form method="POST" action="/admin/albums/{{ $album->id }}" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title">Title: </label>
        @if($errors->has('title'))
            <span class="error-message">{{ $errors->first('title') }}</span>
        @endif
        <input type="text" name="title" value="{{ old('title') ?? $album->title }}" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>