<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label for="titulo">Título</label><br>
      <input class='form-control' type="text" id="titulo" name="titulo" value="{{ (isset($info->titulo) ? $info->titulo : old('titulo')) }}">
      @if($errors->has('titulo'))
      @foreach($errors->get('titulo') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
    
    <div class="col-sm-3">
      <label for="arquivo">Imagem</label><br>
      <input class='form-control' type="file" id="arquivo" name="arquivo" >
      @if($errors->has('arquivo'))
      @foreach($errors->get('arquivo') as $e)
      <span class="error">{{$e}}</span>
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
    
    <div class="col-sm-2">
      <label for="status">Status</label><br>
      <select class="form-control" name="status" id="status">
        <option {{ (isset($info->status) && $info->status == 'A' ? "selected" : "") }} value="A">Ativo</option>
        <option {{ (isset($info->status) && $info->status == 'I' ? "selected" : "") }} value="I">Inativo</option>
      </select>
      @if($errors->has('status'))
      @foreach($errors->get('status') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12">
      <label for="descricao">Descrição</label><br>
      <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10">{{ (isset($info->descricao) ? $info->descricao : old('descricao')) }}</textarea>
      @if($errors->has('descricao'))
      @foreach($errors->get('descricao') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12">
      <label for="referencia">Referência</label><br>
      <input class='form-control' type="text" id="referencia" name="referencia" value="{{ (isset($info->referencia) ? $info->referencia : old('referencia')) }}">
      @if($errors->has('referencia'))
      @foreach($errors->get('referencia') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
</div>