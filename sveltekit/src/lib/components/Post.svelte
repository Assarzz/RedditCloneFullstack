
<script>

import PostForm from "$lib/components/PostForm.svelte";
import { each } from "svelte/internal";
import Comment from "./Comment.svelte";

import {CommentTree} from "../shared/commentTree.mjs"
import CommentForm from "./CommentForm.svelte";
import UserTag from "./UserTag.svelte";
import PostActionIcon from "./PostActionIcon.svelte"
import ResponseBar from "./postRepyComponents/ResponseBar.svelte";

export let post;

    const commentTree = new CommentTree(post.commentsData)
    const commentRoot = commentTree.getRoot

    //console.log(commentRoot.children)

</script>

<article>


  <div class="postItem">
    <UserTag details={{username:post.username, uid:post.uid}}></UserTag>
  </div>

  <div class="postItem">
    <ResponseBar></ResponseBar>
  </div>

   <p class="paragraph postItem">{post.post_txt}</p>

   {#each commentRoot.children as commentData }

   <div class="postItem">
    <Comment comment={commentData} layer={1}></Comment>
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



</style>
