<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="nome">Nome * </label><br>
            <input required class='form-control' type="text" id="nome" name="nome" value="{{ (isset($empresa->nome) ? $empresa->nome : old('nome') )}}">
            @if($errors->has('nome'))
            @foreach($errors->get('nome') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        <div class="col-md-3">
            <label for="categoria">Categoria * </label>
            <select required class="form-control" name="categoria" id="categoria">
                @foreach($categorias as $cat)
                <option {{ (isset($empresa->categoria_id) && $empresa->categoria_id == $cat->id ? "selected" : "")  }} value="{{ $cat->id }}">{{ $cat->nome }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label for="subcategoria">SubCategoria * </label>
            @if(isset($empresa))
            <input type="hidden" id="sub_ativa" value="{{ $empresa->subcategoria_id }}">
            @endif
            <select required class="form-control" name="subcategoria" id="subcategoria">
                @foreach($subcategorias as $cat)
                <option {{ (isset($empresa->subcategoria_id) && $empresa->subcategoria_id == $cat->id ? "selected" : "")  }} value="{{ $cat->id }}">{{ $cat->nome }}</option>
                @endforeach
            </select>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <label for="descricao">Descrição * </label>
            <textarea class='form-control' id="description" name="descricao" cols="30" rows="5">{{ (isset($empresa->descricao) ? $empresa->descricao : old('descricao') )}}</textarea>
            @if($errors->has('descricao'))
            @foreach($errors->get('descricao') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="logo">Logo/ Principal * </label>
            <input class='form-control' type="file" id="logo" name="logo" value="{{old('logo')}}">
            @if($errors->has('logo'))
            @foreach($errors->get('logo') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-6">
            <label for="imagem">Imagem Secundária * </label>
            <input class='form-control' type="file" name="imagem" value="{{old('imagem')}}">
            @if($errors->has('imagem'))
            @foreach($errors->get('imagem') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
            <br>
            <p style="display: block; width: 100%;">Você pode utilizar para enviar uma imagem de algum produto específico ou até mesmo a imagem de um cardápio!</p>
        </div>
        
    </div>
    
    <hr>
    
    <div class="row">
        <h3>Informações de Contato</h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="telefone">Telefone * </label>
            <input required class='form-control' type="text" id="telefone" name="telefone" value="{{ (isset($empresa->telefone) ? $empresa->telefone : old('telefone') )}}">
            @if($errors->has('telefone'))
            @foreach($errors->get('telefone') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-4">
            <label for="whatsapp">Whatsapp</label>
            <input class='form-control' type="text" id="whatsapp" name="whatsapp" value="{{ (isset($empresa->whatsapp) ? $empresa->whatsapp : old('whatsapp') )}}">
            @if($errors->has('whatsapp'))
            @foreach($errors->get('whatsapp') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-4">
            <label for="email">E-mail</label>
            <input class='form-control' type="email" id="email" name="email" value="{{ (isset($empresa->email) ? $empresa->email : old('email') )}}">
            @if($errors->has('email'))
            @foreach($errors->get('email') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <label for="endereco">Endereço/N</label>
            <input  class='form-control' type="text" id="endereco" name="endereco" value="{{ (isset($empresa->endereco) ? $empresa->endereco : old('endereco') )}}" placeholder="Ex.: Meu Bairro">
            @if($errors->has('endereco'))
            @foreach($errors->get('endereco') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-3">
            <label for="bairro">Bairro</label>
            <input  class='form-control' type="text" id="bairro" name="bairro" value="{{ (isset($empresa->bairro) ? $empresa->bairro : old('bairro')) }}">
            @if($errors->has('bairro'))
            @foreach($errors->get('bairro') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-3">
            <label for="cidade">Cidade</label>
            <input  class='form-control' type="text" id="cidade" name="cidade" value="{{ (isset($empresa->cidade ) ? $empresa->cidade : old('cidade')) }}">
            @if($errors->has('cidade'))
            @foreach($errors->get('cidade') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        <div class="col-md-2">
            <label for="estado">Estado</label>
            <input  class='form-control' type="text" id="estado" name="estado" value="{{ (isset($empresa->estado ) ? $empresa->estado : old('estado')) }}">
            @if($errors->has('estado'))
            @foreach($errors->get('estado') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <h3>Horário de Atendimento</h3>
    </div>
    <div class="row">
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="segunda">Segunda Feira</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="segunda" name="segunda" value="{{ (isset($empresa->segunda) ? $empresa->segunda : old('segunda'))}}">
                        @if($errors->has('segunda'))
                        @foreach($errors->get('segunda') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="segunda_final" name="segunda_final" value="{{ (isset($empresa->segunda_final) ? $empresa->segunda_final : old('segunda_final'))}}">
                        @if($errors->has('segunda_final'))
                        @foreach($errors->get('segunda_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>  
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="terca">Terça Feira</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="terca" name="terca" value="{{ (isset($empresa->terca) ? $empresa->terca : old('terca'))}}">
                        @if($errors->has('terca'))
                        @foreach($errors->get('terca') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="terca_final" name="terca_final" value="{{ (isset($empresa->terca_final) ? $empresa->terca_final : old('terca_final'))}}">
                        @if($errors->has('terca_final'))
                        @foreach($errors->get('terca_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="quarta">Quarta Feira</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="quarta" name="quarta" value="{{ (isset($empresa->quarta) ? $empresa->quarta : old('quarta'))}}">
                        @if($errors->has('quarta'))
                        @foreach($errors->get('quarta') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="quarta_final" name="quarta_final" value="{{ (isset($empresa->quarta_final) ? $empresa->quarta_final : old('quarta_final'))}}">
                        @if($errors->has('quarta_final'))
                        @foreach($errors->get('quarta_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="quinta">Quinta Feira</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="quinta" name="quinta" value="{{ (isset($empresa->quinta) ? $empresa->quinta : old('quinta'))}}">
                        @if($errors->has('quinta'))
                        @foreach($errors->get('quinta') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="quinta_final" name="quinta_final" value="{{ (isset($empresa->quinta_final) ? $empresa->quinta_final : old('quinta_final'))}}">
                        @if($errors->has('quinta_final'))
                        @foreach($errors->get('quinta_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="sexta">Sexta Feira</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="sexta" name="sexta" value="{{ (isset($empresa->sexta) ? $empresa->sexta : old('sexta'))}}">
                        @if($errors->has('sexta'))
                        @foreach($errors->get('sexta') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="sexta_final" name="sexta_final" value="{{ (isset($empresa->sexta_final) ? $empresa->sexta_final : old('sexta_final'))}}">
                        @if($errors->has('sexta_final'))
                        @foreach($errors->get('sexta_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="sabado">Sábado</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="sabado" name="sabado" value="{{ (isset($empresa->sabado) ? $empresa->sabado : old('sabado'))}}">
                        @if($errors->has('sabado'))
                        @foreach($errors->get('sabado') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="sabado_final" name="sabado_final" value="{{ (isset($empresa->sabado_final) ? $empresa->sabado_final : old('sabado_final'))}}">
                        @if($errors->has('sabado_final'))
                        @foreach($errors->get('sabado_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="domingo">Domingo</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="domingo" name="domingo" value="{{ (isset($empresa->domingo) ? $empresa->domingo : old('domingo'))}}">
                        @if($errors->has('domingo'))
                        @foreach($errors->get('domingo') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="domingo_final" name="domingo_final" value="{{ (isset($empresa->domingo_final) ? $empresa->domingo_final : old('domingo_final'))}}">
                        @if($errors->has('domingo_final'))
                        @foreach($errors->get('domingo_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="dia_semana">
                <label for="feriado">Feriados</label>
                <div class="row">
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="feriado" name="feriado" value="{{ (isset($empresa->feriado) ? $empresa->feriado : old('feriado'))}}">
                        @if($errors->has('feriado'))
                        @foreach($errors->get('feriado') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input  class='form-control' type="time" id="feriado_final" name="feriado_final" value="{{ (isset($empresa->feriado_final) ? $empresa->feriado_final : old('feriado_final'))}}">
                        @if($errors->has('feriado_final'))
                        @foreach($errors->get('feriado_final') as $e)
                        <span class="error">{{$e}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    
    <div class="row">
        <h3>Informações On-Line</h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="site">Site</label>
            <input  class='form-control' type="text" id="site" name="site" value="{{ (isset($empresa->site) ? $empresa->site : old('site') )}}" placeholder="www.meusite.com.br">
            @if($errors->has('site'))
            @foreach($errors->get('site') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        
        <div class="col-md-4">
            <label for="facebook">Facebook</label>
            <input  class='form-control' type="text" id="facebook" name="facebook" value="{{ isset($empresa->facebook) ? $empresa->facebook : old('facebook') }}" placeholder="/itacomercios">
            @if($errors->has('facebook'))
            @foreach($errors->get('facebook') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
        <div class="col-md-4">
            <label for="instagran">Instagran</label>
            <input  class='form-control' type="text" id="instagran" name="instagran" value="{{ (isset($empresa->instagran) ? $empresa->instagran : old('instagran') )}}" placeholder="@itacomercios">
            @if($errors->has('instagran'))
            @foreach($errors->get('instagran') as $e)
            <span class="error">{{$e}}</span>
            @endforeach
            @endif
        </div>
    </div>
</div>