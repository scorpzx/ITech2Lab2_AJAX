 <?php
        include 'connect.php';
try{
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbh->beginTransaction();

$res0=$dbh->query("SELECT COUNT(*) from lesson");
$count=$res0 ->fetchColumn();

var_dump($count);
$dbh->query("INSERT INTO lesson SET 
ID_Lesson={$count},
week_day='".$_POST['week']."',
lesson_number={$_POST['number']},
auditorium='".$_POST['audN']."',
disciple='".$_POST['name']."',
type='Practical'");


$dbh->query("INSERT INTO lesson_groups SET 
FID_Lesson2={$count},
FID_Groups={$_POST['group']}");

$dbh->query("INSERT INTO lesson_teacher SET 
FID_Teacher={$_POST['teacher']},
FID_Lesson1={$count}");

$dbh->commit();
}
catch (Exception $e){
        $dbh->rollBack();
  echo "Ошибка: " . $e->getMessage();
}
echo '<br><a href="index.php">Назад</a>';

 ?>