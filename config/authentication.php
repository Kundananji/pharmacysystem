
  <?php 

    class Authentication{



    /**
     * 
     * function to determine user profile
     *  @param $user : object with user details
     *  @returns array of profile details 
    **/  
    function getUserProfile($user){
      $profileId = $user['profile'];
      $sql ="SELECT id,name,description,isActive FROM _profile WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$profileId);
      $stmt->execute();
      $result = $stmt->get_result();
      $object = null;
      while($row=$result->fetch_assoc()){
        $object=$row;
      }
      $stmt->close();
      return $object;
    }


    /**
     * function to logout user
     * 
     */
    function logout(): void
      {
          

            // delete the user token
            $this->deleteUserToken($_SESSION["user_id"]);

            // delete session
            unset($_SESSION["username"], $_SESSION["user_id"], $_SESSION["user_profile"]);

            // remove the remember_me cookie
            if (isset($_COOKIE["remember_me"])) {
                unset($_COOKIE["remember_me"]);
                setcookie("remember_me", null, -1);
            }

            // remove all session data
            // uncommented because this will also logout crud generator
            //  session_destroy();          
        }

      /**
       *  Get User by Searching using the id field
       *  @param  userId: id of user to fetch by
       *  @return : array of record of user 
       * 
       */
      function getUserById($userId){
        try{
          $sql="SELECT * FROM users  WHERE id=?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("i",$userId);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }
      }

      /**
       *  Get User by Searching using the email field
       *  @param  email: email of user to fetch by
       *  @return : array of records of user 
       * 
       */
      function getUserByEmail($email){
        try{
          $sql="SELECT * FROM users  WHERE email=?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }
      }

      /**
       *  Get User by Searching using the username field
       *  @param username: email of user to fetch by
       *  @return : array of records of the user 
       * 
       */
      function getUserByUsername($username){

        try{
          $sql="SELECT * FROM `users` WHERE `username`=?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("s",$username);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }

      }

      /**
       *  Get User by Searching using the username or email field
       *  
       *  $param $username: username of user to fetch by
       *  @param $email: email of user to fetch by
       *  @return : array of records of the user 
       * 
       */

      function getUserByUsernameOrEmail($username,$email){
        
        try{
          $sql="SELECT * FROM `users`  WHERE `username`=? OR email=?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("ss",$username,$email);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }

      }

      /**
       *  Create and store user cookies
       *  
       *  $param user: array of user record
       *  @return : void 
       * 
       */
      function rememberMe($user){

        //create a selector and a validator
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));

        $token ="$selector:$validator";

        //hash the validator
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);

        //set expiry to 2 weeks into the future
        $expiryStamp = time() + (14 * 24 * 60 * 60);
        $expiry = date("Y-m-d H:i:s",$expiryStamp);

        try{
        //insert cookies into database
          $sql = "INSERT INTO _user_tokens(user_id, selector, hashed_validator, expiry)
              VALUES(?, ?, ?, ?)";

          $statement = Database::getConnection()->prepare($sql);
          $statement->bind_param("isss", $user["id"],$selector,$validator,$expiry);    

          $statement->execute();

          //create cookie
          setcookie("remember_me", $token, $expiryStamp);

        }
        catch(Exception $ex){
          throw $ex;
        }
      }

      /**
       *  function to log user in
       *  @param user: record of user to be logged in
       *  @returns void
       */
      function logUserIn($user){
        $_SESSION["username"] = isset($user["username"])?$user["username"]:$user["email"];
        $_SESSION["user_id"] = $user["id"];
      }  

      /**
       *  Get user  from the data base using token
       *  @param token :  token from cookie used in search search by
       *  @return : array of record of the user 
       * 
       */
      function getUserByToken($token){
        $tokens = $this->parseToken($token);

        if (!$tokens) {
            return null;
        }

        $selector = $tokens[0];
        $validator = $tokens[1];

        try{
          $sql="SELECT users.* FROM _user_token INNER JOIN users on _user_token.user_id = users.id WHERE selector =? AND expiry > now()";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("s",$selector);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }

      }

      /**
       *  Get user token from the data base using selector
       *  @param selector : selector token to search by
       *  @return : array of record of the user  token
       * 
       */
      function getUserTokenBySelector($selector){

        try{
          $sql="SELECT * FROM _user_token  WHERE selector =? AND expiry > now()";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("s",$selector);
          $stmt->execute();
          $result = $stmt->get_result();
          $object = null;
          while($row=$result->fetch_assoc()){
            $object=$row;
          }
          $stmt->close();
          return $object;
        }
        catch(Exception $ex){
          throw $ex;
        }

      }

      /**
       * function to verify if token is valid, compares what is in cookie with what is on the database
       * 
       * @param token : token gotten from cookie
       * @returns boolean: returns true if the cookies match, false if not
       */
       function tokenIsValid($token){
         //extract selector and validator from token
         $tokenParts = explode($token,":");
         $selector = $tokenParts[0];
         $validator = $tokenParts[1];

         $tokens = $this->getUserTokenBySelector($selector);
          if (!$tokens) {
              return false;
          }

          return password_verify($validator, $tokens["hashed_validator"]);
       }


       /**
        *  function to split cookie token into a selector and validator
        * @param token: token string gotten from cookie
        * @returns array containing selector and validator
        *
        */

       function parseToken(string $token): ?array
      {
          $parts = explode(":", $token);
          if ($parts && count($parts) == 2) {
              return [$parts[0], $parts[1]];
          }
          return null;
       }

      /**
       *  function to delete user Token from database
       *  @param userId: id of the user whose token to delte
       *  @return bool: true if delete happened successfully, false if it did not
       * 
       */

      function deleteUserToken(int $userId): bool
      {
          $sql = "DELETE FROM _user_tokens WHERE user_id = ?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("s", $userId);

          return $stmt->execute();
      }

      /**
       *  function to check if a user is logged in
       *  @returns: boolean true if user is logged in, false if not       * 
       * 
       */
      function isUserLoggedIn(): bool
      {
          // check the session
          if (isset($_SESSION["username"])) {
              return true;
          }

          // check the remember_me in cookie
          $token = filter_input(INPUT_COOKIE, "remember_me", FILTER_SANITIZE_STRING);

          if ($token && $this->tokenIsValid($token)) {

              $user = $this->getUserByToken($token);

              if ($user) {
                  return logUserIn($user);
              }
          }
          return false;
      }

    }
 
 
 