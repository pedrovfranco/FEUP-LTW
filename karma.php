<?php
    function karma($id)
    {
        include_once("utilities.php");

        ini_set('display_errors', 1);
        
        $dbh = new PDO('sqlite:database.db');
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $query = $dbh->prepare('SELECT TOTAL(Upvotes-Downvotes) totalPosts FROM User U LEFT OUTER JOIN Post P ON U.idUser = P.idUser WHERE U.idUser = ? GROUP BY U.idUser');
        if (!$query->execute(array($id)))
        {
            echo "\nPDO::errorInfo():\n";
            print_r($dbh->errorInfo());
            echo "Error!<br>";
        }

        $totalPosts = $query->fetch()['totalPosts'];
        
        $query = $dbh->prepare('SELECT TOTAL(Upvotes-Downvotes) totalComments from User U LEFT OUTER JOIN Comment C ON U.idUser = C.idUser WHERE U.idUser = ? GROUP BY U.idUser
        ');
        if (!$query->execute(array($id)))
        {
            echo "\nPDO::errorInfo():\n";
            print_r($dbh->errorInfo());
            echo "Error!<br>";
        }

        $totalComments = $query->fetch()['totalComments'];

        $karma = $totalPosts+$totalComments;

        echo "$karma";
    }
    
?>