<div class="form-group">
  <div class="form-row">
    <div class="col-sm-12">
      <label for="seo_titulo">Título</label><br>
      <input class='form-control' type="text" id="seo_titulo" name="seo_titulo" value="{{ (isset($info->seo_titulo) ? $info->seo_titulo : old('seo_titulo')) }}">
      @if($errors->has('seo_titulo'))
      @foreach($errors->get('seo_titulo') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
  <div class="form-row">
    <div class="col-sm-12">
      <label for="seo_descricao">Descrição</label><br>
      <textarea class="form-control" name="seo_descricao" id="seo_descricao" cols="30" rows="5">{{ (isset($info->seo_descricao) ? $info->seo_descricao : old('seo_descricao')) }}</textarea>
      @if($errors->has('seo_descricao'))
      @foreach($errors->get('seo_descricao') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
  <div class="form-row">
    <div class="col-sm-12">
      <label for="seo_keywords">Palavras Chaves (Separada por vírgula)</label><br>
      <input class='form-control' type="text" id="seo_keywords" name="seo_keywords" value="{{ (isset($info->seo_keywords) ? $info->seo_keywords : old('seo_keywords')) }}">
      @if($errors->has('seo_keywords'))
      @foreach($errors->get('seo_keywords') as $e)
      <span class="error">{{$e}}</span>
      @endforeach
      @endif
    </div>
  </div>
  
</div>