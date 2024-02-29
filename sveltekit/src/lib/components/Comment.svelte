<script>
    import { children } from "svelte/internal";
    import CommentForm from "./CommentForm.svelte";
    import UserTag from "./UserTag.svelte";

   /**
    * Data som kommer in i komponenten
    * <Comment comment = {...} />
    */  
   export let comment;
   export let layer;
</script>

<article style="margin-left: {layer*20}px ;">

   <UserTag details={{username:comment.username, uid:comment.uid}}></UserTag>

   <p class="paragraph">{comment.comment_txt}</p>

   <section id="smallButtonWrapper">
      <img class="smallButton" src="/images/comment_icon.png" alt="comment icon">
      <img class="smallButton" src="/images/like_icon.png" alt="like icon">
     </section>

   {#each comment.children as child}
      
   <svelte:self comment={child} layer={layer+1}></svelte:self>
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

      #userTag{
        display: inline-flex;
        margin: 5px;
        padding: 4px;
        border-bottom: thin black ;
        border-radius: 1px;
        background-color: white;

        .userIcon{
            width: 30px;
            height: 30px;
        }
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
