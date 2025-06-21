<div class="form-group">
  <div class="row">
    <div class="col-sm-8">
      <label for="titulo">Título * </label><br>
      <input class='form-control' type="text" id="titulo" name="titulo" value="{{ (isset($categoria->titulo) ? $categoria->titulo : old('titulo')) }}">
      @if($errors->has('titulo'))
      @foreach($errors->get('titulo') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
    
    <div class="col-md-4">
      <label for="status">Status</label>
      <select name="status" id="status" class="form-control">
        <option {{ (isset($categoria->status) && $categoria->status == "A" ? "selected" : "") }} value="A">Ativo</option>
        <option {{ (isset($categoria->status) && $categoria->status == "I" ? "selected" : "") }} value="I">Inativo</option>
      </select>
      @if($errors->has('imagem'))
      @foreach($errors->get('imagem') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
</div>