<script lang="ts">

    import type {Contribution, PostBase, CommentBase, CommentFull, PostFull} from "$lib/types/contribution"
    import {user} from "$lib/stores/user"


    import { createEventDispatcher } from "svelte";
    const dispatch = createEventDispatcher();
        
    // the post/comment we are going to comment on.
    let content = "";

    function cancel(){
        dispatch("Cancel");
    }

    async function submitForm(){

        let formData = new FormData();
        formData.append("uid", $user.user?.uid+"");
        formData.append("post_txt", content);

        // use await fetch
        let response = await fetch("/api/addPost.php", {
            method: "POST",
            body: formData
        });
        let data:{success:string} = await response.json();

        // if post request falied
        if (!response.ok){
            console.log("Failed to add post");
            return;
        }

        let newPost: PostFull = {
            content: content,
            user: $user.user!,
            pid: parseInt(data.success),
            uid: $user.user!.uid,
            directChildren: []
        }
        dispatch("Create", newPost);
    }

</script>

<article>

<form on:submit|preventDefault={submitForm} method="post" id="contentForm">

    <textarea bind:value={content} name="content" id=""></textarea>

    <div id="sideBtn">
        <button type="submit">Create Post</button>
        <button on:click={cancel}> Cancel</button>
    </div>

</form>



</article>

<style lang="scss">

    #separate{
        margin: 0;
        padding: 0;
        border: 0;
        height: 1px;
        background-color: $mediumDark2;
    }

    article{
        background-color: $mainDark1;
        display: flex;
        flex-direction: column;
        border-radius: 20px;
        padding: 10px;

        p{
            color: $mediumLight3;
            margin: 0;

        }
    }

#contentForm{
        margin: 10px;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        // make the flex item take up the full width of the container
        width: 100%;
        align-items: start;
        padding: 0%;
        margin: 0;
        gap: 0;

        textarea{
            border-radius: 12px;
            background-color: $mainLight4;
            color: $mainDark1;
            width: 100%;
            box-sizing: border-box;
            flex-grow: 1;
            margin: 5px;
            padding: 10px;
            align-self: center;
        }

        #sideBtn{

            display: flex;
            margin: 5px;
            align-self: flex-end;

            button{
                border-radius: 12px;
                padding: 6px;
                background-color: $mediumLight3;
                color: $mainDark1;
            }
        }


    }

</style>