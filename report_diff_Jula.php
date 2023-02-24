<?php

include_once './db_connect.php';
include_once './functions.php';

sec_session_start();
ini_set("memory_limit", "512M");
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

//$StocktakeID = $_GET['StocktakeID'];

// Defaluse variable
$row = 1;
// get Client Name
//if ($stmt = $mysqli_asset->prepare("select CL_ClientName from `clients`")) {
//    $stmt->execute();
//    $stmt->store_result();
//    $stmt->bind_result($CL_ClientName);
//    $stmt->fetch();
//    $stmt->close();
//}
$CL_ClientName = "PCS ISD";
// get Client Name
//if ($stmt = $mysqli_asset->prepare("SELECT stocktake_table.StoreNumber,stocktake_table.StocktakeDate,store_table.ST_StoreName FROM stocktake_table INNER JOIN store_table ON stocktake_table.StoreNumber = store_table.ST_StoreNumber WHERE stocktake_table.StocktakeID = ?")) {
//    $stmt->bind_param('s', $StocktakeID);
//    $stmt->execute();
//    $stmt->store_result();
//    $stmt->bind_result($StoreNumber, $StocktakeDate, $StoreName);
//    $stmt->fetch();
//    $stmt->close();
//}
$StoreNumber = "0001";
$StocktakeDate = "02/10/2018";
$StoreName = "สำนักงานใหญ่";
//Update_Variance($mysqli_asset,1,"1234");


$html = '
<html><head>
      
	
	<style>
            .Header{
                font-family: Arial Black;
                text-align:center;
            }
            .textHeader{
                display: inline;
            }
            .valueUnderline{
                display: inline;
                text-decoration:underline;
            }
            .tableData{
                border-collapse: collapse;
                width: 100%;
                font-size: 14px;
            }
            .tableStore{
               
                font-weight:900;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 14px;
            }

            .tableData td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
              
            }

            .tableData tr:nth-child(even) {
                background-color: #dddddd;
            }
             
            
            
        </style>
</head><body>
<p class="Header" >' . $CL_ClientName . '<br>Diff Only Fixed asset By Code</p>
<table class=tableStore><tr>
<td><div class="textHeader">Zone : </div><div  class="valueUnderline">-</div></td>
<td><div class="textHeader">Area : </div><div  class="valueUnderline">-</div></td>
<td><div class="textHeader">ID : </div><div  class="valueUnderline">' . $StoreNumber . '</div></td>
<td><div class="textHeader">Branch : </div><div  class="valueUnderline">' . $StoreName . '</div></td>
<td><div class="textHeader">Area : </div><div  class="valueUnderline">Bangkok</div></td>
<td><div class="textHeader">Date : </div><div  class="valueUnderline">' . date("d/m/Y", strtotime($StocktakeDate)) . '</div></td>
</tr></table>
<hr size="5px" width="100%">
<table class=tableData>
 <thead>
    <th width=30><div  class="valueUnderline">No</div></th>
    <th width=100><div  class="valueUnderline">QRCode</div></th>
    <th width=100><div  class="valueUnderline">AssetCode</div></th>
    <th width=50><div  class="valueUnderline">Description</div></th>
    <th width=50><div  class="valueUnderline">Location</div></th>

  </thead>


';
$TolCount=0;
$TolQty=0;
$TolVariance=0;
// $sql = "SELECT QRCode,StoreNumber,Count,Qty,Variance FROM `ioh` Order By QRCode";
$sql = "SELECT tb_product_lookup_table.PL_Barcode, tb_product_lookup_table.PL_Description, tb_product_lookup_table.PL_Department
FROM tb_productdetail RIGHT JOIN tb_product_lookup_table ON tb_productdetail.PR_Barcode = tb_product_lookup_table.PL_Barcode
WHERE (((tb_productdetail.PR_Barcode) Is Null))
ORDER BY tb_product_lookup_table.PL_Description, tb_product_lookup_table.PL_Barcode;";

if ($stmt = $mysqli_asset->prepare($sql)) {
//            $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($PL_Barcode,$PL_Description,$location);
}


while ($stmt->fetch()) {
    $html .= '<tr><td width=30>'.$row.'</td><td></td><td>'.$PL_Barcode.'</td><td>'.$PL_Description.'</td><td>'.$location.'</td></tr>';
    $row += 1;

}

$html .= '
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    
    </tr>';
$html .= '</table>';

$html .= '<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    Auditor_______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager_______________________';
$html .= '<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    (_______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(_______________________)';

$html .= '</body></html>';

echo $html;
ob_clean();
