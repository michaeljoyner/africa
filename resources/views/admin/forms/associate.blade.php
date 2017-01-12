<form action="{{ $formAction }}" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name: </label>
        @if($errors->has('name'))
            <span class="error-message">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ old('name') ?? $associate->name }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('writeup') ? ' has-error' : '' }}">
        <label for="writeup">Writeup: </label>
        @if($errors->has('writeup'))
            <span class="error-message">{{ $errors->first('writeup') }}</span>
        @endif
        <textarea name="writeup" class="form-control dd-tall-textbox">{{ old('writeup') ?? $associate->writeup }}</textarea>
    </div>
    <hr>
    <div>
        <h3>Social Links</h3>
        <p>Only include links that this associate would want shared. Leave blank otherwise.</p>
        <p>Links must start with either http:// or https://</p>
        <div class="is-2-column">
            @foreach(config('social.platforms') as $platform)
                <div class="form-group{{ $errors->has($platform) ? ' has-error' : '' }}">
                    <label for="$platform">{{ ucfirst($platform) }}: </label>
                    @if($errors->has($platform))
                        <span class="error-message">{{ $errors->first($platform) }}</span>
                    @endif
                    <input type="text" name="{{ $platform }}" value="{{ old($platform) ?? $associate->socialLinkTo($platform) }}" class="form-control">
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>