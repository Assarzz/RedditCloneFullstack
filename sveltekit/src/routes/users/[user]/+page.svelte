<script>
    import { onMount } from "svelte";
    import UserTag from "../../../lib/components/UserTag.svelte";
    import { goto, afterNavigate } from "$app/navigation";
    import { user } from "$lib/stores/user.js";
    import { auth } from "$lib/shared/auth.js";

    import { page } from "$app/stores";
    import { each } from "svelte/internal";

    let userParam = $page.params.user;
    let userData = []
    let commentsData = []
    let postsData = []

    function upperCase(str){

        if (!str){
            return
        }
            let result = str.charAt(0).toUpperCase() + str.slice(1);
            return result
        }
    afterNavigate(async () => {
        $user = await auth();

        if (!$user.auth) {
            goto("/login");
        }



        const responsePosts = await fetch(`/api/getAllPostsFromUid.php?uid=${userParam}`)
        postsData = await responsePosts.json()

        const response = await fetch(`/api/getUserFromUid.php?uid=${userParam}`);
        userData = await response.json();

        const response2 = await fetch(`/api/getCommentsAndOPFromUid.php?uid=${userParam}`)
        commentsData = await response2.json()
    });



    /* ||| this is how the item of the commentsData array look like|||
    {
"cid": 4,
"comment_txt": "I don't now what is going on but i agree.",
"uid": "956eef04-c402-11ee-b2a4-0242ac150003",
"pcid": 3,
"ppid": null,
"parent_txt": "You are the cutest dog!",
"parent_uid": "8be58e91-c02c-11ee-bc34-0242ac150002",
"user": {
"uid": "956eef04-c402-11ee-b2a4-0242ac150003",
"firstname": "Bert",
"surname": "Berticus",
"username": "NotBert",
"password": "$2y$10$6uSB54XBjj6GP0jZLmOl7.miXKbi4o1rSy6p6sO2iUC5TlMKj1Pby"
},
"parentUser": {
"uid": "8be58e91-c02c-11ee-bc34-0242ac150002",
"firstname": "assar",
"surname": "lannerborn",
"username": "assar2",
"password": "$2y$10$L3He3Z0Seaw08Y60JsDXDuoMOIju3AeePfZu2094H1I9bP4ebWGou"
}
}
    */
</script>

<article>

    <div id="superIntro">
        <div id="intro">

            <div id="title" class="item2">
    
                <svg class="item" xmlns="http://www.w3.org/2000/svg" width="5em" height="5em" viewBox="0 0 24 24" {...$$props}><g stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m13.163 2.168l8.021 5.828c.694.504.984 1.397.719 2.212l-3.064 9.43a1.978 1.978 0 0 1-1.881 1.367H7.042a1.978 1.978 0 0 1-1.881-1.367l-3.064-9.43a1.978 1.978 0 0 1 .719-2.212l8.021-5.828a1.978 1.978 0 0 1 2.326 0"/><path d="M12 13a3 3 0 1 0 0-6a3 3 0 0 0 0 6m-6 7.703V20a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v.707"/></g></svg>
                
                <h1 class="item">{userData.username} </h1>
            
            </div>
                <p class="item2">{upperCase(userData.firstname)+" "+upperCase(userData.surname) }</p>
    
        </div>
    </div>





{#each postsData as postData}
     {postData.post_txt}
{/each}


Comments

{#each commentsData as commentData }
    <p>you responded </p>
    <p>{commentData.comment_txt}</p>
    <p>to </p>
    <p>{commentData.parent_txt}</p>
{/each}
</article>


<style lang="scss">

article{
    color: $mainDark1;
    width: 70%;
    left: 50%;
    position: absolute;
    transform: translateX(-50%);
    background-color: $mainDark1;

    #superIntro{
        background-image: linear-gradient(to right, $mediumLight3, $mediumDark2);
        margin: 10px;
        widows: 100%;

    }

    #intro{
        margin: 15px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        
        .item2{
            color: $mainDark1;
            margin: 0;
        }
    }
    #title{
        display: flex;
        justify-content: start;
        align-items: center;

    }

    .item{
        *{
            color: $mainLight4;
            stroke: $mainLight4;
            fill: transparent;
        }
    }
}

</style>