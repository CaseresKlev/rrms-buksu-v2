<?php
     
    $book_id= null;
    if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
        //mkdir($rootPath . "2018/");
    }else{
        //header("Location: ../404.php");
    }
    

?>

<!DOCTYPE html>
<html>
<head>
    <?php
    	include '../includes/header.php';
        $book_id;
        include $_SERVER['DOCUMENT_ROOT'] . "/rrms-buksu/includes/connection.php";
        $dbconfig= new dbconfig();
        $con= $dbconfig -> getCon();
        $book_id= null;
        $filename = $rootPath . "index.php";

/*
        if (file_exists($filename)) {
    echo "The $filename file exists";
} else {
    echo "The file $filename does not exist";
}

*/


    if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
       
    }else{
        //header("Location: ../404.php");
    }
    
    ?>
</head>
<body>
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <?php
                        $book_id;
                        $dbconfig= new dbconfig();
                        $con= $dbconfig -> getCon();
                            //$filter = $_GET['filter'];
                                $query= "SELECT book.book_id, book.book_title, book.cover, book.docloc, SUBSTRING(book.pub_date, 1, 4) as date, book.abstract FROM groupdoc INNER JOIN book on groupdoc.book_id = book.book_id INNER JOIN account ON account.id = groupdoc.accid WHERE book.enabled=1 and account.type = 'STUDENT' ORDER BY book.pub_date ASC limit 20";
                                $result = $con -> query($query);
                                if ($result->num_rows>0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $book_id = $row['book_id'];

                                        echo '<div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id='. $row['book_id'] .'>
                                    <img src="'. $rootPath  . $row['cover'] .'" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id='. $row['book_id'] .'">
                                        <h5 class="tittle">'. $row['book_title'] .'</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp';

                                    $query= 'SELECT author.`a_id`, CONCAT(author.`a_fname`, " ", SUBSTRING(author.`a_mname`, 1, 1), ". " , author.`a_lname`, " ", author.`a_suffix`) AS name FROM junc_authorbook INNER JOIN author on author.a_id = junc_authorbook.aut_id WHERE junc_authorbook.book_id = ' . $book_id;
                                                        $resultAut = $con -> query($query);
                                                        while ($author = $resultAut->fetch_assoc()) {
                                                            echo '<a href="author/?aut_id='. $author['a_id'] .'" class="author">' . $author['name']. '</a>, &nbsp';
                                                        }
                                        echo '&nbsp; -' .  $row['date'] . '</div>
                                <div class="row">
                                    <div class="text abstract">
                                    ' . $row['abstract'] . 
                                    '</div>
                                </div>
                                <div class="row keywords">
                                Key words: &nbsp; <i style="color:#3366ff">';

                                        $query= 'SELECT keywords.key_words FROM `junc_bookkeywords` INNER JOIN keywords on keywords.id = junc_bookkeywords.keywords_id WHERE junc_bookkeywords.book_id = ' . $book_id;
                                                        $resulKw = $con -> query($query);
                                                        if($resulKw->num_rows>0){
                                                            while($kw = $resulKw->fetch_assoc()){
                                                                echo $kw['key_words'] . ", "; 
                                                            }
                                                        }
                                        echo '</i>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }

                    ?>



                <div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                        &nbsp; - 2018
                                </div>
                                <div class="row">
                                    <div class="text abstract">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row keywords">
                                        Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                                </div>
                            </div>
                    </div>
                    <div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                        &nbsp; - 2018
                                </div>
                                <div class="row">
                                    <div class="text abstract">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row keywords">
                                        Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                                </div>
                            </div>
                    </div>
                    <div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                        &nbsp; - 2018
                                </div>
                                <div class="row">
                                    <div class="text abstract">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row keywords">
                                        Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                                </div>
                            </div>
                    </div>
                    <div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                        &nbsp; - 2018
                                </div>
                                <div class="row">
                                    <div class="text abstract">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row keywords">
                                        Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                                </div>
                            </div>
                    </div>
                    <div class="row entry">
                            <div class="col-md-2" id="cover-div">
                                <a href=research/?book_id=2>
                                    <img src="research/cover/5b98b3aed8a385.66287600.jpg" id="cover-img">
                                </a>
                            </div>
                            <div class="col-md-10" id="details">
                                <div class="row">
                                    <a href="research/?book_id=2">
                                        <h5 class="tittle">Bukidnon State University Research Record Management System</h5>
                                    </a>
                                </div>
                                <div class="row">
                                    By: &nbsp<a href="author/?aut_id=2" class="author">Klevie Jun R. Caseres </a>, &nbsp<a href="author/?aut_id=3" class="author">Anne P. Cruz </a>, &nbsp
                                                        &nbsp; - 2018
                                </div>
                                <div class="row">
                                    <div class="text abstract">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="row keywords">
                                        Key words: &nbsp;<i style="color:#3366ff">BukSu, Document Management, </i>
                                </div>
                            </div>
                    </div>
            </div>
            <!--widget area -->
            <!--related study-->
                <div class="col-md-4" id="related-study">
                      <div class="list-group" >
                        <div class="list-group-item bg-dark" id="widget-header">
                            Recent Post
                        </div>
                        <a href="#" class="list-group-item">First item</a>
                        <a href="#" class="list-group-item">Second item</a>
                        <a href="#" class="list-group-item">Third item</a>
                        <a href="#" class="list-group-item">Fourth item First item First item First item Fourth item First item First item First item</a>
                        <a href="#" class="list-group-item">Fifth item</a>
                      </div>

                       <div class="list-group" >
                        <div class="list-group-item bg-dark" id="widget-header">
                            Archive
                        </div>
                        <a href="#" class="list-group-item">2007</a>
                        <a href="#" class="list-group-item">2018</a>
                        <a href="#" class="list-group-item">2019</a>
                      </div>
                </div>
        </div>
    </div>

    <?php
        include '../includes/footer.php';
    ?>

<!-- JQUERY JS -->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min-4.1.0.js"></script>
</body>
</html>