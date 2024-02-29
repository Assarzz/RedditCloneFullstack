<script>
    import { onMount } from "svelte";

    export let details

    // example of how you use it
    //  <UserTag details={{username:post.username, uid:post.uid}}></UserTag>


    let ownerIsUser = false
    onMount(async () => {

        if (details.highlightOwner === false){
            return
        }
        ownerIsUser = await isOwnerTheViewingUser();
    });


    async function isOwnerTheViewingUser(){

        const response1 = await fetch(`/api/isUidFromUser.php?uid=${details.uid}`)
        const returnData = await response1.json()

        if (returnData.uidIsUser){
            return true
        }
        return false
    }
</script>

{#if details.linkNotActive === true}

<a href="">

    <section id="userTag"  class={ownerIsUser? "owner":""}>
        <img class="userIcon" src="/images/Sample_User_Icon.png" alt="User icon">
        <h2 >{details.username}</h2>
    </section>
</a>
{/if}

{#if !details.linkNotActive}

<a href="/users/{details.uid}">

    <section id="userTag"  class={ownerIsUser? "owner":""}>
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24" {...$$props}><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>        <h2 >{details.username}</h2>
    </section>
    
</a>

{/if}




<style lang="scss">


    a{
        text-decoration: none;
        color: inherit;

        #userTag{
        display: inline-flex;
        margin: 5px;
        padding: 4px;
        border-bottom: thin black ;
        border-radius: 1px;
        background-color: white;
        justify-content: center;
        .userIcon{
            width: 30px;
            height: 30px;
        }

        &.owner{
            color: greenyellow;

        }

      }

    }







</style>