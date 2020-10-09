
var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];


 let today = new Date();
let thisMonth = today.getMonth();                   
let thisYear = today.getFullYear();
let tDate =today.getDate();

function timeF() {
    thisYear = (thisMonth === 11) ? thisYear + 1 :thisYear;
    thisMonth = (thisMonth + 1) % 12;
    cali(thisMonth, thisYear);
}

function timeB() {
    thisYear = (thisMonth === 0) ? thisYear - 1 : thisYear;
    thisMonth = (thisMonth === 0) ? 11 : thisMonth - 1;
    cali(thisMonth, thisYear);
}

function cali(month,year){
    var blanks;
    var startDay = (new Date(year, month)).getDay();
    var html="<tr>";
    var days_in_month =new Date(year, month+1, 0).getDate();
    var count=1;
    for(var i=0; i<startDay;i++){
        html+="<td></td>";
      count++;
    }
     var day_num=1;
    while(day_num<=days_in_month){
            if(tDate==day_num && today.getMonth()==month){
                html+="<td class='todays'>";
            }else{
            html+="<td class='nonemp'>";}
            html+= day_num;
            html+="</td>";  
            day_num++;
            count++;
        if(count >7){
            html+= "</tr><tr>";
            count=1;
        }

        


    }
    while(count>1 && count <=7){
        html+="<td></td>";
        count++;
    }
    html+="</tr>"; 
    var tbod  = document.getElementById('dates');
    tbod.innerHTML=html;

    document.getElementById('whatis').innerHTML=months[thisMonth]+","+(thisYear);
}


