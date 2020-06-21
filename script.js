//bootstable.js
/*
Bootstable
 @description  Javascript library to make HMTL tables editable, using Bootstrap
 @version 1.1
 @autor Tito Hinostroza
*/
  "use strict";
  //Global variables
  var params = null;  		//Parameters
  var colsEdi =null;
  var newColHtml = 
'<button  id="bEdit" class="ui blue active button"  onclick="rowEdit(this);">'+
 '<i class="edit icon"></i>'+
'</button>'+

'<button id="loader"  style="display:none;width:60px;" class="ui small green loading button">Loading</button>'+
// '<button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowAcep(this);">' + 
// '<span class="glyphicon glyphicon-ok" > </span>'+
// '</button>'+
'<button  id="bAcep" class="ui green active button" style="display:none;" onclick="rowAcep(this);">'+
 '<i class="save icon"></i>'+
'</button>'+

// '<button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowCancel(this);">' + 
// '<span class="glyphicon glyphicon-remove" > </span>'+
// '</button>'+
    '</div>';
  var colEdicHtml = '<td name="buttons">'+newColHtml+'</td>'; 
    
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
    this.find('tbody tr').append(colEdicHtml);
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
    var dict1={};
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
        dict1={"roll":arr[i]};
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
        url:"handler.php",
        type:"POST",
        data:data,
        success:function(d)
        {
            if(d=="s")
            {
                 $(but).parent().find('#loader').hide();
                $(but).parent().find('#bEdit').show();
             }
            else{
                alert("Error")
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

function rowCancel(but) {
//Rechaza los cambios de la edición
    var $row = $(but).parents('tr');  //accede a la fila
    var $cols = $row.find('td');  //lee campos
    if (!ModoEdicion($row)) return;  //Ya está en edición
    //Está en edición. Hay que finalizar la edición
    IterarCamposEdit($cols, function($td) {  //itera por la columnas
        var cont = $td.find('div').html(); //lee contenido del div
        $td.html(cont);  //fija contenido y elimina controles
    });
    FijModoNormal(but);
}

 function rowEdit(but){

    var i=0;
     var $row = $(but).parents('tr');  //accede a la fila
    var $cols = $row.find('td');  //lee campos
    if (ModoEdicion($row)) return;  //Ya está en edición
    //Pone en modo de edición

    IterarCamposEdit($cols, function($td)
     {  //itera por la columnas

        if(i==0)
        {   
            i++;
        }
        else{

            var cont = $td.html(); //lee contenido
            //console.log(cont)
            var div = '<div style="display: none;">' + cont + '</div>';  //guarda contenido
            var input = '<div class="ui input"><input maxlength="1" size="02" type="text" value='+cont+'></div>';
            $td.html(div + input); 
            i+=1; //fija contenido
        }
            
    });

    $row.keypress(function(event){

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $row.find("#bAcep").click()
        }
    });
     FijModoEdit(but);
}



$("#table-list").SetEditable({
        $addButton: $('#add')
    });


