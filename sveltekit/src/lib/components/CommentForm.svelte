<script>
   import { update } from "$lib/stores/update.js";

   export let postID;

   async function addComment(e) {
   }
</script>


<form on:submit|preventDefault={addComment}>

   <label for="comment"></label>
   <input type="text" name="comment">
   <button type="submit">Send</button>
   
</form>
<style lang="scss">
   form {
      padding: 5px;
      textarea {
         width: 100%;
         height: 10rem;
         vertical-align: top;
         border: 1px solid rgb(124, 10, 10);
         border-radius: 6px;
         resize: none;
         padding: 0.5rem;
      }

      p {
         display: inline-block;
         color: red;
         font-weight: bold;
         margin-right: 1rem;
      }

      button {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-top: 0.2rem;

         &:enabled:hover {
            background-color: green;
            color: #ffffff;
         }

         &:enabled:active {
            background-color: rgb(4, 50, 4);
            color: #aeaeae;
         }

         &:disabled {
            background-color: lightgrey;
         }
      }
   }
</style>
<!-- <style lang="scss">
   form {
      display: flex;
      flex-direction: row;

      width: 100%;
      input[type="text"] {
         width: 100%;
      }
      
      input[type="submit"] {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-left: 2px;
         &:hover {
            background-color: darkgreen;
            color: #ffffff;
         }
      }
   }
</style> -->
