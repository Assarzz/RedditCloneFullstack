<script>
    import { onMount } from "svelte";
    import Post from "./Post.svelte";

    onMount(async () => {
    await loadPosts(0, 1);
  });

  function increasePostsToLoad() {
    const currentPostCount = posts.length;
    loadPosts(currentPostCount+1, currentPostCount + 1);
  }

    let posts = []
    async function loadPosts(pidStart, pidEnd) {

        const response = await fetch(`/api/getPosts.php?pidStart=${pidStart}&pidEnd=${pidEnd}`);
        const postsData = await response.json();

        
        for (const postData of postsData) {

          // get firstname, surname, username from uid
          const responseUser = await fetch(`/api/getUserFromUid.php?uid=${postData.uid}`)
          const userData = await responseUser.json()

          // get all comments to the post
          const responseComments = await fetch(`api/getCommentsFromPid.php?pid=${postData.pid}`)
          const commentsData = await responseComments.json()

          //assign the userData and commentData to the postData so that i have access to it in the post element
          Object.assign(postData,  {...userData, commentsData})
        }
        posts = posts.concat(postsData);

  }

</script>

<article>

  {#each posts as postData}

  <section class="posts">
    <Post post={postData}></Post>
  </section>
{/each}


<button id="loadMore" on:click={increasePostsToLoad}>Load more posts</button>


</article>



<style lang="scss">

article{

  .posts{
    margin-bottom: 10px;
  }
  #loadMore{
  @include defaultBtn();
  
}
}

</style>