<script>
   import { user } from "$lib/stores/user.js";
   import { goto } from "$app/navigation";

   import {auth} from "$lib/shared/auth.js"

   async function signIn(e) {

      const data = new FormData(e.target);

      const url = "/api/auth.php"

      const response = await fetch(url, {
        method: "post",
        body: data
     });

     const result = await response.json()
      if (result.auth) {
         goto("/")
      }
      else{

         if (logInMessage.failedAttempts > 0){
            logInMessage.message = "Failed to log in(" + logInMessage.failedAttempts+"x)"
         }
         else{
            logInMessage.message = "Failed to log in"
         }
         logInMessage.failedAttempts += 1

      }

   }

   let logInMessage = {message:"", failedAttempts:0}

</script>

<form id="testForm" on:submit|preventDefault={signIn}>

   <label for="usr">Användarnamn</label>
   <input id="usr" type="text" name="username" />

   <label for="pwd">Lösenord</label>
   <input id="pwd" type="password" name="pwd" />

   <input type="submit" value="Logga In" />

</form>

<p id="logInMessage">{logInMessage.message}</p>




<style lang="scss">
   label {
      display: block;
   }

   input {
      width: 100%;

      &[type="submit"] {
         color: white;
         background-color: #42b72a;
         border: none;
         margin: 10px 10px 0 0;
         padding: 0.7rem;
         border-radius: 6px;

         &:hover {
            background-color: green;
         }
      }
   }

   #logInMessage{
      color: red;
      padding: 5px;
   }

</style>
