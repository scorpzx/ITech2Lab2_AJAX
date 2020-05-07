<?php
       
        include 'connect.php';
        header('Content-Type:application/json');
$res = $dbh -> prepare("SELECT `week_day`,`lesson_number`,`disciple`,`name`,`title`,`type` 
                        FROM `lesson` Left join lesson_groups on lesson.ID_Lesson=lesson_groups.FID_Lesson2
                        Left join lesson_teacher on lesson_teacher.FID_Lesson1=lesson.ID_Lesson
                        Left join groups on lesson_groups.FID_Groups=groups.ID_Groups
                        Left join teacher on lesson_teacher.FID_Teacher=teacher.ID_Teacher 
                        WHERE auditorium=(:aud)
                        ");
$res->bindParam(':aud', $aud);
$aud = $_GET['Third'];

// echo ';


$res->execute();

$result =$res->fetchAll(PDO::FETCH_OBJ);

echo json_encode($result);

// while($row = $res ->fetch(PDO::FETCH_ASSOC))
// {    
//              echo '<tr>
//                          <td>',$row['week_day'],'</td>',
//                         '<td>',$row['lesson_number'],'</td>',
//                         '<td>',$row['disciple'],'</td>',
//                         '<td>',$row['name'],'</td>',
//                         '<td>',$row['title'],'</td>',
//                         '<td>',$row['type'],'</td>',
               
//                 '</tr>';   
// }
// echo '</table><br><a href="index.php">Назад</a>';
 ?>