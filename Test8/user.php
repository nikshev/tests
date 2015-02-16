<?php
/**
 * Class: User
 */

require_once("base.php");
class User {

    var $base;
   /**
   * Constructor for User
   */
	public function __constructor(){
      $this->base=new Base();
	}

   /**
    * Check user authorization
    */
	public function is_authorized(){
    
	}

	/**
    * Show login form
    */
	private function login_form(){
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" action="login.php" method="POST">
     <fieldset>
      <legend>login form</legend>
      
       <div class="control-group">
        <label class="control-label" for="login">Email</label>
        <div class="controls">
         <input type="text" id="login" name="login" placeholder="Please enter your login..." /><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="pwd">Password</label>
        <div class="controls">
          <input type="password" id="pwd" name="pwd" value=""/><br/>
         </div>
       </div>

       <div class="control-group">
        <div class="controls">
         <button type="submit" class="btn">login</button>
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
     <legend>Sign In form</legend>
     <table id="myTable" class="table table-bordered" width="10%">
     <tbody>
      <tr>	
      	<td width="50%">
          <form class="form-horizontal" enctype="multipart/form-data" action="/forge/signin.php" method="POST">
          <fieldset>
      
      
           <div class="control-group">
             <label class="control-label" for="first">First name</label>
             <div class="controls">
              <input type="text" id="first" name="first" placeholder="Please enter your first name..." /><br/>
             </div>
           </div>

          <div class="control-group">
           <label class="control-label" for="last">Last name</label>
            <div class="controls">
             <input type="text" id="last" name="last" placeholder="Please enter your last name..." /><br/>
            </div>
           </div>

          <div class="control-group">
           <label class="control-label" for="phone">Phone</label>
           <div class="controls">
            <input type="text" id="phone" name="phone" placeholder="Please enter your phone number..." /><br/>
           </div>
          </div>

          <div class="control-group">
           <label class="control-label" for="newlogin">Email</label>
           <div class="controls">
            <input type="text" id="newlogin" name="newlogin" placeholder="Please enter your login..." /><br/>
           </div>
          </div>

         <div class="control-group">
          <label class="control-label" for="pwd">Password</label>
           <div class="controls">
            <input type="password" id="pwd" name="pwd" value=""/><br/>
           </div>
         </div>

         <div class="control-group">
          <label class="control-label" for="av">Avatar</label>
          <div class="controls">
            <input type="file" id="av" name="av" value=""/><br/>
          </div>
         </div>

        <div class="control-group">
        <label class="control-label" for="birth">Birth date</label>
        <div class="controls">
         <div id="datetimepicker1" class="input-append date">
          <input data-format="dd.MM.yyyy" type="text" id="birth" name="birth" placeholder="Please enter your birth date..." value=""/>
          <span class="add-on">
           <i data-time-icon="icon-time" data-date-icon="icon-calendar">
           </i>
          </span>
          </div>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="marital">Marital status</label>
        <div class="controls">
         <select id="marital" name="marital">
         	<option value="m">Married</option>
         	<option selected value="u">Unmarried</option>
         </select>
         	<br/>
        </div>
       </div>

        <div class="control-group">
        <label class="control-label" for="ed">Education</label>
        <div class="controls">
         <textarea class="form-control" id="ed" name="ed">Please enter your education</textarea><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="ex">Experience</label>
        <div class="controls">
         <textarea class="form-control" id="ex" name="ex">Please enter your experience</textarea><br/>
        </div>
       </div>

       <div class="control-group">
        <label class="control-label" for="ad">Additional info</label>
        <div class="controls">
         <textarea class="form-control" id="ad" name="ad">Please enter your additional info if you have</textarea><br/>
        </div>
       </div>

         <div class="control-group">
          <div class="controls">
           <button type="submit" class="btn">Sign in</button>
          </div>
         </div>

        </div>
       </fieldset>
      </form>
     </td>
     <td>
     	<div id="ava" style="float: left; width:40%">
     		<img src="https://odeworld.files.wordpress.com/2008/05/cdn10_mydeco_avatar.gif?w=490" alt="Mydeco blankie">
     	</div>	
     	<div  style="float: left; width:50%">
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
        <legend>Sign In form</legend>
        <table id="myTable" class="table table-bordered" width="10%">
            <tbody>
            <tr>
                <td width="50%">
                    <form class="form-horizontal" enctype="multipart/form-data" action="/forge/update.php" method="POST">
                        <fieldset>


                            <div class="control-group">
                                <label class="control-label" for="first">First name</label>
                                <div class="controls">
                                    <input type="text" id="first" name="first" placeholder="Please enter your first name..." /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="last">Last name</label>
                                <div class="controls">
                                    <input type="text" id="last" name="last" placeholder="Please enter your last name..." /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="phone">Phone</label>
                                <div class="controls">
                                    <input type="text" id="phone" name="phone" placeholder="Please enter your phone number..." /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="newlogin">Email</label>
                                <div class="controls">
                                    <input type="text" id="newlogin" name="newlogin" placeholder="Please enter your login..." /><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="pwd">Password</label>
                                <div class="controls">
                                    <input type="password" id="pwd" name="pwd" value=""/><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="av">Avatar</label>
                                <div class="controls">
                                    <input type="file" id="av" name="av" value=""/><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="birth">Birth date</label>
                                <div class="controls">
                                    <div id="datetimepicker1" class="input-append date">
                                        <input data-format="dd.MM.yyyy" type="text" id="asd" name="asd" placeholder="Please enter your birth date..." value=""/>
          <span class="add-on">
           <i data-time-icon="icon-time" data-date-icon="icon-calendar">
           </i>
          </span>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="marital">Marital status</label>
                                <div class="controls">
                                    <select id="marital" name="marital">
                                        <option value="m">Married</option>
                                        <option selected value="u">Unmarried</option>
                                    </select>
                                    <br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ed">Education</label>
                                <div class="controls">
                                    <textarea class="form-control" id="ed" name="ed">Please enter your education</textarea><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ex">Experience</label>
                                <div class="controls">
                                    <textarea class="form-control" id="ex" name="ex">Please enter your experience</textarea><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ad">Additional info</label>
                                <div class="controls">
                                    <textarea class="form-control" id="ad" name="ad">Please enter your additional info if you have</textarea><br/>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn">Sign in</button>
                                </div>
                            </div>

                            </div>
                        </fieldset>
                    </form>
                </td>
                <td>
                    <div id="ava" style="float: left; width:40%">
                        <img src="https://odeworld.files.wordpress.com/2008/05/cdn10_mydeco_avatar.gif?w=490" alt="Mydeco blankie">
                    </div>
                    <div  style="float: left; width:50%">
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
    *  Main function 
    */
	public function login(){
      $this->signin_form();
     /*if (!$this->is_authorized)
        $this->login_form();
     else 
     	$this->profile_form();*/
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
              if (strlen($value)>10&&strpos($value,'@')!== false)
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
                  $retval=md5($value);
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
     * @param $userid
     * @return array
     */
    public function get_data($userid){
       $this->base=new Base();
       return $this->base->get_user_data($userid);
    }

}