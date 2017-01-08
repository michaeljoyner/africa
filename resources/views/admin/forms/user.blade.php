<form action="/admin/users/{{ $user->id }}" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name: </label>
        @if($errors->has('name'))
            <span class="error-message">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Email: </label>
        @if($errors->has('email'))
            <span class="error-message">{{ $errors->first('email') }}</span>
        @endif
        <input type="text" name="email" value="{{ old('email') ?? $user->email }}" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="dd-btn btn">Edit</button>
    </div>
</form>