<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

              <table width="100%">
                  <tr>
                        <td align="right"  >Sub Total HPS Tanpa PPN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($HPS_NON_PPN,0); ?></td>
                  </tr>  
                  <tr>
                        <td align="right"  >Sub Total HPS Dengan PPN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($HPS_KENA_PPN,0); ?></td>
                  </tr>  
                  <tr>
                        <td align="right"  >Total HPS</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($HPS_TOTAL,0); ?></td>
                  </tr>      
                  <tr>
                        <td align="right"   >PPN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($PPN,0); ?></td>
                  </tr>   
                  <tr>
                        <td align="right" style="color:red;font-weight: bold"  >TOTAL HPS SETELAH PPN</td>
                        <td align="right" style="color:red;font-weight: bold;border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($HPS_PPN,0); ?></td>
                  </tr>
                  <tr>
                        <td align="right"   >TOTAL PAGU ANGGARAN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;"  width="30%" ><?php echo number_format($PAGU_ANGGARAN,0); ?></td>
                  </tr>
                  <tr>
                        <td align="right"   >SISA PAGU ANGGARAN</td>
                        <td align="right" style="border-bottom: 1px solid #ccc;" width="30%" ><?php echo number_format($SISA_ANGGARAN,0); ?></td>
                  </tr>
                  
              </table>
              
 