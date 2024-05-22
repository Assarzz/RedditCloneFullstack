<?php

/**
 * Instans av klassen skapar en koppling till databasen egytalk
 * och tillhandahåller ett antal metoder för att hämta och manipulera data i databasen.
 *
 */
class DbEgyTalk
{
   /**
    * Används i metoder genom $this->db</code>
    */
   private $db;

   /**
    * DbEgyTalk constructor.
    *
    * Skapar en koppling till databaseb egytalk
    */
   public function __construct()
   {
      // Definierar konstanter med användarinformation.
      define('DB_USER', 'egytalk');
      define('DB_PASSWORD', '12345');
      define('DB_HOST', 'mariadb');
      define('DB_NAME', 'egytalk');

      // Skapar en anslutning till MySql och databasen world
      $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
      $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);


   }

   /**
    * Kontrollerar av användare och lösen.
    * Skapar global sessions-array med användarinformation.
    *
    * @param  $userName  Användarnamn
    * @param  $password  Lösenord
    * @return $response användardata eller tom [] om inloggning misslyckas
    */
   function auth($userName, $password)
   {
      $response = [];



      /* Bygger upp sql frågan */
      $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :user");
      $stmt->bindValue(":user", $userName);
      $stmt->execute();

      // $errorCode = $stmt->errorCode();
      // $errorInfo = $stmt->errorInfo();

      // if ($errorCode !== '00000') {
      //     // There was an error
      //     echo "Error Code: $errorCode<br>";
      //     echo "Error Info: " . implode(", ", $errorInfo) . "<br>";
      // } else {
      //     // No error
      //     echo "Query executed successfully!<br>";

      //     echo "<br>";
      //     echo password_hash("abc123", PASSWORD_DEFAULT);
      //     echo "<br>";

      // }


      /* Kontroll att resultat finns */
      if ($stmt->rowCount() == 1) {
         // Hämtar användaren, kan endast vara 1 person
         $user = $stmt->fetch(PDO::FETCH_ASSOC);
         // Kontrollerar lösenordet, och allt ok.
         if (password_verify($password, $user['password'])) {
            $response['uid'] = $user['uid'];
            $response['firstname'] = $user['firstname'];
            $response['surname'] = $user['surname'];
         }
      }

      return $response;
   }

   /**
    * Hämtar anvädardata från användare med secifikt användarID
    * 
    * @param  $uid  användarID
    * @return $response användardata eller tom [] om ingen anvädare hittats eller fel inträffat
    */
   function getUserFromUid($uid)
   {

      // gets everything from user including uid

      $response = [];
      $stmt = $this->db->prepare("SELECT * FROM user WHERE uid = :uid");
      $stmt->bindValue(":uid", $uid);
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
         // Hämtar användaren, kan endast vara 1 person
         $user = $stmt->fetch(PDO::FETCH_ASSOC);

         $response = $user;

      }

      return $response;

   }
   function getUserFromUsername($username)
   {

      // gets everything from user including uid

      $response = [];
      $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
      $stmt->bindValue(":username", $username);
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
         // Hämtar användaren, kan endast vara 1 person
         $user = $stmt->fetch(PDO::FETCH_ASSOC);

         $response = $user;

      }

      return $response;

   }

   /**
    * Hämtar alla poster som gjorts på egytalk
    *
    * @return array med alla poster
    */
   function getAllPostsFromUid($uid)
   {
      $posts = [];
      $stmt = $this->db->prepare("SELECT * FROM post WHERE post.uid = :uid");
      $stmt->bindValue(":uid", $uid);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
         $posts[] = $row;
      }
      return $posts;
   }
   function getPosts($pidStart, $count)
   {
      // both pidStart and end is included
      //docker stop $(docker ps -a -q)  && docker rm $(docker ps -a -q)
      // overly ambitious failing statement: $sqlStatement = "SELECT post.*, user.firstname, user.surname, user.username, comment.cid, comment.comment_txt, comment.date FROM post INNER JOIN user ON post.uid = user.uid LEFT JOIN comment ON comment.pid = post.pid WHERE post.pid >= :pidStart && post.pid <= :pidEnd ORDER BY post.pid ASC;";

      $response = [];
      $stmt = $this->db->prepare("SELECT * FROM post WHERE pid >= :pidStart && pid <:pidStart + :count");
      $stmt->bindValue(":pidStart", $pidStart);
      $stmt->bindValue(":count", $count);
      // 0   1
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
         $response[] = $row;

      }
      return $response;

   }

   /**
    * Hämtar poster för en användare,
    * sorterade efter publiceringsdatum
    *
    * @param   $uid    användar-ID för användaren
    * @return  array med statusuppdateringar sorterade efter datum
    */
   function getPost($uid)
   {
      $posts = [];

      // KOD!

      return $posts;
   }

   /**
    * Hämtar alla kommentarer till en post
    *
    * @param  $pid postens ID-nummer
    * @return array med kommentarer sorterade efter datum
    */
   function getComments($pid)
   {
      $comments = [];

      // KOD!

      return $comments;
   }

   function getCommentsFromPid($pid)
   {
      $comments = [];

      $stmt = $this->db->prepare("SELECT comment.*, user.firstname, user.surname, user.username FROM 
      comment JOIN user
      ON comment.uid = user.uid
      WHERE comment.pid = :pid;");
      $stmt->bindValue(":pid", $pid);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
         $comments[] = $row;
      }
      return $comments;
   }

   function getCommentsAndOPFromUid($uid)
   {
      $comments = [];

      $sqlStatement = "SELECT
      c.cid,
      c.comment_txt,
      c.uid,
      c.pcid,
      p.pid AS ppid,
      COALESCE(pc.comment_txt, p.post_txt) AS parent_txt,
      COALESCE(pc.uid, p.uid) AS parent_uid
  FROM
      comment c
  LEFT JOIN
      comment pc ON c.pcid IS NOT NULL AND c.pcid = pc.cid
  LEFT JOIN
      post p ON c.pcid IS NULL AND c.pid = p.pid
  WHERE c.uid = :uid; ";

      $stmt = $this->db->prepare($sqlStatement);
      $stmt->bindValue(":uid", $uid);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {

         $row["user"] = $this->getUserFromUid($row["uid"]);
         $row["parentUser"] = $this->getUserFromUid($row["parent_uid"]);

         $comments[] = $row;
      }
      return $comments;
   }

   /**
    * Skapar ny samtalstråd.
    *
    * @param  $uid       Användar-ID
    * @param  $postTxt   Postat inlägg
    * @return true om det lyckades, annars false
    */
    function addPost($uid,$post_txt)
    {
       // $pid = filter_var($pid, FILTER_SANITIZE_NUMBER_INT);
       // $comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);
  
       // get current time that can be passed to mysql as a date
       $query = "INSERT INTO `post` (`pid`, `uid`, `post_txt`, `date`) VALUES (NULL, :uid, :post_txt, :date);";
       $stmt = $this->db->prepare($query);
       $stmt->bindValue(":post_txt", $post_txt);
       $stmt->bindValue(":uid", $uid);
       $stmt->bindValue(":date", date("Y-m-d H:i:s"));
       $result = $stmt->execute();
       $lastInsertId = $this->db->lastInsertId();
 
       // return last insert id only if it represnts the pid of the post
       if (is_numeric($lastInsertId) && $lastInsertId > 0) {
          return $lastInsertId;
       }
       return false;
    }

   /**
    * Lägger till en ny kommentar till en post.
    *
    * @param  $userID    Användar-ID för den som skriver kommentaren
    * @param  $statusID  Status-ID för statusuppdatering som kommenteras
    * @param  $comment   Kommentar
    * @return true om det lyckades, annars false
    */
   function addComment($uid, $pid, $comment_txt, $pcid)
   {
      // $pid = filter_var($pid, FILTER_SANITIZE_NUMBER_INT);
      // $comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);

      //INSERT INTO `comment` (`cid`, `pid`, `comment_txt`, `date`, `uid`, `pcid`) VALUES (NULL, '3', 'this is test comment', '2024-05-20 15:52:24.000000', '956eef04-c402-11ee-b2a4-0242ac150003', '4');

      // get current time that can be passed to mysql as a date
      $query = "INSERT INTO comment (cid, pid, comment_txt, date, uid, pcid) VALUES (NULL, :pid, :comment_txt, :date, :uid, :pcid);";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":pid", $pid);
      $stmt->bindValue(":comment_txt", $comment_txt);
      $stmt->bindValue(":uid", $uid);
      $stmt->bindValue(":pcid", $pcid);
      $stmt->bindValue(":date", date("Y-m-d H:i:s"));
      $result = $stmt->execute();
      $lastInsertId = $this->db->lastInsertId();

      // return last insert id only if it represnts the cid of the comment
      if (is_numeric($lastInsertId) && $lastInsertId > 0) {
         return $lastInsertId;
      // execute the command do the necessary, and return true if it was successful
      }
      return false;
   }

   /**
    * Lägger till en ny användare
    *
    * @param  $fname   Förnamn
    * @param  $sname   Efternamn
    * @param  $user    Användarnamn
    * @param  $pwd     Lösenord
    * @return true om det lyckades, annars false
    */
   function addUser($fname, $sname, $user, $pwd)
   {
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);

      // KOD!

   }

   /**
    * Hämtar alla avändare i nätverket
    * @return array med användare
    */
   function getAllUsers()
   {
      $users = [];

      $stmt = $this->db->prepare("SELECT * FROM user");

      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
         $users[] = $row;

      }

      return $users;
   }

   function getLikesFromContribution($pid, $cid)
   {

      $stmt = "";
      if (!is_null($pid)) {
         // we find the original comment with the pid
         $sqlStatement = "SELECT COUNT(*) AS like_count FROM likes WHERE likes.pid = :pid;";
         $stmt = $this->db->prepare($sqlStatement);
         $stmt->bindValue(":pid", $pid);

      } else {
         $sqlStatement = "SELECT COUNT(*) AS like_count FROM likes WHERE likes.cid = :cid;";
         $stmt = $this->db->prepare($sqlStatement);
         $stmt->bindValue(":cid", $cid);
      }
      $response = [];
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
         $data = $stmt->fetch(PDO::FETCH_ASSOC);

         $response = $data;

      }
      return $response;
   }
   function getDislikesFromContribution($pid, $cid)
   {

      $stmt = "";
      if (!is_null($pid)) {
         // we find the original comment with the pid
         $sqlStatement = "SELECT COUNT(*) AS dislike_count FROM dislikes WHERE dislikes.pid = :pid;";
         $stmt = $this->db->prepare($sqlStatement);
         $stmt->bindValue(":pid", $pid);



      } else {
         $sqlStatement = "SELECT COUNT(*) AS dislike_count FROM dislikes WHERE dislikes.cid = :cid;";
         $stmt = $this->db->prepare($sqlStatement);
         $stmt->bindValue(":cid", $cid);
      }
      $response = [];
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
         $data = $stmt->fetch(PDO::FETCH_ASSOC);

         $response = $data;

      }
      return $response;
   }

   function addLikeToContribution($uid, $pid, $cid)
   {

      //INSERT INTO `likes` (`like_id`, `uid`, `pid`, `cid`) VALUES (NULL, '956eef04-c402-11ee-b2a4-0242ac150003', '4', NULL);
      $sqlStatement = "INSERT INTO `likes` (`like_id`, `uid`, `pid`, `cid`) VALUES (NULL, :uid, :pid, :cid);";
      $stmt = $this->db->prepare($sqlStatement);
      $stmt->bindValue(":cid", $cid);
      $stmt->bindValue(":pid", $pid);
      $stmt->bindValue(":uid", $uid);

      $response = [];
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
         $data = $stmt->fetch(PDO::FETCH_ASSOC);

         $response = $data;

      }
      return $response;

   }

   /**
    * Söker efter användare.
    *
    * @param  $searchWord    Sökord
    * @return array med användare
    */
   function findUsers($searchWord)
   {
      $searchWord = filter_var($searchWord, FILTER_UNSAFE_RAW);
      $sql = "SELECT uid, firstname, surname FROM user WHERE firstname LIKE :search OR surname LIKE :search  ORDER BY surname, firstname";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(":search", "%$searchWord%");

      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   /**
    * Returnerar användarinstälningar
    * Förutsätter att mail och phone lagts till i tabllen user
    *
    * @param  $uid    användarens uid
    * @return json-obj med användardata, mail, phone
    */
   function getSettings($uid)
   {
      $settings = [];

      try {
         $stmt = $this->db->prepare("SELECT mail, phone FROM user WHERE uid = :uid");
         $stmt->bindValue(":uid", $uid);

         if ($stmt->execute())
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
      }

      return $settings;
   }


   /**
    * Uppdaterar användarinstälningar
    * Förutsätter att mail och phone lagts till i tabllen user
    *
    * @param  $uid      användarens uid
    * @param  $settings array med inställningar, $settings['phone'], $settings['mail']
    * @return true om uppdateringen lyckades
    */
   function setSettings($uid, $settings)
   {
      $success = false;

      // KOD!

      return $success;
   }

   /**
    * Verifierar om lösenord överenstämmer med användarens lösenord
    *
    * @param $uid    Användarens uid 
    * @param $pwd    Lösenord som skall testas
    * @return true   om löseordet är korrekt
    */
   private function verifyPassword($uid, $pwd)
   {
      $verified = false;

      try {
         $stmt = $this->db->prepare("SELECT password FROM user WHERE uid = :uid ");
         $stmt->bindValue(":uid", $uid);

         if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $verified = password_verify($pwd, $user['password']);
         }

      } catch (Exception $e) {
      }

      return $verified;
   }

   /**
    * Uppdaterar lösenorder
    *
    * @param  $uid      användarens uid
    * @param  $oldpwd   Nuvarande lösenord
    * @param  $pwd      Nytt lösenord
    * @return true om uppdateringen lyckades
    */
   function setPassword($uid, $oldpwd, $pwd)
   {
      $success = false;

      // KOD!

      return $success;
   }
}
