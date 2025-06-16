<?php

namespace App\Traits;

class UploadArquivoTrait {
  
  
  public function uploadArquivo($arquivo, $alias, $tipo)
  {
    $file = $arquivo;
    $extensao = $arquivo->getClientOriginalExtension();
    $nomeArquivo =  $alias. "." .$extensao;
    $path = public_path('/storage/'. $tipo .'/');
    
    $file->move($path, $nomeArquivo);
    
    if(!$file){
      flash('Falha ao fazer o upload do Arquivo')->warning();
      return redirect()
      ->back()
      ->with('error', 'Falha ao fazer upload do Arquivo')
      ->withInput();
    }
    return $nomeArquivo;
  }
  
  public function unlinkArquivo($arquivo, $tipo)
  {
    $path = public_path('/storage/'. $tipo . '/');
    $file = $arquivo;
    $arquivo = $path.$file;
    if (is_dir($arquivo)) {
      // rmdir($arquivo); // remove diretório vazio
    } elseif (is_file($arquivo)) {
      unlink($arquivo); // remove arquivo
    }
    
    return true;
  }
  
  function getAlias($string){
    $string = str_replace("?", "_", $string);
    $string = str_replace("!", "_", $string);
    $string = str_replace(",", "_", $string);
    $string = str_replace(' ', "_", $string);
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
  }
}