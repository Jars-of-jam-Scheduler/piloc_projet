<form method="POST" action="/login">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>