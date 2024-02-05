<script>
    import { onMount } from "svelte";
    import Post from "./Post.svelte";

    onMount(async () => {
    await loadPosts(0, 2);
  });

  function increasePostsToLoad() {
    const currentPostCount = posts.length;
    loadPosts(currentPostCount+1, currentPostCount + 2);
  }

    let posts = []
    async function loadPosts(pidStart, pidEnd) {
        const response = await fetch(`/api/getPostsAndTheirOwners.php?pidStart=${pidStart}&pidEnd=${pidEnd}`);
        const data = await response.json();
        posts = posts.concat(data);

        console.log(data)
  }

</script>



{#each posts as postElement}
  <Post post={postElement}></Post>
{/each}

<button on:click={increasePostsToLoad}>Load more posts</button>