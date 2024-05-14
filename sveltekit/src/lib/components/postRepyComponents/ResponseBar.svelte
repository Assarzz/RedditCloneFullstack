<script>

    import Like from "./Like.svelte";
    import Dislike from "./Dislike.svelte";
    import ReplyComment from "./ReplyComment.svelte";
    import {onMount, setContext} from "svelte"

    export let details
    const pid = details.pid
    const cid = details.cid


    // can be "nothing", "like", dislike
    let likeDislike = "nothing"
    let Listeners = []

    let likeBtnBeenClicked = false
    let DislikeBtnBeenClicked = false;

    const likeObj = {state:"nothing", addListener: function(fn){
        Listeners.push(fn)
    }}
    setContext("likeState", likeObj)

    function like(){
        likeBtnBeenClicked = true
        if (likeDislike == "nothing"){
            likeDislike = "like"
        }
        else if (likeDislike == "like"){
            likeDislike = "nothing"
        }
        else{ // likeDislike = "dislike"
            likeDislike = "like"
        }
        Listeners.forEach(listener => listener(likeDislike));
    }
    function dislike(e){
        DislikeBtnBeenClicked = true
        if (likeDislike == "nothing"){
            likeDislike = "dislike"
        }
        else if (likeDislike == "dislike"){
            likeDislike = "nothing"
        }
        else{ // likeDislike = "dislike"
            likeDislike = "dislike"
        }
        Listeners.forEach(listener => listener(likeDislike));
    }
</script>
<Like {pid}{cid}{likeBtnBeenClicked} on:like={like}></Like>

<Dislike {pid}{cid}{DislikeBtnBeenClicked} on:dislike={dislike}></Dislike>

<ReplyComment></ReplyComment>
