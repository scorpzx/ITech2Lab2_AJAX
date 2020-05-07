<html>
   <head>
   <meta charset="utf-8">
      <title>
          Расписание
     </title>
     <script>
     var ajax; // глобальная переменная для хранения обработчика запросов 
     //InitAjax(); 
     ajax = new XMLHttpRequest();

function get1()
{
    

    var requestVal = document.getElementById("First").value;

    ajax.onreadystatechange = result1; 
    var params ="First="+encodeURIComponent(requestVal);
    ajax.open("GET", "1.php?"+params, true);
    ajax.setRequestHeader("Content-type","application/x-www-formurlencoded");
    ajax.send(null);
    console.log(params);
}

function result1()
{
    if (ajax.readyState== 4)  
    {   
       
        if(ajax.status== 200) 
        {
            // If no errors
            var select = document.getElementById("FirstResult");
            select.innerHTML= ajax.responseText;
        }
        else alert(ajax.status+ " -" + ajax.statusText);
        ajax.abort();
    }
}

function get2()
{
    if (!ajax)
    {
        alert("Ajax not initialized");
        return;  
    }
    var valueSecond = document.getElementById("Second").value;

    ajax.onreadystatechange = result2; 
    var params = 'Second=' + encodeURIComponent(valueSecond);
    ajax.open("GET", "2.php?"+params, true);
    ajax.send(null)
}

function result2()
{
    if(ajax.readyState == 4) {
        
        if(ajax.status == 200) {
            var result_Addres = document.getElementById("SecondResult"); 
            var result = "";
            var xml = ajax.responseXML;

        var week_days     =xml.getElementsByTagName("week_day");
        var lesson_numbers=xml.getElementsByTagName("lesson_number");
        var auditoriums   =xml.getElementsByTagName("auditorium");
        var disciples     =xml.getElementsByTagName("disciple");
        var titles        =xml.getElementsByTagName("title");
        var types         =xml.getElementsByTagName("type");

           // alert(week_days.length);
            result += '<table border="1"><tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>Group</th><th>type</th>';

            for (var i = 0; i < week_days.length; i++) {
        result +='<tr>   <td>'+week_days[i].firstChild.nodeValue+'</td>'+
                        '<td>'+lesson_numbers[i].firstChild.nodeValue+'</td>'+
                        '<td>'+auditoriums[i].firstChild.nodeValue+'</td>'+
                        '<td>'+disciples[i].firstChild.nodeValue+'</td>'+
                        '<td>'+titles[i].firstChild.nodeValue+'</td>'+
                        '<td>'+types[i].firstChild.nodeValue+'</td>'+            
                 '</tr>'               
                
            }
            result += "</table>";
            result_Addres.innerHTML = result;
        }
        else alert(ajax.status+ " -" + ajax.statusText);
        ajax.abort();
    }
}

function get3()
{
    
    if (!ajax)
    {
        alert("Ajax not initialized");
        return;  
    }

    ajax.onload = function() {
        if(ajax.status===200) {
            //console.dir(ajax.response);
            let res = JSON.parse(ajax.response);
            let result = "";
            result += '<table border="1"><tr><th>week_day</th><th>lesson_number</th><th>disciple</th><th>name</th><th>Group</th><th>type</th>';
            for(let i in res) {
                result += '<tr>';
                result += '<td>' + res[i].week_day + '</td>'+
                          '<td>' + res[i].lesson_number + '</td>'+
                          '<td>' + res[i].disciple + '</td>'+
                          '<td>' + res[i].name + '</td>'+
                          '<td>' + res[i].title + '</td>'+
                          '<td>' + res[i].type + '</td>';
                result += '<tr>';
            }
        document.getElementById("ThirdResult").innerHTML = result;
        }
    }
    var valueThird = document.getElementById("Third").value;   
    var params = 'Third=' + encodeURIComponent(valueThird);
    ajax.open("GET", "3.php?"+params, true);
    ajax.send(null)
}


        
     </script>
   </head>
   <body>
<script src = "ajax.js"></script>
<?php 
include 'connect.php';


    echo '     <form method="GET">
                   <b>Вывести расписание занятий группы</b>
                   <select id="First">';

$res = $dbh -> query('select `ID_Groups`, `title` from `groups`');
while($row = $res ->fetch(PDO::FETCH_ASSOC))
{    
 echo'    <option value="',
$row['ID_Groups'],'">',$row['title'],
'</option>';   
}

      echo' </select>
                   <input type="button" value="Ок" onclick = "get1()">
                   
              <div id="FirstResult"></div>
                    </form>' ; 



   echo '     <form method="GET">
                   <b>Вывести расписание преподавателя</b>
                   <select id="Second">';

$res2 = $dbh -> query('select `ID_Teacher`, `name` from `teacher`');
while($row2 = $res2 ->fetch(PDO::FETCH_ASSOC))
{    
 echo'    <option value="',
$row2['ID_Teacher'],'">',$row2['name'],
'</option>';   
}

      echo' </select>
                   <input type="button" value="Ок" onclick = "get2()">
                   <div id="SecondResult"></div>
                    </form>' ; 





   echo '     <form method="GET">
                   <b>Вывести расписание для аудитории</b>
                   <select id ="Third">';

$res3 = $dbh -> query('select distinct `auditorium` from `lesson`');
while($row3 = $res3 ->fetch(PDO::FETCH_ASSOC))
{    
 echo'    <option value="',
$row3['auditorium'],'">',$row3['auditorium'],
'</option>';   
}

      echo' </select>
                   <input type="button" value="Ок" onclick = "get3()">
                   <div id="ThirdResult"></div>
                    </form>' ; 



   echo '     <form action="input.php" method="POST">
                   <b>Добавление нового ПЗ</b><br>
                    Введите день недели<br>
                   <input type="text" name="week"><br>
                    Введите номер пары<br>
                   <input type="number" min="1" name="number"><br>
                   Ввелите номер аудитории<br> 
                   <input type="text" name="audN"><br>
                   Введите название дисциплины<br> 
                   <input type="text" name="name"><br>
                   
                  <b>Выберите преподавателя</b>
                   <select name="teacher">';

$res2 = $dbh -> query('select `ID_Teacher`, `name` from `teacher`');
while($row2 = $res2 ->fetch(PDO::FETCH_ASSOC))
{    
 echo'    <option value="',
$row2['ID_Teacher'],'">',$row2['name'],
'</option>';   
}

      echo' </select>
<b>Выберите группу</b>
                   <select name="group">';

$res = $dbh -> query('select `ID_Groups`, `title` from `groups`');
while($row = $res ->fetch(PDO::FETCH_ASSOC))
{    
 echo'    <option value="',
$row['ID_Groups'],'">',$row['title'],
'</option>';   
}

      echo' </select><br>
       <input type="submit" name="send" value="Добавить">
                    </form>' ; 












?>
</body>
</html>