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
      color: $mainLight4;
      margin-left: auto;
      margin-right: auto;
   }
   #createAccount{
      @include defaultBtn();
      background-color: blue;

   }
</style>