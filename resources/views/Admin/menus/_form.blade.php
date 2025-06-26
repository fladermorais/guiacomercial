<div class="form-group">
  <div class="row">
    <div class="col-sm-9">
      <label for="alias">Nome * </label><br>
      <input required class='form-control' type="text" id="alias" name="alias" value="{{ (isset($info->alias) ? $info->alias : old('alias')) }}">
      @if($errors->has('alias'))
      @foreach($errors->get('alias') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
    <div class="col-sm-3">
      <label for="categoria_id">Categoria</label><br>
      <select class="form-control" name="categoria_id" id="categoria_id">
        <option value="">Escolha uma Categoria</option>
        @foreach($categorias as $cat)
        <option {{ (isset($info->categoria_id) && $info->categoria_id == $cat->id) ? "selected" : "" }} value="{{ $cat->id }}">{{ $cat->titulo }}</option>
        @endforeach
      </select>
      @if($errors->has('categoria_id'))
      @foreach($errors->get('categoria_id') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
    
  </div>
  <div class="row">
    
    <div class="col-sm-4">
      <label for="exibe_menu">exiber no Menu</label><br>
      <select class="form-control" name="exibe_menu" id="exibe_menu">
        <option {{ (isset($info->exibe_menu) && $info->exibe_menu == 'S' ? "selected" : "") }} value="S">Ativo</option>
        <option {{ (isset($info->exibe_menu) && $info->exibe_menu == 'N' ? "selected" : "") }} value="N">Inativo</option>
      </select>
      @if($errors->has('exibe_menu'))
      @foreach($errors->get('exibe_menu') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
    
    <div class="col-sm-4">
      <label for="exibe_home">exiber na Home</label><br>
      <select class="form-control" name="exibe_home" id="exibe_home">
        <option {{ (isset($info->exibe_home) && $info->exibe_home == 'S' ? "selected" : "") }} value="S">Ativo</option>
        <option {{ (isset($info->exibe_home) && $info->exibe_home == 'N' ? "selected" : "") }} value="N">Inativo</option>
      </select>
      @if($errors->has('exibe_home'))
      @foreach($errors->get('exibe_home') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>

    <div class="col-sm-4">
      <label for="ordem">Ordenação</label><br>
      <input type="number" class="form-control" name="ordem" id="ordem" value="{{ (isset($info->ordem) ? $info->ordem : old('ordem')) }}">
      @if($errors->has('ordem'))
      @foreach($errors->get('ordem') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
</div>