<?php

  require_once("search.php");
  include_once 'config/dbclass.php';
  include_once 'entities/customer.php';
  include_once 'entities/product.php';
  include_once 'entities/brand.php';
  include_once 'entities/ped.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $customer = new Customer($connection);
  $product = new Product($connection);
  $brand = new Brand($connection);
  $ped = new Ped($connection);
  
  $action = "GET";
  $url = "http://www.mocky.io/v2/5de67e9f370000540009242b";
  $parameters = false;
  
  $result = search::perform_http_request($action, $url, $parameters);

  foreach($result as $data){
    //echo 'Nome: '.$cliente->nome.' cpf: '.$cliente->cpf.'<br>';
    $cpf = $customer->checkCPF($data->cpf);

    if(empty($cpf)){
      $client = array(
        $data->nome,
        $data->cpf
      );
      $customer->create($client);
    }

  }
  
  $action = "GET";
  $url = "http://www.mocky.io/v2/5e960a2d2f0000f33b0257c4";
  $parameters = false;
  
  $result = search::perform_http_request($action, $url, $parameters);
  $result = '';

  //lê os dados da compra
  foreach($result as $data){

    $customerId = $customer->checkCPF($data->cliente);

    if(!empty($customerId)){

      $productId = '';
      $brandId = '';

      //lê produtos
      foreach($data->itens as $item){

        $VerificBrand = $brand->checkBrand($item->marca);

        if(empty($VerificBrand)){
          $brandId = $brand->create($item->marca);
        }

        $arrayProduct = array(
          $item->produto,
          $item->tamanho,
        );

        $verificProduct = $product->checkProduct($arrayProduct);

        if(empty($verificProduct)){

          if(empty($item->codigo)){
            $item->codigo = null;
          }

          $arrayProduct = array(
            $item->codigo,
            $item->produto,
            $item->tamanho,
            $item->preco,
            $brandId
          );

          $productId = $product->create($arrayProduct);

        }
      }

      $dataCompra = date('Y-m-d', strtotime($data->data));
      $arrayPed = array(
        $data->codigo,
        $customerId[0]['id'],
        $productId,
        $data->valorTotal,
        $dataCompra
      );

      $pedID = $ped->create($arrayPed);

    }

  }


  $list = $customer->listaOrderByMinValue();

  echo json_encode($list);

  $Cliente = $customer->MaiorCompraUnica2019();

  echo json_encode($list);

  $Cliente = $customer->MaisRealizaramCompras2018();

  echo json_encode($list);

