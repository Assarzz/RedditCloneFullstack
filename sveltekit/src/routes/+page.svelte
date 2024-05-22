<script lang="ts">

   import { user } from "$lib/stores/user.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth";
   import PostManager from "../lib/components/PostManager.svelte";

   import {type PostFull} from "$lib/types/contribution" 
   import {loadUser, loadPostFulls} from "$lib/ts_files/database_com"
    import { onMount } from "svelte";

   export let data: {value:PostFull[]}

   // afterNavigate(async () => {

   //    const authenticated = await auth();

   //    if (authenticated.auth && !$user.auth){
   //       // this is right after the session has been created and we have not yet updated the store
   //       // we update the store!

   //       (async ()=>{
   //          user.set({
   //          user:await loadUser(authenticated.uid!),
   //          auth:true
   //       })})()

   //    }

   //    if (!authenticated.auth) {
   //       goto("/login");
   //    }
   // });

</script>

<section>
   <h1>Latest Posts!</h1>

   <div>
      <PostManager posts={data.value}></PostManager>
   </div>
</section>



<style lang="scss">

section{
      width: 80%;
      margin-left: auto;
      margin-right: auto;
   }
</style>
