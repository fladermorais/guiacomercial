<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <label for="name">Nome</label>
            <input class='form-control' type="text" id="name" name="name" value="{{ $role->name ?? old('name') }}">
            @if($errors->has('name'))
            @foreach($errors->get('name') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
        
        <div class="col-md-12">
            <label for="description">Descrição</label>
            <input class='form-control' type="text" id="description" name="description" value="{{ $role->description ?? old('description') }}">
            @if($errors->has('description'))
            @foreach($errors->get('description') as $e)
            {{$e}}
            @endforeach
            @endif
        </div>
    </div>
</div>