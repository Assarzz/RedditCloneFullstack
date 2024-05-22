<script  lang="ts">
   //import "$lib/global.scss";
   import Header from "$lib/components/Header.svelte";
   import Footer from "$lib/components/Footer.svelte";


   import { user } from "$lib/stores/user.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth";
   import PostManager from "../lib/components/PostManager.svelte";

   import {type PostFull} from "$lib/types/contribution" 
   import {loadUser, loadPostFulls} from "$lib/ts_files/database_com"
    import { onMount } from "svelte";
    import type { AfterNavigate } from "@sveltejs/kit";

   afterNavigate(async (navigation:AfterNavigate) => {

      if (navigation.to?.url.pathname == "/login"){
         return
      }
      const authenticated = await auth();

      if (authenticated.auth && !$user.auth){
         // this is right after the session has been created and we have not yet updated the store
         // we update the store!

         (async ()=>{
            user.set({
            user:await loadUser(authenticated.uid!),
            auth:true
         })})()

      }

      if (!authenticated.auth) {
         goto("/login");
      }
      });
</script>

<head:title>
   <title>EGY Talk</title>
</head:title>

<div id="app">

<Header />
<main>
   <slot />
</main>
<Footer />

</div>


<style lang="scss">


   #app{
      display: flex;
      flex-direction: column;
      gap: 20px;
      justify-content: space-between;
      min-height: 100vh;
   }

   :global(body){
      background-color: $mediumDark2;
      margin: 0;
      padding: 0;
   }
</style>
