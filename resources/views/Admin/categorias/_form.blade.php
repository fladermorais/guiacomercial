<div class="form-group">
  <div class="form-row">
    <div class="col-sm-6">
      <label for="nome">Nome * </label><br>
      <input required class='form-control' type="text" id="nome" name="nome" value="{{ (isset($categoria->nome) ? $categoria->nome : old('nome')) }}">
      @if($errors->has('nome'))
      @foreach($errors->get('nome') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
    <div class="col-md-3">
      <label for="imagem">Imagem</label>
      <input class='form-control' type="file" id="imagem" name="imagem" value="{{old('imagem')}}">
      @if($errors->has('imagem'))
      @foreach($errors->get('imagem') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
    @if(isset($categoria->img))
    <div class="col-md-3">
      <img id="imagem" src="{{ asset('/storage/categorias/' . $categoria->img) }}" alt="">
    </div>
    @endif
    
  </div>
  <div class="form-row">
    
    <div class="col-md-12">
      <label for="descricao">Descrição</label>
      <textarea required class='form-control ckeditor' type="text" id="descricao" name="descricao" >{{ (isset($categoria->descricao) ? $categoria->descricao : old('descricao')) }}</textarea>
      @if($errors->has('descricao'))
      @foreach($errors->get('descricao') as $e)
      {{$e}}
      @endforeach
      @endif
    </div>
    
  </div>
</div>