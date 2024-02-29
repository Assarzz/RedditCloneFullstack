
<script>

import PostForm from "$lib/components/PostForm.svelte";
    import { each } from "svelte/internal";
import Comment from "./Comment.svelte";

import {CommentTree} from "../shared/commentTree.mjs"
    import CommentForm from "./CommentForm.svelte";
import UserTag from "./UserTag.svelte";
import PostActionIcon from "./PostActionIcon.svelte"
export let post;

    const commentTree = new CommentTree(post.commentsData)
    const commentRoot = commentTree.getRoot

    //console.log(commentRoot.children)

</script>

<article>


  <UserTag details={{username:post.username, uid:post.uid}}></UserTag>

   <p class="paragraph">{post.post_txt}</p>

   <section id="smallButtonWrapper">
    <!-- <img class="smallButton" src="/images/comment_icon.png" alt="comment icon">
    <img class="smallButton" src="/images/like_icon.png" alt="like icon"> -->

   </section>

   {#each commentRoot.children as commentData }

   <Comment comment={commentData} layer={1}></Comment>
   {/each}



</article>

<style lang="scss">
   // article {
   //    border-bottom: 1px solid black;
   //    display: block;
   //    width: 100%;
   //    padding: 4px;
   //    margin-top: 6px;
   //    margin-bottom: 6px;
   //    background-color: white;

   //    p {
   //       font-size: 1.6rem;
   //    }
   // }

   article{
      background: rgb(249, 246, 238);
      border: thin solid white;

      border-left: thin black solid;

      .paragraph{
        background-color: white;
        border-left: 1px black dotted;
        margin: 5px;
        padding: 10px;
      }
      


        .smallButton{
        width: 30px;
        height: 30px;
        background-color: white;
        margin: 10px;
        margin-left: 5px;

        

      }


      // h1{
      //    padding: 5px;
      //    margin: 5px ;
      // }
      // p{
      //    padding: 5px;
      //    margin: 20px;
      // }

   }
</style>
