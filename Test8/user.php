<?php
/**
 * Class: User
 */

require_once("base.php");
class User {

    var $base;
    var $salt="allok2345";
   /**
   * Constructor for User
   */
	public function __constructor(){
      $this->base=new Base();
	}

   /**
    * Check user authorization
    * @return bool
    */
	public function is_authorized(){
     if (!isset($_SESSION))
         session_start();
     if (isset($_SESSION["userid"]))
         return true;
     else
         return false;
	}


    /**
     * check login in
     * @param string $email
     * @param string $pwd
     */
    public function check_login($email="", $pwd="")
    {
        if (!isset($_SESSION))
            session_start();
        $this->base=new Base();
        $userid=$this->base->check_login($email,md5($pwd.$this->salt));
        if ($userid>-1){
            $_SESSION["userid"]=$userid;
        }
    }

    /**
     * Switch language
     */
    public function switch_lang(){
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION["lang"])&&$_SESSION["lang"]==='ru')
            $_SESSION["lang"]='en';
        else
            $_SESSION["lang"]='ru';
    }

    /**
     * Get language constants from  config.php
     * @param $constant
     * @return mixed
     */
    public function get_lang_constant($constant){
     require_once('config.php');
     global $ru_lang;
     global $eng_lang;
     $tmp_array=$eng_lang;
     if (!isset($_SESSION))
         session_start();
     if (isset($_SESSION["lang"])&&$_SESSION["lang"]==='ru')
         $tmp_array=$ru_lang;

     $ret_val=$constant;
     foreach($tmp_array as $key=>$value)
     {
         if ($key===$constant)
             $ret_val=$value;
     }
     return $ret_val;
    }

	/**
    * Show login form
    */
	private function login_form(){
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" action="/forge/login.php" method="POST">
     <fieldset>
      <legend><?php echo $this->get_lang_constant("login_form_legend");?></legend>
       <a href="/forge/register.php"><?php echo $this->get_lang_constant("sign_in")?></a>

       <div class="control-group">
        <label class="control-label" for="login"><?php echo $this->get_lang_constant("email");?></label>
        <div class="controls">
         <input type="text" id="login" name="login" placeholder="<?php echo $this->get_lang_constant("email_placeholder");?>"/><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="pwd"><?php echo $this->get_lang_constant("pwd");?></label>
        <div class="controls">
          <input type="password" id="pwd" name="pwd" value=""/><br/>
         </div>
       </div>

       <div class="control-group">
        <div class="controls">
         <button type="submit" class="btn"><?php echo $this->get_lang_constant('login_btn');?></button>
        </div>
       </div>

      </div>
    </fieldset>
   </form>

    <?php
	}

	/**
    * Show signin form
    */
	public function signin_form(){
    ?>
     <legend><?php echo $this->get_lang_constant('si_form_legend');?></legend>
     <table id="myTable" class="table table-bordered" width="10%">
     <tbody>
      <tr>	
      	<td width="50%">
          <form class="form-horizontal" enctype="multipart/form-data" action="/forge/signin.php" method="POST">
          <fieldset>
      
      
           <div class="control-group">
             <label class="control-label" for="first"><?php echo $this->get_lang_constant('first');?></label>
             <div class="controls">
              <input type="text" id="first" name="first" placeholder="<?php echo $this->get_lang_constant('first_p');?>"/><br/>
             </div>
           </div>

          <div class="control-group">
           <label class="control-label" for="last"><?php echo $this->get_lang_constant('last');?></label>
            <div class="controls">
             <input type="text" id="last" name="last" placeholder="<?php echo $this->get_lang_constant('last_p');?>" /><br/>
            </div>
           </div>

          <div class="control-group">
           <label class="control-label" for="phone"><?php echo $this->get_lang_constant('phone');?></label>
           <div class="controls">
            <input type="text" id="phone" name="phone" placeholder="<?php echo $this->get_lang_constant('phone_p');?>" /><br/>
           </div>
          </div>

          <div class="control-group">
           <label class="control-label" for="newlogin"><?php echo $this->get_lang_constant('email');?></label>
           <div class="controls">
            <input type="text" id="newlogin" name="newlogin" placeholder="<?php echo $this->get_lang_constant('email');?>" /><br/>
           </div>
          </div>

         <div class="control-group">
          <label class="control-label" for="pwd"><?php echo $this->get_lang_constant('pwd');?></label>
           <div class="controls">
            <input type="password" id="pwd" name="pwd" value=""/><br/>
           </div>
         </div>

         <div class="control-group">
          <label class="control-label" for="av"><?php echo $this->get_lang_constant('av');?></label>
          <div class="controls">
            <input type="file" id="av" name="av" value=""/><br/>
          </div>
         </div>

        <div class="control-group">
        <label class="control-label" for="birth"><?php echo $this->get_lang_constant('birth');?></label>
        <div class="controls">
         <div id="datetimepicker1" class="input-append date">
          <input data-format="dd.MM.yyyy" type="text" id="birth" name="birth" placeholder="<?php echo $this->get_lang_constant('birth_p');?>" value=""/>
          <span class="add-on">
           <i data-time-icon="icon-time" data-date-icon="icon-calendar">
           </i>
          </span>
          </div>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="marital"><?php echo $this->get_lang_constant('marital');?></label>
        <div class="controls">
         <select id="marital" name="marital">
         	<option value="m"><?php echo $this->get_lang_constant('m_option');?></option>
         	<option selected value="u"><?php echo $this->get_lang_constant('m_option');?></option>
         </select>
         	<br/>
        </div>
       </div>

        <div class="control-group">
        <label class="control-label" for="ed"><?php echo $this->get_lang_constant('ed');?></label>
        <div class="controls">
         <textarea class="form-control" id="ed" name="ed"><?php echo $this->get_lang_constant('ed_p');?></textarea><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="ex"><?php echo $this->get_lang_constant('ex');?></label>
        <div class="controls">
         <textarea class="form-control" id="ex" name="ex"><?php echo $this->get_lang_constant('ex_p');?></textarea><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="ad"><?php echo $this->get_lang_constant('ad');?></label>
        <div class="controls">
         <textarea class="form-control" id="ad" name="ad"><?php echo $this->get_lang_constant('ad_p');?></textarea><br/>
        </div>
       </div>

         <div class="control-group">
          <div class="controls">
           <button type="submit" class="btn"><?php echo $this->get_lang_constant('sign_in');?></button>
          </div>
         </div>

        </div>
       </fieldset>
      </form>
     </td>
     <td>
     	<div>
     		<p style="text-align:justify;"><span id="tooltip" style="color:#FF0000;">Please enter your first name.</span> Lorem ipsum dolor sit amet, ex legere mandamus vis, vim feugiat democritum scriptorem in. An vix suas paulo laoreet, ea vis malorum instructior. Te ius eius instructior, ius id tamquam tractatos. Quo ei dolores euripidis disputando, nam ad vitae dissentias signiferumque. Cetero alienum suscipit sed ad, utinam corpora lucilius quo in. Ei vel propriae sententiae.
             Vero gubergren ex nec. Phaedrum moderatius has ut, unum explicari in cum. Eu quo atqui mundi, tollit graecis phaedrum usu ex, velit vivendo has te. Ius perfecto sapientem posidonium ea.

             Omnis putant ei pro. Commodo recteque eum id, te eius augue elitr nec. His eu erat percipitur. Ad sit causae veritus dignissim. Postulant instructior interpretaris no sit.

             At sea duis accusam, sit fuisset efficiantur in. Admodum tacimates imperdiet at pro. Graece meliore accusamus sed at. Quo meliore oporteat at.

             Vis ridens iuvaret ne. Nec ei graeci lucilius salutatus, cu eam iusto latine. Sint liber ceteros an ius, eu eius malorum has. Vix ne laudem similique quaerendum, eum at etiam decore.</p> 
     	</div>
     </td>	
    </tr>
    <?php
	}

    /**
    * Show recovery password form
    */
	public function recovery_form(){
    ?>

    <?php
	}

    /**
    * Show profile
    */
	public function profile_form(){
    ?>
        <br/>
        <a href="/forge/logout.php"><?php echo $this->get_lang_constant('log_out');?></a>
        <?php
         $user_data=$this->get_data();
         if ($user_data!=null):
        ?>
        <legend><?php echo $this->get_lang_constant('profile');?></legend>
         <table id="myTable" class="table table-bordered" width="10%">
            <tbody>
            <tr>
                <td width="50%">
                    <form class="form-horizontal" enctype="multipart/form-data" action="/forge/update.php" method="POST">
                        <fieldset>


                            <div class="control-group">
                                <label class="control-label" for="first"><?php echo $this->get_lang_constant('first');?></label>
                                <div class="controls">
                                    <input type="text" id="first" readonly name="first" value="<?php echo $user_data["first"];?>"/><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="last"><?php echo $this->get_lang_constant('last');?></label>
                                <div class="controls">
                                    <input type="text" id="last" readonly name="last" value="<?php echo $user_data["last"];?>" /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="phone"><?php echo $this->get_lang_constant('phone');?></label>
                                <div class="controls">
                                    <input type="text" id="phone"  readonly name="phone" value="<?php echo $user_data["phone"];?>" /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="newlogin"><?php echo $this->get_lang_constant('email');?></label>
                                <div class="controls">
                                    <input type="text" id="newlogin" readonly name="newlogin" value="<?php echo $user_data["email"];?>" /><br/>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="birth"><?php echo $this->get_lang_constant('birth');?></label>
                                <div class="controls">
                                  <input type="text" id="birth" readonly name="birth"  value="<?php echo $user_data["birth"];?>"/>
                                </div>
                           </div>

                            <div class="control-group">
                                <label class="control-label" for="marital"><?php echo $this->get_lang_constant('marital');?></label>
                                <div class="controls">
                                    <select id="marital" readonly name="marital">
                                        <?php if ($user_data["marital"]==='m') :?>
                                         <option selected value="m"><?php echo $this->get_lang_constant('m_option');?></option>
                                         <option value="u"><?php echo $this->get_lang_constant('m_option');?></option>
                                        <?php else : ?>
                                            <option value="m"><?php echo $this->get_lang_constant('m_option');?></option>
                                            <option selected value="u"><?php echo $this->get_lang_constant('m_option');?></option>
                                        <?php endif ?>
                                    </select>
                                    <br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ed"><?php echo $this->get_lang_constant('ed');?></label>
                                <div class="controls">
                                    <textarea class="form-control" id="ed" readonly name="ed"><?php echo $user_data["ed"];?></textarea><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ex"><?php echo $this->get_lang_constant('ex');?></label>
                                <div class="controls">
                                    <textarea class="form-control" id="ex" readonly name="ex"><?php echo $user_data["ex"];?></textarea><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ad"><?php echo $this->get_lang_constant('ad');?></label>
                                <div class="controls">
                                    <textarea class="form-control" id="ad" readonly name="ad"><?php echo $user_data["ad"];?></textarea><br/>
                                </div>
                            </div>

                            </div>
                        </fieldset>
                    </form>
                </td>
                <td>
                    <div id="ava" style="float: left; width:40%">
                        <img src="<?php echo $user_data["av"];?>" alt="Avatar">
                    </div>
                    <div  style="float: left; width:50%">
                        <p style="text-align:justify;"><span id="tooltip" style="color:#FF0000;">Good day <?php echo $user_data["first"];?>.</span> Lorem ipsum dolor sit amet, ex legere mandamus vis, vim feugiat democritum scriptorem in. An vix suas paulo laoreet, ea vis malorum instructior. Te ius eius instructior, ius id tamquam tractatos. Quo ei dolores euripidis disputando, nam ad vitae dissentias signiferumque. Cetero alienum suscipit sed ad, utinam corpora lucilius quo in. Ei vel propriae sententiae.
                            Vero gubergren ex nec. Phaedrum moderatius has ut, unum explicari in cum. Eu quo atqui mundi, tollit graecis phaedrum usu ex, velit vivendo has te. Ius perfecto sapientem posidonium ea.

                            Omnis putant ei pro. Commodo recteque eum id, te eius augue elitr nec. His eu erat percipitur. Ad sit causae veritus dignissim. Postulant instructior interpretaris no sit.

                            At sea duis accusam, sit fuisset efficiantur in. Admodum tacimates imperdiet at pro. Graece meliore accusamus sed at. Quo meliore oporteat at.

                            Vis ridens iuvaret ne. Nec ei graeci lucilius salutatus, cu eam iusto latine. Sint liber ceteros an ius, eu eius malorum has. Vix ne laudem similique quaerendum, eum at etiam decore.</p>
                    </div>
                </td>
            </tr>
            <?php
            endif;
	}

    /**
    *  Main function 
    */
	public function login(){
     if (!$this->is_authorized())
        $this->login_form();
     else 
     	$this->profile_form();
	}

    /**
     * Check Email In Base (double login protection)
     * @param string $email
     * @return bool
     */
    public function CheckEmailInBase($email="")
    {
      $this->base=new Base();
      return $this->base->check_email($email);
    }

    /**
     *  Function for data validation
     * @param $key
     * @param $value
     * @return mixed
     */
	public function validate($key,$value){
      $retval=null;
      switch ($key){
          case "login":
              if (strlen($value)>10&&strpos($value,'@')!== false && $this->CheckEmailInBase($value))
                  $retval=$value;
              break;
          case "first":
              $retval=$value;
              break;
          case "last":
              $retval=$value;
              break;
          case "phone":
              if (ctype_digit($value))
                  $retval=$value;
              break;
          case "pwd":
              if (strlen($value)>6)
                  $retval=md5($value.$this->salt);
              break;
          case "av":
              $retval=$value;
              break;
          case "birth":
              $retval=$value;
              break;
          case "marital":
              $retval=substr($value,0,1);
              break;
          case "ed":
              $retval=$value;
              break;
          case "ex":
              $retval=$value;
              break;
          case "ad":
              $retval=$value;
              break;
      }
      return $retval;
	}

     /**
     *  Function for save  data to database
     * @param $userdata
     * @return error
     */
    public function set_data($userdata){
        $this->base=new Base();
        return $this->base->save_user_data($userdata);
    }

    /**
     *  Function for get  data from database
     * @return array
     */
    public function get_data(){
       if (!isset($_SESSION))
        session_start();

       if (isset($_SESSION["userid"])) {
           $this->base = new Base();
           return $this->base->get_user_data($_SESSION["userid"]);
       } else
           return null;
    }

    public function logout(){
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION["userid"]))
          unset($_SESSION["userid"]);
    }

}