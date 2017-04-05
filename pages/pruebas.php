<!DOCTYPE html>
<html>
    <head>
        <title>Brection</title>
        <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="styles/css/pruebas.css?<?php echo time(); ?>" type="text/css" />
    </head>
    <body>
        <div id="target" class="playground">
          Presiona los botones de abajo
        </div>
        
        <button id='fadein'>Aparecer</button>
        <button id='fadeout'>Desvanecer</button>
        <button id='fadeto'>Desvanecer a 0.3</button>
        <button id='fadeto1'>Aparecer a 1</button>
    </body>
</html>

<script language="javascript">
    $('document').ready(function() {
      
      $('#fadein').click(function(env) {
        
        $('#target').fadeIn(1000);
      });
      
      $('#fadeout').click(function(env) {
        
        $('#target').fadeOut(1000);
      });
      
      $('#fadeto').click(function(env) {
        
        $('#target').fadeTo(1000, 0.3);
      });
      
      $('#fadeto1').click(function(env) {
        
        $('#target').fadeTo(1000, 1.0);
      });
      
      
    
    });
</script>