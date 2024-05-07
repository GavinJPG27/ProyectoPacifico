<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD
      //include '../PHP/conexion.php';
      //$consulta_info = $conexion->query("select * from Habitacion");
      //$dato_info = $consulta_info->fetch_object();

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Hotel el Pacifico'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(44, 77, 63);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("HABITACION(es) RESERVADA(s) "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(44, 77, 63); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(35, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('TIPO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('NUM_PERS'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('PRECIO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

include ('../otherpages/conexion.php');
$conexion = connection();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_info = $conexion->query("select * from habitacion");
//$dato_info = $consulta_info->fetch_object();
//$pdf->cell(15,10, utf8_decode($i),1,0,'C',0);
if ($consulta_info) {
   while ($datos_reporte = $consulta_info->fetch_object()) {
       // Ahora puedes acceder a las propiedades de $datos_reporte de forma segura
       $pdf->Cell(35, 10, utf8_decode($datos_reporte->nombre), 1, 0, 'C', 0);
       $pdf->Cell(30, 10, utf8_decode($datos_reporte->tipo), 1, 0, 'C', 0);
       $pdf->Cell(30, 10, utf8_decode($datos_reporte->numero_personas), 1, 0, 'C', 0);
       $pdf->Cell(25, 10, utf8_decode($datos_reporte->precio), 1, 1, 'C', 0);
   }
} else {
   // Manejar el caso en que la consulta no devuelva resultados
   echo "No se encontraron habitaciones";
}

/*while($datos_reporte = $consulta_reporte_reserva->fetch_object()){
   $i = $i + 1;

   $pdf->cell(15,10, utf8_decode($i),1,0,'C',0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->nombre_habi), 1, 0, 'C', 0);
   $pdf->Cell(20, 10, utf8_decode($datos_reporte->tipo), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->numero_personas), 1, 0, 'C', 0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->precio), 1, 1, 'C', 0);
}*/
/*$consulta_reporte_alquiler = $conexion->query("  ");*/

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
/* TABLA */


$pdf->Output('Reserva.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)