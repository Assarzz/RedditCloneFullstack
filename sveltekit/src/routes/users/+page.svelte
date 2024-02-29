<script>
    import { onMount } from "svelte";
    import UserTag from "../../lib/components/UserTag.svelte";
    import { goto, afterNavigate } from "$app/navigation";
    import { user } from "$lib/stores/user.js";
    import { auth } from "$lib/shared/auth.js";

    import { page } from '$app/stores';
    let userParam = $page.params.user;



    afterNavigate(async () => {
      $user = await auth();

      if (!$user.auth) {
         goto("/login");
      }
   });



    
    let allUsers = []
    onMount(async ()=>{
        const response = await fetch("/api/getAllUsers.php");
        allUsers = await response.json()
    })
</script>


{#each allUsers as User }
    
    <UserTag details={{username:User.username, uid:User.uid, highlightOwner:false}}></UserTag>
{/each}