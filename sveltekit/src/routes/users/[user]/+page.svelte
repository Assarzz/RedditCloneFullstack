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
    afterNavigate(async () => {
        $user = await auth();

        if (!$user.auth) {
            goto("/login");
        }

        console.log(userParam);
        const response = await fetch(`/api/getUserFromUid.php?uid=${userParam}`);
        userData = await response.json();
        console.log(userData);

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




<UserTag details={{username:userData.username, linkNotActive:true}}></UserTag>

{#each commentsData as commentData }
    <p>you responded </p>
    <p>{commentData.comment_txt}</p>
    <p>to </p>
    <p>{commentData.parent_txt}</p>
{/each}