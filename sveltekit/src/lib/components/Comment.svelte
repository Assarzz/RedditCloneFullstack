<script>
    import { children, onMount } from "svelte/internal";
    import CommentForm from "./CommentForm.svelte";
    import UserTag from "./UserTag.svelte";
    import ResponseBar from "./postRepyComponents/ResponseBar.svelte";

   /**
    * Data som kommer in i komponenten
    * <Comment comment = {...} />
    */  
   export let comment;
   export let layer;

   onMount(()=>{
      //console.log(comment)
   })
</script>

<article style="margin-left: {layer*20}px ;">

   <div class="postItem">
      <UserTag details={{username:comment.username, uid:comment.uid}}></UserTag>

    </div>

    <div class="postItem">
      <ResponseBar details={{pid:null, cid:comment.cid}}></ResponseBar>
    </div>
  

   <p class="paragraph postItem">{comment.comment_txt}</p>


   {#each comment.children as child}
   
   <div class="postItem">
      <svelte:self comment={child} layer={layer+1}></svelte:self>
   </div>
   {/each}


</article>
<style lang="scss">

   article{
      background: $mainDark1;

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


// <style lang="scss">

// article{
//    background: rgb(249, 246, 238);
//    border: thin solid white;

//    border-left: thin black solid;

//    .paragraph{
//      background-color: white;
//      border-left: 1px black dotted;
//      margin: 5px;
//      padding: 10px;
//    }

//    #userTag{
//      display: inline-flex;
//      margin: 5px;
//      padding: 4px;
//      border-bottom: thin black ;
//      border-radius: 1px;
//      background-color: white;

//      .userIcon{
//          width: 30px;
//          height: 30px;
//      }
//    }


//      .smallButton{
//      width: 30px;
//      height: 30px;
//      background-color: white;
//      margin: 10px;
//      margin-left: 5px;

//    }


//    // h1{
//    //    padding: 5px;
//    //    margin: 5px ;
//    // }
//    // p{
//    //    padding: 5px;
//    //    margin: 20px;
//    // }

// }
// </style>
