let MedicinesStock  = (function($) {
"use strict";

/**
* Function to Delete files
**/
let deleteFile=(typeOfFile,fieldId,fieldName)=>{
  //create form data
  let formData = new FormData();
  //get file to delete
  let file = $('#'+fieldId).val();
  formData.append('file', file);
  formData.append('fieldName', fieldName);
  formData.append('typeOfFile', typeOfFile);
  formData.append('fieldId', fieldId);
  
  swal({
    title: "Are you sure?",
    text: "Are you sure you want to delete this "+typeOfFile,
    type: "warning",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },  ()=> {
    //submit file to back end
    $('input_feedback_'+fieldName+'_'+fieldId).html('<div class="alert alert-warning"><i class="fa fa-hourglass"></i> Deleting...</div>');
    $.ajax({
      url:"scripts/delete-upload-file.php",
      type:"post",
      data:formData,
      dataType: "json",
      contentType:false,
      processData: false,
      success: function(response){
        if(response.status=="success"){
          $('#input_feedback_'+fieldName+'_'+fieldId).html('');
          swal('Delete Success','File has been successfully deleted!','success');
          $("#"+fieldId).val('');
        }else{
          swal('Delete Failure','Failed to delete file','warning');
          $('#input_feedback_'+fieldName+'_'+fieldId).html('');
        }
      }
    });
  }); //end sweet alert
}
/**
* Function to upload files
**/
let uploadFile=(obj,typeOfFile,fieldId,fieldName)=>{
  //create form data
  let formData = new FormData();
  //get file to upload
  console.log(obj)
  let files = $(obj)[0].files[0];
  //add file to form data
  formData.append('file', files);
  formData.append('fieldName', fieldName);
  formData.append('typeOfFile', typeOfFile);
  formData.append('fieldId', fieldId);
  
  //submit file to back end
  $('#input_feedback_'+fieldName+'_'+fieldId).html('<div class="alert alert-warning"><i class="fa fa-hourglass"></i> Uploading...</div>');
  $.ajax({
    url:"scripts/upload-file.php",
    type:"post",
    data:formData,
    dataType: "json",
    contentType:false,
    processData: false,
    success: function(response){
      if(response.status=="success"){
        //get file url
        var url = response.url;
        //display file in feedback div, with option to delete it
        if(typeOfFile =='video'){
          url='img/video-thumbnail.png';
        } else if(typeOfFile =='file'){
          url='img/file-thumbnail.png';
        }
        var output ='<div id="" class="row m-3"><div class="col-sm-12 col-md-2 col-lg-2"><img src="'+url+'" class="rounded" style="width:100%"/></div><div class="col-sm-12 col-md-10 col-lg-10"><a href="javascript:void(0)" onclick="MedicinesStock.deleteFile(\''+typeOfFile+'\',\''+fieldId+'\',\''+fieldName+'\')" class="btn"><i class="fa fa-trash"></i> Delete Image</a></div></div>';
        $('#input_feedback_'+fieldName+'_'+fieldId).html(output);
        //update input with new url
        $("#"+fieldId).val(response.url);
      }else{
        swal('Upload Failure','Failed to upload file','warning');
        $('#input_feedback_'+fieldName+'_'+fieldId).html('');
      }
    }
  });
  
}
/**
* Function to initialize plugins on the form
**/
let initializePlugins=()=>{
}
/**
* Function to remove row from form table
**/
let removeFormTableRow=(tableId,obj)=>{
  let rowNo =obj.parentElement.parentElement.parentElement.rowIndex;
  document.getElementById(tableId).deleteRow((rowNo));
  let rows = document.getElementById(tableId).rows;
  let rowCount = 1;
  for(let i=1; i<rows.length; i++){
  if(!rows[i].innerHTML.replace(/\s/g, '')) continue;
  rows[i].innerHTML.replace(/<span class="rowCount">[0-9]<\/span>/g,'<span class="rowCount">'+(rowCount)+'<\/span>');
  rows[i].innerHTML.replace(/_row_[0-9]/g,'_row_'+rowCount);
  rowCount += 1;
  }
  localStorage.setItem("table_medicines_stock_id",tableId);
    localStorage.setItem("table_medicines_stock",(rows.length-1));
}

/**
* Function to add row from form table
**/
let addFormTableRow=(tableId,incrementRowCount=true)=>{
  let rowCount = document.getElementById(tableId).rows.length;
  let row = document.getElementById(tableId).rows[1];
  let rowHtml = row.innerHTML;
  rowHtml = rowHtml.replace(/<span class="rowCount">[0-9]<\/span>/,'<span class="rowCount">'+(rowCount-1)+'<\/span>');
  rowHtml = rowHtml.replace(/rmb d-none/,"rmb");
  rowHtml = rowHtml.replace(/<\/tr>/,"");
  rowHtml = rowHtml.replace(/<tr>/,"");
  rowHtml = rowHtml.replace(/_row_1/g,"_row_"+(rowCount-1));
  let tableBody = document.getElementById(tableId).getElementsByTagName('tbody')[0];
  tableBody.insertRow().innerHTML =rowHtml;
  var lastDate = localStorage.getItem('_date_cache_');
  $('.datepicker').datepicker({
    format:'dd/mm/yyyy',
    todayBtn:'linked',
        defaultViewDate:isEmpty(lastDate)?'today':lastDate,
  }) ;
  var i = rowCount-1; //add row number
  var id = undefined;
  var storedValue = undefined;
  id = 'input-medicines-stock-i-d' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-n-a-m-e' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-batch-id' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-expiry-date' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-q-u-a-n-t-i-t-y' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-m-r-p' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  id = 'input-medicines-stock-r-a-t-e' +'_row_' + i;
  storedValue = localStorage.getItem(id);
  if(storedValue){
    $('#'+id).val(storedValue);
  }
  if(incrementRowCount){
    localStorage.setItem("table_medicines_stock",rowCount-1);
  }
  localStorage.setItem("table_medicines_stock_id",tableId);
}

let divPageContent = $('#page-content');
let viewMedicinesStock=( ID)=>{
  let viewInModal = $('#link-view-medicines-stock').data('viewInModal'); 
    loader(divPageContent);
  $.ajax({
    url: "pages/view-medicines-stock.php",
    type: "post",
    data: { 
      ID:ID
     },
    success: (data)=>{
        divPageContent.html(data);
      $('#table-medicines-stock').DataTable({});
    }
  });
}

let addNewMedicinesStock=(data)=>{
  $('#dataInputModal').modal('show');
  $.ajax({
    url: "forms/medicines-stock-form.php",
    type: "get",
    data:data,
    success: (data)=>{
      $('#dataInputModalBody').html(data);
      initializePlugins();
      var lastDate = localStorage.getItem('_date_cache_');
      $('.datepicker').datepicker({
        format:'dd/mm/yyyy',
        todayBtn:'linked',
        defaultViewDate:isEmpty(lastDate)?'today':lastDate,
      }) ;
    }
  });
}

 let submitFormMedicinesStock = (e,args) =>{
  e.preventDefault();
  let oForm = document.getElementById('form-medicines-stock');
  let elements = oForm.elements;
  let data = {};
  let tinyFields = [];
  for(let i=0; i<elements.length; i++){
    let element = elements[i];
    if(tinyFields.indexOf(element.name)!=-1){
      data[element.name] =  tinymce.activeEditor.getContent();
    }else{
      data[element.name]=element.value;
    }
  };
  console.log('medicines_stock',data);
  $('#form-submit-feedback').html('<div class="alert alert-warning"><i class="fa fa-hourglass"></i> Submitting. Please wait...</div>');
  $('#form-submit-button').prop('disabled', true);
  $.ajax({
    url: "scripts/submit-medicines-stock-form.php",
    type: "post",
    dataType:"json",
    data:data,
    success: (data)=>{
      $('#form-submit-button').prop('disabled', false);
      if(data.status == "success"){
        $('#form-submit-feedback').html('<div class="alert alert-success"><i class="fa fa-check"></i> '+data.message+'</div>');
  $('#dataInputModal').modal('hide');
        viewMedicinesStock(args);
        swal(data.title,data.message,'success');
      }else{
        $('#form-submit-feedback').html('<div class="alert alert-danger"><i class="fa fa-times"></i> '+data.message+'</div>');
        swal(data.title,data.message,'warning');
      }
    }
  });
}

/**
/*
/* function to delete item 
/*
**/
 let deleteMedicinesStock = (medicinesStockId) =>{
  swal({
    title: "Are you sure you want to delete this item?",
    text: "If you are sure you want to delete; proceed and click okay below. Otherwise, cancel to abort.",
    type: "warning",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },  ()=> {
    $.ajax({
      url: "scripts/delete-medicines-stock-item.php",
      type: "post",
      dataType: "json",
      data:{medicinesStockId: medicinesStockId},
      success: (data)=>{
        if(data.status == "success"){
          viewMedicinesStock();
          swal(data.title,data.message,'success');
      }else{
          swal(data.title,data.message,'warning');
        }
      }
    });
  });
};

$(document).ready(()=>{
  $('#link-view-medicines-stock').off().on('click',()=>{
    viewMedicinesStock();
  });

  $('#add-new-medicines-stock').on('click',()=>{
    addNewMedicinesStock();
  });
});

 return {
   addNewMedicinesStock:addNewMedicinesStock,
   deleteMedicinesStock:deleteMedicinesStock,
  removeFormTableRow:removeFormTableRow,
  addFormTableRow:addFormTableRow,
  viewMedicinesStock:viewMedicinesStock,
   submitFormMedicinesStock : submitFormMedicinesStock, 
   uploadFile : uploadFile, 
   deleteFile : deleteFile, 
}
})(jQuery); // End of use strict
