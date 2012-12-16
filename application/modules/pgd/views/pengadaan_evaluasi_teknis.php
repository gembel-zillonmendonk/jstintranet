<?php $this->load->helper('form'); ?>

      <form id="frmEvaluasiTeknis" method="POST" action="add_tender" >
<div class="accordion"> 
   <h3 href="">PERBANDINGAN PENAWARAN TEKNIS</h3>
            <div>
                <fieldset class="ui-widget-content">
                     <p>	
                         <?php echo form_label("Bobot Teknis") ?>
                         <input type="text" style="width: 50%" readonly="true"  value="" />
                     </p>
                     <p>	
                         <?php echo form_label("Passing Grade") ?>
                         <input type="text" style="width: 50%" readonly="true"  value="" />
                     </p>
                </fieldset>     
             </div>
   <h3 href="">NILAI</h3>
            <div>
            </div>
   <h3 href="">KOMENTAR</h3>
            <div>
            </div>
   
   
   
   
</div> 
      </form>

<script>
$(document).ready(function(){
    $(".accordion")
    .addClass("ui-accordion ui-widget ui-helper-reset")
    //.css("width", "auto")
    .find('h3')
    .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
    .css("padding", ".5em .5em .5em .7em")
    //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
    .next()
    .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
    .css('overflow','visible')
});
    

</script>
          
