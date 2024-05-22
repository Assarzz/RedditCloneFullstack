<script lang="ts">
    import { onMount } from "svelte";
    import type {User} from "$lib/types/contribution"
    import {user as userStore} from "$lib/stores/user"
    export let user:User
    
    let ownerIsUser = false

    $: if($userStore.user){
        if (user.uid == $userStore.user.uid){
            ownerIsUser = true
        }
    }
    onMount(()=>{
        if (!$userStore.user){
            return
        }
        if (user.uid == $userStore.user?.uid){
            ownerIsUser = true
        }
        else{
            ownerIsUser = false
        }
    })

</script>

<a href="/users/{user.uid}">

    <section id="userTag"  class="{ownerIsUser? "owner":""} item">
        <svg class="item" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" {...$$props}><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
        
        <h2 class="item">{user.userName}</h2>
        {#if ownerIsUser}
        <svg class="star" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" {...$$props}><path fill="currentColor" d="m8.243 7.34l-6.38.925l-.113.023a1 1 0 0 0-.44 1.684l4.622 4.499l-1.09 6.355l-.013.11a1 1 0 0 0 1.464.944l5.706-3l5.693 3l.1.046a1 1 0 0 0 1.352-1.1l-1.091-6.355l4.624-4.5l.078-.085a1 1 0 0 0-.633-1.62l-6.38-.926l-2.852-5.78a1 1 0 0 0-1.794 0z"/></svg>
        {/if}
    </section>
    
</a>




<style lang="scss">


.star *{
    color: gold;
}


a{

    section{

        display: inline-flex;
        justify-content: center;
        align-items: center;

        padding: 0;
        margin: 0;

        *{
            color: $mediumLight3;
            padding: 0;
        margin: 0;

        }

        &.owner{

    }
    }


}

    // a{
    //     text-decoration: none;
    //     color: inherit;

    //     #userTag{
    //     display: inline-flex;
    //     margin: 5px;
    //     padding: 4px;
    //     border-bottom: thin black ;
    //     border-radius: 1px;
    //     background-color: white;
    //     justify-content: center;
    //     .userIcon{
    //         width: 30px;
    //         height: 30px;
    //     }

    //     &.owner{
    //         color: greenyellow;

    //     }

    //   }

    // }







</style>