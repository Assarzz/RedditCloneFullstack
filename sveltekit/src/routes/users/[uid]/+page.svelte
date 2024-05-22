<script lang="ts">
    import type { PageData } from "./$types";
    import {user as UserStore} from "$lib/stores/user";
    import { afterNavigate, goto } from "$app/navigation";
    export let data: PageData;
    import { auth } from "$lib/shared/auth";


    let user = data.user;
    let posts = data.posts
    let commentUserOPComments = data.commentUserOPComments

    $: {
    user = data.user;
    posts = data.posts;
    commentUserOPComments = data.commentUserOPComments;
  }

    
    function upperCase(str:string) {
        if (!str) {
            return ""
        }
        let result = str.charAt(0).toUpperCase() + str.slice(1);
        return result;
    }

    // afterNavigate(async()=>{

    //     const authenticated = await auth();

    //     if (!authenticated.auth){
    //         goto("/")
    //     }
    // })


</script>

<article>
    <div id="superIntro">
        <div id="intro">
            <div id="title" class="item2">
                <svg
                    class="item"
                    xmlns="http://www.w3.org/2000/svg"
                    width="5em"
                    height="5em"
                    viewBox="0 0 24 24"
                    {...$$props}
                    ><g
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        ><path
                            d="m13.163 2.168l8.021 5.828c.694.504.984 1.397.719 2.212l-3.064 9.43a1.978 1.978 0 0 1-1.881 1.367H7.042a1.978 1.978 0 0 1-1.881-1.367l-3.064-9.43a1.978 1.978 0 0 1 .719-2.212l8.021-5.828a1.978 1.978 0 0 1 2.326 0"
                        /><path
                            d="M12 13a3 3 0 1 0 0-6a3 3 0 0 0 0 6m-6 7.703V20a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v.707"
                        /></g
                    ></svg
                >

                <h1 class="item">{user.userName}</h1>
            </div>
            <p class="item2">
                {upperCase(user.firstName) + " " + upperCase(user.lastName)}
            </p>
        </div>
    </div>

    <h1 style="margin: 10px;">Posts</h1>
    {#each posts as post}

    <section class="post">
        {post.content}
    </section>
    {/each}
    <!-- Comments

    {#each commentsData as commentData}
        <p>you responded</p>
        <p>{commentData.comment_txt}</p>
        <p>to</p>
        <p>{commentData.parent_txt}</p>
    {/each} -->
</article>




<style lang="scss">

    .post{
        background-color: $mainDark1;
        padding: 20px;
        margin: 8px;
    }

article{
    color: $mainDark1;
    width: 70%;
    background-color: $mainDark1;
    margin-left: auto;
    margin-right: auto;
    padding: 30px;
    height: 100%;

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
