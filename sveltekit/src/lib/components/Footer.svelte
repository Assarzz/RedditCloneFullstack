<script lang="ts">
   import { user as userStore } from "$lib/stores/user";
   import type {User} from "$lib/types/contribution";
</script>

<footer>
   <p>
      EGY TALK
      {#if $userStore.auth}
         Användare:
         {$userStore.user?.firstName} {$userStore.user?.lastName}
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
