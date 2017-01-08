<form action="/admin/users" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name: </label>
        @if($errors->has('name'))
        <span class="error-message">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Email: </label>
        @if($errors->has('email'))
        <span class="error-message">{{ $errors->first('email') }}</span>
        @endif
        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">Password: </label>
        @if($errors->has('password'))
        <span class="error-message">{{ $errors->first('password') }}</span>
        @endif
        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password_confirmation">Confirm Password: </label>
        @if($errors->has('password_confirmation'))
        <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
        @endif
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="dd-btn btn">Register User</button>
    </div>
</form>