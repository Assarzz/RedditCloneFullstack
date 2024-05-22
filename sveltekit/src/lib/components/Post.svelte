<!-- 
<script lang="ts">

import Comment from "./Comment.svelte";
import ResponseBar from "./postRepyComponents/ResponseBar.svelte";

import UserTag from "./UserTag.svelte";
import {type PostFull} from "$lib/types/contribution"

export let post:PostFull;

</script>

<article>


  <div class="postItem">
    <UserTag user={post.user} highlightOwner={false} linkNotActive={false}></UserTag>
  </div>

  <div class="postItem">
    <ResponseBar details={{pid:post.pid, cid:null}}></ResponseBar>
  </div>

   <p class="paragraph postItem">{post.content}</p>

   {#each post.directChildren as comment }

   <div class="postItem">
    <Comment comment={comment} layer={1}></Comment>
   </div>
   {/each}


</article>

<style lang="scss">

   article{
      background: $mainDark1;
      padding: 3px;


      .postItem{
        margin: 5px;
      }

      .paragraph{
        color: $mainLight4;
        padding-top: 5px;
        padding-bottom: 10px;
        padding-left: 4px;
        border-left: thin solid $mediumDark2;
      }

   }



</style> -->
