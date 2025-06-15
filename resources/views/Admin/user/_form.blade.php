<div class="form-group">
    <div class="row">
        <div class="col-sm-8">
            <label for="name">Nome * </label><br>
            <input required class='form-control' type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}">
            @if($errors->has('name'))
            @foreach($errors->get('name') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>

        @if(auth()->user()->isAdmin())
        <div class="col-sm-4">
            <label for="quantidade">Quantidade</label><br>
            <input required class='form-control' type="text" id="quantidade" name="quantidade" value="{{ $user->quantidade ?? old('quantidade') }}">
            @if($errors->has('quantidade'))
            @foreach($errors->get('quantidade') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="email">Email</label>
            <input class='form-control' type="text" id="email" name="email" value="{{ $user->email ?? old('email') }}">
            @if($errors->has('email'))
            @foreach($errors->get('email') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
        
        <div class="col-md-4">
            <label for="password">Senha</label>
            <input class='form-control' type="password" id="password" name="password">
            @if($errors->has('password'))
            @foreach($errors->get('password') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
        
        <div class="col-md-4">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input class='form-control' type="password" id="password_confirmation" name="password_confirmation">
            @if($errors->has('password_confirmation'))
            @foreach($errors->get('password_confirmation') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
    </div>
</div>