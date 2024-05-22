<script lang="ts">
    import type { CommentWithUser, Contribution, CommentFull } from "$lib/types/contribution";
    import UserTag from "./UserTag.svelte";
    import ResponseBar from "./postRepyComponents/ResponseBar.svelte";
    import ReplyComment from "./postRepyComponents/ReplyComment.svelte";
    import ReplyCommentForm from "./postRepyComponents/ReplyCommentForm.svelte";
    import { fade, fly } from 'svelte/transition';

    export let contribution: Contribution;
    export let layer:number

    let replyCommentFormActive = false;
    let addedComment:CommentFull|null = null;
    function handleCreatedComment(event:any){
        console.log(event.detail);
        addedComment = event.detail;
        replyCommentFormActive = false;

    }

</script>


<article style="margin-left: {layer * 20}px ;">
    <div class="postItem">
        <UserTag
            user={contribution.user}
            highlightOwner={false}
            linkNotActive={false}
        ></UserTag>
    </div>

    <div class="postItem">
        <ReplyComment  bind:formActive={replyCommentFormActive}></ReplyComment>

    </div>

    {#if replyCommentFormActive}
<ReplyCommentForm contribution={contribution} on:Create={handleCreatedComment}  on:Cancel={()=>{replyCommentFormActive = false}} ></ReplyCommentForm>
    {/if}
    <p class="paragraph postItem">{contribution.content}</p>


    {#each contribution.directChildren as child}
        <div class="postItem">
            <svelte:self
                contribution={child}
                layer={layer + 1}
            ></svelte:self>
        </div>
    {/each}

    {#if addedComment}
    <div class="postItem" transition:fade={{ delay: 250, duration: 300 }}> 
        <svelte:self
            contribution={addedComment}
            layer={layer + 1}
        ></svelte:self>
    </div>   
    {/if}

</article>

<!-- {#if "post" in contribution}
    <article>
        <div class="postItem">
            <UserTag
                user={contribution.post.user}
                highlightOwner={false}
                linkNotActive={false}
            ></UserTag>
        </div>

        <div class="postItem">
            <ResponseBar details={{ pid: contribution.post.pid, cid: null }}
            ></ResponseBar>
            <ReplyComment  bind:formActive={replyCommentFormActive}></ReplyComment>

        </div>

        <p class="paragraph postItem">{contribution.post.content}</p>

        {#each contribution.post.directChildren as comment}
            <div class="postItem">
                <svelte:self contribution={{ comment, layer: 1 }}></svelte:self>
            </div>
        {/each}
    </article>
{/if} -->




<style lang="scss">

    #test{
        display: block;
        width: 100px;
        height: 100px;
        background-color: red;
    }

// #separate{
//         margin: 0;
//         padding: 0;
//         border: 0;
//         height: 1px;
//         background-color: $mediumDark2;
//     }
    article {
        background: $mainDark1;
        padding: 10px;

        .postItem {
            margin: 5px;
            padding: 5px;
        }

        .paragraph {
            color: $mainLight4;
            padding-top: 5px;
            padding-bottom: 10px;
            padding-left: 4px;
            border-left: thin solid $mediumDark2;
        }
    }
</style>
