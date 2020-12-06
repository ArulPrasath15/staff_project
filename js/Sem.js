


//  JavaScript File for Mark Entry Table

"use strict";
var key;
var params = null;  	
var colsEdi =null;
var newColHtml = 
'<button  id="bEdit" class="ui blue active button"  onclick="rowEdit(this);">'+
'<i class="edit icon"></i>'+
'</button>'+

'<button id="loader"  style="display:none;width:30px;" class="ui small green loading button">Loading</button>'+
// '<button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowAcep(this);">' + 
// '<span class="glyphicon glyphicon-ok" > </span>'+
// '</button>'+
'<button id="bAcep" class="ui green active button" style="display:none;" onclick="rowAcep(this);">'+
'<i class="save icon"></i>'+
'</button>'+

// '<button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowCancel(this);">' + 
// '<span class="glyphicon glyphicon-remove" > </span>'+
// '</button>'+
  '</div>';
var colEdicHtml = '<td name="buttons">'+newColHtml+'</td>'; 
var grade;
$.fn.SetEditable = function (options) {
  var defaults = {
      columnsEd: null,         //Index to editable columns. If null all td editables. Ex.: "1,2,3,4,5"
      $addButton: null,        //Jquery object of "Add" button
      onEdit: function() {},   //Called after edition
  onBeforeDelete: function() {}, //Called before deletion
      onDelete: function() {}, //Called after deletion
      onAdd: function() {}     //Called when added a new row
  };
  params = $.extend(defaults, options);
  this.find('thead tr').append('<th/>');  //encabezado vacío
  this.find('.item').append(colEdicHtml);
var $tabedi = this;   //Read reference to the current table, to resolve "this" here.
  //Process "addButton" parameter
  // if (params.$addButton != null) {
  //     //Se proporcionó parámetro
  //     params.$addButton.click(function() {
  //         rowAddNew($tabedi.attr("id"));
  //     });
  // }
  //Process "columnsEd" parameter
  if (params.columnsEd != null) {
      //Extract felds
      colsEdi = params.columnsEd.split(',');
  }

};
function IterarCamposEdit($cols, tarea) {
//Itera por los campos editables de una fila
  var n = 0;
  $cols.each(function() {
      n++;
      if ($(this).attr('name')=='buttons') return;  //excluye columna de botones
     // if (!EsEditable(n-1)) return;   //noe s campo editable
      tarea($(this));
  });
  
  function EsEditable(idx) {
  //Indica si la columna pasada está configurada para ser editable
      if (colsEdi==null) {  //no se definió
          return true;  //todas son editable
      } else {  //hay filtro de campos
//alert('verificando: ' + idx);
          for (var i = 0; i < colsEdi.length; i++) {
            if (idx == colsEdi[i]) return true;
          }
          return false;  //no se encontró
      }
  }
}
function FijModoNormal(but) {
  // $(but).parent().find('#bAcep').hide();
  // $(but).parent().find('#bCanc').hide();
  // $(but).parent().find('#bEdit').show();
  // $(but).parent().find('#bElim').hide();
  var $row = $(but).parents('tr');  //accede a la fila
  $row.attr('id', '');  //quita marca
}
function FijModoEdit(but) {
  console.log("edit");
  $(but).parent().find('#bAcep').show();
  $(but).parent().find('#bCanc').hide();
  $(but).parent().find('#bEdit').hide();
  $(but).parent().find('#bElim').hide();
  var $row = $(but).parents('tr');  //accede a la fila
  $row.attr('id', 'editing');  //indica que está en edición
}
function ModoEdicion($row) {
  if ($row.attr('id')=='editing') {
      return true;
  } else {
      return false;
  }
}
function rowAcep(but) {

  var arr=[];
  $(but).parent().find('#bAcep').hide();
  $(but).parent().find('#loader').show();
  $(but).parent().find('#bEdit').hide();
  var i=0;
  var $row = $(but).parents('tr');  //accede a la fila
  var $cols = $row.find('td'); 
  if (!ModoEdicion($row)) return;  //Ya está en edición
  //Está en edición. Hay que finalizar la edición
  $(but).parent().find('#bA').hide();
  IterarCamposEdit($cols, function($td) 
  {  //itera por la columnas
  
   if(i==0)
   {
      console.log($td.text());
      arr[i]=$td.text();
      i++;
      

   }
   else
   {
    var cont = $td.find('input').val();
    $td.html(cont);
    arr[i]=cont;
     i++;

   }
  });

  var data=$.param($cols.map(function(){
      return {
          name: $(this).attr('id'),
          value:$(this).text().trim()
      }
  }));

  
  $.ajax({
      url:"../Ajax/SemHandler.php",
      type:"POST",
      data:data,
      success:function(d)
      {
          // alert(d);
          if(d=="s")
          {
               $(but).parent().find('#loader').hide();
               $(but).parent().find('#bEdit').show();
           }
          else
          {
              alert("error");
              $(but).parent().find('#loader').hide();
              $(but).parent().find('#bEdit').show();
          }
        }
  });

  console.log(data)
  console.log(arr);
  FijModoNormal(but);
  params.onEdit($row);
}


function rowEdit(but){

  var i=0;
  var $row = $(but).parents('tr');  
  var $cols = $row.find('td'); 
  if (ModoEdicion($row)) return;  
  
  // Adding Input fields
  IterarCamposEdit($cols, function($td)
   {  

      if(i==0)
      {   
          i++;
      }
      else{

          if(i==1)
          {
            var cont = $td.html();
            //console.log(cont)
            var div = '<div style="display: none;">' + cont + '</div>';  
            var input = '<div class="ui input" ><input class="mytest" autofocus id="name-input" type="text" maxlength="2" style="width: 65px;" value='+cont+' ></input></div>';
            $td.html(div+input); 
            i+=1; 

          }
          else
          {

            var cont = $td.html();
            //console.log(cont) 
            var div = '<div style="display: none;">' + cont + '</div>';  
            var input = '<div class="ui input" ><input class="mytest1" id="name-input" type="text" maxlength="2" style="width: 65px;" value='+cont+' ></input></div>';
            $td.html(div+input); 
            i+=1; 

          }
         
      }
  });
  
  $("input.mytest").focus();
  $("input.mytest1").attr('readonly', 'true');
  $("input.mytest").keyup( checkLength );

  function checkLength()
  {
    this.value = this.value.toLocaleUpperCase(); 

      key=13;
      if( $(this).val() != "A+" && $(this).val() !="A" && $(this).val() !="B+" && $(this).val() !="B" && $(this).val() !="O" && $(this).val() !="RA" && $(this).val() !="WH"  && $(this).val() !="AB" && $(this).val() !="W" )
       { 

         
          key=0;
          $cols.find('input').attr('disabled', true);
          $(this).attr('disabled', false);   
          $(this).focus();
          $(this).css("border-color","red"); 
          $cols.find('#bAcep').prop('disabled', true);
          // alert("Invalid Entry");
          return; 

       }
      else
      {
        key=13;
        $cols.find('input').attr('disabled', false);
        $cols.find('button').attr('disabled', false);
        $(this).css("border-color","#ECECED"); 
      }
       //console.log($cols);
      var $total;
      var $count=1;
      
      
     // console.log($cols);
     // console.log($($cols).length);
      $($cols).each(function(){
          if($count==1 || $count==$($cols).length-1)
          {
              if($count==$($cols).length-1)
              {

                  $(this).find('.mytest1').val($total);
                  return;
              }
              else{
                  $count+=1;
              }
           }
          else
          {
              grade = $(this).find('.mytest').val();
              if(grade=="A")
              {
                $total=4;
              }
              if(grade=="A+")
              {
                $total=4.5;
              }
              if(grade=="B")
              {
                $total=3;
              }
              if(grade=="B+")
              {
                $total=3.5;
              }
              if(grade=="O")
              {
                $total=5;
              }
              if(grade=="WH")
              {
                $total="Withheld";
              }
              if(grade=="RA")
              {
                $total="Reappear";
              }
              if(grade=="AB")
              {
                $total="Absent";
              }
              if(grade=="W")
              {
                $total="Withdrawal";
              }
              $count++;
              
          }
      });
      // console.log($total);
      



}
  // Enter to save the data
  $row.keypress(function(event){

      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == key)
      {
          $row.find("#bAcep").click()
      }
  });

   FijModoEdit(but);
}

// Add a buttons column to the table

$("#table-list").SetEditable({
      $addButton: $('#add')
});
  