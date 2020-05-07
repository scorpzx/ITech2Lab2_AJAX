 <?php
 //       echo $_GET['Second'];
        include 'connect.php';
        header('Content-Type: text/xml');

$res = $dbh -> prepare("SELECT `week_day`,`lesson_number`,`auditorium`,`disciple`,`title`,`type` 
                        FROM `lesson` Left join lesson_groups on lesson.ID_Lesson=lesson_groups.FID_Lesson2
                        Left join lesson_teacher on lesson_teacher.FID_Lesson1=lesson.ID_Lesson
                        Left join groups on lesson_groups.FID_Groups=groups.ID_Groups
                        WHERE lesson_teacher.FID_Teacher=(:teacher)
                        ");
$res->bindParam(':teacher', $teacher_tmp);
$teacher_tmp = $_GET['Second'];

//echo '<table border="1">',
//        '<tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>Group</th><th>type</th>';
$res->execute();
$result =$res->fetchAll();

?>

<response>
        <?php foreach ($result as $row):?>
        <week_day><?=$row['week_day']?></week_day>
        <lesson_number><?=$row['lesson_number']?></lesson_number>
        <auditorium><?=$row['auditorium']?></auditorium>
        <disciple><?=$row['disciple']?></disciple>
        <title><?=$row['title']?></title>
        <type><?=$row['type']?></type>
        <?php endforeach; ?>
</response>