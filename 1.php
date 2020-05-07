 <?php
 var_dump($_GET);
        echo $_GET['First'];
        include 'connect.php';
$res = $dbh -> prepare("SELECT `week_day`,`lesson_number`,`auditorium`,`disciple`,`name`,`type` 
                        FROM `lesson` inner join lesson_groups on lesson.ID_Lesson=lesson_groups.FID_Lesson2
                        inner join lesson_teacher on lesson_teacher.FID_Lesson1=lesson.ID_Lesson
                        inner join teacher on lesson_teacher.FID_Teacher=teacher.ID_Teacher
                        WHERE lesson_groups.FID_Groups=(:group)
                        ");
$res->bindParam(':group', $group_tmp);
$group_tmp = $_GET['First'];
echo '<table border="1">',
        '<tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>name</th><th>type</th>';
$res->execute();
while($row = $res ->fetch(PDO::FETCH_ASSOC))
{    
             echo '<tr>
                         <td>',$row['week_day'],'</td>',
                        '<td>',$row['lesson_number'],'</td>',
                        '<td>',$row['auditorium'],'</td>',
                        '<td>',$row['disciple'],'</td>',
                        '<td>',$row['name'],'</td>',
                        '<td>',$row['type'],'</td>',
               
                '</tr>';   
}
echo '</table>';
 ?>