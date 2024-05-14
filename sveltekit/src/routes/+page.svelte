<script>
   import Load from "$lib/components/Load.svelte";
   import PostForm from "$lib/components/PostForm.svelte";
   import Post from "$lib/components/Post.svelte";
   import CommentForm from "$lib/components/CommentForm.svelte";
   import Comment from "$lib/components/Comment.svelte";

   import { user } from "$lib/stores/user.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth.js";
   import PostManager from "../lib/components/PostManager.svelte";
    import { onMount } from "svelte";

   onMount(async ()=>{
      console.log("on mount")
   })

   afterNavigate(async () => {
      console.log("after navigation")
      $user = await auth();

      if (!$user.auth) {
         goto("/login");
      }
   });

</script>

<section>
   <h1>Latest Posts!</h1>

   <div>
      <PostManager></PostManager>
   </div>
</section>



<style lang="scss">

   section{
      width: 80%;
      left: 50%;
      position: absolute;
      transform: translateX(-50%);
   }
</style>
