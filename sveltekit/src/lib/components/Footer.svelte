<script>
   import { user } from "$lib/stores/user.js";
</script>

<footer>
   <p>
      EGY TALK
      {#if $user.auth}
         Användare:
         {$user.userdata.firstname + " " + $user.userdata.surname}
      {/if}
   </p>
</footer>


<style lang="scss">
   footer {
      height: 45px;
      width: 100%;
      border-top: thin solid $mainLight4;
      background-color: $mainDark1;
      color: $mainLight4;

      p{
         padding-left: 5px;
      }
   }
</style>
