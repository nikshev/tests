<?php
/**
 * Comment form class
 */

require_once("observer.php");

class Comment implements EventHandler{

    var $link;
    var $host='mysql.hostinger.com.ua                        ';
    var $dbname='u781633213_task';
    var $dbuser='u781633213_task';
    var $password='ueFV8ocbuq';


    public function __construct(){

    }

    /**
     * Handler for event processing
     * @param Event $event
     */
    function handler(Event $event) {
            switch ($event->getType()) {
                case Event::ON_SUBMIT:
                    $source = $event->getSource();
                    //var_dump($source);
                    $this->store_to_database($source["subject"],$source["name"],$source["email"],$this->smiles($source["comment"]));
                break;
            }

       // print $event;
      //  print '';
    }

    /**
     * Replace smiles
     * @param $comment
     * @return string
     */
    public function smiles($comment){
      $str="";

      //Smile
      $smile=array(":)",":-)",":=)","(smile)");
      $str=str_replace($smile,'<img src="/nettask/smiles/ff.gif">',$comment);

      //Sad
      $sad=array(":(",":-(",":=(","(sad)");
      $str=str_replace($sad,'<img src="/nettask/smiles/sad.gif">',$str);

      //laugh
      $laugh=array(":D",":=D",":d",":-d",":=d","(laugh)");
      $str=str_replace($laugh,'<img src="/nettask/smiles/laugh.gif">',$str);

      return $str;

    }

    /**
     * Store data to database
     * @param string $subject
     * @param string $name
     * @param string $email
     * @param string $comment
     */
    public function store_to_database($subject="",$name="",$email="",$comment=""){
        $sql_command="INSERT INTO comment (";
        $sql_value="VALUES(";
        $value_count=0;
        $point="";

        if (!empty($subject)){
            $sql_command.=$point."subject";
            $sql_value.=$point."'".$subject."'";
            $value_count++;
            $point=",";
        }

        if (!empty($name)){
            $sql_command.=$point."name";
            $sql_value.=$point."'".$name."'";
            $value_count++;
            $point=",";
        }

        if (!empty($email)){
            $sql_command.=$point."email";
            $sql_value.=$point."'".$email."'";
            $value_count++;
            $point=",";
        }

        if (!empty($comment)){
            $sql_command.=$point."comment";
            $sql_value.=$point."'".$comment."'";
            $value_count++;
            $point=",";
        }

        $sql_command.=") ";
        $sql_value.=");";
        $query=$sql_command.$sql_value;
        //echo "value_count=".$value_count.",<br/>";
        //echo "query=".$query."<br/>";
        if ($value_count>2){
            $this->connect();
            mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
            $this->disconnect();
        } else {
            ?>
            <span style="color:#FF0000;">Need more info! Please fill more fields and try again!</span>
            <?php
        }
    }

    /**
     * Show comment form and stored comments
     */
    public function show(){
    ?>
    <table id="myTable" class="table table-bordered" width="10%">
     <tbody>
      <tr>
         <td>
            <form class="form-horizontal" enctype="multipart/form-data" action="/nettask/index.php" method="POST">
                <fieldset>

                    <div class="control-group">
                        <label class="control-label" for="subject">Subject</label>
                        <div class="controls">
                            <input type="text" id="subject" name="subject" placeholder="Please enter subject...."/><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">Your name</label>
                        <div class="controls">
                            <input type="text" id="name" name="name" placeholder="Enter your name...." /><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input type="text" id="email" name="email" placeholder="Please enter your email..." /><br/>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="comment">Comment</label>
                        <div class="controls">
                            <textarea class="form-control" id="comment" name="comment"></textarea><br/>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </div>

                    </div>
                </fieldset>
            </form>
        </td>
      </tr>
      <?php
      $query = "SELECT * FROM comment";
      $this->connect();
      $result=mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
        while($row=mysql_fetch_assoc($result)) {
            ?>
            <tr> 
               <td>
                <p>
                   <span style="color:#F05FFF;"><?php echo $row["name"]."(".$row["email"].") at ".$row["posted"]." said:";?>
                   </span>
                    <?php echo $row["comment"];?>
                </p>
               </td>
            </tr>
        <?php
        }
            ?>
     </tbody>
     </table>
   <?php
    }

    /**
     * Update comment table (submit comment)
     * @param null $parameters
     */
    public function update($parameters=null){
       if (!empty($parameters))
        Observer::notify(new Event(Event::ON_SUBMIT, $this, $parameters));
    }

    /**
     * Connect with database
     */
    function connect(){
        $this->link = mysql_connect($this->host, $this->dbuser,$this->password);
        if (!$this->link) {
            die('Connection error: ' . mysql_error());
        }
        mysql_select_db($this->dbname) or die('Database error: ' . mysql_error());

    }

    /**
     * Disconnect
     */
    function disconnect(){
        if (isset($this->link))
            mysql_close($this->link);
    }

}