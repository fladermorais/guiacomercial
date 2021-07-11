<section id="login-reg">
  <div class="">
      <form role="form" action="{{ route('search')}}" method="post" class="login-form pesquisar">
          @csrf
          <h3 class="text-center">O que você deseja encontrar! </h3>
          <div class="col-md-10">
              <div class="input-group form-group form-busca">
                  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                  <input type="text" name="busca" class="form-control busca" placeholder="Digite o que procura" aria-describedby="basic-addon1">
              </div>
          </div>
          <div class="col-md-2">
              <button type="submit" class="btn btn-primary">Pesquisar</button>    
          </div>
          <div class="espacamento">
              
          </div>
      </form>
      
  </div>
</section>