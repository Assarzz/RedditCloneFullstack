<!-- 
{#if searchActive}
<form on:submit|preventDefault={submitForm} method="post" id="contentForm">

    <input type="text" name="content" bind:value={content} >

</form>
{/if}

<script>
    export let details
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
    let content = ""
    let searchActive = false
    async function submitForm() {
        console.log("adfg")
        const response = await fetch(`/api/getUserFromUsername.php?username=${content}`)
        const user = await response.json()
        if (!response.ok) {
            dispatch("Search",content );
            return
        }
        dispatch("Search",user.uid );
    }


</script> -->


<svg xmlns="http://www.w3.org/2000/svg" width={details.width} height={details.height} viewBox="0 0 24 24" {...$$props}><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6"/></svg>

<script>
    export let details
</script>

