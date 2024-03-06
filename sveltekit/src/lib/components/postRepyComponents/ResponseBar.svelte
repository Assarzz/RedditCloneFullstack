<script>

    import Like from "./Like.svelte";
    import Dislike from "./Dislike.svelte";
    import ReplyComment from "./ReplyComment.svelte";

    import {setContext} from "svelte"

    // can be "nothing", "like", dislike
    let likeDislike = "nothing"
    let Listeners = []

    const likeObj = {state:"nothing", addListener: function(fn){
        Listeners.push(fn)
    }}
    setContext("likeState", likeObj)

    function like(){
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
<Like on:like={like}></Like>

<Dislike on:dislike={dislike}></Dislike>

<ReplyComment></ReplyComment>
