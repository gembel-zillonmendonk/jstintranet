<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

              <table width="100%">
                  <tr>
                        <td align="right"  >Total Pembelian</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($BELI_TOTAL,0); ?></td>
                  </tr>      
                  <tr>
                        <td align="right"   >PPN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($PPN,0); ?></td>
                  </tr>   
                  <tr>
                        <td align="right" style="color:red;font-weight: bold"  >TOTAL PEMBELIAN SETELAH PPN</td>
                        <td align="right" style="color:red;font-weight: bold;border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($BELI_PPN,0); ?></td>
                  </tr>
                   
              </table>
              
 