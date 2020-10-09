function loadRoutine($showHere,$url){
    $.ajax({
     url:"../csv/"+$url,
     dataType:"text",
     success:function(data)
     {
      
      var r_data = data.split(/\r?\n|\r/);
      var table= '<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">';
      for(var count = 0; count<r_data.length; count++)
      {
       var cell_data = r_data[count].split(",");
       table += '<tr>';
       for(var cell_count=0; cell_count<cell_data.length; cell_count++)
       {
        if(count === 0){
         table += '<th>'+cell_data[cell_count]+'</th>';
        } else{
         table += '<td>'+cell_data[cell_count]+'</td>';
        }
       }
       table += '</tr>';
      }
      table += '</table>';
     
      $($showHere).html(table);
     }
    });
  
  }
  