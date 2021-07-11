<div class="form-group">
  <div class="form-row">
    <div class="col-md-8">
      <label for="nome">Nome * </label><br>
      <input required class='form-control' type="text" id="nome" name="nome" value="{{ (isset($categoria->nome) ? $categoria->nome : old('nome'))}}">
      @if($errors->has('nome'))
      @foreach($errors->get('nome') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
    <div class="col-md-4">
      <label for="categoria_id">Categoria Principal</label>
      <select class="form-control" name="categoria_id" id="categoria_id">
        <option value="">Escolha uma Categoria</option>
        @foreach($categorias as $cat)
        <option {{ ((isset($categoria->categoria_id) && $categoria->categoria_id == $cat->id ) || old('categoria_id') == $cat->id ? "selected" : "" ) }} value="{{ $cat->id }}">{{ $cat->nome }}</option>
        @endforeach
      </select>
      @if($errors->has('categoria_id'))
      @foreach($errors->get('categoria_id') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
    
  </div>
  <div class="form-row">
    
    <div class="col-md-12">
      <label for="descricao">Descrição</label>
      <textarea class='form-control' type="text" id="descricao" name="descricao">{{ (isset($categoria->descricao) ? $categoria->descricao : old('descricao') )}} </textarea>
      @if($errors->has('descricao'))
      @foreach($errors->get('descricao') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
  </div>
</div>