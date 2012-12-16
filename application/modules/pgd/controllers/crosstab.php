<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Crosstab extends MX_Controller {
    
    
 /*
  * $sql = PivotTableSQL(
        $gDB,                                                                                   # adodb connection
        'products p ,categories c ,suppliers s',                # tables
        'CompanyName,QuantityPerUnit',                                  # row fields
        'CategoryName',                                                                 # column fields 
        'p.CategoryID = c.CategoryID and s.SupplierID= p.SupplierID' # joins/where
);
 print "<pre>$sql";
 $rs = $gDB->Execute($sql);
 rs2html($rs);
 
  */   
    function PivotTableSQL(&$db,$tables,$rowfields,$colfield, $where=false,
        $aggfield = false,$sumlabel='Sum ',$aggfn ='SUM', $showcount = true)
 {
        if ($aggfield) $hidecnt = true;
        else $hidecnt = false;
        
         $iif = false;
       // $iif = strpos($db->databaseType,'access') !== false; 
                // note - vfp 6 still doesn' work even with IIF enabled || $db->databaseType == 'vfp';
        
        //$hidecnt = false;
        
        if ($where) $where = "\nWHERE $where";
        //if (!is_array($colfield)) $colarr = $db->GetCol("select distinct $colfield from $tables $where order by 1");
        $query = $this->db->query("select distinct $colfield from $tables $where order by 1"); 
        //echo "select distinct $colfield from $tables $where order by 1";
        
        /*
        foreach ($query->list_fields() as $field)
         {
             $colarr[$field] =  $field;
         } 
         */
        
        foreach ($query->result_array() as $field)
         {
             $colarr[$field[$colfield]] =   "'". $field[$colfield] . "'"  ;
         }
        
        if (!$aggfield) $hidecnt = false;
         
        
        $sel = "$rowfields, ";
        if (is_array($colfield)) {
                foreach ($colfield as $k => $v) {
                        $k = trim($k);
                        if (!$hidecnt) {
                                $sel .= $iif ? 
                                        "\n\t$aggfn(IIF($v,1,0)) AS \"$k\", "
                                        :
                                        "\n\t$aggfn(CASE WHEN $v THEN 1 ELSE 0 END) AS \"$k\", ";
                        }
                        if ($aggfield) {
                                $sel .= $iif ?
                                        "\n\t$aggfn(IIF($v,$aggfield,0)) AS \"$sumlabel$k\", "
                                        :
                                        "\n\t$aggfn(CASE WHEN $v THEN $aggfield ELSE 0 END) AS \"$sumlabel$k\", ";
                        }
                } 
        } else {
                foreach ($colarr as $v) {
                       // if (!is_numeric($v)) $vq =   $db->qstr($v);  
                        if (!is_numeric($v)) $vq =     $v ;  
                        
                    else $vq = $v;
                        $v = trim($v);
                        if (strlen($v) == 0     ) $v = 'null';
                         
                        if (!$hidecnt) {
                                $sel .= $iif ?
                                        "\n\t$aggfn(IIF($colfield=$vq,1,0)) AS \"$v\", "
                                        :
                                        "\n\t$aggfn(CASE WHEN $colfield=$vq THEN 1 ELSE 0 END) AS \"$v\", ";
                        }
                        if ($aggfield) {
                                if ($hidecnt) $label = $v;
                                else $label = "{$v}_$aggfield";
                                $sel .= $iif ?
                                        "\n\t$aggfn(IIF($colfield=$vq,$aggfield,0)) AS \"$label\", "
                                        :
                                        "\n\t$aggfn(CASE WHEN $colfield=$vq THEN $aggfield ELSE 0 END) AS \"$label\", ";
                        } 
                          
                }
        }
        if ($aggfield && $aggfield != '1'){
                $agg = "$aggfn($aggfield)";
                $sel .= "\n\t$agg as \"$sumlabel$aggfield\", ";         
        }
        
        if ($showcount)
                $sel .= "\n\tSUM(1) as Total";
        else
                $sel = substr($sel,0,strlen($sel)-2);
        
        
        // Strip aliases
        $rowfields = preg_replace('/ AS (\w+)/i', '', $rowfields);
        
        $sql = "SELECT $sel \nFROM $tables $where \nGROUP BY $rowfields";
        
        return $sql;
 }

/* EXAMPLES USING MS NORTHWIND DATABASE */
 
 
    function pivot_sql(){
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR, P.KODE_VENDOR, P.KODE_BARANG_JASA, P.KODE_SUB_BARANG_JASA, P.HARGA   ";
        $sql .= " FROM EP_PGD_ITEM_PENAWARAN P ";
        
         
        $sql =   $this->PivotTableSQL($this->db, "EP_PGD_ITEM_PENAWARAN P, EP_VENDOR V, VW_BARANG_JASA J ", "P.KODE_BARANG_JASA, J.NAMA_BARANG_JASA ", "NAMA_VENDOR", "P.KODE_VENDOR = V.KODE_VENDOR AND P.KODE_BARANG_JASA =  J.KODE_BARANG_JASA AND P.KODE_SUB_BARANG_JASA =  J.KODE_SUB_BARANG_JASA ",  "P.HARGA","SUM");
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        // print_r($arr);        
                 
        foreach ($arr[0] as $k=>$v) {
            echo $arr[0][$k];
        }
        
       
    }
 
    
    public function index(){
       
        // BUAT ARRAY
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR, P.KODE_VENDOR, P.KODE_BARANG_JASA, P.KODE_SUB_BARANG_JASA, P.HARGA, T.HARGA AS HPS  ";
        $sql .= " FROM EP_PGD_ITEM_PENAWARAN P ";
        $sql .= " LEFT JOIN EP_PGD_ITEM_TENDER T ON  P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR =  T.KODE_KANTOR AND P.KODE_BARANG_JASA = T.KODE_BARANG_JASA AND  P.KODE_SUB_BARANG_JASA =  T.KODE_SUB_BARANG_JASA ";
         
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        
        print_r($arr);
        
        $i = count($arr);
        
        //  
        echo "<table border='1'>";
        $j=0;//row of $view
        $k=0; //row of $row
        $lastrowbarang = "" ;
        $barang = "" ;
            while ($k<$i)
            {
                echo "<tr>";
                $barang = $arr[$k]['KODE_BARANG_JASA'];
                    if(strcmp($lastrowbarang, $barang) !=0) {
                        echo $barang;
                        $j++; // get new row in array if project changed
                    }
                    $view[$j]['c1'] = $barang;
                    $view[$j]['c2'] = $arr[$k]['KODE_VENDOR'];
                    $view[$j]['c3'] = $arr[$k]['HARGA'];
                    
                    
                echo "<td>" . $view[$j]['c1'] . "</td>";
                echo "<td>" . $view[$j]['c2'] . "</td>";
                echo "<td>" . $view[$j]['c3'] . "</td>";
                 
                $lastrowbarang = $barang;
                $k++;
                echo "</tr>";
            }
         echo "</table>";   
         echo "<br/>";
        echo $j;
        print_r($view);
         echo "</table>";   
        
         for($i=1;$i<=$j;$i++)
        {
            $temp = "<tr><td/>".  $view[$i]['c1'] ."</td><td> " .   $view[$i]['c2']. "</td><td> " .  $view[$i]['c3'] .  "</td></tr>"; 
            echo $temp;
            
            
        }
         echo "<table>";   
        
         
        }
        
        
        
    public function pivot(){
       $this->load->library('pivot');
       

$recordset = array(
    array('host' => 1, 'country' => 'fr', 'year' => 2010, 'month' => 1, 'clicks' => 123, 'users' => 4),
    array('host' => 1, 'country' => 'fr', 'year' => 2010, 'month' => 2, 'clicks' => 134, 'users' => 5),
    array('host' => 1, 'country' => 'fr', 'year' => 2010, 'month' => 3, 'clicks' => 341, 'users' => 2),
    array('host' => 1, 'country' => 'es', 'year' => 2010, 'month' => 1, 'clicks' => 113, 'users' => 4),
    array('host' => 1, 'country' => 'es', 'year' => 2010, 'month' => 2, 'clicks' => 234, 'users' => 5),
    array('host' => 1, 'country' => 'es', 'year' => 2010, 'month' => 3, 'clicks' => 421, 'users' => 2),
    array('host' => 1, 'country' => 'es', 'year' => 2010, 'month' => 4, 'clicks' => 22,  'users' => 3),
    array('host' => 2, 'country' => 'es', 'year' => 2010, 'month' => 1, 'clicks' => 111, 'users' => 2),
    array('host' => 2, 'country' => 'es', 'year' => 2010, 'month' => 2, 'clicks' => 2,   'users' => 4),
    array('host' => 3, 'country' => 'es', 'year' => 2010, 'month' => 3, 'clicks' => 34,  'users' => 2),
    array('host' => 3, 'country' => 'es', 'year' => 2010, 'month' => 4, 'clicks' => 1,   'users' => 1),
);
 
echo "<h2>pivot on 'host'</h2>";
  $this->pivot->setRecordSet($recordset) ;
  $this->pivot->pivotOn(array('host'));
  $this->pivot->addColumn(array('year', 'month'), array('users', 'clicks',));
   $this->pivot->fetch();
// simpleHtmlTable($data);
       
    }
        
        
        
         
    
}
