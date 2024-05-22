<script>
   import { goto } from "$app/navigation";

   async function signIn(e) {
      
      const data = new FormData(e.target);
      const response = await fetch("/api/auth.php", {
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

<form on:submit|preventDefault={signIn}>

   <label for="usr">Användarnamn</label>
   <input type="text" name="username" />

   <label for="pwd">Lösenord</label>
   <input type="password" name="pwd" />

   <input type="submit" value="Logga In" />

</form>

{#if logInMessage.message.length >0}

<div id="alert">

   <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" {...$$props}><path fill="currentColor" d="M10.425 1.414a3.33 3.33 0 0 1 3.026-.097l.19.097l6.775 3.995l.096.063l.092.077l.107.075a3.224 3.224 0 0 1 1.266 2.188l.018.202l.005.204v7.284c0 1.106-.57 2.129-1.454 2.693l-.17.1l-6.803 4.302c-.918.504-2.019.535-3.004.068l-.196-.1l-6.695-4.237a3.225 3.225 0 0 1-1.671-2.619L2 15.502V8.217c0-1.106.57-2.128 1.476-2.705zM12.01 15l-.127.007a1 1 0 0 0 0 1.986L12 17l.127-.007a1 1 0 0 0 0-1.986zM12 7a1 1 0 0 0-.993.883L11 8v4l.007.117a1 1 0 0 0 1.986 0L13 12V8l-.007-.117A1 1 0 0 0 12 7"/></svg>
   <p>{logInMessage.message}</p>

</div>
{/if}


<style lang="scss">
   #alert{
      color: red;
      display: flex;
      justify-content: center;
      align-items: center;
   }

   form{

      input[type=text], input[type=password] {
         @include defaultInput();
      }

      input[type=submit]{
         @include defaultBtn();
      }

   }
</style>


