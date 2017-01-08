<form action="/admin/expeditions/{{ $expedition->id }}" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-5">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name: </label>
                @if($errors->has('name'))
                <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $expedition->name }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description">SEO Description: </label>
                @if($errors->has('description'))
                    <span class="error-message">{{ $errors->first('description') }}</span>
                @endif
                <textarea name="description" class="form-control">{{ old('description') ?? $expedition->description }}</textarea>
            </div>
            <div class="form-group{{ $errors->has('writeup') ? ' has-error' : '' }}">
                <label for="writeup">Writeup: </label>
                @if($errors->has('writeup'))
                    <span class="error-message">{{ $errors->first('writeup') }}</span>
                @endif
                <textarea name="writeup" class="form-control dd-tall-textbox">{{ old('writeup') ?? $expedition->writeup }}</textarea>
            </div>
        </div>
        <div class="col-md-offset-2 col-md-5">
            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                <label for="start_date">Expedition Start Date: </label>
                @if($errors->has('start_date'))
                <span class="error-message">{{ $errors->first('start_date') }}</span>
                @endif
                <input type="text" name="start_date" value="{{ old('start_date') ?? $expedition->start_date }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                <label for="duration">Duration: </label>
                @if($errors->has('duration'))
                <span class="error-message">{{ $errors->first('duration') }}</span>
                @endif
                <input type="text" name="duration" value="{{ old('duration') ?? $expedition->duration }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="location">Location: </label>
                @if($errors->has('location'))
                <span class="error-message">{{ $errors->first('location') }}</span>
                @endif
                <input type="text" name="location" value="{{ old('location') ?? $expedition->location }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                <label for="capacity">Number of People: </label>
                @if($errors->has('capacity'))
                <span class="error-message">{{ $errors->first('capacity') }}</span>
                @endif
                <input type="text" name="capacity" value="{{ old('capacity') ?? $expedition->capacity }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('difficulty') ? ' has-error' : '' }}">
                <label for="difficulty">Difficulty: </label>
                @if($errors->has('difficulty'))
                <span class="error-message">{{ $errors->first('difficulty') }}</span>
                @endif
                <input type="text" name="difficulty" value="{{ old('difficulty') ?? $expedition->difficulty }}" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>