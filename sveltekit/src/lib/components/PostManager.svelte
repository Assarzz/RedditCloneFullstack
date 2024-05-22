<script lang="ts">
    import { onMount } from "svelte";
    import Post from "./Post.svelte";
    import {loadPostFulls} from "$lib/ts_files/database_com"
    import {type PostFull} from "$lib/types/contribution"
    import { fade, fly } from 'svelte/transition';


    import Contribution from "./Contribution.svelte";
    import ReplyComment from "./postRepyComponents/ReplyComment.svelte";
    import ReplyCommentForm from "./postRepyComponents/ReplyCommentForm.svelte";
    import CreatePostForm from "./CreatePostForm.svelte";

    export let posts:PostFull[]

  async function increasePostsToLoad(postsToLoad:number) {
    const loadedPosts = posts.length
    const newPosts = (await loadPostFulls(loadedPosts+1, postsToLoad)).value
    posts = [...posts, ...newPosts]
  }

  let createPostFormActive = false;
  function handleCreatedPost(event:any){
        console.log(event.detail);
        let addedPost:PostFull = event.detail;
        createPostFormActive = false;
        posts = [addedPost, ...posts]

    }
</script>

<article>


  <button on:click={()=>{createPostFormActive = !createPostFormActive}} id="createPost">
    Create Post
    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" {...$$props}><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
  </button>

  {#if createPostFormActive}
    <CreatePostForm on:Cancel={()=>{createPostFormActive = false}} on:Create={handleCreatedPost}></CreatePostForm>
  {/if}

  <!-- {#if addedPost}
  <section transition:fade={{ delay: 250, duration: 300 }} class="posts">
    <Contribution contribution={addedPost} layer={0}></Contribution>
  </section>
  {/if} -->

  <!-- if posts are not undefined -->
  {#if posts && posts.length > 0}
  {#each posts as post (post.pid)} <!-- Add a unique key if available -->
    <section transition:fade={{ delay: 250, duration: 300 }} class="posts">
      <Contribution contribution={post} layer={0}></Contribution>
    </section>
  {/each}
{/if}


<button id="loadMore" on:click={async()=>{increasePostsToLoad(1)}}>Load more posts</button>


</article>

<style lang="scss">

  #createPost{
    @include defaultBtn();
  margin-bottom: 10px;
    background-color: $mediumLight3;
    padding: 20px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 10px;

    *{
      color: $mediumDark2;
    }
    color: $mediumDark2;


  }

article{

  .posts{
    margin-bottom: 10px;
  }
  #loadMore{
  @include defaultBtn();
  margin-bottom: 10px;
  color: $mediumDark2;

  
}
}

</style>