<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Crosstab extends CI_Model {

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
    
    function __construct() {
        parent::__construct();
         

            
    }
	
}	