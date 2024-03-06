<script>
   import Auth from "$lib/components/Auth.svelte";
   import { goto } from '$app/navigation';
</script>

<section>
   <h1>EGY Talk Login</h1>
   <Auth />
   <p>eller</p>
   <button id="createAccount" on:click={() => goto('/createaccount')}>Skapa Konto</button>
</section>


<style lang=scss>

   section{
      width: 60%;
      left: 50%;
      position: absolute;
      transform: translateX(-50%);
      color: $mainLight4;
   }
   #createAccount{
      @include defaultBtn();
      background-color: blue;

   }
</style>